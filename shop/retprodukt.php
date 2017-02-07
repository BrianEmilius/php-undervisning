<?php
if ($_GET['id']) {
	$produktid = $_GET['id'];
}

$conn = mysqli_connect('localhost', 'root', '', 'shop');

if ($_POST) {
	if (!empty($_POST['produktnavn'])
	    && !empty($_POST['produktinfo'])
		&& !empty($_POST['produktpris'])) {

			mysqli_query($conn, "UPDATE produkter
			                     SET produktnavn = '".$_POST['produktnavn']."',
								     produktinfo = '".$_POST['produktinfo']."',
									 produktpris = '".$_POST['produktpris']."'
								 WHERE ID = '$produktid'");
		
		}
}

$resultat = mysqli_query($conn, "SELECT produktnavn, produktinfo, produktpris
						  FROM produkter
						  WHERE ID = $produktid");
$row = mysqli_fetch_array($resultat, MYSQLI_ASSOC);
?>
<form action="retprodukt.php?id=<?=$produktid?>" method="post">
	<p>Produktnavn: <input type="text" value="<?=$row['produktnavn']?>" name="produktnavn"></p>
	<p>Produktinfo: <textarea name="produktinfo"><?=$row['produktinfo']?></textarea></p>
	<p>Produktpris: <input type="number" value="<?=$row['produktpris']?>" name="produktpris"></p>
	<button type="submit">Gem</button>
</form>