<?php
session_start();
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] != FALSE) {
	header('Location: index.php');
	die();
}