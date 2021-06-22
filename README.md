# file-system-explorer

    mkdir(__DIR__ . "/user_folder");

    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('../root'));

    $files = array();

    foreach ($rii as $file) {

        if ($file->isDir()) {
            mkdir()
        }

        $files[] = $file->getPathname();
    }

    var_dump($files);
