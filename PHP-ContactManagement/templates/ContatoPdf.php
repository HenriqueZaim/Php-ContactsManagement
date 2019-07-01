<?php
require_once '/opt/lampp/htdocs/projetoPHP/fpdf/fpdf.php';
require_once '../classes/DAO/contatoDao.php';
require_once '../classes/DAO/usuarioDao.php';

date_default_timezone_set('America/Sao_Paulo');

class PDF extends FPDF{

    function Header()    {
        

        $this->Image('brand.gif',10,6,30);
        $this->SetFont('Arial','B',15);
        $this->Cell(80);
        $this->Cell(30,10,'Relatorio',0,0,'C');
        $this->Ln(9);
        $this->SetFont('Arial','',10);
        $this->Cell(80);
        $this->Cell(30,10,'Lista de contatos',0,0,'C');
        $this->Ln(20);
        $this->SetFont('Arial','',8);
        $this->Cell(80);
        $this->Cell(30,3,date('d-m-y'),0,0,'C');
        $this->Ln(20);
    }

    function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function ImprovedTable($header, $data)    {

        if($data == null){
            $this->SetFont('Arial','B',24);
            $this->Cell(80);
            $this->Cell(30,60,'Nao ha contatos',0,0,'C');
            $this->Ln(10);
        }else{
            $w = array(40, 40, 45, 40);

            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],7,$header[$i],1,0,'C');
            $this->Ln();

            foreach($data as $row){
                $this->Cell($w[0],6,$row->nome,'LR');
                $this->Cell($w[1],6,$row->apelido,'LR');
                $this->Cell($w[2],6,$row->email,'LR',0,'R');
                $ano = substr($row->dtnasc,0,4);
                $dia = substr($row->dtnasc, 8);
                $mes = substr($row->dtnasc, 5, 2);
                $this->Cell($w[3],6,$dia."/".$mes."/".$ano,'LR',0,'R');
                $this->Ln();
            }

            $this->Cell(array_sum($w),0,'','T');
        }
    }
}

session_start();

if(isset($_SESSION["id"])){
    $contatoDao = new ContatoDao();

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $header = array('Nome', 'Apelido', 'E-Mail', 'Data de Nascimento');
    $data = $contatoDao->findAll();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',9);
    $pdf->ImprovedTable($header,$data);
    $pdf->Output();
}else
    header("Location: login.php");

?>