<?php
require('../../pdf/fpdf_horizontal.php');

require_once "../conexion.php";
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
    $pdf->Cell(0,5,'Reporte de Registro Tutorias', 0,0,'C');
    $pdf->Ln(10);//salto de linea y su tamaño

    //** Encabezado de la tabla **
    $pdf->SetFont('Arial','B',8);
    $pdf->SetX(20);//posicion en X
    $pdf->Cell(20,9,'ID', 0,0,'C',0);
    $pdf->Cell(35,9,'Tutores registrados', 0,0,'C',0);
    $pdf->Cell(50,9,'Cantidad de alumnos grupal', 0,0,'C',0);
    $pdf->Cell(50,9,'Cantidad de encuentro con padres', 0,0,'C',0);
    $pdf->Cell(50,9,'Cantidad de conferencias a alumnos', 0,0,'C',0);
    $pdf->Cell(50,9,'Cantidad de alumnos en conferencia',0,1,'C',0);
    $pdf->SetDrawColor(255, 0, 0);//pinta lo que se quiere (linea)
    $pdf->SetLineWidth(1);//grosor de la linea
    $pdf->Line(20,50,275,50); //linea y posicion

    //****TABLA SALIDA***** 
    $pdf->Ln(2);//salto de linea tamaño
    $pdf->SetFont('Arial','',10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetDrawColor(255, 255, 255);
    $pdf->SetLineWidth(1);
    
    
    $sentencia = ("select id_tutorias,tutores_registrados, alumnos_tuto_grupal,encuentro_padres,conferencias_alumnos,
                alumnos_asistieron_conferencias from tutorias");
    $query = mysqli_query($conexion,$sentencia);
    
    while($row = $query -> fetch_assoc()){
        $pdf->SetX(20);//posicion en X
        $pdf->SetFillColor(248, 249, 249 ); //relleno de la tabla y su color

        $pdf->Cell(20,8, $row['id_tutorias'], 1,0,'C',1);
        $pdf->Cell(35,8, $row['tutores_registrados'], 1,0,'C',1);
        $pdf->Cell(50,8, $row['alumnos_tuto_grupal'], 1,0,'C',1);
        $pdf->Cell(50,8, $row['encuentro_padres'], 1,0,'C',1);
        $pdf->Cell(50,8, $row['conferencias_alumnos'], 1,0,'C',1);
        $pdf->Cell(50,8, $row['alumnos_asistieron_conferencias'], 1,1,'C',1);
    }
    
    $pdf->Output();
?>