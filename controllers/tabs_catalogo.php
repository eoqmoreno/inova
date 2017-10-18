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


function getArrayIDsToDown($id_origem,$full_arr){
  $arrAll=array();$lastFound=array(0=>array('id_tab'=>$id_origem));$kwtr=array();

  $parou = false;
  while (!$parou){
foreach ($lastFound as $ky => $tabfound) {
  $id_atual=$tabfound['id_tab'];
  $arrAll[]=$id_atual;
  //echo("ATUAL=".$id_atual);
    foreach ($full_arr as $tab) {
      if($tab['herdando']==$id_atual){
        if(!in_array($tab['id_tab'],$arrAll)) $lastFound[]=$tab;
      }
    }
    unset($lastFound[$ky]);
  }
$parou=sizeof($lastFound)==0;

  }
return $arrAll;
}


function getProdutosByTab($tab_id){
$tmpv=array();

$dbRetorno  = DBCon::dbQuery("SELECT * FROM inova_produto_classe WHERE tab=$tab_id;");

if($dbRetorno->num_rows>0){
  while($item = $dbRetorno->fetch_array(MYSQLI_BOTH)){
    //Item só retorna uma classe. Teremos que escolher um ao acaso...
    $itm_id=$item['id_itm'];
    //Escolhe cor ao acaso
    $queryCores  = DBCon::dbQuery("SELECT * FROM inova_produto_cor WHERE id_itm=$itm_id ORDER BY rand() LIMIT 1;");
    if($queryCores->num_rows==1){//Se alguma cor foi retornada
      $cor_data = $queryCores->fetch_array(MYSQLI_BOTH);
      $item['nome_cor']=$cor_data['nome_cor'];
      $item['link_imagem']=$cor_data['link_imagem'];
      $item['id_cor']=$cor_data['id_cor'];//Atribui os valores
      array_push($tmpv,$item); //Acrescenta ao vetor de retorno
    }
  }
}
return $tmpv;
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
  $TabPrincipal="Produtos";
  $retorno=array(
    'code'=>0,
    'lista'=>getSubItens($TabPrincipal,$RetornoBD),
    'produtos'=>array() );

    /*
    $tmp_arr=getProdutosByTab( getKeyBySubkey($TabPrincipal,$RetornoBD,'titulo') );
      if(sizeof($tmp_arr)>0) foreach ($tmp_arr as $item_prod) array_push($retorno['produtos'],$item_prod);

  foreach ($retorno['lista'] as $valor)
    if(sizeof($valor)>0) {
      $tmp_arr=getProdutosByTab($valor['id_tab']);
      foreach ($tmp_arr as $itens_ret) array_push($retorno['produtos'], $itens_ret );
    }
*/
$idtmp=getArrayIDsToDown($RetornoBD[getKeyBySubkey($TabPrincipal,$RetornoBD,'titulo')]['id_tab'],$RetornoBD);
foreach ($idtmp as $val){
  $tmp_arr=getProdutosByTab(intval($val));
  foreach ($tmp_arr as $itens_ret) {array_push($retorno['produtos'], $itens_ret );}
}

  if(sizeof($retorno['lista'])==0) $retorno['code']=7;//COD 7 = SEM RESULTADOS DE TABS.
  echo json_encode($retorno);



}elseif(isset($_POST['funcao']) && ($_POST['funcao'] == "nxt")){//Proximas tabs, avança para a ID
  $retorno=array(
    'code'=>0,
    'lista'=>getKeyBySubkeyA($_POST['nxt-id'],$RetornoBD,'herdando'),
  'produtos'=>array());
  $tmp_arr=getProdutosByTab(intval($_POST['nxt-id']));
    if(sizeof($tmp_arr)>0) foreach ($tmp_arr as $item_prod) array_push($retorno['produtos'],$item_prod);

  foreach ($retorno['lista'] as $valor)
    if(sizeof($valor)>0) {
      $tmp_arr=getProdutosByTab($valor['id_tab']);
      foreach ($tmp_arr as $itens_ret) array_push($retorno['produtos'], $itens_ret );
    }

  if(sizeof($retorno['lista'])==0) $retorno['code']=7;//COD 7 = SEM RESULTADOS DE TABS..

  echo json_encode($retorno);


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
