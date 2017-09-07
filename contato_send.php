<?php
include("CAPISPHP.php");
if(isset($_POST["nome"])&&isset($_POST["mail"])&&isset($_POST["assu"])&&isset($_POST["mes"])){
  $nome=$_POST["nome"];$email=$_POST["mail"];$assunto=$_POST["assu"];$mensg=$_POST["mes"];
  $data=date("Y-m-d H:i:s");

$resu=DBCon::dbQuery("INSERT INTO inova_contatos VALUES(null,'$nome','$assunto','$email','$mensg','$data');");
}
?>
