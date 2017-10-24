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


$data=DBCon::dbQuery("SELECT inova_produto_classe.id_itm \"id_itm\",inova_produto_classe.titulo \"itm_titulo\",inova_catalogo_tabs.id_tab \"id_tab\",inova_catalogo_tabs.titulo \"tab_titulo\"
   FROM inova_produto_classe INNER JOIN inova_catalogo_tabs ON inova_produto_classe.tab=inova_catalogo_tabs.id_tab ORDER BY inova_catalogo_tabs.herdando,inova_catalogo_tabs.titulo ASC;");


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

}elseif(isset($_POST['funcao']) && ($_POST['funcao'] == "e")){//Extração | LISTAGEM DE PRODUTOS/COMPRAS
  $nid=intval($_POST['id']);
  $retorno=array('code'=>0);

  $dt_produto=DBCon::dbQuery("SELECT inova_produto_cor.link_imagem,inova_produto_cor.nome_cor,inova_produto_classe.titulo,inova_produto_cor.id_cor FROM inova_produto_cor INNER JOIN inova_produto_classe ON inova_produto_cor.id_itm=inova_produto_classe.id_itm WHERE inova_produto_cor.id_cor=$nid;");
  $dados_recv =  $dt_produto->fetch_array(MYSQLI_BOTH);
  $arquivo_imagem=URLPos::getURLDirRoot().CAPISPHP_Structure::$Produtos_Upload_Data['path_name'].$dados_recv['link_imagem'];
  $retorno['objeto']=array(
    'img_link'=>$arquivo_imagem, // Link com localização
    'nome'=>$dados_recv['titulo']." - ".$dados_recv['nome_cor'], //
    'id'=>$dados_recv['id_cor'] // ID da cor, que inclui ID do objeto (no BD)
  );

echo json_encode($retorno);

}elseif(isset($_POST['funcao']) && ($_POST['funcao'] == "a")){//Acréscimo
  $pnome=$_POST['nome'];
  $prod_tab=intval($_POST['tab']);
  $data=DBCon::dbQuery("INSERT INTO inova_produto_classe VALUES(null,'$pnome','Sem descrição.',$prod_tab);");
  $retorno=array('code'=>0);

  echo json_encode($retorno);
}
else echo json_encode(array('code'=>1,'msg'=>'Ação não reconhecida.'));
?>
