<?php
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
}; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://kit.fontawesome.com/55a90b93c4.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <!-- NAV BAR -->
    <nav class="navbar navbar-dark bg-dark w-100">
        <div class=" d-flex flex-grow-1">
            <a href="index.php" class="navbar-brand">
                <?php
                $rest = after_last('/', $_GET['openfile']);
                echo $rest
                ?></a>
        </div>
    </nav>

    <div class="file__card card mt-4 p-4">
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <?php
                $value = $_GET['openfile'];
                $_SESSION['filename'] = $value;

                $filename = $value;
                $fp = fopen($filename, "r"); //open file in read mode    

                $contents = fread($fp, filesize($filename)); //read file    

                echo "<pre>$contents</pre>"; //printing data of file  
                fclose($fp); //close file   
                ?>
            </blockquote>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
<script src="../assets/js/main.js"></script>

</html>