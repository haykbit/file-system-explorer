<?php
session_start();

include "errors.php";

$dir = $_SESSION['path'];
$path = dirname($dir);
$result = str_replace("/", "%2F", $path);

$currentPath = $_SESSION['item'];
$prevPath = before_last('/', $currentPath);

if (isset($_GET['confirmDelte'])) {
    if ($prevPath == "../root") {
        removePrev($currentPath);
    } else if ($currentPath != "../root") {
        removeCurrent($currentPath, $result);
    }
} else if (isset($_GET['declineDelte'])) {
    $_SESSION['decline'] = true;
    if ($prevPath == "../root") {
        session_unset();
        header("Location: ./index.php");
    } else if ($currentPath != "../root") {
        session_unset();
        header("Location: ./listdir.php?dirList=$result");
    }
}

function removePrev($item)
{
    rrmdir($item);
    session_unset();
    header("Location: ./index.php");
}

function removeCurrent($item, $url)
{
    rrmdir($item);
    session_unset();
    header("Location: ./listdir.php?dirList=$url");
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

function rrmdir($dir)
{
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $object) && !is_link($dir . "/" . $object))
                    rrmdir($dir . DIRECTORY_SEPARATOR . $object);
                else
                    unlink($dir . DIRECTORY_SEPARATOR . $object);
            }
        }
        rmdir($dir);
    }
}
