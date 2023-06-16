<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function conf_link($link){
    if(isContaint('#',$link)){
        return '#';
    }else
    if(isContaint('http',$link)){
        return $link;
    }if(isFile($link)){
        return base_url().$link;
    }else               
        return base_url().'index.php'.$link;
}
function isFile($link){
    $arrExt=array('.jpg','.png');
    foreach($arrExt as $ext){
        if(isContaint($ext,$link)) return true;
    }
    return false;
}
function isContaint($search,$string){
    if (strpos($string,$search) !== false) {
        return true;
    }else return false;
}

function specialCharToHtmlCode($string){
    $key=$string;
    $key=str_replace(' ','%20',$key);
    $key=str_replace('@','%40',$key);
    return $key;
}

function transHtmlCode($string){
    $key=$string;
    $key=str_replace('%40','@',$key);
    $key=str_replace('%20',' ',$key);
    return $key;
}
function conf_filename($filename){
    $forbid=array("'");
    return str_replace($forbid,"",$filename);
}
