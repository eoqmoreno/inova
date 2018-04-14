<?php
$dados=json_decode($_POST['client']);
if($dados->status==="success"){
$dbCon = DBCon::getDB();
$cidade=$dados->city;
$estado_nome=$dados->regionName;
$estado_uf=$dados->region;
$pais=$dados->country;
$cep=$dados->zip;

$CitySelect=$dbCon->query("SELECT id_cidade FROM acessos_cidades WHERE nome_cidade='$cidade' AND estado_nome='$estado_nome' AND uf='$estado_uf' AND cep='$cep';");
  //Se a cidade já está registrada
if($CitySelect->num_rows==1){
  $CidadeDados=$CitySelect->fetch_array(MYSQLI_BOTH);
  $cidade_id=$CidadeDados['id_cidade']; //Usa o ID
}else{//Se não foi registrada,
  //Registra
  $CityInsert=$dbCon->query("INSERT INTO acessos_cidades VALUES(null,'$cidade','$estado_nome','$estado_uf','$pais','$cep');");
  if($CityInsert){//Se teve sucesso, usa o ID
    $cidade_id= $dbCon->insert_id;
  }
}
  $ip=$dados->query;
  $provd_id=$dados->as;
  $provd=$dados->org;
  $AcessoInsert=$dbCon->query("INSERT INTO acessos_dados VALUES(null,'$ip','$provd_id','$provd', $cidade_id, CURRENT_TIMESTAMP());");
  $sucesso = $AcessoInsert!==false;
}


?>
