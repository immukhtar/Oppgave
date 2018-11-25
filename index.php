<?php

$Feilmeldinger = "";
  $Connect = mysqli_connect('127.0.0.1', 'root', '', 'dagsoppg');

  if(isset($_POST['Kjor'])){
  $oppg = $_POST['oppg'];
  if(empty($oppg)){
  $Feilmeldinger = "Du må skrive noe for at dette kan kunne utføres!";
}else{
 mysqli_query($Connect, "INSERT INTO oppgs(oppg) VALUES('$oppg')");
  header('location: index.php');
	
}

}
if(isset($_GET['del_oppg'])){
	$id =$_GET['del_oppg'];
	mysqli_query($Connect, "DELETE FROM oppgs WHERE id=$id");
}

$oppgs = mysqli_query($Connect, "SELECT* FROM oppgs");


?>



<!DOCTYPE html>
<html>
<head>
	<title>Dags oppgave tabell</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="heading">
		<h2>informasjon informasjon</h2>
	</div>

	<form method="POST" action="index.php">
		<?php if (isset($Feilmeldinger)){ ?>
		<p><?php echo $Feilmeldinger; ?></p>

	<?php }?>

		<input type="text" name="oppg" class="oppg_input" style="width: 580px;">
		<button type="Kjor" class="add_btn" name="Kjor">Legg til</button>
	</form>
	<table>
		<thead>
			<tr>
				<th>Id Nummer</th>
				<th>Oppgave</th>
				<th>Handling</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_array($oppgs)){?>

			
			<tr>
				<td><?php echo $row['id']; ?></td>
				<td class="oppg"><?php echo $row['oppg'];?></td>
				<td class="delete">
					<a href="index.php?del_oppg=<?php echo $row['id'];?>" style="text-align: left;
					">X</a>
				</td>
			</tr>
			<?php }?>
		</tbody>
	</table>

</body>
</html>