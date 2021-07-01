<?php
session_start();

include "errors.php";

$dir = $_SESSION['path'];
$path = dirname($dir);
$result = str_replace("/", "%2F", $path);

$currentPath = $_SESSION['item'];
$prevPath = before_last('/', $currentPath);

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];

    $file_ext = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext));

    $allowed = array('doc', 'csv', 'jpg', 'png', 'txt', 'ppt', 'odt', 'pdf', 'zip', 'rar', 'exe', 'svg', 'mp3', 'mp4');

    if (in_array($file_ext, $allowed)) {
        if ($file_error === 0) {
            if ($file_size <= 2097152) {
                if ($prevPath == "../root") {
                    $file_name_new = $file_name;
                    $file_destination = $prevPath . "/" . $file_name_new;
                    echo "$prevPath" . "\n";
                    echo "$file_name_new" . "\n";
                    echo "$file_destination";
                    //header("Location: ./index.php");
                } else if ($currentPath != "../root") {
                    $file_name_new = $file_name;
                    $file_destination = $prevPath . "/" . $file_name_new;
                    echo "$prevPath" . "\n";
                    echo "$file_name_new" . "\n";
                    echo "$file_destination";
                    //header("Location: ./listdir.php?dirList=$result");
                }
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
