<?php
$link = mysqli_connect("jerezfam.com","jerezfam_root","rootogame","jerezfam_ogame");

// Check connection
if (mysqli_connect_errno()){
   printf("Connect failed: %s\n" , mysqli_connect_errno());
   exit();
}

/* Planets count */
$num = mysqli_query($link, "SELECT Planetas.id FROM Planetas");
$num = mysqli_num_rows($num);

/* Update values just in case that we change something in the form */
for ($aux=1;$aux<=$num;$aux++){
	
	if(isset($_POST['Metal'.$aux])){$query = 'UPDATE Recursos SET Metal="'.$_POST['Metal'.$aux].'" WHERE id='.$aux;mysqli_query($link,$query);};
	if(isset($_POST['Cristal'.$aux])){$query = 'UPDATE Recursos SET Cristal="'.$_POST['Cristal'.$aux].'" WHERE id='.$aux;mysqli_query($link,$query);};
	if(isset($_POST['Deuterio'.$aux])){$query = 'UPDATE Recursos SET Deuterio="'.$_POST['Deuterio'.$aux].'" WHERE id='.$aux;mysqli_query($link,$query);};
	if(isset($_POST['Robots'.$aux])){$query = 'UPDATE Instalaciones SET Robots="'.$_POST['Robots'.$aux].'" WHERE id='.$aux;mysqli_query($link,$query);};
	if(isset($_POST['Hangar'.$aux])){$query = 'UPDATE Instalaciones SET Hangar="'.$_POST['Hangar'.$aux].'" WHERE id='.$aux;mysqli_query($link,$query);};
	if(isset($_POST['Laboratorio'.$aux])){$query = 'UPDATE Instalaciones SET Laboratorio="'.$_POST['Laboratorio'.$aux].'" WHERE id='.$aux;mysqli_query($link,$query);};
	if(isset($_POST['Nanos'.$aux])){$query = 'UPDATE Instalaciones SET Nanos="'.$_POST['Nanos'.$aux].'" WHERE id='.$aux;mysqli_query($link,$query);};
	
	if($aux == $num && isset($_POST['Metal'.$aux])){echo '<div id="success" class="alert alert-success" role="alert"><strong>Éxito!</strong> Actualización correcta.</div> 
	<script>
	var aux = setInterval(function(){dels()},5000);
	function dels(){
		document.getElementById("success").remove();
		clearInterval(aux);
	}
	</script>';};
}

/* Consultas de selección que devuelven un conjunto de resultados */
$resultado = mysqli_query($link, "SELECT Planetas.TempMax,Planetas.TempMin,Planetas.id,nombre,Metal,Cristal,Deuterio,Robots,Hangar,Laboratorio,Nanos,Lanzamisiles,LaseresP,LaseresG,Gauss,Ionico,Plasma,CupulaP,CupulaG,MisilesB,Satelites FROM Planetas,Recursos,Instalaciones,FlotaDef where Planetas.id = Recursos.id AND Planetas.id = Instalaciones.id AND Planetas.id = FlotaDef.id;");
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<?php include 'includes/header.php';?>
	</head>

	<body>
		<title>Imperio</title>
		  <div class="panel panel-default">
		  <!-- Default panel contents -->
		  <div class="panel-heading"><strong>Visión general del imperio Ogame</strong><p>Universo especial: velocidad x5, 50% de escombros, +25 campos en todos los planetas</p></div>
		  <div class="panel-body">
		    <i><p><?php printf("Número de planetas actual: <strong> %d</strong>.\n", mysqli_num_rows($resultado));?></p></i>
		  </div>
		
		<!-- Form to modify db -->
		<form action="index.php" method="post">
		  <!-- Table -->
		  <table class="table" style="background-color:rgba(240, 240, 240, 1);border-style: solid;border-width: 1px;">
			<thead>
			  <tr>
			    <th style="width:26px;">#</th>
			    <th style="width:59px;">TempMed</th>
			    <th style="color:red;">Nombre planeta</th>
			    <th style="color:grey;">Metal</th>
			    <th style="color:blue;">Cristal</th>
			    <th style="color:green;">Deuterio</th>
			    <th>Robots</th>
			    <th>Hangar</th>
			    <th>Laboratorio</th>
			    <th>Nanos</th>
			  </tr>
			</thead>
			<tbody>
			  <tr>
				<?php $metalt = 0;$cristalt = 0;$deuteriot = 0;?>
			    <?php while($row = mysqli_fetch_assoc($resultado)){?>
			    <?php echo '<input type="text" name="'.$row['id'].'" style="visibility:collapse;position: absolute">';?>
			    <th scope="row" style="color:red;"><?php echo $row['id'];?></th>
				<th scope="row" style="color:black;"><?php echo (($row['TempMax']+$row['TempMin'])/2).'º';?></th>
                <th scope="row"><?php echo $row['nombre'];?></th>
			    <td><?php echo '<input style="width:24px" type="text" name="Metal'.$row['id'].'" value="'.$row['Metal'].'">';?></td>
			    <td><?php echo '<input style="width:24px" type="text" name="Cristal'.$row['id'].'" value="'.$row['Cristal'].'">';?></td>
			    <td><?php echo '<input style="width:24px" type="text" name="Deuterio'.$row['id'].'" value="'.$row['Deuterio'].'">';?></td>
			    <td><?php echo '<input style="width:24px" type="text" name="Robots'.$row['id'].'" value="'.$row['Robots'].'">';?></td>
			    <td><?php echo '<input style="width:24px" type="text" name="Hangar'.$row['id'].'" value="'.$row['Hangar'].'">';?></td>
			    <td><?php echo '<input style="width:24px" type="text" name="Laboratorio'.$row['id'].'" value="'.$row['Laboratorio'].'">';?></td>
			    <td><?php echo '<input style="width:24px" type="text" name="Nanos'.$row['id'].'" value="'.$row['Nanos'].'">';?></td>
					<?php $op = pow(1.1,(int)$row['Metal']);$metalres = 150*(int)$row['Metal']*$op;$metalt = $metalt+$metalres;?>
					<?php $op = pow(1.1,(int)$row['Cristal']);$cristalres = 75*(int)$row['Cristal']*$op;$cristalt = $cristalt+$cristalres;?>
					<?php $op = pow(1.1,(int)$row['Deuterio']);$deuteriores = 50*(int)$row['Deuterio']*$op*(1.36-0.004*((($row['TempMax']+$row['TempMin'])/2)));$deuteriot = $deuteriot+$deuteriores;?>
			  </tr> <?php } ?>
			</tbody>
		    </table>
				<div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
				  <a href="#" class="btn btn-default" role="button">Producción de metal: <strong style="color:purple"><?=number_format($metalt,0,",",".");?></strong> por hora</a>
				  <a href="#" class="btn btn-default" role="button">Producción de cristal: <strong style="color:blue"><?=number_format($cristalt,0,",",".");?></strong> por hora</a>
				  <a href="#" class="btn btn-default" role="button">Producción de deuterio: <strong style="color:red"><?=number_format($deuteriot,0,",",".");?></strong> por hora</a>
				</div></br>
			<button type="submit" class="btn btn-default">Actualizar</button>
		</form>
		<?php 
			if(mysqli_num_rows($resultado) <= 9){
				echo '<button id="btnadd" onclick="addPlanet(0,1000)" class="btn btn-default">Añadir planeta</button>';
				}else{
				echo '<button class="btn btn-default disabled">Añadir planeta</button>';}
		?>
		</br>
		</br>
		<?php 	
		/* Reiniciamos el array */
		mysqli_data_seek($resultado,0);
		?>
		
		<!-- Defenses table -->
		<table class="table" style="background-color:rgba(240, 240, 240, 1);border-style: solid;border-width: 1px;">
		<thead>
			  <tr>
			    <th style="color:red;">Nombre defensa</th>
			    <?php while($row = mysqli_fetch_assoc($resultado)){?>
			    <th scope="row"><?php echo $row['nombre'];?></th>
			    <?php }?>
			  </tr>
			</thead>
			<tbody>
				<tr>
					<th>Lanzamisiles</th>
					<?php mysqli_data_seek($resultado,0);
					      while($row = mysqli_fetch_assoc($resultado)){?>
					      <td><?=$row['Lanzamisiles'];?></td>
					<?php }?>
				</tr>
				<tr>
					<th>LaseresP</th>
					<?php mysqli_data_seek($resultado,0);
					      while($row = mysqli_fetch_assoc($resultado)){?>
					      <td><?=$row['LaseresP'];?></td>
					<?php }?>
				</tr>
				<tr>
					<th>LaseresG</th>
					<?php mysqli_data_seek($resultado,0);
					      while($row = mysqli_fetch_assoc($resultado)){?>
					      <td><?=$row['LaseresG'];?></td>
					<?php }?>
				</tr>
				<tr>
					<th>Gauss</th>
					<?php mysqli_data_seek($resultado,0);
					      while($row = mysqli_fetch_assoc($resultado)){?>
					      <td><?=$row['Gauss'];?></td>
					<?php }?>
				</tr>
				<tr>
					<th>Ionico</th>
					<?php mysqli_data_seek($resultado,0);
					      while($row = mysqli_fetch_assoc($resultado)){?>
					      <td><?=$row['Ionico'];?></td>
					<?php }?>
				</tr>
				<tr>
					<th>Plasma</th>
					<?php mysqli_data_seek($resultado,0);
					      while($row = mysqli_fetch_assoc($resultado)){?>
					      <td><?=$row['Plasma'];?></td>
					<?php }?>
				</tr>
				<tr>
					<th>CupulaP</th>
					<?php mysqli_data_seek($resultado,0);
					      while($row = mysqli_fetch_assoc($resultado)){?>
					      <td><?=$row['CupulaP'];?></td>
					<?php }?>
				</tr>
				<tr>
					<th>CupulaG</th>
					<?php mysqli_data_seek($resultado,0);
					      while($row = mysqli_fetch_assoc($resultado)){?>
					      <td><?=$row['CupulaG'];?></td>
					<?php }?>
				</tr>
				<tr>
					<th>MisilesB</th>
					<?php mysqli_data_seek($resultado,0);
					      while($row = mysqli_fetch_assoc($resultado)){?>
					      <td><?=$row['MisilesB'];?></td>
					<?php }?>
				</tr>
				<tr>
					<th>Satelites</th>
					<?php mysqli_data_seek($resultado,0);
					      while($row = mysqli_fetch_assoc($resultado)){?>
					      <td><?=$row['Satelites'];?></td>
					<?php }?>
				</tr>
			</tbody>
		</table></br>
		<button id="btnaddD" class="btn btn-default" onclick="addDef()" >Actualizar defensas</button>
		<br><br>
		<!-- Order defenses information -->
		<ol class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display: block; position: static; margin-bottom: 5px; *width: 180px;">
                <li><a tabindex="-1" href="#">Planeta con más lanzamisiles:</a></li>
                <li><a tabindex="-1" href="#">Planeta con más láseres pequeños:</a></li>
                <li><a tabindex="-1" href="#">Planeta con más láseres grandes:</a></li>
                <li><a tabindex="-1" href="#">Planeta con más gauss:</a></li>
                <li><a tabindex="-1" href="#">Planeta con más ionicos:</a></li>
                <li><a tabindex="-1" href="#">Planeta con más plasmas:</a></li>
                <li><a tabindex="-1" href="#">Planeta con más misiles:</a></li>
                <li><a tabindex="-1" href="#">Planeta con más satélites:</a></li>
                <li class="divider"></li>
                <li><a tabindex="-1" href="#">Separated link</a></li>
              </ol>
		<!-- Add defense form start -->
		<form id="adddef" action="adddef.php" method="post" target="_blank">
		<table class="table" style="background-color:rgba(240, 240, 240, 1);border-style: solid;border-width: 1px;">
		<thead>
			<tr>
			<th>ID planeta</th>
			<th>Lanzamisiles</th>
			<th>LaseresP</th>
			<th>LaseresG</th>
			<th>Gauss</th>
			<th>Ionico</th>
			<th>Plasma</th>
			<th>CupulaP</th>
			<th>CupulaG</th>
			<th>MisilesB</th>
			<th>Satelites</th>
			</tr>
		</thead>
		<tbody>
			<tr>
			<td><input type="number" name="id" required></td>
			<td><input type="number" style="width:100px" name="Lanzamisiles" ></td>
			<td><input type="number" style="width:100px" name="LaseresP" ></td>
			<td><input type="number" style="width:80px" name="LaseresG" ></td>
			<td><input type="number" style="width:60px" name="Gauss" ></td>
			<td><input type="number" style="width:60px" name="Ionico" ></td>
			<td><input type="number" style="width:60px" name="Plasma" ></td>
			<td><input type="number" style="width:40px" name="CupulaP" ></td>
			<td><input type="number" style="width:40px" name="CupulaG" ></td>
			<td><input type="number" style="width:60px" name="MisilesB" ></td>
			<td><input type="number" style="width:60px" name="Satelites" ></td>
			</tr>
		</tbody>
		</table>
		<button type="submit" class="btn btn-default" id="addbtn">Actualizar</button>
		</form>
		<!-- END Defenses table -->
		
		</br>
		</br>
		
		<form id="addplanet" action="addplanet.php" method="post" target="_blank">
		<table class="table" style="background-color:rgba(240, 240, 240, 1);border-style: solid;border-width: 1px;">
		<thead>
			<tr>
			<th>Nombre</th>
			<th>Metal</th>
			<th>Cristal</th>
			<th>Deuterio</th>
			<th>Robots</th>
			<th>Hangar</th>
			<th>Laboratorio</th>
			</tr>
		</thead>
		<tbody>
			<tr>
			<td><input type="text" name="NNombre" required></td>
			<td><input type="number" style="width:40px" name="NMetal" required></td>
			<td><input type="number" style="width:40px" name="NCristal" required></td>
			<td><input type="number" style="width:40px" name="NDeuterio" required></td>
			<td><input type="number" style="width:40px" name="NRobots" required></td>
			<td><input type="number" style="width:40px" name="NHangar" required></td>
			<td><input type="number" style="width:40px" name="NLaboratorio" required></td>
			</tr>
		</tbody>
		</table>
		<button type="submit" class="btn btn-default" id="addbtn">Añadir</button>
		</form>
	</body>
</html>

<?php 
    /* liberar el conjunto de resultados */
    mysqli_free_result($resultado);
    /* cerrar conexión */
    mysqli_close($link);
?>
