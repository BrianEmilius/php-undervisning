<?php
#
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>produkter</title>
</head>
<body>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Produktnavn</th>
				<th>Produktinfo</th>
				<th colspan="2">Produktpris</th>
			</tr>
		</thead>
		<tbody>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'shop');
$result = mysqli_query($conn, "SELECT ID, produktnavn, produktinfo, produktpris
							   FROM `produkter`");
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
?>
<tr>
	<td><?=$row['ID']?></td>
	<td><?=$row['produktnavn']?></td>
	<td><?=$row['produktinfo']?></td>
	<td><?=$row['produktpris']?></td>
	<td><a href="produkt.php?id=<?=$row['ID']?>">Vis</a></td>
</tr>
<?php
}
?>
		</tbody>
	</table>
</body>
</html>