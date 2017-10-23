<?php
if( isset(URLPos::getURLObjects()[2]) && (URLPos::getURLObjects()[2]=="criar") ){
  header('Content-Type: application/json');

  if( Cookie::get("UID") ){
    $UID=intval(Cookie::get("UID"));
    $repres_nome=$_POST['represent'];
    $prod_arr = json_decode($_POST['produtos']);

    $dbCon = DBCon::getDB();
    $query="INSERT INTO inova_pedido VALUES (null,CURRENT_TIMESTAMP(),$UID,'$repres_nome');";
    $pedidoCreate = $dbCon->query($query);
    $pedido_id= $dbCon->insert_id;
    foreach ($prod_arr as $key => $valor) {
      if($valor!==NULL)
      $insercaoProduto = $dbCon->query("INSERT INTO inova_pedido_produtos VALUES(null,$pedido_id,".$valor->id.",".$valor->quant.");");
    }
    echo(json_encode(array('code' => 0, 'msg'=>'Pedido No. '.$pedido_id )));
  }
}

?>
