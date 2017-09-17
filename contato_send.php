<?php
header('Content-Type: application/json');
include("CAPISPHP.php");
if(array_key_exists('nome',$_POST)&&array_key_exists('assu',$_POST)&&array_key_exists('mes',$_POST)
&&(array_key_exists('telef',$_POST) || array_key_exists('mail',$_POST))){
  $nome=$_POST["nome"];$assunto=$_POST["assu"];$mensg=$_POST["mes"];

$msend = new ModulePHPMailer($MailerData);
$msend->SetAssunto("SAC - Nova Mensagem");
$msend->SetNomeOrigem('Inova Website');
$msend->addDestino('jeimison3@gmail.com');

$emailcampo="";
if(isset($_POST["mail"])){$emailcampo="<p>E-mail: <a href=".$_POST["mail"].">".$_POST["mail"]."</a></p>";}

$telefonecampo="";
if(isset($_POST["telef"])){$telefonecampo="<p>Telefone: ".$_POST["telef"]."</p>";}


$msend->SetMensagem("<p>Classificação: <b>$assunto</b>.</p>
<p>A seguinte mensagem foi <b>enviada por '$nome'</b></p>
$emailcampo
$telefonecampo
<p>Mensagem: <b><i>$mensg</i></b></p>");
$msend->enviar();

echo(json_encode($msend->getError()));
/*
  $data=date("Y-m-d H:i:s");

$resu=DBCon::dbQuery("INSERT INTO inova_contatos VALUES(null,'$nome','$assunto','$telefone','$email','$mensg','$data');");
*/
}elseif($_POST["classe"]=="trabalhe-conosco"){
  $regras_upload=array(
    'path_name'=>'uploads/tmp/',
    'extension'=>array('pdf','jpg','png','bmp','jpeg'),
    'renbymd5_fname'=>true,
    'prefix_name'=>'curric_',
    'return_extense_fname'=>true
  );
  $uploader=new FileUpload($regras_upload);
  $nome_arquivo = $uploader->upload($_FILES["anexo"]);


  $msend = new ModulePHPMailer($MailerData);
  $msend->SetAssunto('Trabalhe Conosco - Novo Curriculo');
  $msend->AddAnexo($nome_arquivo);
  $msend->SetNomeOrigem('Inova Website');
  $msend->addDestino('jeimison3@gmail.com');

  $msend->SetMensagem('<p>Segue em anexo currículo enviado no site.</p>');

  $msend->enviar();
  echo(json_encode($msend->getError()));


}else echo(json_encode(array('code'=>404,'value'=>'Função não reconhecida. Algum campo está faltando?')));
?>
