<?php

$hostname     = 'localhost';
$databasename = 'test';
$username     = 'root';
$password     = '';

$conn = mysqli_connect($hostname, $username, $password, $databasename);

$stmt = mysqli_prepare($conn, "SELECT id, name FROM crud_test WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'd', $id);

$id = 4;
mysqli_stmt_execute($stmt);

mysqli_stmt_bind_result($stmt, $id, $name);

mysqli_stmt_fetch($stmt);

printf("%d\t%s".PHP_EOL, $id, $name);

mysqli_stmt_close($stmt);

mysqli_close($conn);
