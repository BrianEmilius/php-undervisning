<?php

$success = 'Opret et produkt herunder.';

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
	if ( $fejl === 0 ) { // Hvis der ikke er nogen fejl
		$conn = mysqli_connect('localhost', 'root', '', 'shop');
		mysqli_query($conn, "INSERT INTO `produkter` (produktnavn, produktinfo, produktpris)
							 VALUES('$produktnavn', '$produktinfo', '$produktpris')");
		mysqli_close($conn);

		unset($produktnavn, $produktinfo, $produktpris);
		$success = 'Produktet blev oprettet.';
	}
}
?>
<form action="" method="post">
	<p><?=@$success?></p>
	<input type="text" name="produktnavn" placeholder="Produktnavn" value="<?=@$produktnavn?>">
	<p><?=@$fejlnavn?></p>
	<textarea name="produktinfo" placeholder="Produktinfo"><?=@$produktinfo?></textarea>
	<p><?=@$fejlinfo?></p>
	<input type="text" name="produktpris" placeholder="Produktpris" value="<?=@$produktpris?>">
	<p><?=@$fejlpris?></p>
	<button type="submit">Opret</button>
</form>