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
    $pdf->Cell(0,5,'Reporte de Registro de equipo apoyo de asesores PDA', 0,0,'C');
    $pdf->Ln(10);//salto de linea y su tamaño

    //** Encabezado de la tabla **
    $pdf->SetFont('Arial','B',8);
    $pdf->SetX(20);//posicion en X
    $pdf->Cell(30,5,'ID', 0,0,'C',0);
    $pdf->Cell(60,5,'Nombre', 0,0,'C',0);
    $pdf->Cell(50,5,'Puesto', 0,0,'C',0);
    $pdf->Cell(60,5,'Grado de Estudios', 0,0,'C',0);
    $pdf->Cell(60,5,'Funciones TECNM', 0,1,'C',0);
    $pdf->SetDrawColor(255, 0, 0);//pinta lo que se quiere (linea)
    $pdf->SetLineWidth(1);//grosor de la linea
    $pdf->Line(20,50,275,50); //linea y posicion

    //****TABLA SALIDA***** 
    $pdf->Ln(4);//salto de linea tamaño
    $pdf->SetFont('Arial','',10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetDrawColor(255, 255, 255);
    $pdf->SetLineWidth(1);


/*Verifica si la variable global fue definida*/
if (isset($_SESSION['consulta'])) {
    /*Se le pasa el valor de la variable global a $q*/
    $q = $_SESSION['consulta'];  //query para buscador

    $sql = "select id_equipo_apoyo,nombre,puesto,grado_estudios,funciones_med_tecnm 
              from equipo_apoyo_asesores_pda
              where (nombre like '%$q%'
              or puesto like '%$q%'
              or grado_estudios like '%$q%'
              or funciones_med_tecnm like '%$q%')";


    if (isset($_SESSION['consulta_anio'])) {
        /*Se le pasa el valor de la variable global a $q*/
        $p = $_SESSION['consulta_anio'];

        $sql = "select id_equipo_apoyo,nombre,puesto,grado_estudios,funciones_med_tecnm 
            from equipo_apoyo_asesores_pda
            where (nombre like '%$q%'
            or puesto like '%$q%'
            or grado_estudios like '%$q%'
            or funciones_med_tecnm like '%$q%')
            and fecha_creado like '%$p%'";

    }
    /*Se destruye/quita el valor dentro de la variable global*/
    unset($_SESSION['consulta']);
    unset($_SESSION['consulta_anio']);
} /*Sino se cumplio ninguno de arriba, se va a ejecutar esta instruccion que es la de por defecto. Es una query para ver todos los registros
de la tabla.*/
elseif (isset($_SESSION['consulta_anio'])) {
    $q = $_SESSION['consulta_anio'];

    $sql = "select id_equipo_apoyo,nombre,puesto,grado_estudios,funciones_med_tecnm 
                        from equipo_apoyo_asesores_pda,
                        where fecha_creado like '%$q%'";

    unset($_SESSION['consulta_anio']);
}

 else {

    $sql = "select id_equipo_apoyo, nombre, puesto, grado_estudios, funciones_med_tecnm from equipo_apoyo_asesores_pda";
    unset($_SESSION['consulta']);
    unset($_SESSION['consulta_anio']);
}


$query = mysqli_query($conexion,$sql);
while($row = $query -> fetch_assoc()){
        $pdf->SetX(20);//posicion en X
        $pdf->SetFillColor(248, 249, 249 ); //relleno de la tabla y su color

        $pdf->Cell(30,8, $row['id_equipo_apoyo'], 1,0,'C',1);
        $pdf->Cell(60,8, $row['nombre'], 1,0,'C',1);
        $pdf->Cell(50,8, $row['puesto'], 1,0,'C',1);
        $pdf->Cell(60,8, $row['grado_estudios'], 1,0,'C',1);
        $pdf->Cell(60,8, $row['funciones_med_tecnm'], 1,1,'C',1);
        }
    
    $pdf->Output();
?>