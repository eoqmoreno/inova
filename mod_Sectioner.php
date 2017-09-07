<?php
class HTMLSection{
  public static $section_props=array('path_sections'=>'sections');
  public static $arrayClasses=array();

  function __construct($namesArray){
    foreach ($namesArray as $item){
      include_once(URLPos::getURLDirRoot().HTMLSection::$section_props['path_sections'].'/'.$item.'.php');
      $objeto = new $item();
      echo($objeto->getHTML());
    }
  }

}
?>
