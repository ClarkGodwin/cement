<?php

$directories = [
        '/var/www/html/cement/Models/',
        '/var/www/html/cement/Models/tables/',
];

spl_autoload_register(function($class_name) use($directories){
        foreach($directories as $directory){
                $file = $directory . $class_name . '.php';
                if(file_exists($file)){
                        include $file;
                        return;
                }
        }
});
