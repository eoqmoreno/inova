<?php
include('CAPISPHP.php');

class ObjetoView{
  public static $mvw;
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
ObjetoView::$mvw->AddScript("js/jquery.mask.js");
ObjetoView::$mvw->AddScript("js/main.js");




//echo($mvw->head());
//Reconhece URL atual e navega diretamente.
PageControl::navegar_para(URLPos::getURLObjects());
//Encaminha para arquivo: mod_PageControl.php
?>
