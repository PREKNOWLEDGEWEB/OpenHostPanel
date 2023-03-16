<?php
session_start();
if(isset($_SERVER['HTTP_ARRAY_DATA'])){ 
    $_POST = json_decode($_SERVER['HTTP_ARRAY_DATA'],"false"); 
}
function checkLogin(){
    if(isset($_SESSION['uid'])){
        return true;
    }else{
        return false;
    }
}

function get_Sites(){
    $siteJson = file_get_contents("/opt/openhostpanel/user/sites.json");
    return json_decode($siteJson,"false");
}

function JRedir($u){
    echo ('<script>');
    echo ('window.location.href = "'.$u.'";');
    echo ('</script>');
}

function replaceStar($domain){
    $domain = str_replace("*","." ,$domain);
    return $domain;
}

function replaceDot($domain){
    $domain = str_replace(".","_" ,$domain);
    return $domain;
}

function rrmdir($dir) { 
    if (is_dir($dir)) { 
      $objects = scandir($dir);
      foreach ($objects as $object) { 
        if ($object != "." && $object != "..") { 
          if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
            rrmdir($dir. DIRECTORY_SEPARATOR .$object);
          else
            unlink($dir. DIRECTORY_SEPARATOR .$object); 
        } 
      }
      rmdir($dir); 
    } 
}

function replaceDash($domain){
    $domain = str_replace("_","*" ,$domain);
    return $domain;
}

function _replaceDash($domain){
    $domain = str_replace("_","-" ,$domain);
    return $domain;
}

function checkRegister(){
    if(file_exists("/opt/openhostpanel/user/password")){
        return false;
    }else{
        return true;
    }
}