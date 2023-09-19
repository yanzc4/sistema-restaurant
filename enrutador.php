<?php 
$url= $_GET['url'];
$patch = __DIR__.'/';
$file= $patch.$url.'.php';

if (!empty($url)){
    if (file_exists($file)) {
        require $file;
    } else {
    $directory = explode('/', $url);
    $param = end($directory);
    $newurl = str_replace($param, '', $url);
    echo $newurl;
    }
}else{
    $file= $patch.'index.php';
    require $file;
}



?>