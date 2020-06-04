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
    $pdf->Cell(0,5,'Reporte de Registro de Listado de Maestros con Certificaciones', 0,0,'C');
    $pdf->Ln(10);//salto de linea y su tamaño

    //** Encabezado de la tabla **
    $pdf->SetFont('Arial','B',8);
    $pdf->SetX(0);//posicion en X
    $pdf->Cell(20,5,'ID', 0,0,'C',0);
    $pdf->Cell(60,5,'Nombre de Docente', 0,0,'C',0);
    $pdf->Cell(30,5,'Categoria', 0,0,'C',0);
    $pdf->Cell(50,5,'Grado de Estudios', 0,0,'C',0);
    $pdf->Cell(30,5,'SNI', 0,0,'C',0);
    $pdf->Cell(50,5,'Area de Especializacion', 0,0,'C',0);
    $pdf->Cell(30,5,'Exp. Profesional', 0,0,'C',0);
    $pdf->Cell(30,5,'Exp. Docente', 0,0,'C',0);
    $pdf->SetDrawColor(255, 0, 0);//pinta lo que se quiere (linea)
    $pdf->SetLineWidth(1);//grosor de la linea
    $pdf->Line(20,50,275,50); //linea y posicion

    //****TABLA SALIDA***** 
    $pdf->Ln(4);//salto de linea tamaño
    $pdf->SetFont('Arial','',10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetDrawColor(255, 255, 255);
    $pdf->SetLineWidth(1);


if(isset($_SESSION['consulta'])){

    /*Se le pasa el valor de la variable global a $q*/
    $q = $_SESSION['consulta'];
    $sql = "select id_equipo_maestros_itcj,
                                    nombre_docente,
                                    categoria_hora,
                                    grado_estudios,
                                    sni,area_especializacion,
                                    experiencia_profesional,
                                    experiencia_docente 
                                    from equipo_maestros_itcj
                                    where nombre_docente like '%$q%' or grado_estudios like '%$q%'";

    /*Se destruye/quita el valor dentro de la variable global*/
    unset($_SESSION['consulta']);

}

/*Sino se cumple el if de arriba, se pasa a este.
Verifica si la variable global fue definida*/
elseif (isset($_SESSION['consulta_anio'])){
    /*Se le pasa el valor de la variable global a $q*/
    $q = $_SESSION['consulta_anio'];

    $sql = "select id_equipo_maestros_itcj,
                                    nombre_docente,
                                    categoria_hora,
                                    grado_estudios,
                                    sni,area_especializacion,
                                    experiencia_profesional,
                                    experiencia_docente 
                                    from equipo_maestros_itcj
                                    where fecha_creado like '%$q%'";
    /*Se destruye/quita el valor dentro de la variable global*/
    unset($_SESSION['consulta_anio']);
}
/*Sino se cumplio ninguno de arriba, se va a ejecutar esta instruccion que es la de por defecto. Es una query para ver todos los registros
de la tabla.*/
else{

    $sql="select id_equipo_maestros_itcj,
                            nombre_docente,
                            categoria_hora,
                            grado_estudios,
                            sni,
                            area_especializacion,
                            experiencia_profesional,
                            experiencia_docente 
                            from equipo_maestros_itcj";

}




    $query = mysqli_query($conexion,$sql);
    
    while($row = $query -> fetch_assoc()){
        $pdf->SetX(0);//posicion en X
        $pdf->SetFillColor(248, 249, 249 ); //relleno de la tabla y su color

        $pdf->Cell(20,8, $row['id_equipo_maestros_itcj'], 1,0,'C',1);
        $pdf->Cell(60,8, $row['nombre_docente'], 1,0,'C',1);
        $pdf->Cell(30,8, $row['categoria_hora'], 1,0,'C',1);
        $pdf->Cell(50,8, $row['grado_estudios'], 1,0,'C',1);
        $pdf->Cell(30,8, $row['sni'], 1,0,'C',1);
        $pdf->Cell(50,8, $row['area_especializacion'], 1,0,'C',1);
        $pdf->Cell(30,8, $row['experiencia_profesional'], 1,0,'C',1);
        $pdf->Cell(30,8, $row['experiencia_docente'], 1,1,'C',1);
    }
    
    $pdf->Output();
?>