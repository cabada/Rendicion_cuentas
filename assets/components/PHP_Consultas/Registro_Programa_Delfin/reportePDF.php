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
    $pdf->Cell(0,5,'Reporte de Registro Programa Delfin', 0,0,'C');
    $pdf->Ln(10);//salto de linea y su tamaño

    //** Encabezado de la tabla **
    $pdf->SetFont('Arial','B',11);
    $pdf->SetX(20);//posicion en X
    $pdf->Cell(20,9,'ID', 0,0,'C',0);
    $pdf->Cell(60,9,'Nombre de proyecto', 0,0,'C',0);
    $pdf->Cell(45,9,'Cantidad de alumnos', 0,0,'C',0);
    $pdf->Cell(60,9,'Carrera', 0,0,'C',0);
    $pdf->Cell(30,9,'Año', 0,0,'C',0);
    $pdf->Cell(20,9,'Fecha de I', 0,0,'C',0);
    $pdf->Cell(30,9,'Fecha de t', 0,1,'C',0);
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
        $sql="select
                programa_delfin.id_programa,
                programa_delfin.nombre_proyecto,
                programa_delfin.cantidad_alumnos,
                carreras.nombre_carrera,
                programa_delfin.anio,
                programa_delfin.fecha_inicio,
                programa_delfin.fecha_termino
                from carreras
                right join programa_delfin on carreras.ID_CARRERA = programa_delfin.ID_CARRERA
                where (
                programa_delfin.nombre_proyecto like '%$q%'
                or programa_delfin.cantidad_alumnos like '%$q%'
                or carreras.nombre_carrera like '%$q%'
                or programa_delfin.anio like '%$q%'
                or programa_delfin.fecha_inicio like '%$q%'
                or programa_delfin.fecha_termino like '%$q%')";
        

    if (isset($_SESSION['consulta_anio'])) {
        /*Se le pasa el valor de la variable global a $q*/
        $p = $_SESSION['consulta_anio'];
        $sql="select
                programa_delfin.id_programa,
                programa_delfin.nombre_proyecto,
                programa_delfin.cantidad_alumnos,
                carreras.nombre_carrera,
                programa_delfin.anio,
                programa_delfin.fecha_inicio,
                programa_delfin.fecha_termino
                from carreras
                right join programa_delfin on carreras.ID_CARRERA = programa_delfin.ID_CARRERA
                where (
                programa_delfin.nombre_proyecto like '%$q%'
                or programa_delfin.cantidad_alumnos like '%$q%'
                or carreras.nombre_carrera like '%$q%'
                or programa_delfin.anio like '%$q%'
                or programa_delfin.fecha_inicio like '%$q%'
                or programa_delfin.fecha_termino like '%$q%')
                and programa_delfin.fecha_creado like '%$p%'";
        
    }
    unset($_SESSION['consulta']);
    unset($_SESSION['consulta_anio']);
}

    elseif (isset($_SESSION['consulta_anio'])) {
    /*Se le pasa el valor de la variable global a $q*/
    $q = $_SESSION['consulta_anio'];
    $sql="select
    programa_delfin.id_programa,
    programa_delfin.nombre_proyecto,
    programa_delfin.cantidad_alumnos,
    carreras.nombre_carrera,
    programa_delfin.anio,
    programa_delfin.fecha_inicio,
    programa_delfin.fecha_termino
    from carreras
    right join programa_delfin on carreras.ID_CARRERA = programa_delfin.ID_CARRERA
    where programa_delfin.fecha_creado like '%$q%'";
    /*Se destruye/quita el valor dentro de la variable global*/
unset($_SESSION['consulta_anio']);
    }

    else {
        $sql="select
            programa_delfin.id_programa,
            programa_delfin.nombre_proyecto,
            programa_delfin.cantidad_alumnos,
            carreras.nombre_carrera,
            programa_delfin.anio,
            programa_delfin.fecha_inicio,
            programa_delfin.fecha_termino
            from carreras
            right join programa_delfin on carreras.ID_CARRERA = programa_delfin.ID_CARRERA";
          unset($_SESSION['consulta']);
          unset($_SESSION['consulta_anio']);  
        }

    $query = mysqli_query($conexion,$sql);
    
    while($row = $query -> fetch_assoc()){
        $pdf->SetX(20);//posicion en X
        $pdf->SetFillColor(248, 249, 249 ); //relleno de la tabla y su color

        $pdf->Cell(20,8, $row[utf8_decode('id_programa')], 1,0,'C',1);
        $pdf->Cell(60,8, $row[utf8_decode('nombre_proyecto')], 1,0,'C',1);
        $pdf->Cell(45,8, $row[utf8_decode('cantidad_alumnos')], 1,0,'C',1);
        $pdf->Cell(60,8, $row[utf8_decode('nombre_carrera')], 1,0,'C',1);
        $pdf->Cell(30,8, $row[utf8_decode('anio')], 1,0,'C',1);
        $pdf->Cell(20,8, $row[utf8_decode('fecha_inicio')], 1,0,'C',1);
        $pdf->Cell(30,8, $row[utf8_decode('fecha_termino')], 1,1,'C',1);
    }
    
    $pdf->Output();
?>