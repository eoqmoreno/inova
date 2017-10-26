<?php
include('CAPISPHP.php');

class ObjetoView{
  public static $mvw;
}
class Usuario{
  public static $ativo=false;
}

if(Cookie::get("UID")){
$UID = intval(Cookie::get("UID"));
$data=DBCon::dbQuery("SELECT * FROM inova_representante WHERE id_rep=$UID;");
if($data){
  if($data->num_rows==1){//Se achar algum resultado válido...
Usuario::$ativo=true;
    }else Cookie::del("UID"); //Se não houver alguém com ID, 'desloga'

}
}

ObjetoView::$mvw = new MainView();
ObjetoView::$mvw->AddStyle("css/bootstrap.min.css");
ObjetoView::$mvw->AddStyle("css/animate.min.css");
ObjetoView::$mvw->AddStyle("font-awesome/css/font-awesome.min.css");
ObjetoView::$mvw->AddStyle("css/lightbox.css");
ObjetoView::$mvw->AddStyle("css/main.css");
ObjetoView::$mvw->AddStyle("css/presets/preset1.css"); //CSS-PRESET
ObjetoView::$mvw->AddStyle("css/responsive.css");
ObjetoView::$mvw->AddHead('<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyD8hFUlenk2HWG8MFJk7TCouZJTi3xStZ8"></script>');
ObjetoView::$mvw->AddHead("<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>");
ObjetoView::$mvw->AddHead("<link rel='shortcut icon' href='".URLPos::getURLDirRoot()."images/favicon.ico'>");

ObjetoView::$mvw->AddScript("js/jquery.js");
ObjetoView::$mvw->AddScript("js/jquery.inview.min.js");
ObjetoView::$mvw->AddScript("js/wow.min.js");
ObjetoView::$mvw->AddScript("js/mousescroll.js");
ObjetoView::$mvw->AddScript("js/smoothscroll.js");
ObjetoView::$mvw->AddScript("js/lightbox.min.js");
ObjetoView::$mvw->AddScript("js/bootstrap.min.js");
ObjetoView::$mvw->AddScript("js/html5shiv.js");
ObjetoView::$mvw->AddScript("js/jquery.mask.js");
ObjetoView::$mvw->AddScript("js/main.js");




//echo($mvw->head());
//Reconhece URL atual e navega diretamente.
PageControl::navegar_para(URLPos::getURLObjects());
//Encaminha para arquivo: mod_PageControl.php
?>
