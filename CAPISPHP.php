<?php
/**
 * @author Jeimison M. Lima
 * @version 1.0.000
 * @since 2018-08-03
 */
// http://jeimison.me.pn | https://github.com/jeimison3/CAPISPHP/


include_once('./mod_PageControl.php'); //Controle de redirecionamentos [MODIFIQUE]
include_once('./mod_URLPos.php'); //Funções para redirecionamentos
include_once('./mod_Bootstrap.php'); //Livraria de funções para Bootstrap
include_once('./mod_BDCon.php'); //Funções para BD
include_once('./mod_BuildCatalogo.php'); //Funções de catálogo
include_once('./mod_Sectioner.php'); //Funções de catálogo
include_once('./mod_FileUploads.php'); //Ferramenta de apoio para uploads.
$MailerData=array('host'=>'smtp.gmail.com','porta'=>587,'SMTPSec'=>'tls','email'=>'j3systems0@gmail.com','passwd'=>'thesystemKILLER','use_html'=>true);
include_once('./mod_PHPMailer.php');

//Regras para estrutura HTML da página:
class CAPISPHP_Structure{

  //Dados padrão:
  public static $METAPROP_SiteName="Inova ";
  public static $autor="Nome Autor";
  public static $HTML_lang="pt";
  public static $COPYRIGHT="GNU GENERAL PUBLIC LICENSE v3";
  public static $descricao="Ferramenta de exemplo sem fins lucrativos e diversas funcionalidades";
  public static $titulo="Início";
  public static $corTema="#ffffff";
  public static $keywrds="";

  public static $UsarMetaProp=false;
  public static $METAPROP_Language="pt-br";
  public static $METAPROP_Locale="pt_BR";
  public static $METAPROP_IMG="";
  //( Alterações exigem uso das funções abaixo )

  //Definir título da página atual
  public static function setTitl($entrada){self::$titulo=$entrada;}

  //Definir Keywords
  public static function setKeywords($entrada){self::$keywrds=$entrada;}

  //Definir descrição da página atual.
  public static function setDescr($entrada){self::$descricao=$entrada;}


  //Retornar link completo da pasta raiz
  public static function endereco_link(){
	   $requri=$_SERVER['REQUEST_URI'];
	   return 'http://'.$host.URLPos::getURLPos();
  }

  //Retornar link do site
  public static function host_link(){return 'http://'.$_SERVER['HTTP_HOST'].'/';}
}

?>
