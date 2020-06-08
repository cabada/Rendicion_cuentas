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
    $pdf->Cell(0,5, utf8_decode('Registro tiempo parcial profesores'), 0,0,'C');
    $pdf->Ln(10);//salto de linea y su tamaño

    //** Encabezado de la tabla **
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(20);//posicion en X
    $pdf->Cell(85,8,'ID', 0,0,'C',0);
    $pdf->Cell(85,8,'Cantidad de profesores en tiempo parcial', 0,0,'C',0);
    $pdf->Cell(85,8,'Grado', 0,1,'C',0);
    $pdf->SetDrawColor(255, 0, 0);//pinta lo que se quiere (linea)
    $pdf->SetLineWidth(1);//grosor de la linea
    $pdf->Line(20,50,275,50); //linea y posicion

    //****TABLA SALIDA***** 
    $pdf->Ln(1);//salto de linea tamaño
    $pdf->SetFont('Arial','',10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetDrawColor(255, 255, 255);
    $pdf->SetLineWidth(1);


    // VERIFICA SI LA VARIABLE GLOBAL FUE DEFINIDA
    if(isset($_SESSION['consulta'])){
        // SE LE PASA EL VALOR DE LA VARIABLE GLOBAL A $q
        $q = $_SESSION['consulta'];
        $sql = "SELECT id_prof_tmp_parc, cantidad_tiempo_parcial, grado, fecha_creado FROM profesores_tiempo_parcial 
            WHERE cantidad_tiempo_parcial LIKE '%$q%' OR grado LIKE '%$q%'";

        if(isset($_SESSION['consulta_anio'])){
            $p = $_SESSION['consulta_anio'];
            $sql = "SELECT id_prof_tmp_parc, cantidad_tiempo_parcial, grado, fecha_creado 
                FROM profesores_tiempo_parcial WHERE (cantidad_tiempo_parcial LIKE '%$q%' 
                OR grado LIKE '%$q%') AND fecha_creado LIKE '%$p%'";
        }
        // SE DESTRUYE/QUITA EL VALOR DENTRO DE LA VARIABLE GLOBAL
        unset($_SESSION['consulta']);
        unset($_SESSION['consulta_anio']);
    
    // SI NO SE CUMPLE EL IF DE ARRIBA, SE PASA A ESTE.
    // VERIFICA SI LA VARIABLE GLOBAL FUE DEFINIDA
    } else if (isset($_SESSION['consulta_anio'])){
        // SE LE PASA EL VALOR DE LA VARIABLE GLOBAL A $q
        $q = $_SESSION['consulta_anio'];
        $sql="SELECT id_prof_tmp_parc, cantidad_tiempo_parcial, grado, fecha_creado 
            FROM profesores_tiempo_parcial WHERE fecha_creado LIKE '%$q%'";
        // SE DESTRUYE/QUITA EL VALOR DENTRO DE LA VARIABLE GLOBAL
        unset($_SESSION['consulta_anio']);
    
    // SI NO SE CIMPLIO NINGUNO DE ARRIBA, SE VA EJECUTAR ESTA INSTRUCCION QUE ES POR DEFECTO, 
    // ES UNA QUERY PARA VER TODOS LOS REGISTROS DE LA TABLA
    } else {
        unset($_SESSION['consulta_anio']);
        unset($_SESSION['consulta']);
        $sql="SELECT id_prof_tmp_parc, cantidad_tiempo_parcial, grado, fecha_creado FROM profesores_tiempo_parcial";
    }

    $query = mysqli_query($conexion,$sql);
    while($row = $query -> fetch_assoc()){
        $pdf->SetX(20);//posicion en X
        $pdf->SetFillColor(248, 249, 249 ); //relleno de la tabla y su color

        $pdf->Cell(85,8, $row['id_prof_tmp_parc'], 1,0,'C',1);
        $pdf->Cell(85,8, $row['cantidad_tiempo_parcial'], 1,0,'C',1);
        $pdf->Cell(85,8, $row['grado'], 1,1,'C',1);
    }
    
    $pdf->Output();
?>