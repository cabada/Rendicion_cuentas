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
    $pdf->Cell(0,5,'Reporte de Registro de Coordinacion Educativa', 0,0,'C');
    $pdf->Ln(10);//salto de linea y su tamaño

    //** Encabezado de la tabla **
    $pdf->SetFont('Arial','B',11);
    $pdf->SetX(20);//posicion en X
    $pdf->Cell(30,9,'ID', 0,0,'C',0);
    $pdf->Cell(105,9,'Nombre actividad', 0,0,'C',0);
    $pdf->Cell(60,9,'Periodo ENE-JUN', 0,0,'C',0);
    $pdf->Cell(60,9,'Periodo AGO-DIC', 0,1,'C',0);
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
                 $sql = "select id_actividad,nombre_actividad,PERIODO_ENE_JUN,PERIODO_AGO_DIC
                            from coordinacion_educativa_y_tutorias 
                            where coordinacion_educativa_y_tutorias.NOMBRE_ACTIVIDAD LIKE '%$q%'";

                 if (isset($_SESSION['consulta_anio'])) {
                     /*Se le pasa el valor de la variable global a $q*/
                     $p = $_SESSION['consulta_anio'];
                     $sql = "select id_actividad,nombre_actividad,PERIODO_ENE_JUN,PERIODO_AGO_DIC
                            from coordinacion_educativa_y_tutorias
                            where coordinacion_educativa_y_tutorias.NOMBRE_ACTIVIDAD LIKE '%$q%'
                            and fecha_creado LIKE '%$p%'";
                 }

                 /*Se destruye/quita el valor dentro de la variable global*/
                 unset($_SESSION['consulta']);
                 unset($_SESSION['consulta_anio']);
             }


             /*Sino se cumple el if de arriba, se pasa a este.
             Verifica si la variable global fue definida*/
             elseif (isset($_SESSION['consulta_anio'])) {
                 /*Se le pasa el valor de la variable global a $q*/
                 $q = $_SESSION['consulta_anio'];
                 $sql = "select id_actividad,nombre_actividad,PERIODO_ENE_JUN,PERIODO_AGO_DIC
                            from coordinacion_educativa_y_tutorias
                            where fecha_creado LIKE '%$q%'";

                 /*Se destruye/quita el valor dentro de la variable global*/
                 unset($_SESSION['consulta_anio']);
             }

             else {

                 $sql = "select id_actividad,nombre_actividad,PERIODO_ENE_JUN,PERIODO_AGO_DIC
                            from coordinacion_educativa_y_tutorias";

                 unset($_SESSION['consulta']);
                 unset($_SESSION['consulta_anio']);
             }


    $query = mysqli_query($conexion,$sql);
    
    while($row = $query -> fetch_assoc()){
        $pdf->SetX(20);//posicion en X
        $pdf->SetFillColor(248, 249, 249 ); //relleno de la tabla y su color

        $pdf->Cell(30,8, $row[utf8_decode('id_actividad')], 1,0,'C',1);
        $pdf->Cell(105,8, $row[utf8_decode('nombre_actividad')], 1,0,'C',1);
        $pdf->Cell(60,8, $row[utf8_decode('PERIODO_ENE_JUN')], 1,0,'C',1);
        $pdf->Cell(60,8, $row[utf8_decode('PERIODO_AGO_DIC')], 1,1,'C',1);
    }
    
    $pdf->Output();
?>