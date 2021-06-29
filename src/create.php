<?php

session_start();

if (isset($_GET['folderName'])) {
    createRelativeDir();
}

if (isset($_GET['folderCurrentName'])) {
    createCurrentDir();
}

function createRelativeDir()
{
    $path = "../root/";
    $newDir = $_GET['folderName'];
    mkdir("$path/$newDir", 0777);
    header("Location: ./index.php");
}

function createCurrentDir()
{
    /*$path = $_GET['dirList'];
    echo $path;
    if (isset($_GET['folderCurrentName'])) {
        $newDir = $_GET['folderCurrentName'];
        mkdir("$path/$newDir");
    }*/
    $path = $_SESSION['path'];
    echo $path;
    $newDir = $_GET['folderCurrentName'];
    if ($newDir) {
    }
    mkdir("$path/$newDir", 0777);

    $result = str_replace("/", "%2F", $path);

    header("Location: ./listdir.php?dirList=$result");
}
