
<?php
@ini_set('display_errors', 0);
session_start();

require ("lib/fpdf/fpdf.php");
require("lib/lib-function.php");
require("dbconnect.php");
$querya="SELECT COUNT(*) AS barang_belum FROM tb_barang WHERE id_barang NOT IN(SELECT id_barang FROM tb_lelang)";
$resulta=mysqli_query($conn,$querya);
$dataa=mysqli_fetch_array($resulta);

$queryb="SELECT COUNT(*) AS barang_dilelang FROM tb_lelang WHERE status!='terlelang'";
$resultb=mysqli_query($conn,$queryb);
$datab=mysqli_fetch_array($resultb);

$queryc="SELECT COUNT(*) AS barang_terlelang FROM tb_lelang WHERE status='terlelang'";
$resultc=mysqli_query($conn,$queryc);
$datac=mysqli_fetch_array($resultc);

$queryd="SELECT COUNT(*) AS total_barang FROM tb_barang";
$resultd=mysqli_query($conn,$queryd);
$datad=mysqli_fetch_array($resultd);

function TanggalIndo($date){
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 
	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl   = substr($date, 8, 2);
 
	$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
	return($result);
}
Class Kwitansi extends FPDF
{
	/*Format Kwitansi Sederhana oleh : Ahyarudin -- www.ayayank.com*/
	var $tanggal,$kwnums,$admins,$notevalid,$headerCo,$headerAddr,$headerTel;
	/* Header Kwitansi */
	function Header(){
		$this->SetFont('Arial','B',32);
		$this->Cell(0,15,$this->headerCo,0,1,'C');
		$this->SetFont('Arial','B',11);
		$this->Cell(0,7,$this->headerAddr,0,1,'L');
		$this->Cell(120,7,$this->headerTel,0,0,'L');
		$this->SetFont('Arial','',12);
		$this->Cell(28,7,'',0,0,'L');
		$this->SetFont('Courier','',12);
		$this->Cell(0,7,'',0,1,'L');
		$this->SetFillColor(95, 95, 95);
		$this->Rect(5, 27.5, 198, 3, 'FD');
	}
	/* Footer Kwitansi*/
	function Footer(){
		$this->SetY(-40);
		$this->Ln(18);
		$this->Cell(130);
		$this->SetFont('Courier','B',12);
		$this->Cell(0,6,$this->admins,0,1,'C');
		$this->Ln(3);
		$this->SetFont('Arial','I',10);
		$this->Cell(0,6,$this->notevalid,0,1,'R');
	}
	function setHeaderParam($pt,$jl,$tel){
		$this->headerCo=$pt;
		$this->headerAddr=$jl;
		$this->headerTel=$tel;
		}
	function setAdmins($admins){$this->admins=$admins;}
	function setValidasi($word){$this->notevalid=$word;}
}
/*Deklarasi variable untuk cetak*/
$pt='LAPORAN';
/*parameter kertas*/
$pdf=new Kwitansi('L','mm','A5');
$fungsi=new Fungsi();
/* Retrieve No. Kwitansi*/
/*Persiapan Parameter*/
$pdf->setAdmins($admins);
$pdf->setValidasi($notevalid);
$pdf->setHeaderParam($pt,$jl,$tel);
/* Bagian di mana inti dari kwitansi berada*/
$pdf->setMargins(5,5,5);
$pdf->AddPage();
$pdf->SetLineWidth(0.6);
$pdf->Ln(10);

$pdf->Cell(2);
$pdf->SetFont('Courier','B',12);
$pdf->Cell(193,8,'Laporan Barang Lelang',1,1,'C');


$pdf->Cell(2);
$pdf->SetFont('Courier','',12);
$pdf->Cell(175,8,'Jumlah Barang yang Belum Dilelang (Belum Dimasukan ke Data Lelang)',1,0,'C');
$pdf->SetFont('Courier','',12);
$pdf->Cell(18,8,$dataa['barang_belum'],1,1,'C');

$pdf->Cell(2);
$pdf->SetFont('Courier','',12);
$pdf->Cell(175,8,'Jumlah Barang yang Dilelang',1,0,'C');
$pdf->SetFont('Courier','',12);
$pdf->Cell(18,8,$datab['barang_dilelang'],1,1,'C');

$pdf->Cell(2);
$pdf->SetFont('Courier','',12);
$pdf->Cell(175,8,'Jumlah Barang yang Terlelang',1,0,'C');
$pdf->SetFont('Courier','',12);
$pdf->Cell(18,8,$datac['barang_terlelang'],1,1,'C');

$pdf->Cell(2);
$pdf->SetFont('Courier','',12);
$pdf->Cell(175,8,'Total Barang Lelang',1,0,'C');
$pdf->SetFont('Courier','',12);
$pdf->Cell(18,8,$datad['total_barang'],1,1,'C');


$pdf->Output();
?>
<title>Laporan</title>