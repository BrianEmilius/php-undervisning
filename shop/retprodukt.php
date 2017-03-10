<?php
if ($_GET['id']) {
	$produktid = $_GET['id'];
}

$conn = mysqli_connect('localhost', 'root', '', 'shop');

$success = "Udfyld felterne og klik Gem.";

if ($_POST) {

	$fejl = 0;

	## PRODUKTNAVN VALIDERING
	if ( isset($_POST['produktnavn']) ) { // eksisterer variablen?
		if ( empty($_POST['produktnavn']) ) { // er variablen tom?
			$fejlnavn = 'Du skal udfylde dette felt.';
			++$fejl;
		} else if ( preg_match('/\d/', $_POST['produktnavn']) ) { // indeholder variablen tal
			$fejlnavn = 'Produktnavn må ikke indeholde tal.';
			++$fejl;
		} else { // success
			$produktnavn = $_POST['produktnavn'];
		}
	}

	## PRODUKTINFO VALIDERING
	if ( isset($_POST['produktinfo']) ) { // eksisterer variablen?
		if ( empty($_POST['produktinfo']) ) { // er variablen tom?
			$fejlinfo = 'Du skal udfylde dette felt.';
			++$fejl;
		} else { // success
			$produktinfo = $_POST['produktinfo'];
		}
	}

	## PRODUKTPRIS VALIDERING
	if ( isset($_POST['produktpris']) ) { // eksisterer variablen?
		if ( empty($_POST['produktpris']) ) { // er variablen tom?
			$fejlpris = 'Du skal udfylde dette felt.';
			++$fejl;
		} else if ( !is_numeric($_POST['produktpris']) ) { // indeholder variablen bogstaver eller andre tegn
			$fejlpris = 'Produktpris må kun indeholde tal.';
			++$fejl;
		} else { // success
			$produktpris = $_POST['produktpris'];
		}
	}

	## FEJLHÅNDTERING
	if ( $fejl === 0 ) {

		if ( $stmt = mysqli_prepare($conn, "UPDATE produkter
											SET produktnavn = ?,
												produktinfo = ?,
												produktpris = ?
											WHERE ID = ?") ) { // kan statement forberedes til SQL-serveren?
			mysqli_stmt_bind_param($stmt, 'ssii', $produktnavn, $produktinfo, $produktpris, $produktid);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			header('Location: produkt.php?id='.$produktid);
		}
	}
}

if ( $stmt = mysqli_prepare($conn, "SELECT produktnavn, produktinfo, produktpris
									FROM produkter
									WHERE ID = ?") ) {
	mysqli_stmt_bind_param($stmt, 'i', $produktid);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $produktnavn, $produktinfo, $produktpris);
	while ( mysqli_stmt_fetch($stmt) ) {
?>
<form action="retprodukt.php?id=<?=$produktid?>" method="post">
	<p><?=@$success?></p>
	<label>Produktnavn</label>
	<input type="text" value="<?=$produktnavn?>" name="produktnavn">
	<p><?=@$fejlnavn?></p>
	<label>Produktinfo</label>
	<textarea name="produktinfo"><?=$produktinfo?></textarea>
	<p><?=@$fejlinfo?></p>
	<label>Produktpris</label>
	<input type="number" value="<?=$produktpris?>" name="produktpris">
	<p><?=@$fejlpris?></p>
	<button type="submit">Gem</button>
</form>
<?php
	} // while
} // if
mysqli_close($conn);
