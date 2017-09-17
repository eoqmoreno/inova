<?php
include_once('mod_PHPMailer.php');
$vectDados=array('host'=>'smtp.gmail.com',
'porta'=>587,
'SMTPSec'=>'tls',
'email'=>'j3systems0@gmail.com',
'passwd'=>'thesystemKILLER',
'use_html'=>true);
$msend = new ModulePHPMailer($vectDados);
$msend->SetAssunto('Somente um teste!');
$msend->AddAnexo('./images/about-bg.jpg');
$msend->SetNomeOrigem('Inova Website');
$msend->addDestino('jeimison3@gmail.com');

$msend->SetMensagem('<h1>Isso é somente um teste</h1><h2>Haverão mil testes até que um instante de perfeição seja obtido.</h2>');

if($msend->enviar()) echo('Enviado!');
else var_dump($msend->getError());
?>
