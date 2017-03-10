<?php

$hostname     = 'localhost';
$databasename = 'test';
$username     = 'root';
$password     = '';

$conn = mysqli_connect($hostname, $username, $password, $databasename);

$stmt = mysqli_prepare($conn, "INSERT INTO crud_test (name) VALUES(?)");
mysqli_stmt_bind_param($stmt, 's', $name);

$name = "Albert";
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

mysqli_close($conn);
