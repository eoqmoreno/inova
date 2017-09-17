<?php
include("CAPISPHP.php");
if(isset($_POST["nome"])&&isset($_POST["telef"])&&isset($_POST["assu"])&&isset($_POST["mes"])){
  $nome=$_POST["nome"];$email=$_POST["mail"];$telefone=$_POST["telef"];$assunto=$_POST["assu"];$mensg=$_POST["mes"];
  $data=date("Y-m-d H:i:s");

$resu=DBCon::dbQuery("INSERT INTO inova_contatos VALUES(null,'$nome','$assunto','$telefone','$email','$mensg','$data');");
}elseif($_POST["classe"]=="trabalhe-conosco"){
  $vectDados=array('host'=>'smtp.gmail.com',
  'email'=>'exemplo@gmail.com',
  'passwd'=>'123aaa123',
);
  $mailsend=new ModulePHPMailer();

  $_FILE['anexo'];

  $regras_upload=array(
    'path_name'=>'images/catalogo/',
    'extension'=>array('jpg','png','bmp','jpeg'),
    'renbymd5_fname'=>true,
    'prefix_name'=>'catal_',
    'return_extense_fname'=>false
  );
  $uploader=new FileUpload($regras_upload);
  $nome_arquivo = $uploader->upload($_FILES["prod_img"]);

}
?>
