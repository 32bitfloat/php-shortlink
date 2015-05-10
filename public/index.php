<?php

require_once '../application/config/bootstrap.php';

if(isset($_GET['shorty'])){
    $shorty = trim($_GET['shorty']);
    $db = new Database();
    $url = $db->getURLfromShorty($shorty);
    $db = null;
    if($url){
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: $url");
        header("Connection: close");
        exit();
    }
}

$info = '';
$error = '';
$msg = '';

if(isset($_POST['shortenme'])){
    $url = trim($_POST['shortenme']);
    if (! URLChecker::isURLvalid($url) || ! URLChecker::isURLavailable($url)){
        $error = URLChecker::$errormsg;
    }else{
        $db = new Database();
        $shorty = $db->getShortyFromURL($url);
        if(!$shorty){
            //generate a new one
            $id = $db->insertURL($url);
            $shorty = '/'.URLShortener::encode($id);
            $db->updateShorty($id, $shorty);
            $fullurl = SHORTENER_URL.$shorty;
            $info = 'short URL successfully generated: <a href="'.$fullurl.'" target="_blank">'.$fullurl.'</a>';
        }else{
            $fullurl = SHORTENER_URL.'/'.$shorty;
            $info = 'short URL was already generated: <a href="'.$fullurl.'" target="_blank">'.$fullurl.'</a>';
        }

    }
}
if (!empty($info)){
    $msg = '<p class="info">'.$info.'</p>';
}
if (!empty($error)){
    $msg = '<p class="error">'.$error.'</p>';
}

include_once(ROOT_PATH.'/output.php');
