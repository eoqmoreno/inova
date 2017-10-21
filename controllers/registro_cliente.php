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
        /*
        //Aqui deve vir uma mensagem personalizada para o(a) recém cadastrado(a)
        $msend = new ModulePHPMailer(CAPISPHP_Structure::$MailerData);
        $msend->SetAssunto("SAC - Nova Mensagem");
        $msend->SetNomeOrigem('Inova Website');
        $msend->addDestino('comercial@inovautilidades.com.br');
        $msend->addDestino('financeiro@inoplast.com.br');

        $emailcampo="";
        if(isset($_POST["mail"])){$emailcampo="<p>E-mail: <a href=".$_POST["mail"].">".$_POST["mail"]."</a></p>";}

        $telefonecampo="";
        if(isset($_POST["telef"])){$telefonecampo="<p>Telefone: ".$_POST["telef"]."</p>";}


        $msend->SetMensagem("<p>Classificação: <b>$assunto</b>.</p>
        <p>A seguinte mensagem foi <b>enviada por '$nome'</b></p>
        $emailcampo
        $telefonecampo
        <p>Mensagem: <b><i>$mensg</i></b></p>");
        $msend->enviar();
        */
      }

    }else{$retorno = array('code'=>1,'msg'=>"As credenciais já estão cadastradas. Caso tenha problemas, entre em contato pelo SAC.");}

    echo(json_encode($retorno));

  }
}

?>
