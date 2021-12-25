<?php
session_start();
require 'extensions/fpdf/fpdf.php';
require "connect.php";
require "models/orders.php";
require "models/producttypes.php";
$order= Orders::getDetail($db,$_GET["id"]);
$nodetail = Orders::getAllForId($db, $_GET["id"]);
class PDF extends FPDF
{
    // Page header
    function Header()
    {
        $this->SetFont('arial', 'I', 10);
        $this->Cell(30,10,date('Y-m-d H:i:s'),0,0,'L');
        $this->Ln(8);
        // Arial bold 15
        $this->SetFont('arial','B',18);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,'APOTEKita Sehat',0,0,'C');
        $this->SetFont('arial');
        $this->SetFontSize(14);
        $this->Ln(9);
        $this->Cell(80);
        $this->Cell(30,10,'Laporan Transaksi Jual Beli',0,0,'C');
        // Line break
        $this->Ln(12);
        $this->Cell(190, 0,'',1,0,'C');
        $this->Ln(10);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('arial','I',10);
        // Page number
        $this->Cell(0,10,'Terima Kasih Telah Berbelanja Di Apotek Kami',0,0,'C');
    }
    // Colored table
    function FancyTable($header, $data)
    {
        // Colors, line width and bold font
        $this->SetFillColor(231,76,60);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Header
        $this->Ln(10);
        $w = array(15, 85, 20, 35, 35);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],10,$header[$i],1,0,'C',true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(255,210,206);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        $i = 1;
        foreach($data as $row)
        {
            $this->Cell($w[0], 8, $i++,'LR',0,'C',$fill);
            $this->Cell($w[1], 8, $row["NAME"],'LR',0,'L',$fill);
            $this->Cell($w[2], 8, $row["AMOUNT"],'LR',0,'C',$fill);
            $this->Cell($w[3], 8, "Rp. ".number_format($row["PRICE"], 2, ",", "."),'LR',0,'R',$fill);
            $this->Cell($w[4], 8, "Rp. ".number_format($row["SUBTOTAL"], 2, ",", "."),'LR',0,'R',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('arial','B',11);
$pdf->Cell(0, 10, 'A. Identitas Pelanggan', 0, 0, 'L');
$pdf->Ln(10);

$pdf->SetFont('arial','',11);
$pdf->Cell(0, 10, 'Nama Pelanggan', 0, 0, 'L');
$pdf->SetX(90);
$pdf->SetFont('arial','I',11);
$pdf->Cell(0, 7, $nodetail["NAME"], 1, 0, '');

$pdf->Ln(10);
$pdf->SetFont('arial','',11);
$pdf->Cell(0, 10, 'Kode Transaksi', 0, 0, 'L');
$pdf->SetX(90);
$pdf->SetFont('arial','I',11);
$pdf->Cell(0, 7, $nodetail["CODE"], 1, 0, '');

$pdf->Ln(10);
$pdf->SetFont('arial','',11);
$pdf->Cell(0, 10, 'Total Pembelian', 0, 0, 'L');
$pdf->SetX(90);
$pdf->SetFont('arial','I',11);
$pdf->Cell(0, 7, "Rp. ".number_format($nodetail["TOTAL"], 2, ",", "."), 1, 0, '');

$pdf->Ln(10);
$pdf->SetFont('arial','',11);
$pdf->Cell(0, 10, 'Tanggal Transaksi', 0, 0, 'L');
$pdf->SetX(90);
$pdf->SetFont('arial','I',11);
$pdf->Cell(0, 7, formatTS($nodetail["CREATED_AT"]), 1, 0, '');

$pdf->Ln(15);
$pdf->SetFont('arial','B',11);
$pdf->Cell(0, 10, 'B. Daftar Produk', 0, 0, 'L');

$header = array("No", "Nama", "Jumlah", "Harga", "Sub Total");
$pdf->FancyTable($header, $order);

$pdf->Output();
?>