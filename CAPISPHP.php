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
include_once('./mod_PHPMailer.php');

//Regras para estrutura HTML da página:
class CAPISPHP_Structure{
  public static $Produtos_Upload_Data=array('path_name'=>'images/catalogo/','extension'=>array('jpg','png','bmp','jpeg'),'renbymd5_fname'=>true,'prefix_name'=>'catal_');
  public static $MailerData=array('host'=>'smtp.gmail.com','porta'=>587,'SMTPSec'=>'tls','email'=>'j3systems0@gmail.com','passwd'=>'thesystemKILLER','use_html'=>true);

  //Dados padrão:
  public static $METAPROP_SiteName="Inova Utilidades";
  public static $autor="Inova";
  public static $HTML_lang="pt";
  public static $COPYRIGHT="GNU GENERAL PUBLIC LICENSE v3";
  public static $descricao="Inova - Indústria e Comércio de Utilidades para o Lar";
  public static $titulo="";
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


class MainView{
public $headStrct;

function AddHead($dataAdd){$this->headStrct.="\t\t$dataAdd\n";}
function AddRawMeta($contnt){self::AddHead("<meta ".$contnt." />");}
function AddMeta($name,$contnt){self::AddRawMeta("name='".$name."' content='".$contnt."'");}
function AddScript($dataAdd){self::AddHead("<script src='".URLPos::getURLDirRoot().$dataAdd."'></script>");}
function AddStyle($dataAdd){self::AddHead("<link href='".URLPos::getURLDirRoot().$dataAdd."' rel='stylesheet' type='text/css'>");}

//Função final para exibir conteúdo
function head($indexar=false){
$this->AddRawMeta('http-equiv="Content-type" content="text/html; charset=utf-8"');
$this->AddRawMeta('http-equiv="X-UA-Compatible" content="IE=edge"');
$this->AddMeta('viewport','width=device-width, initial-scale=1, maximum-scale=1');

if(!$indexar) $this->AddMeta('robots','noindex');

$this->AddMeta('description',CAPISPHP_Structure::$descricao);
$this->AddMeta('author',CAPISPHP_Structure::$autor);
$this->AddMeta('keywords',CAPISPHP_Structure::$keywrds);
$this->AddMeta('theme-color',CAPISPHP_Structure::$corTema);
$this->AddMeta('language',CAPISPHP_Structure::$METAPROP_Language);
$this->AddMeta('COPYRIGHT',CAPISPHP_Structure::$COPYRIGHT);

//GOOGLE METATAGS:
$this->AddMeta('google',"notranslate");
$this->AddMeta('google',"nositelinkssearchbox");

$this->AddMeta('RATING','GENERAL');
$this->AddMeta('DISTRIBUTION','GLOBAL');
$this->AddMeta('RESOURCE-TYPE','DOCUMENT');

if(CAPISPHP_Structure::$UsarMetaProp){
$this->AddRawMeta('property="og:locale" content="'.CAPISPHP_Structure::$METAPROP_Locale.'"');
$this->AddRawMeta('property="og:description" content="'.PageStruct::$descricao.'"');
$this->AddRawMeta('property="og:site_name" content="'.CAPISPHP_Structure::$METAPROP_SiteName.'"');
$this->AddRawMeta('property="og:image" itemprop="image" content="'.CAPISPHP_Structure::host_link().CAPISPHP_Structure::$METAPROP_IMG.'"');
$this->AddRawMeta('property="og:url" content="'.CAPISPHP_Structure::endereco_link().'"');
$this->AddRawMeta('property="og:type" content="article"');
$this->AddRawMeta('property="og:title" content="'.CAPISPHP_Structure::$titulo.' - '.CAPISPHP_Structure::$METAPROP_SiteName.'"');
}
if(CAPISPHP_Structure::$titulo!="")
$this->AddHead('<title>'.CAPISPHP_Structure::$titulo.' - '.CAPISPHP_Structure::$METAPROP_SiteName.'</title>');
else $this->AddHead('<title>'.CAPISPHP_Structure::$METAPROP_SiteName.'</title>');

return $this->headStrct;
}
}
?>
