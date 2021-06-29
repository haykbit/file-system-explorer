<?php

function listDirContent($dir)
{
    $dirs = array_filter(glob($dir . "/*"));
    if (!empty($dirs)) {
        echo "
        <tr class='table__fields'>
        <th scope='col'>Name</th>
        <th scope='col'>Size</th>
        <th scope='col'>Path</th>
        <th scope='col'>Permissions</th>
        <th scope='col'>Extension</th>
        <th scope='col'>Actions</th>
        </tr>";
        foreach ($dirs as $item) {
            //$rest = substr($item, 8);
            $rest = after_last('/', $item);
            echo "<tr>";
            echo "<form action='listdir.php' method='GET'>";

            if (is_dir($item)) {
                echo "<td class='align-middle'><img src='../assets/img/folder-item.png' width='25px' height='25px'><button class='dir__list' type='submit' name='dirList' value='$item'>$rest/</button></td>";
            } else {
                echo "<td class='align-middle'><p class='file__name'>$rest</p></td>";
            }

            echo "</form>";

            if (is_dir($item)) {
                $f = $item;
                $io = popen('/usr/bin/du -sk ' . $f, 'r');
                $size = fgets($io, 4096);
                $size = substr($size, 0, strpos($size, "\t"));
                pclose($io);
                echo "<td class='align-middle'>" . formatSizeUnits($size) . "</td>";
            } else {
                $fileSize = filesize($item);
                echo "<td class='align-middle'>" . formatSizeUnits($fileSize) . "</td>";
            }

            echo "<td class='align-middle'>$item</td>";
            echo "<td class='align-middle'>" . substr(sprintf('%o', fileperms($item)), -4) . "</td>";

            $partes_ruta = pathinfo($item);
            if (is_dir($item)) {
                echo "<td class='align-middle'>Directory</td>";
            } else {
                echo "<td class='align-middle'>" . $partes_ruta['extension'] . "</td>";
            }
            echo "<form action='./remove.php' method='GET'>";
            echo "<td class='align-middle'>
            <button type='submit' value='$item' name='removeDir' class='btn btn-danger'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
                <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
                </svg>
                Remove
            </button>
            </form>";
            echo "<button type='submit' class='btn btn-primary'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16 '>
                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                </svg>
                Edit
            </button></td>";
            echo "</form>";
            echo "</tr>";
        }
    } else {
        //echo "<div class='empty__folder'><img src='../assets/img/folder.png' width='300px' height='300px' /><h3>Empty folder</h3></div>";
        echo "<div class='alert alert-info mr-2 ml-2' role='alert' style='margin-top: 100px;'>
            This folder is empty. Create a folder or add a file.
            </div>";
    }
}

function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
};

function after_last($text, $inthat)
{
    if (!is_bool(strrevpos($inthat, $text)))
        return substr($inthat, strrevpos($inthat, $text) + strlen($text));
};

function strrevpos($instr, $needle)
{
    $rev_pos = strpos(strrev($instr), strrev($needle));
    if ($rev_pos === false) return false;
    else return strlen($instr) - $rev_pos - strlen($needle);
};
