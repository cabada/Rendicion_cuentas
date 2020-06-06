<?php
require('../../pdf/fpdf_horizontal.php');

require_once "../conexion.php";
session_start();

    $conexion = conexion();

class PDF extends FPDF
{
    //** ENCABEZADO **
public function Header()
{
    $this->Image('tecnologico-icon.png',20,15,45); //logo, posicion y tamaño
    $this->SetFont('Arial','B',10);
    $this->SetTextColor(88, 88, 88);
    $this->SetX(-60);
    $this->Ln(5);
      
}
    //** PIE DE PAGINA **
public function Footer()
{
    $this->SetY(-15);//posicion en Y
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Pagina').$this->PageNo().'/{nb}',0,0,'C');
}
}
    //** CREAR EL PDF **
    $pdf = new PDF();
    $pdf->AliasNbPages();//hace el conteo de las pag
    $pdf->AddPage();//agrega pagina
    $pdf->SetX(-58);
    $pdf->SetTextColor(88, 88, 88);
    $pdf->SetX(-62);
    $pdf->SetMargins(10,30,20,20); //margen al contenido
    
    
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial','B',13);
    $pdf->SetY(30);//posicion en Y
    $pdf->Ln(10);
    $pdf->Cell(0,5,'Registro de Cuerpos Academicos Pertenecientes a Posgrado', 0,0,'C');
    $pdf->Ln(10);//salto de linea y su tamaño

    //** Encabezado de la tabla **
    $pdf->SetFont('Arial','B',11);
    $pdf->SetX(20);//posicion en X
    $pdf->Cell(20,9,utf8_decode('ID'), 0,0,'C',0);
    $pdf->Cell(50,9,utf8_decode('Nombre de Cuerpo Academico'), 0,0,'C',0);
    $pdf->Cell(40,9,utf8_decode('Grado'), 0,0,'C',0);
    $pdf->Cell(40,9,utf8_decode('Estado'), 0,0,'C',0);
    $pdf->Cell(30,9,utf8_decode('Año de Registro'), 0,0,'C',0);
    $pdf->Cell(30,9,utf8_decode('Vigencia'), 0,0,'C',0);
    $pdf->Cell(45,9,utf8_decode('Area'),0,1,'C',0);
    $pdf->SetDrawColor(255, 0, 0);//pinta lo que se quiere (linea)
    $pdf->SetLineWidth(1);//grosor de la linea
    $pdf->Line(20,50,275,50); //linea y posicion

    //****TABLA SALIDA***** 
    $pdf->Ln(2);//salto de linea tamaño
    $pdf->SetFont('Arial','',10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetDrawColor(255, 255, 255);
    $pdf->SetLineWidth(1);

    
    if (isset($_SESSION['consulta'])){
        $q = $_SESSION['consulta'];
        $sql="select   id_cuerpos_academicos_posgrado, nombre_cuerpo, 
                      grado, estado, anio_registro, vigencia, area 
                      from cuerpos_academicos_posgrado
                      where nombre_cuerpo like '%$q%'
                      or grado like '%$q%'
                      or estado like '%$q%'
                      or anio_registro like '%$q%'
                      or vigencia like '%$q%'
                      or area like '%$q%'
                      ";
    unset($_SESSION['consulta']);

    }

    elseif (isset($_SESSION['consulta_anio'])){
        $q=$_SESSION['consulta_anio'];
        $sql="select   id_cuerpos_academicos_posgrado, nombre_cuerpo, 
                      grado, estado, anio_registro, vigencia, area 
                      from cuerpos_academicos_posgrado 
                      where fecha_creado like '%$q%'";
        unset($_SESSION['consulta_anio']);
    }
    else{

        $sql="select   id_cuerpos_academicos_posgrado, nombre_cuerpo, 
                      grado, estado, anio_registro, vigencia, area 
                      from cuerpos_academicos_posgrado ";

    }
$query = mysqli_query($conexion,$sql);
    
    while($row = $query -> fetch_assoc()){
        $pdf->SetX(20);//posicion en X
        $pdf->SetFillColor(248, 249, 249 ); //relleno de la tabla y su color

        $pdf->Cell(20,8, $row[utf8_decode('id_cuerpos_academicos_posgrado')], 1,0,'C',1);
        $pdf->Cell(50,8, $row[utf8_decode('nombre_cuerpo')], 1,0,'C',1);
        $pdf->Cell(40,8, $row[utf8_decode('grado')], 1,0,'C',1);
        $pdf->Cell(40,8, $row[utf8_decode('estado')], 1,0,'C',1);
        $pdf->Cell(30,8, $row[ utf8_decode('anio_registro')], 1,0,'C',1);
        $pdf->Cell(30,8, $row[utf8_decode('vigencia')], 1,0,'C',1);
        $pdf->Cell(45,8, $row[utf8_decode('area')], 1,1,'C',1);
    }
    
    $pdf->Output();

    unset($_SESSION['buscar']);
?>