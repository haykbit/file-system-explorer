<?php
session_start();

include "errors.php";

$dir = $_SESSION['path'];
$path = dirname($dir);
$result = str_replace("/", "%2F", $path);

$currentPath = $_GET['removeItem'];
$prevPath = before_last('/', $currentPath);
echo "PREV PATH: $prevPath" . "\n";
echo "CURRENT PATH: $currentPath";

$ext = pathinfo($currentPath);

if (isset($_GET['removeItem'])) {
    if (isset($ext['extension'])) {
        if ($prevPath == "../root") {
            unlink($prevPath);
            header("Location: ./index.php");
        } else if ($currentPath != "../root") {
            unlink($currentPath);
            header("Location: ./listdir.php?dirList=$result");
        }
    } else {
        $dirs = scandir($currentPath);
        $empty = sizeof($dirs);
        if ($empty <= 2) {
            if ($prevPath == "../root") {
                rmdir($currentPath);
                header("Location: ./index.php");
            } else if ($currentPath != "../root") {
                rmdir($currentPath);
                header("Location: ./listdir.php?dirList=$result");
            }
        } else {
            $_SESSION['error'] = true;
            echo "<br/>" . "$prevPath" . "<br/>";
            echo "$currentPath";
            if ($prevPath == "../root" && $empty >= 2) {
                rmdir($currentPath);
                header("Location: ./index.php");
            }
        }
    }
}

function before_last($text, $inthat)
{
    return substr($inthat, 0, strrevpos($inthat, $text));
};

function strrevpos($instr, $needle)
{
    $rev_pos = strpos(strrev($instr), strrev($needle));
    if ($rev_pos === false) return false;
    else return strlen($instr) - $rev_pos - strlen($needle);
};
