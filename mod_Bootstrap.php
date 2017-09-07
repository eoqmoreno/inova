<?php
class Bootstrap{
public static $bootstrap = array(
'css_folder' => 'css/',
'js_folder' => 'js/',
'use_jquery' => false);

public static function InitBootstrap($MainVClass){
$MainVClass->AddStyle(self::$bootstrap['css_folder'].'bootstrap.min.css');
$MainVClass->AddStyle(self::$bootstrap['css_folder'].'bootstrap-theme.min.css');
if(self::$bootstrap['use_jquery'])
$MainVClass->AddScript(self::$bootstrap['js_folder'].'bootstrap.min.js');
}
}
?>
