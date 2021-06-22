<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">

    <title>Document</title>
</head>

<body>

    <div class="wrapper">
        <section class="leftSection">
            <?php
            function listFolderFiles($dir)
            {
                $ffs = scandir($dir);

                unset($ffs[array_search('.', $ffs, true)]);
                unset($ffs[array_search('..', $ffs, true)]);

                // prevent empty ordered elements
                if (count($ffs) < 1)
                    return;
                echo '<ul>';
                foreach ($ffs as $ff) {
                    echo '<li>' . $ff;
                    if (is_dir($dir . '/' . $ff)) listFolderFiles($dir . '/' . $ff);
                    echo '</li>';
                }
                echo '</ul>';
            }

            listFolderFiles('../root');
            ?>
        </section>
        <section class="rightSection">
            <?php
            if (isset($_GET['action']) == 'submitfunc') {
                $add = $_POST["add"];
                $path = "../root" . $add;
                if (!file_exists($path)) {
                    mkdir("../root/" . $add);
                }
            } else

            ?>
            <form action="?action=submitfunc" method="post">
                <table>
                    <tr>
                        <td style=" border-style: none;"></td>
                        <td style="font-weight: bold">
                            Enter Dummy Text and Then Press 'Create Directory'
                        </td>

                        <td>
                            <input type="text" style="width: 220px;" class="form-control" name="add" id="add" />
                        </td>

                        <td colspan="2">
                            <input type="submit" name="submit" value="Create directory" />
                        </td>
                    </tr>
                </table>
            </form>
        </section>
    </div>

</body>

</html>