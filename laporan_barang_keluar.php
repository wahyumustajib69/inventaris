<?php
session_start();
if(!isset($_SESSION['username'])){
  header("location:login");
}
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('fpdf/logo.png',10,8,24);
    // Arial bold 12
    $this->SetFont('Arial','B',12);
    // Geser Ke Kanan 30mm
    $this->Cell(30);
    // Judul
    $this->Cell(30,5,'LAPORAN DATA BARANG KELUAR',0,1,'L');
    $this->Cell(30);
    $this->Cell(30,5,'KANTOR BKKBN BANJARMASIN',0,1,'L');
    $this->Cell(30);
    $this->Cell(30,5,'PERIODE '.tgl_indo(date('Y-m-d')),0,1,'L');
    $this->Cell(30);
    $this->SetFont('Arial','',11);
    $this->Cell(30,5,'Jl. Gatot Subroto No.9, Banjarmasin, Kalimantan Selatan 70235',0,1,'L');
    // Garis Bawah Double
    $this->SetLineWidth(1);
    $this->Line(10,31,198,31);
    $this->SetLineWidth(0);
    $this->Line(10,32,198,32);
    // Line break 5mm
    $this->Ln(6);
}

// Page footer
function Footer()
{
    // Posisi 15 cm dari bawah
    $this->SetY(-15);
    

    // Arial italic 8
    $this->SetFont('Arial','I',8);
    

    // Page number
    $this->Cell(0,10,'Halaman '.$this->PageNo().' / {nb}',0,0,'C');
}
}

//Membuat file PDF
$pdf = new PDF('P','mm','A4');

//Alias total halaman dengan default {nb} (berhubungan dengan PageNo())
$pdf->AliasNbPages();

$pdf->AddPage();
$pdf->SetFont('Times','',12);

//Mencetak kalimat dengan perulangan
$pdf->SetFillColor(24,224,23);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(6,6,'NO',1,0,'C',0);
$pdf->Cell(40,6,'TANGGAL',1,0,'C',0);
$pdf->Cell(45,6,'NAMA BARANG',1,0,'C',0);
$pdf->Cell(25,6,'JUMLAH',1,0,'C',0);
$pdf->Cell(25,6,'STATUS',1,0,'C',0);
$pdf->Cell(50,6,'KETERANGAN',1,1,'C',0);
 
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

$bl = $_GET['bln'];

if($_GET['bln']=='ALL'){
    $sql = mysqli_query($konek,"SELECT*FROM brg_keluar");
}else{
    if(isset($_GET['bln'])){       
        $tg = explode('-', $_GET['bln']);
        $th = $tg[0];
        $bl = $tg[1];
        
        $sql = mysqli_query($konek,"SELECT*FROM brg_keluar WHERE month(tgl)='$bl' AND year(tgl)='$th'");
    }else{
        $sql = mysqli_query($konek,"SELECT*FROM brg_keluar");
    }
}

$no =1;
while($row = mysqli_fetch_array($sql)){
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(6,6,$no,1,0,'C',0);
    $pdf->Cell(40,6,tgl_indo($row['tgl']),1,0,'L',0);
    $pdf->Cell(45,6,$row['nm_brg'],1,0,'L',0);
    //$pdf->Cell(44,6,tgl_indo($row['tgl_terima']),1,0,'C',0);
    //if($row['kondisi']=="NORMAL"){
      //  $pdf->Cell(25,6,$row['kondisi'],1,0,'C',0); 
    //}else{
      //  $pdf->SetFont('Arial','I',8);
        //$pdf->SetTextColor(220,50,50);
        //$pdf->Cell(25,6,$row['kondisi'],1,0,'C',0); 
        //$pdf->SetTextColor(0,0,0);
    //}
    //$pdf->SetFont('Arial','',9);
    $pdf->Cell(25,6,$row['jml'],1,0,'C',0);
    $pdf->Cell(25,6,$row['status'],1,0,'C',0); 
    $pdf->Cell(50,6,$row['ket'],1,1,'L',0); 
    $no++;
}

//Menutup dokumen dan dikirim ke browser
$pdf->Output();
?>
