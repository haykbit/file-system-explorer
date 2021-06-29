<?php
include "create.php";
// $dir contiene el PATH del directorio listado
$_SESSION['path'] = $_GET['dirList'];

$dir = $_GET['dirList'];
?>

<!--<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://kit.fontawesome.com/55a90b93c4.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div class="main__content">
        <div class="top__bar">
            <section class="create__folder">
                <form action="create.php" method="GET" enctype="multipart/form-data">
                    <p>Create folder</p>
                    <input id="createInput" type="text" name="folderCurrentName">
                    <input id="createButton" type="submit" value="Create Folder" name="createDir">
                </form>
            </section>
        </div>
        <section class="back__button">
            <form action="./movedir.php" method="GET" enctype="multipart/form-data">
                <input type="submit" value="Back" name="backFolder">
            </form>
        </section>
        <div class="table__render">
            <table class="directories__list">

            </table>
        </div>
        <div class="bottom__bar">
            <section class="upload__file">
                <form action="upload.php" method="GET" enctype="multipart/form-data">
                    <p>Upload a File</p>
                    <input type="file" name="uploadedFile" />
                    <input type="submit" name="uploadBtn" value="Upload" />
                </form>
            </section>
        </div>
    </div>
</body>
<script src="../assets/js/main.js"></script>

</html>-->

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
    <nav class="navbar navbar-expand-md navbar-dark bg-dark w-100">
        <div class=" d-flex flex-grow-1">
            <a href="index.php" class="navbar-brand">File System</a>
            <form class="mr-2 my-auto w-100 d-inline-block order-1">
                <div class="input-group w-50 float-right">
                    <input type="text" class="form-control border border-right-0 " placeholder="Search...">
                    <span class="input-group-append">
                        <button class="btn btn-outline-light border border-left-0" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
        <button class="navbar-toggler order-0" type="button" data-toggle="collapse" data-target="#navbar7">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <!--CREATE FOLDER-->
    <form class="form-inline mt-3 mr-2 float-right" action="create.php" method="GET" enctype="multipart/form-data">
        <div>
            <img src="../assets/img/add-folder.png" width="50px" height="50px" class="mb-3">
        </div>
        <div class="form-group mx-sm-2 mb-2">
            <label for="folderName" class="sr-only">folder name</label>
            <input type="text" class="form-control" id="folderName" name="folderCurrentName" placeholder="folder name">
        </div>
        <button type="submit" class="btn btn-primary mb-2" name="createDir">Add folder</button>
    </form>

    <!--TABLE RENDER-->
    <table class="table table-striped table-dark ml-2">
        <?php
        include "./listdircontent.php";
        listDirContent($dir);
        ?>
    </table>

    <div class="bottom__bar">
        <section class="upload__file">
            <form action="upload.php" method="GET" enctype="multipart/form-data">
                <label class="custom-file-upload ml-2">
                    <input id="uploadInput" type="file" name="uploadedFile" />
                    <img src="../assets/img/file.png" width="25px" height="25px">
                    Select a file
                </label>
                <input id="uploadButton" type="submit" name="uploadBtn" value="Upload" class="btn btn-primary" />
            </form>
        </section>
        <section class="back__button">
            <form action="./movedir.php" method="GET" enctype="multipart/form-data">
                <input type="submit" value="Back" name="backFolder" class="btn btn-dark mr-2 back">
            </form>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
<script src="../assets/js/main.js"></script>

</html>