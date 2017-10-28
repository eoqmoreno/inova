<?php
class CountAccess{
  public static function getIPData($SERVIDOR){
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    return array('IP_REAL'=> $_SERVER['HTTP_CLIENT_IP'] ,'IP_PROXY'=>$_SERVER['REMOTE_ADDR'], 'CASO'=>'HTTP_CLIENT_IP');
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    return array('IP_REAL'=> $_SERVER['HTTP_X_FORWARDED_FOR'] ,'IP_PROXY'=>$_SERVER['REMOTE_ADDR'],'CASO'=>'HTTP_X_FORWARDED_FOR');
    else
    return array('IP_REAL'=>$_SERVER['REMOTE_ADDR'],'IP_PROXY'=>'','CASO'=>'OK');
  }

	public static function acesso($SERVIDOR_DT){
    $sucesso=false;
    $ip_data=self::getIPData($SERVIDOR_DT);
    var_dump($ip_data);
    $ip=$ip_data['IP_REAL'];
  if(strpos($ip,".")!==false){
  $dadosExtraidos=json_decode(file_get_contents("http://ip-api.com/json/$ip"));
    if($dadosExtraidos->status==="success"){
    $dbCon = DBCon::getDB();
    $cidade=$dadosExtraidos->city;
    $estado_nome=$dadosExtraidos->regionName;
    $estado_uf=$dadosExtraidos->region;
    $pais=$dadosExtraidos->country;
    $cep=$dadosExtraidos->zip;

    $CityInsert=$dbCon->query("INSERT INTO acessos_cidades VALUES(null,'$estado_nome','$estado_nome','$estado_uf','$pais','$cep');");

    if($CityInsert){
      $cidade_id= $dbCon->insert_id;
      $ip_prx=$ip_data['IP_PROXY'];
      $provd_id=$dadosExtraidos->as;
      $provd=$dadosExtraidos->org;
      $AcessoInsert=$dbCon->query("INSERT INTO acessos_dados VALUES(null,'$ip','$ip_prx','$provd_id','$provd', $cidade_id, CURRENT_TIMESTAMP());");
      $sucesso = $AcessoInsert!==false;
    }
    }
  }
		return $sucesso;
	}

}
?>
