<?php

$hostname     = 'localhost';
$databasename = 'test';
$username     = 'root';
$password     = '';

$conn = mysqli_connect($hostname, $username, $password, $databasename);

$stmt = mysqli_prepare($conn, "UPDATE crud_test SET name=? WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'sd', $name, $id);

$name = "Jørgen";
$id = 1;

mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

mysqli_close($conn);
