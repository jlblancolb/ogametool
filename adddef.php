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
foreach ($_POST as $param_name => $param_val){
	if($param_val && $param_name != 'id'){ 
		$query = 'UPDATE FlotaDef SET '.$param_name.'="'.$param_val.'" WHERE id="'.$_POST['id'].'"';
		if (!mysqli_query($link,$query)){printf("Connect failed:");};}
	}
	   
	echo '<div class="alert alert-success" role="alert"><strong>Éxito!</strong> Actualización completa.</div>';
?>
</body>
</html>
