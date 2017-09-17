<?php
class ModulePHPMailer{
	public $mail,$mailRules,$corpoEmail,$ErrorNum=0,$ErroMsg="";

function __construct($inp_rules){
	$this->mailRules=$inp_rules;
	require './libs/phpmailer/PHPMailerAutoload.php';
	$this->mail = new PHPMailer();
	$this->mail->isSMTP(); //Define como SMTP
	$this->mail->Port = $this->mailRules['porta'];
	$this->mail->SMTPSecure = $this->mailRules['SMTPSec'];
	$this->mail->SMTPAuth = true;
	$this->mail->SMTPDebug = 0; //2=Desativa depuração
	$this->mail->Debugoutput = 'html';
	$this->mail->Host = $this->mailRules['host'];
	$this->mail->Username = $this->mailRules['email'];
	$this->mail->Password = $this->mailRules['passwd'];
	$this->mail->setLanguage('pt_br', './libs/phpmailer/language/');
if(array_key_exists('use_html', $this->mailRules))	$this->mail->isHTML($this->mailRules['use_html']);
}

function addDestino($email,$nome=""){if($nome!="")$this->mail->addAddress($email,$nome);else $this->mail->addAddress($email);}
function SetNomeOrigem($nome){$this->mailRules['from_name']=$nome;}
function SetAssunto($assuntomsg){$this->mail->Subject=$assuntomsg;}
function SetMensagem($msg){$this->corpoEmail=$msg;}
function AddAnexo($endereco,$optionnome=''){if($optionnome=='')$this->mail->addAttachment($endereco);else $this->mail->addAttachment($endereco,$optionnome);}

function enviar(){
		if(!isset($this->corpoEmail)){
			$this->ErrorNum=2;$this->ErroMsg="Não existe mensagem para ser enviada.";
		}
		if(!array_key_exists('from_name', $this->mailRules)){
			$this->ErrorNum=3;$this->ErroMsg="Nome de origem não foi definido.";
		}

		if($this->ErrorNum>0) {return false;}

	$this->mail->Body=$this->corpoEmail;
	$this->mail->setFrom($this->mailRules['email'],$this->mailRules['from_name']);
	if (!$this->mail->send()){
		$this->ErroMsg=$this->mail->ErrorInfo;
		$this->ErrorNum=1;//Erro MAILER.
		return false;
	} else return true;
}
function getError(){
	return array('code'=>$this->ErrorNum,'value'=>$this->ErroMsg);
}
}
?>
