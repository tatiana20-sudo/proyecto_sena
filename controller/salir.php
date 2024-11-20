<?php

session_start();

$_SESSION['active'] = 0;
$_SESSION['rol'] = null;

session_unset();
session_destroy();

header("location: ../index.php");
