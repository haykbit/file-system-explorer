<?php
session_start();

$dir = $_SESSION['path'];
$path = dirname($dir);

$result = str_replace("/", "%2F", $path);


if ($path == "../root") {
    header("Location: ./index.php");
} else {
    header("Location: ./listdir.php?dirList=$result");
}
