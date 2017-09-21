<?php

function getFullStrName($id_origem,$full_arr){
  $separador=">";$id_atual=$id_origem;
  $parou = false;
  $FinalStr="";
  while (!$parou){
    if(isset($full_arr[$id_atual])){
      $FinalStr.=" ".$full_arr[$id_atual]['titulo'];
      $id_atual=$full_arr[$id_atual]['herdando'];
      $parou=( !array_key_exists($id_atual,$full_arr) || ($id_atual==$full_arr[$id_atual]['herdando']) );
      if(!$parou) $FinalStr.=" ".$separador;
    }else $parou=true;
  }
  return $FinalStr;
}

function getKeyBySubkeyA($titulo,$vetor,$subkey){
  return array_filter($vetor, function($element) use($titulo){
    return isset($element['herdando']) && $element['herdando'] == intval($titulo) && $element['id_tab'] != intval($titulo);
  });
}

function getKeyBySubkey($titulo,$vetor,$subkey){
  return array_search($titulo, array_column($vetor, $subkey));
}

function getSubItens($grupo_tab,$main_array){
  $PrincipalValor=$grupo_tab;
  $produtos_itm = getKeyBySubkey($PrincipalValor,$main_array,'titulo');
  if($produtos_itm !== false){
    return getKeyBySubkeyA($main_array[$produtos_itm]['id_tab'],$main_array,'herdando');
  }else return false;
}

header('Content-Type: application/json');
$data=DBCon::dbQuery("SELECT * FROM inova_catalogo_tabs ORDER BY titulo ASC;");
$RetornoBD=array();
if($data->num_rows>0){
  while($item = $data->fetch_array(MYSQLI_BOTH))
    array_push( $RetornoBD, $item );
}

if(isset($_POST['funcao']) && ($_POST['funcao'] == "i")){//Inicial
  $retorno=array(
    'code'=>0,
    'lista'=>getSubItens("Produtos",$RetornoBD));

  if(sizeof($retorno['lista'])>0) echo json_encode($retorno);
  else echo json_encode(array('code'=>7));//COD 7 = SEM RESULTADOS.

}elseif(isset($_POST['funcao']) && ($_POST['funcao'] == "nxt")){//Proximas tabs
  $retorno=array(
    'code'=>0,
    'lista'=>getKeyBySubkeyA($_POST['nxt-id'],$RetornoBD,'herdando'));
    
  if(sizeof($retorno['lista'])>0) echo json_encode($retorno);
  else echo json_encode(array('code'=>7));//COD 7 = SEM RESULTADOS.

}elseif(isset($_POST['funcao']) && ($_POST['funcao'] == "a")){//Acréscimo
  $nome=$_POST['nome'];$herdado=intval($_POST['herdado']);
$data=DBCon::dbQuery("INSERT INTO inova_catalogo_tabs VALUES(null,'$nome',$herdado);");
$retorno=array('code'=>0);

echo json_encode($retorno);

}elseif(isset($_POST['funcao']) && ($_POST['funcao'] == "r")){//Remoção
  $nid=intval($_POST['id']);

$data=DBCon::dbQuery("DELETE FROM inova_catalogo_tabs WHERE id_tab=$nid;");
$retorno=array('code'=>0);

echo json_encode($retorno);

}


else echo json_encode(array('code'=>1,'msg'=>'Ação não reconhecida.'));
?>
