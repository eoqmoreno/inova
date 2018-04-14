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

//Código em http://www.geradorcpf.com/script-validar-cpf-php.htm
function validaCPF($cpf = null) {
if(empty($cpf)) {
        return false;
    }
    $cpf = ereg_replace('[^0-9]', '', $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
if (strlen($cpf) != 11) {
        return false;
    }else if ($cpf == '00000000000' ||
        $cpf == '11111111111' ||
        $cpf == '22222222222' ||
        $cpf == '33333333333' ||
        $cpf == '44444444444' ||
        $cpf == '55555555555' ||
        $cpf == '66666666666' ||
        $cpf == '77777777777' ||
        $cpf == '88888888888' ||
        $cpf == '99999999999') {
        return false;
     } else {

        for ($t = 9; $t < 11; $t++) {

            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
        return true;
    }
}

//Código em https://gist.github.com/guisehn/3276302
function validar_cnpj($cnpj){
	$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
	if (strlen($cnpj) != 14)
		return false;
	for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
	{
		$soma += $cnpj{$i} * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}
	$resto = $soma % 11;
	if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
		return false;
	for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
	{
		$soma += $cnpj{$i} * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}
	$resto = $soma % 11;
	return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
}

ObjetoView::$mvw = new MainView();

ObjetoView::$mvw->AddStyle("css/bootstrap.min.css");
ObjetoView::$mvw->AddStyle("css/animate.min.css");
ObjetoView::$mvw->AddStyle("font-awesome/css/font-awesome.min.css");
ObjetoView::$mvw->AddStyle("css/lightbox.css");
ObjetoView::$mvw->AddStyle("css/main.css");
ObjetoView::$mvw->AddStyle("css/presets/preset1.css"); //CSS-PRESET
ObjetoView::$mvw->AddStyle("css/responsive.css");
ObjetoView::$mvw->AddStyle("css/subeffects.css");
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
