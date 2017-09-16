<?php
include('CAPISPHP.php');
//echo($_SERVER['REQUEST_URI']." | ".$_SERVER['SCRIPT_NAME']);
//echo(str_replace($_SERVER['REQUEST_URI'],"",$_SERVER['SCRIPT_NAME']));
//echo(URLPos::getURLPos());
//var_dump(URLPos::getURLObjects());
//Reconhece URL atual e navega diretamente.
PageControl::navegar_para(URLPos::getURLObjects());
//Encaminha para arquivo: mod_PageControl.php
?>
