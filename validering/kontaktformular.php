<?php
$success = 'Udfyld formularen herunder, ellers dør baby.';

if ($_POST) {

	$fejl = 0; // fejl-counter

	## NAVN
	if ( isset($_POST['navn']) ) { // test om variablen eksisterer
		if ( empty($_POST['navn']) ) { // test om variablen er tom
			$fejlnavn = 'Du skal udfylde feltet, klaphat';
			++$fejl;
		} else if ( preg_match('/\d/', $_POST['navn']) ) { // test om varibel indeholder tal
			$fejlnavn = "DOH! Du ka' sgu' da ikke hedde noget med tal i. Spade.";
			++$fejl;
		} else { // success
			$navn = $_POST['navn'];
		}
	}

	## EMAIL
	if ( isset($_POST['email']) ) { // test om variablen eksisterer
		if ( empty($_POST['email']) ) { // test om variablen er tom
			$fejlemail = 'Du skal udfylde feltet, klaphat';
			++$fejl;
		} else if ( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) { // test om varibel er en email
			$fejlemail = "DOH! Du ska' sgu' da skrive en ordentlig email-adresse. Spade.";
			++$fejl;
		} else { // success
			$email = $_POST['email'];
		}
	}

	## EMNE
	if ( isset($_POST['emne']) ) { // test om variablen eksisterer
		if ( empty($_POST['emne']) ) { // test om variablen er tom
			$fejlemne = 'Du skal udfylde feltet, klaphat';
			++$fejl;
		} else { // success
			$emne = $_POST['emne'];
		}
	}

	## BESKED
	if ( isset($_POST['besked']) ) { // test om variablen eksisterer
		if ( empty($_POST['besked']) ) { // test om variablen er tom
			$fejlbesked = 'Du skal udfylde feltet, klaphat';
			++$fejl;
		} else { // success
			$besked = $_POST['besked'];
		}
	}

	## FEJLHÅNDTERING
	if ( $fejl === 0 ) {
		$navn    = '';
		$email   = '';
		$emne    = '';
		$besked  = '';
		$success = 'jæs jæs, du har klaret at udfylde en skiddesimpel formular. Flot...';
	} else {
		$errormessage = 'Ja, du er så dumpet...';
	}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Kontaktformular</title>
</head>
<body>
	<form action="kontaktformular.php" method="post">
		<p><?=@$success;?></p>
		<input type="text" name="navn" value="<?=@$navn;?>" placeholder="Navn">
		<p><?=@$fejlnavn;?></p>
		<input type="text" name="email" value="<?=@$email;?>" placeholder="Email">
		<p><?=@$fejlemail;?></p>
		<input type="text" name="emne" value="<?=@$emne;?>" placeholder="Emne">
		<p><?=@$fejlemne;?></p>
		<textarea name="besked" placeholder="Besked"><?=@$besked;?></textarea>
		<p><?=@$fejlbesked;?></p>
		<p><?=@$errormessage;?></p>
		<button type="submit">Send</button>
	</form>
</body>
</html>