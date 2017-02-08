<?php

if ($_GET) {
	if ( isset($_GET['id']) ) {
		$conn = mysqli_connect('localhost', 'root', '', 'shop');
		if ( $stmt = mysqli_prepare($conn, "DELETE FROM produkter
									 WHERE ID = ?") ) {
			mysqli_stmt_bind_param($stmt, 'i', $_GET['id']);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($conn);
			header('Location: produkter.php');
		} else {
			header('Location: produkt.php?id='.$_GET['id']);
		}
	} else {
		header('Location: produkter.php');
	}
}