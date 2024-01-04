<?php

    spl_autoload_register(function ($class) {
        
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $class = str_replace('_', DIRECTORY_SEPARATOR, $class);

        $file = __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';

        if (file_exists($file)) {
            require $file;
        }
    })
?>