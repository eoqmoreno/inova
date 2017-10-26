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

    $cliente_dados=$dbCon->query("SELECT * FROM inova_cliente WHERE id_cli=$UID;");
    $arr_cliData=$cliente_dados->fetch_array(MYSQLI_BOTH);
    $cpfoucnpj="";
    if($arr_cliData['cpf']!=="")$cpfoucnpj=$arr_cliData['cpf'];
    elseif ($arr_cliData['cnpj']!=="")$cpfoucnpj=$arr_cliData['cnpj'];

    $arr_produtos=array();//Cria vetor
    //Recebe lista do pedido
    $listaPedido=$dbCon->query("SELECT inova_pedido_produtos.id_cor,inova_pedido_produtos.qnt_cor FROM inova_pedido_produtos INNER JOIN inova_pedido ON inova_pedido_produtos.cpli_id=inova_pedido.cpli_id WHERE inova_pedido.cpli_id=$pedido_id;");
    while($item = $listaPedido->fetch_array(MYSQLI_BOTH)){//Percorre cada produto
      $dados_produto=DBCon::dbQuery("SELECT inova_produto_cor.link_imagem,inova_produto_cor.nome_cor,inova_produto_classe.titulo,inova_produto_cor.id_cor FROM inova_produto_cor INNER JOIN inova_produto_classe ON inova_produto_cor.id_itm=inova_produto_classe.id_itm WHERE inova_produto_cor.id_cor=".$item['id_cor'].";");
      $arrDados=$dados_produto->fetch_array(MYSQLI_BOTH);//Converte em vetor
      $arr_produtos[]=array('nome'=>$arrDados['titulo'].' - '.$arrDados['nome_cor'],//Extrai nome e cor
                            'quant'=>$item['qnt_cor']); //E inclui quantidade
    }

    $listaFinalStr="";
    foreach ($arr_produtos as $produto){
      $listaFinalStr.="<tr><td>".$produto['nome']."</td><td>".$produto['quant']."</td></tr>";
    }


    $msend = new ModulePHPMailer(CAPISPHP_Structure::$MailerData);
    $msend->SetAssunto("Confirmação de Pedido - INOVAWEB");
    $msend->SetNomeOrigem($arr_cliData['nome'].'-INOVAWEB');
    //$msend->addDestino('comercial@inovautilidades.com.br');
    //$msend->addDestino('financeiro@inoplast.com.br');

    $msend->addDestino("jeimison.ti@gmail.com");
    $msend->addDestino("financeiro@inoplast.com.br");


    $msend->SetMensagem('<html>
    <head>
      <meta charset="UTF-8">
      <meta name="description" content="Free Web tutorials">
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
          <tr><td>Nome:</td><td>'.$arr_cliData['nome'].'</td><td></td><td></td></tr>
          <tr><td>CPF/CNPJ:</td><td>'.$cpfoucnpj.'</td><td></td><td></td></tr>
          <tr><td>Endereço:</td><td>'.$arr_cliData['logradouro'].', '.$arr_cliData['numero'].'</td><td>Bairro:</td><td>'.$arr_cliData['bairro'].'</td></tr>
          <tr><td>Cidade:</td><td>'.$arr_cliData['cidade'].'</td><td>Estado/UF:</td><td>'.$arr_cliData['estado'].'/'.$arr_cliData['uf'].'</td></tr>
          <tr><td>Telefone:</td><td>'.$arr_cliData['telefone'].'</td><td>E-mail:</td><td>'.$arr_cliData['email'].'</td></tr>
        </tbody>
      </table>
      <br/><br/>
      <table border="0" style="width:100%;text-align:center;">
        <theader>
          <tr><th>Produto</th><th>Quantidade</th></tr>
        </theader>
        <tbody>
          '.$listaFinalStr.'
        </tbody>
      </table>
      <h3>Representante:<label style="padding-left:20px;">'.$repres_nome.'</label></h3>
      <h3>Pedido Nº <label style="padding-left:20px;">'.$pedido_id.'</label></h3>
    </div></center>
    </body>
    </html>');
    $msend->enviar();


  }
}

?>
