<?php
session_start();
if(!isset($_SESSION['username'])){
  header("location:login");
}
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header(){
    // Logo
    $this->Image('fpdf/logo.png',10,8,24);
    // Arial bold 12
    $this->SetFont('Arial','B',12);
    // Geser Ke Kanan 30mm
    $this->Cell(30);
    // Judul
    $this->Cell(30,5,'LAPORAN DATA BARANG MASUK',0,1,'L');
    $this->Cell(30);
    $this->Cell(30,5,'KANTOR BKKBN BANJARMASIN',0,1,'L');
    $this->Cell(30);
    $this->Cell(30,5,'PERIODE '.tgl_indo(date('Y-m-d')),0,1,'L');
    $this->Cell(30);
    $this->SetFont('Arial','',11);
    $this->Cell(30,5,'Jl. Gatot Subroto No.9, Banjarmasin, Kalimantan Selatan 70235',0,1,'L');
    // Garis Bawah Double
    $this->SetLineWidth(1);
    $this->Line(10,31,342,31);
    $this->SetLineWidth(0);
    $this->Line(10,32,342,32);
    // Line break 5mm
    $this->Ln(6);
}


// Page footer
function Footer(){
    // Posisi 15 cm dari bawah
    $this->SetY(-15);
    

    // Arial italic 8
    $this->SetFont('Arial','',8);
    

    // Page number
    $this->Cell(0,10,'Halaman '.$this->PageNo().' / {nb}',0,0,'R');
}
}

//Membuat file PDF
$pdf = new PDF('L','mm','Legal');

//Alias total halaman dengan default {nb} (berhubungan dengan PageNo())
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

//Mencetak kalimat dengan perulangan
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(6,6,'NO',1,0,'C',0);
$pdf->Cell(40,6,'NO. FAKTUR / PO',1,0,'C',0);
$pdf->Cell(40,6,'TANGGAL MASUK',1,0,'C',0);
$pdf->Cell(50,6,'NAMA BARANG',1,0,'C',0);
$pdf->Cell(50,6,'ASAL BARANG',1,0,'C',0);
$pdf->Cell(18,6,'JUMLAH',1,0,'C',0);
$pdf->Cell(30,6,'HARGA SATUAN',1,0,'C',0);
$pdf->Cell(30,6,'KATEGORI',1,0,'C',0);
$pdf->Cell(25,6,'INVENTARIS',1,0,'C',0);
$pdf->Cell(45,6,'KETERANGAN',1,1,'C',0);

$pdf->SetFont('Arial','',10);
 
include 'koneksi.php';
$bl = $_GET['bln'];

if($_GET['bln']=='ALL'){
    $sql = mysqli_query($konek,"SELECT*FROM brg_masuk");
}else if($_GET['bln']=='HIS'){
	$sql = mysqli_query($konek,"SELECT*FROM brg_masuk WHERE inventaris='SUDAH'");
}else{
    if(isset($_GET['bln'])){
        
        $tg = explode('-', $_GET['bln']);
        $th = $tg[0];
        $bl = $tg[1];
        
        $sql = mysqli_query($konek,"SELECT*FROM brg_masuk WHERE month(tgl)='$bl' AND year(tgl)='$th'");
    }else{
        $sql = mysqli_query($konek,"SELECT*FROM brg_masuk WHERE inventaris='BELUM'");
    }
}

