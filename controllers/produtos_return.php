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

if($data->num_rows>0){
  $all_tabs_arr=array();
	while($item = $data->fetch_array(MYSQLI_BOTH)){
    $all_tabs_arr[$item['id_tab']]=array('id_tab'=>$item['id_tab'],'titulo'=>$item['titulo'],'herdando'=>$item['herdando']);
	}
}


$data=DBCon::dbQuery("SELECT inova_catalogo.id_itm \"id_itm\",inova_catalogo.titulo \"itm_titulo\",inova_catalogo_tabs.id_tab \"id_tab\",inova_catalogo_tabs.titulo \"tab_titulo\"
   FROM inova_catalogo INNER JOIN inova_catalogo_tabs ON inova_catalogo.tab=inova_catalogo_tabs.id_tab ORDER BY inova_catalogo_tabs.herdando,inova_catalogo_tabs.titulo ASC;");


$retorno=array('code'=>0,'lista'=>array());

if($data->num_rows>0){
	while($item = $data->fetch_array(MYSQLI_BOTH)){
    $retorno['lista'][$item['id_itm']]=array('id_prod'=>$item['id_itm'],'titulo'=>$item['itm_titulo'],'herdando_id'=>$item['id_tab'],'herdando_tab'=>$item['tab_titulo'],'herdando_lst'=>getFullStrName($item['id_tab'],$all_tabs_arr) );
    //array_push( $retorno['lista'], $item );
	}
//foreach ($retorno['lista'] as $key => $item) {
//  $retorno['lista'][$key]['localizacao']= getFullStrName($item['id_tab'],$retorno['lista']);
//}
echo json_encode($retorno);
}else echo json_encode(array('code'=>1,'msg'=>'Não há produtos cadastrados.'));

}elseif(isset($_POST['funcao']) && ($_POST['funcao'] == "r")){//Remoção
  $nid=intval($_POST['id']);
  $retorno=array('code'=>0);

  $dt_produto=DBCon::dbQuery("SELECT link_imagem FROM inova_catalogo WHERE id_itm=$nid;");
  $dados_recv =  $dt_produto->fetch_array(MYSQLI_BOTH);
  $arquivo_imagem=CAPISPHP_Structure::$Produtos_Upload_Data['path_name'].$dados_recv['link_imagem'];
  if (!file_exists($arquivo_imagem)) $retorno=array('code'=>2,'msg'=>'Arquivo de imagem ('.$arquivo_imagem.') não encontrado.');
if(file_exists($arquivo_imagem)){
unlink($arquivo_imagem);
$data=DBCon::dbQuery("DELETE FROM inova_catalogo WHERE id_itm=$nid;");
}


echo json_encode($retorno);

}else echo json_encode(array('code'=>1,'msg'=>'Ação não reconhecida.'));
?>
