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
    $pdf->Cell(0,5,'Reporte de Registro de Estudiantes con Capacidades Diferentes', 0,0,'C');
    $pdf->Ln(10);//salto de linea y su tamaño

    //** Encabezado de la tabla **
    $pdf->SetFont('Arial','B',11);
    $pdf->SetX(20);//posicion en X
    $pdf->Cell(50,9,'ID', 0,0,'C',0);
    $pdf->Cell(95,9,'Periodo', 0,0,'C',0);
    $pdf->Cell(50,9,'Año', 0,0,'C',0);
    $pdf->Cell(60,9,'Cantidad de estudiantes',0,1,'C',0);
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
    $sql = "select id_estudiantes_capacidades_diferentes,PERIODO,ANIO,CANTIDAD_ALUMNOS 
                                          from estudiantes_capacidades_diferentes 
                                          where (PERIODO LIKE '%$q%'
                                          or ANIO LIKE '%$q%')";

    if (isset($_SESSION['consulta_anio'])) {
        /*Se le pasa el valor de la variable global a $q*/
        $p = $_SESSION['consulta_anio'];
        $sql = "select id_estudiantes_capacidades_diferentes,PERIODO,ANIO,CANTIDAD_ALUMNOS 
                              from estudiantes_capacidades_diferentes
                              where (PERIODO LIKE '%$q%'
                              or ANIO LIKE '%$q%') 
                              and fecha_creado LIKE '%$p%'";

    }
    /*Se destruye/quita el valor dentro de la variable global*/
    unset($_SESSION['consulta']);
    unset($_SESSION['consulta_anio']);
}

elseif (isset($_SESSION['consulta_anio'])) {
    /*Se le pasa el valor de la variable global a $q*/
    $q = $_SESSION['consulta_anio'];
    $sql = "select id_estudiantes_capacidades_diferentes,PERIODO,ANIO,CANTIDAD_ALUMNOS 
                                         from estudiantes_capacidades_diferentes
                                         where fecha_creado LIKE '%$q%'";

    /*Se destruye/quita el valor dentro de la variable global*/
    unset($_SESSION['consulta_anio']);
}

else{
    $sql="select id_estudiantes_capacidades_diferentes,PERIODO,ANIO,CANTIDAD_ALUMNOS 
                              from estudiantes_capacidades_diferentes";

    unset($_SESSION['consulta']);
    unset($_SESSION['consulta_anio']);
}


    $query = mysqli_query($conexion,$sql);
    
    while($row = $query -> fetch_assoc()){
        $pdf->SetX(20);//posicion en X
        $pdf->SetFillColor(248, 249, 249 ); //relleno de la tabla y su color

        $pdf->Cell(50,8, $row['id_estudiantes_capacidades_diferentes'], 1,0,'C',1);
        $pdf->Cell(95,8, $row['PERIODO'], 1,0,'C',1);
        $pdf->Cell(50,8, $row['ANIO'], 1,0,'C',1);
        $pdf->Cell(60,8, $row['CANTIDAD_ALUMNOS'], 1,1,'C',1);
    }
    
    $pdf->Output();
?>