<?php
class FileUpload{
  public $regrasVector;
  function __construct($regrasArr){
    $this->regrasVector=$regrasArr;
  }

  function upload($uploadFile){
  $extensao_arquivo = strtolower(pathinfo($uploadFile["name"],PATHINFO_EXTENSION)); //Extrai a extensão do arquivo em caixa baixa
  $nome_trajeto=basename($uploadFile["name"]); //Usa o nome original
  if($this->regrasVector['renbymd5_fname']){ //Se regra verdadeira, renomeia usando MD5
    $nome_trajeto=md5(basename($uploadFile["name"]).date("Y-m-d")).".".$extensao_arquivo;
  }
  $nome_trajeto=$this->regrasVector['prefix_name'].$nome_trajeto; //Insere prefixo no nome
  $arquivo_trajeto = URLPos::getURLDirRoot().$this->regrasVector['path_name'] . $nome_trajeto; //Cria variável com pasta e nome final
  $extensao_correta=true; //Começa como verdadeiro
  if(isset($this->regrasVector['extension'])) $extensao_correta=in_array($extensao_arquivo,$this->regrasVector['extension']);
  //Se existir alguma extensão, verifica alguma bate com a atual
  if ($extensao_correta && (!file_exists($arquivo_trajeto)) ) { //Se as extensões estiverem corretas, e o arquivo ainda não existe:
    if( move_uploaded_file($uploadFile['tmp_name'], $arquivo_trajeto) ){
      if($this->regrasVector['return_extense_fname'])
      return $arquivo_trajeto;else return $nome_trajeto;

    }else{echo('Falha no upload.');
      exit; //Ou cancela tudo.
    }
  } else {
    echo('Extensão incorreta.');
    exit;
  }

return "";
  }
}
?>
