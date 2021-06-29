<?php

function emptyDir($dir)
{
    $dirs = scandir($dir);
    $emptyDir = sizeof($dirs);
    if ($emptyDir == 2) {
        echo "Empty";
    } else {
        echo "Not Empty";
    }
}
