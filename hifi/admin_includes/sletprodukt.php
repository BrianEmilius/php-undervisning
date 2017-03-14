<?php
if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
	$delId = $_GET['id'];
} else {
	// 404
	header('Location: admin.php?p=produkter');
}

$stmt = $conn->prepare("SELECT billede FROM produkter WHERE id = ?");
$stmt->bind_param('i', $delId);
$stmt->execute();
$stmt->bind_result($billede);
$stmt->fetch();
$stmt->close();

unlink("img/" . $billede);

if ($stmt = $conn->prepare("DELETE FROM produkter WHERE id = ?")) {
	$stmt->bind_param('i', $delId);
	$stmt->execute();
	header('Location: admin.php?p=produkter');
} else {
	echo 'Noget meget farligt gik galt (solarflares)';
}

?>