$no =1;
while($hasil=mysqli_fetch_array($sql)){
  $pdf->SetFont('Arial','',9);

  $cellWidth=45; //lebar sel
  $cellHeight=6; //tinggi sel satu baris normal
  
  //periksa apakah teksnya melibihi kolom?
  if($pdf->GetStringWidth($hasil['ket']) < $cellWidth){
    //jika tidak, maka tidak melakukan apa-apa
    $line=1;
  }else{
    //jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
    //dengan memisahkan teks agar sesuai dengan lebar sel
    //lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel
    
    $textLength=strlen($hasil['ket']);  //total panjang teks
    $errMargin=5;   //margin kesalahan lebar sel, untuk jaga-jaga
    $startChar=0;   //posisi awal karakter untuk setiap baris
    $maxChar=0;     //karakter maksimum dalam satu baris, yang akan ditambahkan nanti
    $textArray=array(); //untuk menampung data untuk setiap baris
    $tmpString="";    //untuk menampung teks untuk setiap baris (sementara)
    
    while($startChar < $textLength){ //perulangan sampai akhir teks
      //perulangan sampai karakter maksimum tercapai
      while( 
      $pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
      ($startChar+$maxChar) < $textLength ) {
        $maxChar++;
        $tmpString=substr($hasil['ket'],$startChar,$maxChar);
      }
      //pindahkan ke baris berikutnya
      $startChar=$startChar+$maxChar;
      //kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
      array_push($textArray,$tmpString);
      //reset variabel penampung
      $maxChar=0;
      $tmpString='';
      
    }
    //dapatkan jumlah baris
    $line=count($textArray);
  }
  
  //tulis selnya
  $pdf->SetFont('Arial','',9);
  $pdf->Cell(6,($line * $cellHeight),$no++,1,0,'C',true);
  $pdf->Cell(40,($line * $cellHeight),$hasil['no_faktur'],1,0,'L',0);
  $pdf->Cell(40,($line * $cellHeight),tgl_indo($hasil['tgl']),1,0,'L',0);
  $pdf->Cell(50,($line * $cellHeight),$hasil['nama'],1,0,'L',0);
  $pdf->Cell(50,($line * $cellHeight),$hasil['asal'],1,0,'L',0);
  $pdf->Cell(18,($line * $cellHeight),$hasil['jml'],1,0,'C',0);
  $pdf->Cell(30,($line * $cellHeight),duit($hasil['harga']),1,0,'R',0);
  $pdf->Cell(30,($line * $cellHeight),$hasil['ktg'],1,0,'C',0);
  $pdf->Cell(25,($line * $cellHeight),$hasil['inventaris'],1,0,'C',0);
  $xPos=$pdf->GetX();
  $yPos=$pdf->GetY();

  $pdf->MultiCell($cellWidth,$cellHeight,$hasil['ket'],1);
  
  //kembalikan posisi untuk sel berikutnya di samping MultiCell 
    //dan offset x dengan lebar MultiCell
  //$pdf->SetXY($xPos + $cellWidth , $yPos);
  
}
$pdf->SetFont('Arial','B',9);
$pdf->Cell(204,6,'TOTAL HARGA',1,0,'C',0);
if($_GET['bln']=='ALL'){
    $qry = mysqli_query($konek,"SELECT SUM(ttl) AS total FROM brg_masuk");
}else if($_GET['bln']=='HIS'){
	$qry = mysqli_query($konek,"SELECT SUM(ttl) AS total FROM brg_masuk WHERE inventaris='SUDAH'");
}else{
    if(isset($_GET['bln'])){
        
        $tg = explode('-', $_GET['bln']);
        $th = $tg[0];
        $bl = $tg[1];
        
        $qry = mysqli_query($konek,"SELECT SUM(ttl) AS total FROM brg_masuk WHERE month(tgl)='$bl' AND year(tgl)='$th'");
    }else{
        $qry = mysqli_query($konek,"SELECT SUM(ttl) AS total FROM brg_masuk WHERE inventaris='BELUM'");
    }
}
foreach($qry as $hs);
$pdf->Cell(30,6,duit($hs['total']),1,0,'R',0);
$pdf->Cell(100,6,'',1,1,'R',0);
function tgl_indo($tanggal){
  $bulan = array(
    1 => 'JANUARI',
          'FEBRUARI',
          'MARET',
          'APRIL',
          'MEI',
          'JUNI',
          'JULI',
          'AGUSTUS',
          'SEPTEMBER',
          'OKTOBER',
          'NOVEMBER',
          'DESEMBER'
    );
  $pecah = explode('-', $tanggal);
  return $pecah[2].' '.$bulan[(int)$pecah[1]].' '.$pecah[0];
}
function duit($nilai){
  return number_format($nilai, 0, ',', '.');
}

//Menutup dokumen dan dikirim ke browser
$pdf->Output();
?>
