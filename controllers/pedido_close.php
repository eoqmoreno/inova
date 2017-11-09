<?php
function formatMoney($number, $fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
	$number = str_replace('.',',',$number);

    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d

\d)/', '$1.$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}

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

$dados_ok=true;
if(!empty($CPF)){
  $dados_ok=validaCPF($CPF);
}
if(!empty($cnpj)){
  $dados_ok=validar_cnpj($cnpj);
}


  $REP_ID = 0;
  if( Usuario::$ativo ) $REP_ID=intval(Cookie::get("UID"));

  $prod_arr = json_decode($_POST['produtos']);

  $dbCon = DBCon::getDB();
  $query="INSERT INTO inova_pedido VALUES(null,CURRENT_TIMESTAMP(),$REP_ID,'$cliente','$email','$telefone','$cep','$numero','$logradouro','$bairro','$cidade','$estado','$uf','$cnpj','$CPF',$prazo_pgto_dias,'$condicao_pgto');";
  $RESU=$dbCon->query($query);
  if(!$RESU) $retorno = array('code'=>2,'msg'=>"A sequência SQL não pôde ser executada. Erro:".$dbCon->error);
  elseif(!$dados_ok) $retorno = array('code'=>5,'msg'=>"O CPF/CNPJ digitado não é válido.");
  else{//Se deu para fazer o registro...

    $pedido_id= $dbCon->insert_id;
    foreach ($prod_arr as $key => $valor) {
      if($valor!==NULL){
        $preco = Usuario::$ativo ? floatval(str_replace(",",".",$valor->preco)) : 0.00 ;
        $insercaoProduto = $dbCon->query("INSERT INTO inova_pedido_itens VALUES(null,$pedido_id,".$valor->id.",'".$preco."',".$valor->quant.");");
      }
    }
    $retorno = array('code' => 0, 'msg'=>'Pedido No. '.$pedido_id );


    //A partir daqui é referente ao e-mail para a empresa.
$repres_nome="";
  if($REP_ID!==0){
    $query="SELECT * FROM inova_representante WHERE id_rep=$REP_ID";
    $RESU_REP=$dbCon->query($query);
    $dados_representante=$RESU_REP->fetch_array(MYSQLI_BOTH);
    $r_nome=$dados_representante['nome'];
    $r_mail=$dados_representante['email'];$r_telef=$dados_representante['telefone'];
    $linha_repres="<tr><th></th><th colspan=\"2\">Representante</th><th></th></tr>
    <tr><th>Nome:</th><td style=\"text-align:left;\">$r_nome</td> <th>Telefone:</th><td style=\"text-align:left;\">$r_telef</td></tr>
    <tr><th>E-mail:</th><td style=\"text-align:left;\">$r_mail</td><td></td><td></td></tr>\n<br/>\n";
  }


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
    $somatorio = 0.0;
    $itens = 0;
    foreach ($arr_produtos as $produto){
      $listaFinalStr.="<tr><td>".$produto['nome']."</td><td>".$produto['quant']."</td>".(Usuario::$ativo?"<td>R$ ". formatMoney($produto['preco']) ."</td>":"")."</tr>";
      if(Usuario::$ativo && ( ( floatval($produto['preco'])*floatval($produto['quant']) ) != 0) ){
        $somatorio += floatval($produto['preco'])*floatval($produto['quant']);
        $itens+=intval($produto['quant']);
      }
    }

    if(Usuario::$ativo){
      $listaFinalStr.="<tr><th style=\"text-align:center;\">Valor Total</th><th style=\"text-align:center;\">$itens itens</th><th>R$ ".formatMoney($somatorio)."</th></tr>";
    }


    $msend = new ModulePHPMailer(CAPISPHP_Structure::$MailerData);


    $AssuntoTitulo=Usuario::$ativo?"Conf. de Pedido":"Solic. de Orçamento";


    $msend->SetAssunto("$AssuntoTitulo No. $pedido_id - INOVAWEB");
    $msend->SetNomeOrigem($cliente.' - INOVAWEB',$email);
    //$msend->addDestino('comercial@inovautilidades.com.br');
    //$msend->addDestino('financeiro@inoplast.com.br');

    $msend->addDestino("jeimison.ti@gmail.com");
    $msend->addDestino("financeiro@inoplast.com.br");

    $extras_headertb_exists=Usuario::$ativo?"<th>Preço</th>":"";
    $email_envio='<html>
    <head>
      <meta charset="UTF-8">
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
      '.( $REP_ID!==0 ?$linha_repres:"").'
        <theader>
          <tr><th></th><th colspan="2">Cliente</th><th></th></tr>
        </theader>
        <tbody>
          <tr><th>Nome:</th><td style="text-align:left;">'.$cliente.'</td><td></td><td></td></tr>
          <tr><th>CPF/CNPJ:</th><td style="text-align:left;">'.$cpfoucnpj.'</td><td></td><td></td></tr>
          <tr><th>Endereço:</th><td style="text-align:left;">'.$logradouro.', '.$numero.'</td><th>Bairro:</th><td style="text-align:left;">'.$bairro.'</td></tr>
          <tr><th>Cidade:</th><td style="text-align:left;">'.$cidade.'</td><th>Estado/UF:</th><td style="text-align:left;">'.$estado.'/'.$uf.'</td></tr>
          <tr><th>Telefone:</th><td style="text-align:left;">'.$telefone.'</td><th>E-mail:</th><td style="text-align:left;">'.$email.'</td></tr>
          <tr><td colspan="4"></td></tr>
          <tr><th>Condição de Pag.:</th><td style="text-align:left;">'.$condicao_pgto.'</td><th>Prz. de Pagamento:</th><td style="text-align:left;">Prazo médio de <b>'.$prazo_pgto_dias.'</b> dias</td></tr>

        </tbody>
      </table>
      <br/><br/>
      <table border="1" style="width:100%;text-align:center;">
          <tr><th>Produto</th><th>Quantidade</th>'.$extras_headertb_exists.'</tr>
        <tbody>
          '.$listaFinalStr.'
        </tbody>
      </table>
    </div></center>
    </body>
    </html>';

    $msend->SetMensagem($email_envio);
    if( !$msend->enviar() ) $retorno=array('code'=>3,'msg'=>'E-mail não enviado. MSG='.$msend->ErroMsg);

  }
  echo(json_encode($retorno));
}

?>
