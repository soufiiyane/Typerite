<?php
spl_autoload_register(function($class){
    $fullPath = 'app/Classes/'.$class.'.php';
    if(!file_exists($fullPath)){
        return "file $fullPath is not exist";
    }
	include_once $fullPath;
});

spl_autoload_register(function($class){
    $fullPath = 'app/Contracts/'.$class.'.php';
    if(!file_exists($fullPath)){
        return "file $fullPath is not exist";
    }
	include_once $fullPath;
});
