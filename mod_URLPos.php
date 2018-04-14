<?php
class URLPos{
//Retorna string com endereço URL da página a partir do /index.php
	public static function getURLPos(){
		//Se a informação $_SERVER["PATH_INFO"] existir, retorna.
		if(isset($_SERVER["PATH_INFO"])) return $_SERVER["PATH_INFO"];
		//Se não, retira dados antes do /index.php e retorna
		else return str_replace($_SERVER['REQUEST_URI'],"",$_SERVER['SCRIPT_NAME']);
	}
//Retorna array com referências da URL a paritir do /index.php/[1]/[2]/[3]...
	public static function getURLObjects(){
		$tmp=explode('/',self::getURLPos());//Explode endereço URL a partir do /index.php
		foreach ($tmp as $key => $value) {
			if((strtolower($value)=="index.php")||($value=="")) unset($tmp[$key]);
		}
		return $tmp; //Remove index.php e retorna
	}
//Retorna string com diretórios suficientes para a raiz da página, pasta do index.php
	public static function getURLDirRoot(){
		$num_ocur_extras = substr_count(self::getURLPos(), '/');
		//echo(self::getURLPos());
		//if($num_ocur_extras>1)
		$str_sum="";//else $str_sum="../";
		for($cnt=0;$cnt<$num_ocur_extras;$cnt++)
		$str_sum.="../";
		//for ($i=0;$i<$num_ocur_extras;$i++) $str_sum.="../";
		return $str_sum;
	}

}
?>
