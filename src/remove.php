<?php
session_start();

include "errors.php";

$dir = $_SESSION['path'];
$path = dirname($dir);
$result = str_replace("/", "%2F", $path);

$remove = $_GET['removeDir'];
echo $remove;

$ext = pathinfo($remove);

if (isset($ext['extension'])) {
    if ($path == "../root") {
        unlink($remove);
        header("Location: ./index.php");
    } else if ($path != "../root") {
        unlink($remove);
        header("Location: ./listdir.php?dirList=$result");
    }
} else {
    $dirs = scandir($remove);
    $empty = sizeof($dirs);

    if ($empty == 2) {
        if ($path == "../root" && !isset($ext['extension'])) {
            rmdir($remove);
            header("Location: ./index.php");
        } else if (!$path == "../root" && !isset($ext['extension'])) {
            rmdir($remove);
            header("Location: ./listdir.php?dirList=$result");
        }
    } else {
        echo "<p style='color: red;'>This folder is not empty";
    }
}
