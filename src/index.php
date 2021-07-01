<?php
session_start();
?>
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
    </nav>

    <!--CREATE FOLDER-->
    <form class="form-inline mt-3 mr-3 float-right" action="create.php" method="GET" enctype="multipart/form-data">
        <div>
            <img src="../assets/img/add-folder.png" width="50px" height="50px" class="mb-3 mt-2">
        </div>
        <div class="form-group mx-sm-2 mb-2">
            <label for="folderName" class="sr-only">folder name</label>
            <input type="text" class="form-control" id="folderName" name="folderName" placeholder="folder name">
        </div>
        <button type="submit" class="btn btn-primary mb-2" name="createDir">Add folder</button>
    </form>

    <!--TABLE RENDER-->
    <table class="table table-striped table-dark ml-2">
        <?php
        include "./listdircontent.php";
        $dir = "../root";
        listDirContent($dir);
        ?>
    </table>

    <?php
    if (isset($_SESSION['error'])) {
        echo "
    <div class='delete__options h-75'>
    <div class='empty__folder alert alert-danger mr-2 ml-2 h-75' role='alert'>
    This folder is empty. Create a folder or add a file.
    </div> 
    <div class='delete__options'>
    <form action='checkRemove.php' method='GET'>
    <button type='submit' name='confirmDelte' class='btn btn-primary'>Yes</button>
    </form>
    <form action='checkRemove.php' method='GET'>
    <button type='submit' name='declineDelte' id='declineButton' class='btn btn-dark'>No</button>
    </form>
    </div>
    </div>";
    } else if (isset($_SESSION['decline'])) {
        echo '';
    }

    ?>

    <div class="bottom__bar">
        <section class="upload__file">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label class="custom-file-upload ml-2">
                    <input type="file" name="file" id="uploadInput" />
                    <img src="../assets/img/file.png" width="25px" height="25px">
                    Select a file
                </label>
                <input type="submit" value="Upload" class="btn btn-primary" id="uploadButton" />
            </form>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
<script src="../assets/js/main.js"></script>

</html>