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
    $pdf->Cell(0,5,'Reporte de Registro OrientaTec', 0,0,'C');
    $pdf->Ln(10);//salto de linea y su tamaño

    //** Encabezado de la tabla **
    $pdf->SetFont('Arial','B',11);
    $pdf->SetX(20);//posicion en X
    $pdf->Cell(30,9,'ID', 0,0,'C',0);
    $pdf->Cell(80,9,'Nombre de preparatoria', 0,0,'C',0);
    $pdf->Cell(50,9,'Fecha', 0,0,'C',0);
    $pdf->Cell(95,9,'Cantidad de estudiantes atendidos', 0,1,'C',0);
    $pdf->SetDrawColor(255, 0, 0);//pinta lo que se quiere (linea)
    $pdf->SetLineWidth(1);//grosor de la linea
    $pdf->Line(20,50,275,50); //linea y posicion

    //****TABLA SALIDA***** 
    $pdf->Ln(2);//salto de linea tamaño
    $pdf->SetFont('Arial','',10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetDrawColor(255, 255, 255);
    $pdf->SetLineWidth(1);


    /*Verifica si la variable global fue definida*/
    if(isset($_SESSION['consulta'])) {
        /*Se le pasa el valor de la variable global a $q*/
        $q = $_SESSION['consulta'];  //query para buscador
        $sql="select orientatec.ID_ORIENTATEC,
        orientatec.nombre_preparatoria,
        orientatec.fecha,
        orientatec.estudiantes_atendidos 
      from orientatec
      where (orientatec.nombre_preparatoria like '%$q%'
      or orientatec.fecha like '%$q%'
      or orientatec.estudiantes_atendidos like '%$q%')";

    if (isset($_SESSION['consulta_anio'])) {
        /*Se le pasa el valor de la variable global a $q*/
        $p = $_SESSION['consulta_anio'];
        $sql="select orientatec.ID_ORIENTATEC,
        orientatec.nombre_preparatoria,
        orientatec.fecha,
        orientatec.estudiantes_atendidos 
        orientatec.from orientatec
      where (orientatec.nombre_preparatoria like '%$q%'
      or orientatec.fecha like '%$q%'
      or orientatec.estudiantes_atendidos like '%$q%')
      and orientatec.fecha_creado like '%$p%'";  
    }
    unset($_SESSION['consulta']);
    unset($_SESSION['consulta_anio']);
}

    elseif (isset($_SESSION['consulta_anio'])) {
    /*Se le pasa el valor de la variable global a $q*/
    $q = $_SESSION['consulta_anio'];
    $sql="select orientatec.ID_ORIENTATEC,
    orientatec.nombre_preparatoria,
    orientatec.fecha,
    orientatec.estudiantes_atendidos 
      from orientatec
      where orientatec.fecha_creado like '%$q%'";
       /*Se destruye/quita el valor dentro de la variable global*/
unset($_SESSION['consulta_anio']);
    }

    else {
        $sql="select orientatec.ID_ORIENTATEC,
        orientatec.nombre_preparatoria,
        orientatec.fecha,
        orientatec.estudiantes_atendidos 
      from orientatec";

      unset($_SESSION['consulta']);
      unset($_SESSION['consulta_anio']);  
        }

    $query = mysqli_query($conexion,$sql);
    
    while($row = $query -> fetch_assoc()){
        $pdf->SetX(20);//posicion en X
        $pdf->SetFillColor(248, 249, 249 ); //relleno de la tabla y su color

        $pdf->Cell(30,8, $row[utf8_decode('ID_ORIENTATEC')], 1,0,'C',1);
        $pdf->Cell(80,8, $row[utf8_decode('nombre_preparatoria')], 1,0,'C',1);
        $pdf->Cell(50,8, $row[utf8_decode('fecha')], 1,0,'C',1);
        $pdf->Cell(95,8, $row[utf8_decode('estudiantes_atendidos')], 1,1,'C',1);
    }
    
    $pdf->Output();
?>