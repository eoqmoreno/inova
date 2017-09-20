<?php

function getFullStrName($id_origem,$full_arr){
  $separador=">";$id_atual=$id_origem;
  $parou = false;
  $FinalStr="";
  while (!$parou){
    if(isset($full_arr[$id_atual])){
      $FinalStr.=" ".$full_arr[$id_atual]['titulo'];
      $id_atual=$full_arr[$id_atual]['herdando'];
      $parou=!array_key_exists($id_atual,$full_arr);
      if(!$parou) $FinalStr.=" ".$separador;
    }else $parou=true;
  }
  return $FinalStr;
}

header('Content-Type: application/json');
if(isset($_POST['funcao']) && ($_POST['funcao'] == "c")){//Consulta
$data=DBCon::dbQuery("SELECT * FROM inova_catalogo_tabs WHERE id_tab<>herdando ORDER BY herdando,titulo ASC;");
$retorno=array('code'=>0,'lista'=>array());

if($data->num_rows>0){
	while($item = $data->fetch_array(MYSQLI_BOTH)){
    $retorno['lista'][$item['id_tab']]=array('id_tab'=>$item['id_tab'],'titulo'=>$item['titulo'],'herdando'=>$item['herdando']);
    //array_push( $retorno['lista'], $item );
	}
foreach ($retorno['lista'] as $key => $item) {
  $retorno['lista'][$key]['localizacao']= getFullStrName($item['id_tab'],$retorno['lista']);
}
echo json_encode($retorno);
}else echo json_encode(array('code'=>1));
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
