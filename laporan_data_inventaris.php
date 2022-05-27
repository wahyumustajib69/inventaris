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
    $this->Cell(30,5,'LAPORAN INVENTARIS BARANG',0,1,'L');
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

$pdf->SetFont('Arial','B',13);
$ket = $_GET['ref'];
if($ket=='UNUSED'){
  $pdf->Cell(333,6,'STATUS BARANG TIDAK TERPAKAI',0,1,'C',0);  
}else if($ket=='INUSED'){
  $pdf->Cell(333,6,'STATUS BARANG TERPAKAI',0,1,'C',0);
}else{
  $pdf->Cell(333,6,'SEMUA BARANG',0,1,'C',0);
}
$pdf->Ln(4);
//Mencetak kalimat dengan perulangan
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(6,6,'NO',1,0,'C',0);
$pdf->Cell(45,6,'KODE INVENTARIS',1,0,'C',0);
$pdf->Cell(100,6,'NAMA BARANG',1,0,'C',0);
$pdf->Cell(40,6,'KATEGORI',1,0,'C',0);
$pdf->Cell(35,6,'SATUAN',1,0,'C',0);
$pdf->Cell(42,6,'LOKASI',1,0,'C',0);
$pdf->Cell(30,6,'KONDISI',1,0,'C',0);
$pdf->Cell(35,6,'STATUS',1,1,'C',0);

$pdf->SetFont('Arial','',10);

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
 
include 'koneksi.php';
$ref= $_GET['ref'];
if($ref=='INUSED'){
  $data = mysqli_query($konek,"SELECT*FROM inv_brg WHERE status='TERPAKAI'");
}else if($ref=='UNUSED'){
  $data = mysqli_query($konek,"SELECT*FROM inv_brg WHERE status='TIDAK TERPAKAI'");
}else{
  $data = mysqli_query($konek,"SELECT*FROM inv_brg");
}

$no =1;
while($hasil=mysqli_fetch_array($data)){
  $pdf->SetFont('Arial','',9);

  $cellWidth=100; //lebar sel
  $cellHeight=6; //tinggi sel satu baris normal
  
  //periksa apakah teksnya melibihi kolom?
  if($pdf->GetStringWidth($hasil['nama']) < $cellWidth){
    //jika tidak, maka tidak melakukan apa-apa
    $line=1;
  }else{
    //jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
    //dengan memisahkan teks agar sesuai dengan lebar sel
    //lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel
    
    $textLength=strlen($hasil['nama']);  //total panjang teks
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
        $tmpString=substr($hasil['nama'],$startChar,$maxChar);
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
  $pdf->Cell(45,($line * $cellHeight),$hasil['kode'],1,0,'L',0);
  //memanfaatkan MultiCell sebagai ganti Cell
  //atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
  //ingat posisi x dan y sebelum menulis MultiCell
  $xPos=$pdf->GetX();
  $yPos=$pdf->GetY();

  $pdf->MultiCell($cellWidth,$cellHeight,$hasil['nama'],1);
  
  //kembalikan posisi untuk sel berikutnya di samping MultiCell 
    //dan offset x dengan lebar MultiCell
  $pdf->SetXY($xPos + $cellWidth , $yPos);
  
  $pdf->Cell(40,($line * $cellHeight),$hasil['kategori'],1,0,'L',0);
  $pdf->Cell(35,($line * $cellHeight),$hasil['satuan'],1,0,'C',0);
  $pdf->Cell(42,($line * $cellHeight),$hasil['lokasi'],1,0,'L',0);
  $pdf->Cell(30,($line * $cellHeight),$hasil['kondisi'],1,0,'C',0);
  $pdf->Cell(35,($line * $cellHeight),$hasil['status'],1,1,'C',0);
  //$pdf->Cell(29,($line * $cellHeight),$hasil['sn_router'],1,1,'L',0); //sesuaikan ketinggian dengan jumlah garis
}

//Menutup dokumen dan dikirim ke browser
$pdf->Output();
?>
