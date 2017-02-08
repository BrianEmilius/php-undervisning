<?php

$target_dir        = "uploads/";
$uploadOk          = true;
$target_file       = $target_dir . basename($_FILES['file']['name']);
$imageFileType     = pathinfo($target_file,PATHINFO_EXTENSION);
$conn              = mysqli_connect('localhost', 'root', '', 'test_uploads');
$filesizeLimitInKB = 500;

## TJEK OM FILEN ER ET RIGTIGT BILLEDE
if ( !$img = @imagecreatefromgif($_FILES['file']['tmp_name']) || !$img = @imagecreatefromjpeg($_FILES['file']['tmp_name']) || !$img = @imagecreatefrompng($_FILES['file']['tmp_name']) ) {
	echo 'Fejl: filen er ikke et rigtigt billede.';
	$uploadOk = false;
}

## TJEK OM FILEN ALLEREDE EKSISTERER
if ( file_exists($target_file) ) {
	echo 'Fejl: filen findes allerede.';
	$uploadOk = false;
}

## TJEK FILSTØRRELSE
if ( $_FILES['file']['size'] > ($filesizeLimitInKB * 1024) ) {
	echo 'Fejl: filen er for stor.';
	$uploadOk = false;
}

## TJEK FILTYPENAVN
if ( $imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif' ) {
	echo 'Fejl: kun jpg, jpeg, png eller gif er tilladt.';
	$uploadOk = false;
}

## UPLOAD FIL og DATABASE INSERT
if ($uploadOk) { // ingen fejl i alle fil-tjek
	if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) { // hvis filen kan flyttes fra tmp til target_dir
		echo 'Filen '. basename( $_FILES['file']['name']). ' blev uploaded.';
		if ($stmt = mysqli_prepare($conn, "INSERT INTO images (filename) VALUES(?)")) { // hvis sql-sætningen kan forberedes
			mysqli_stmt_bind_param($stmt, 's', $_FILES['file']['name']);
			mysqli_execute($stmt);
			mysqli_stmt_close($stmt);
			echo 'Filnavnet er tilføjet til databasen.';
		} else { // hvis DB INSERT fejler
			echo 'Fejl: filnavnet blev ikke tilføjet til databasen.';
		}
	} else { // hvis flyt fil fejler
		echo 'Fejl: noget gik galt ved upload af filen.';
	}
}
