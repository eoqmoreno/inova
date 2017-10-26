<?php
if( isset(URLPos::getURLObjects()[2]) && (URLPos::getURLObjects()[2]=="criar") ){
  header('Content-Type: application/json');

  $cliente = $_POST["cliente"];
  $CPF = $_POST["cpf"];
  $cnpj=$_POST["cnpj"];
  $telefone = $_POST["telefone"];
  $email = $_POST["email"];
  $cep = $_POST["cep"];
  $bairro = $_POST["bairro"];
  $estado = $_POST["estado"];
  $uf = $_POST["uf"];
  $cidade = $_POST["cidade"];
  $logradouro = $_POST["logradouro"];
  $numero = $_POST["numero"];
  $condicao_pgto = $_POST["condpgto"];
  $prazo_pgto_dias = intval($_POST["przpgto"]);

  $REP_ID = 0;
  if( Usuario::$ativo ) $REP_ID=intval(Cookie::get("UID"));

  $prod_arr = json_decode($_POST['produtos']);

  $dbCon = DBCon::getDB();
  $query="INSERT INTO inova_pedido VALUES(null,CURRENT_TIMESTAMP(),$REP_ID,'$cliente','$email','$telefone','$cep','$numero','$logradouro','$bairro','$cidade','$estado','$uf','$cnpj','$CPF',$prazo_pgto_dias,'$condicao_pgto');";
  $RESU=$dbCon->query($query);
  if(!$RESU) $retorno = array('code'=>2,'msg'=>"A sequência SQL não pôde ser executada. Erro:".$dbCon->error);
  else{//Se deu para fazer o registro...

    $pedido_id= $dbCon->insert_id;
    foreach ($prod_arr as $key => $valor) {
      if($valor!==NULL){
        $preco = Usuario::$ativo ? floatval(str_replace(",",".",$valor->preco)) : 0.00 ;
        $insercaoProduto = $dbCon->query("INSERT INTO inova_pedido_itens VALUES(null,$pedido_id,".$valor->id.",'".$preco."',".$valor->quant.");");
      }
    }
    echo(json_encode(array('code' => 0, 'msg'=>'Pedido No. '.$pedido_id )));

    //A partir daqui é referente ao e-mail para a empresa.
$repres_nome="IRINEU";
    //$cliente_dados=$dbCon->query("SELECT * FROM inova_cliente WHERE id_cli=$UID;");
    //$arr_cliData=$cliente_dados->fetch_array(MYSQLI_BOTH);
    $cpfoucnpj="";
    if($CPF!=="")$cpfoucnpj=$CPF;
    elseif ($cnpj!=="")$cpfoucnpj=$cnpj;

    $arr_produtos=array();//Cria vetor
    //Recebe lista do pedido
    $listaPedido=$dbCon->query("SELECT inova_pedido_itens.id_cor,inova_pedido_itens.qnt_cor,inova_pedido_itens.preco_unit FROM inova_pedido_itens INNER JOIN inova_pedido ON inova_pedido_itens.ped_id=inova_pedido.ped_id WHERE inova_pedido.ped_id=$pedido_id;");
    while($item = $listaPedido->fetch_array(MYSQLI_BOTH)){//Percorre cada produto
      $dados_produto=DBCon::dbQuery("SELECT inova_produto_cor.link_imagem,inova_produto_cor.nome_cor,inova_produto_classe.titulo,inova_produto_cor.id_cor FROM inova_produto_cor INNER JOIN inova_produto_classe ON inova_produto_cor.id_itm=inova_produto_classe.id_itm WHERE inova_produto_cor.id_cor=".$item['id_cor'].";");
      $arrDados=$dados_produto->fetch_array(MYSQLI_BOTH);//Converte em vetor
      $arr_produtos[]=array('nome'=>$arrDados['titulo'].' - '.$arrDados['nome_cor'],//Extrai nome e cor
                            'quant'=>$item['qnt_cor'], //E inclui quantidade
                            'preco'=>$item['preco_unit']);
    }

    $listaFinalStr="";
    foreach ($arr_produtos as $produto){
      $listaFinalStr.="<tr><td>".$produto['nome']."</td><td>".$produto['quant']."</td></tr>";
    }


    $msend = new ModulePHPMailer(CAPISPHP_Structure::$MailerData);
    $msend->SetAssunto("Confirmação de Pedido nº ".$pedido_id." - INOVAWEB");
    $msend->SetNomeOrigem($cliente.' - INOVAWEB');
    //$msend->addDestino('comercial@inovautilidades.com.br');
    //$msend->addDestino('financeiro@inoplast.com.br');

    $msend->addDestino("jeimison.ti@gmail.com");
    //$msend->addDestino("financeiro@inoplast.com.br");

    $extras_headertb_exists=Usuario::$ativo?"<th>Preço</th>":"";
    $msend->SetMensagem('<html>
    <head>
      <meta charset="UTF-8">
      <meta name="description" content="">
      <meta name="keywords" content="">
      <meta name="author" content="Inova Utilidades">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <style>
      body{
            font-family: "Open Sans", sans-serif;
            line-height: 24px;
            background-color: #fff;
            color:rgb(10,10,10);
      }
      </style>
    </head>
    <body><center>
    <div style="text-align:center;">
      <table border="0" style="width:100%;text-align:center;">
        <theader>
          <tr><th></th><th></th><th></th><th></th></tr>
        </theader>
        <tbody>
          <tr><td>Nome:</td><td>'.$cliente.'</td><td></td><td></td></tr>
          <tr><td>CPF/CNPJ:</td><td>'.$cpfoucnpj.'</td><td></td><td></td></tr>
          <tr><td>Endereço:</td><td>'.$logradouro.', '.$numero.'</td><td>Bairro:</td><td>'.$bairro.'</td></tr>
          <tr><td>Cidade:</td><td>'.$cidade.'</td><td>Estado/UF:</td><td>'.$estado.'/'.$uf.'</td></tr>
          <tr><td>Telefone:</td><td>'.$telefone.'</td><td>E-mail:</td><td>'.$email.'</td></tr>
        </tbody>
      </table>
      <br/><br/>
      <table border="0" style="width:100%;text-align:center;">
        <theader>
          <tr><th>Produto</th><th>Quantidade</th>'.$extras_headertb_exists.'</tr>
        </theader>
        <tbody>
          '.$listaFinalStr.'
        </tbody>
      </table>
      <h3>Representante:<label style="padding-left:20px;">'.$repres_nome.'</label></h3>
    </div></center>
    </body>
    </html>');
    $msend->enviar();

  }
}

?>
