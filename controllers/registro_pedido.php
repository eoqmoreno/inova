<?php
if( isset(URLPos::getURLObjects()[2]) && (URLPos::getURLObjects()[2]=="cadastro") ){
  if(array_key_exists('nome',$_POST)&&array_key_exists('cpf',$_POST)&&array_key_exists('cnpj',$_POST)&&
  array_key_exists('telefone',$_POST)&&array_key_exists('email',$_POST)&&array_key_exists('senha',$_POST)&&array_key_exists('cep',$_POST)&&
  array_key_exists('bairro',$_POST)&&array_key_exists('uf',$_POST)&&array_key_exists('estado',$_POST)&&
  array_key_exists('cidade',$_POST)&&array_key_exists('logradouro',$_POST)&&array_key_exists('numero',$_POST)){
    header('Content-Type: application/json');
    $retorno = array('code'=>0,'msg'=>"OK!");
    $existe = false;
    if($_POST['cnpj']!=""){
    $buscaCNPJ=DBCon::dbQuery("SELECT * FROM inova_cliente WHERE cnpj=\"".$_POST['cnpj']."\";");// Consulta se CNPJ já existe
    $existe = $existe || $buscaCNPJ->num_rows>0;
    }
    if($_POST['cpf']!=""){
    $buscaCPF=DBCon::dbQuery("SELECT * FROM inova_cliente WHERE cpf=\"".$_POST['cpf']."\";"); // Consulta de CEP já existe
    $existe = $existe || $buscaCPF->num_rows>0;
    }
    if(!$existe){ //Se tudo retorna FALSO, prossegue
      $nome = $_POST["nome"];$CPF = $_POST["cpf"]; $CNPJ = $_POST["cnpj"]; $email = $_POST["email"];
      $telefone = $_POST["telefone"]; $senha = $_POST["senha"]; $CEP = $_POST["cep"];
      $bairro = $_POST["bairro"]; $UF = $_POST["uf"]; $estado = $_POST["estado"];
      $cidade = $_POST["cidade"]; $logradouro = $_POST["logradouro"]; $numero = $_POST["numero"];

      $dbCon = DBCon::getDB();
      $query="INSERT INTO inova_cliente VALUES(null,'$nome','$senha','$email','$telefone','$CEP','$numero','$logradouro','$bairro','$cidade','$estado','$UF','$CNPJ','$CPF');";
      $RESU=$dbCon->query($query);
      if(!$RESU) $retorno = array('code'=>2,'msg'=>"A sequência SQL não pôde ser executada. Erro:".$dbCon->error);
      else{
        //Aqui deve vir uma mensagem personalizada para o(a) recém cadastrado(a)
        $msend = new ModulePHPMailer(CAPISPHP_Structure::$MailerData);
        $msend->SetAssunto("Cadastro de Cliente");
        $msend->SetNomeOrigem('Inova Utilidades - Website');
        //$msend->addDestino('comercial@inovautilidades.com.br');
        //$msend->addDestino('financeiro@inoplast.com.br');
        $msend->addDestino($email);


        $msend->SetMensagem('<html>
        <head>
          <meta charset="UTF-8">
          <meta name="description" content="">
          <meta name="keywords" content="">
          <meta name="author" content="Inova Utilidades">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <style>
          body{font-family:"Open Sans",sans-serif;line-height:24px;background-color:#028fcc;color:rgb(10,10,10);}
          a{background-color:rgba(255,138,0,0.89);}
          a:hover{background-color:rgba(245,128,0,1);}
          li{font-size:1.2em;cursor: pointer;}
          li:hover{text-decoration: underline;text-decoration-color:rgb(245, 128, 0);}
          li::before {content:"•";color:rgb(245,128,0);display:inline-block;width:1em;margin-left:-1em;}
          </style>
        </head>
        <body><center>
        <div style="width:420px;text-align:center;">
          <img width="90%" src="http://inovautilidades.com.br/images/logo_mini.png"></img>
          <h1 style="padding-left:20px;line-height:35px;">Olá, seja bem-vindo(a)<br>'.$nome.'!</h1>
          <h3>Sua inscrição foi realizada com sucesso!</h3>
          <p><b>Aproveite todos os recursos que nosso<br/>site disponibiliza aos nossos clientes.</b></p>
          <p>Você poderá:<br/><ul style="text-align:left;">
            <li>Ver o catálogo de produtos da empresa;</li>
            <li>Fazer pedidos diretamente pelo site;</li>
            <li>Tirar dúvidas sobre produtos ou serviços.</li>
          </ul></p>
          <a style="color: #fff;padding: 10px 16px;font-size: 18px;line-height: 1.3333333;text-align: center;white-space: nowrap;vertical-align: middle;touch-action: manipulation;cursor: pointer;font-weight: 400;text-decoration: none;" target="_blank" href="http://inovautilidades.com.br/">Clique aqui para acessar</a>
        </div></center>
        </body>
        </html>');
        $msend->enviar();
      }

    }else{$retorno = array('code'=>1,'msg'=>"As credenciais já estão cadastradas. Caso tenha problemas, entre em contato pelo SAC.");}

    echo(json_encode($retorno));

  }
}

?>
