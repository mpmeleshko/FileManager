<?php


//имя каталога
$maindir = 'folders';

if (!isset($_GET["dir"])) {
    $_GET["dir"] = $maindir;
}

//открываем каталог
$dir = opendir($_GET["dir"]);

//читаем каталог
while ($file = readdir($dir)) {
    
    //если каталог записываем в массив $folders
    if (is_dir($_GET["dir"] . "/" . $file) && ($file != ".") && ($file != "..")) {
        
        $folders[] = $file;
        
    }
    
    //если файл записываем в массив $files
    if (is_file($_GET["dir"] . "/" . $file)) {
        
        $files[] = $file;
        
    }
    
}

closedir($dir);

//asort($folders);

//var_dump($folders);


//
if (isset($folders)) {
    
    asort($folders);
    
    foreach ($folders as $folder) {
        
        if (preg_match("/[0-9]/", $folder)){
            
            $full .= $folder . '<br/>';
        }
        else {
            
        $link = $_GET['dir'];
                       
        $full .= "<a href ='?dir=" . $link . "/" . $folder . "'>" . 
                $folder . '</a>' . '<br/>';
        }
        
    }
}


if (isset($files)) {
    
    asort($files);
    
    foreach ($files as $file) {
        
        $link = $_GET['dir'];         
        $full .= $file . " (" . filesize($link) . " b)" . '<br/>' ;
        
    }
}



//переход на каталог вверх
if($_GET["dir"] != $maindir){
    
        $lastslash = strrpos($_GET["dir"], "/");
        
        $backtodir = substr($_GET["dir"], 0, $lastslash);
        
        $backlink = "<a href='?dir=".$backtodir."'>Назад</a>";
        
        print $backlink;
    }




require 'index.view.php';
