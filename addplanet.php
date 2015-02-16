<html>
<head>
<meta charset="UTF-8">
<?php 
include 'includes/header.php';
?>
</head>
<body>
<?php
$link = mysqli_connect("jerezfam.com","jerezfam_root","rootogame","jerezfam_ogame");

// Check connection
if (mysqli_connect_errno()){
   printf("Connect failed: %s\n" , mysqli_connect_errno());
   exit();
}

/* Query to insert into table */
$query1 = 'INSERT INTO Recursos (Metal,Cristal,Deuterio)
		   VALUES ("'.$_POST['NMetal'].'","'.$_POST['NCristal'].'","'.$_POST['NDeuterio'].'")';
$query2 = 'INSERT INTO Instalaciones (Robots,Hangar,Laboratorio,Nanos)
		   VALUES ("'.$_POST['NRobots'].'","'.$_POST['NHangar'].'","'.$_POST['NLaboratorio'].'",0)';
$query3 = 'INSERT INTO Planetas (Nombre,TempMax,TempMin)
		   VALUES ("'.$_POST['NNombre'].'","'.$_POST['TempMax'].'","'.$_POST['TempMin'].'")';
$query4 = 'INSERT INTO FlotaDef (Lanzamisiles,LaseresP,LaseresG,Gauss,Ionico,Plasma,CupulaP,CupulaG,MisilesB,Satelites)
		   VALUES (0,0,0,0,0,0,0,0,0,0)';
		   
		   if (!mysqli_query($link,$query3)){printf("Connect failed:3");};
		   if (!mysqli_query($link,$query1)){printf("Connect failed:1");};
		   if (!mysqli_query($link,$query2)){printf("Connect failed:2");};
		   if (!mysqli_query($link,$query4)){printf("Connect failed:4");};
		   
		   echo '<div class="alert alert-success" role="alert"><strong>Éxito!</strong> Añadido planeta nuevo.</div>';
?>
</body>
</html>
