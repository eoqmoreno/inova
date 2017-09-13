<?php
include("./CAPISPHP.php");
if(isset($_POST["titulo"])&&isset($_FILES["prod_img"]["name"])&&isset($_POST["conteudo"])&&(intval($_POST["tab"])>-1)){
  $titulo=$_POST["titulo"];$conteudo=$_POST["conteudo"];$tab_num=intval($_POST["tab"]);
  $data=date("Y-m-d");


$regras_upload=array(
  'path_name'=>'images/catalogo/',
  'extension'=>array('jpg','png','bmp','jpeg'),
  'renbymd5_fname'=>true,
  'prefix_name'=>'catal_',
  'return_extense_fname'=>false
);
$uploader=new FileUpload($regras_upload);
$nome_arquivo = $uploader->upload($_FILES["prod_img"]);

$resu=DBCon::dbQuery("INSERT INTO inova_catalogo VALUES(null,'$titulo','$nome_arquivo','$conteudo','$data',$tab_num);");
//echo('Publicado com sucesso.');
header('location: catalogo.php');

}else{echo('Há campos ausentes.');}
?>
