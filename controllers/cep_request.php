<?php
if( isset(URLPos::getURLObjects()[2])&&(strlen(URLPos::getURLObjects()[2])==9) ){
header('Content-Type: application/json');
$cep = URLPos::getURLObjects()[2];
$data_get=file_get_contents("https://webmaniabr.com/api/1/cep/".$cep."/?app_key=wxIyUdsEdS5EFAjWrt7PeMFXfiN4QFZ7&app_secret=6THBoFJUrZnd67BR0sYHXaoKaq3fA83ez90ufvKy6lkUlCpR");
//endereco | bairro | cidade | uf
$array_dados=json_decode($data_get);
$array_dados->uf=substr($array_dados->uf, 0, 2);
$resumo = array('code' => 0, 'dados' => $array_dados);
echo(json_encode($resumo));

}elseif(isset(URLPos::getURLObjects()[2])&&(URLPos::getURLObjects()[2]=="estados")){

header('Content-Type: application/json');
$cep_file="js/estados-cidades.json";
$Cidades_INST=file_get_contents($cep_file);
$Cidades_ARR = json_decode($Cidades_INST);
  //Se não há mais atributos, retorna tudo
  if(!isset(URLPos::getURLObjects()[3])){
    $arrEstados=array();
    foreach ($Cidades_ARR->estados as $key => $valor) {
      $arrEstados[$valor->sigla] = array('nome' => $valor->nome,'uf' => $valor->sigla, 'cidades'=> $valor->cidades);
    }
    echo(json_encode(array('code'=>0,'estados'=>$arrEstados)));
  }

//foreach ($Cidades_ARR->estados as $key => $valor) {
//  echo('Estado= '.$valor->nome."<br/>\n\tCidades:".sizeof($valor->cidades)."<br/>\n");
//}

}
?>
