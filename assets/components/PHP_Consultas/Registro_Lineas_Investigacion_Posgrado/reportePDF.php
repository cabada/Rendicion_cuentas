<?php
require('../../pdf/fpdf_horizontal.php');

require_once "../conexion.php";
session_start();

    $conexion = conexion();

class PDF extends FPDF
{
    //** ENCABEZADO **     //** ENCABEZADO **
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
    $pdf->Cell(0,5,'Registro de Lineas de Investigacion Pertenecientes a Posgrado', 0,0,'C');
    $pdf->Ln(10);//salto de linea y su tamaño

    //** Encabezado de la tabla **
    $pdf->SetFont('Arial','B',11);
    $pdf->SetX(20);//posicion en X
    $pdf->Cell(40,9,utf8_decode('ID'), 0,0,'C',0);
    $pdf->Cell(105,9,utf8_decode('Programa'), 0,0,'C',0);
    $pdf->Cell(110,9,utf8_decode('Lineas de Investigacion '), 0,1,'C',0);
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
        $sql="select lineas_investigacion_posgrado.ID_LINEA,
                                 carreras.NOMBRE_CARRERA, 
                                 lineas_investigacion_posgrado.NOMBRE_ESPECIALIDAD
                                 from carreras
                                 right join lineas_investigacion_posgrado on carreras.ID_CARRERA = lineas_investigacion_posgrado.ID_CARRERA
                                 where carreras.NOMBRE_CARRERA LIKE '%$q%' or 
                                 lineas_investigacion_posgrado.NOMBRE_ESPECIALIDAD LIKE '%$q%'";
    unset($_SESSION['consulta']);

    }

    elseif (isset($_SESSION['consulta_anio'])){
        $q=$_SESSION['consulta_anio'];
        $sql = "select lineas_investigacion_posgrado.ID_LINEA,
                                 carreras.NOMBRE_CARRERA, 
                                 lineas_investigacion_posgrado.NOMBRE_ESPECIALIDAD
                                 from carreras
                                 right join lineas_investigacion_posgrado on carreras.ID_CARRERA = lineas_investigacion_posgrado.ID_CARRERA
                                 where lineas_investigacion_posgrado.fecha_creado LIKE '%$q%'";
        unset($_SESSION['consulta_anio']);
    }
    else{

        $sql="select lineas_investigacion_posgrado.ID_LINEA,
                                 carreras.NOMBRE_CARRERA, 
                                 lineas_investigacion_posgrado.NOMBRE_ESPECIALIDAD
                                 from carreras
                                 right join lineas_investigacion_posgrado on carreras.ID_CARRERA =lineas_investigacion_posgrado.ID_CARRERA";



    }
$query = mysqli_query($conexion,$sql);
    
    while($row = $query -> fetch_assoc()){
        $pdf->SetX(20);//posicion en X
        $pdf->SetFillColor(248, 249, 249 ); //relleno de la tabla y su color

        $pdf->Cell(40,8, $row[utf8_decode('ID_LINEA')], 1,0,'C',1);
        $pdf->Cell(105,8, $row[utf8_decode('NOMBRE_CARRERA')], 1,0,'C',1);
        $pdf->Cell(110,8, $row[utf8_decode('NOMBRE_ESPECIALIDAD')], 1,1,'C',1);
    }
    
    $pdf->Output();

    unset($_SESSION['buscar']);
?>