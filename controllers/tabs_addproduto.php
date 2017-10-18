<?php

if( array_key_exists('tipo',$_POST)&&($_POST['tipo']=='1') ){

  if(array_key_exists('titulo',$_POST)&&array_key_exists('conteudo',$_POST)&&(intval($_POST["tab"])>-1)){
    $titulo=$_POST["titulo"];$conteudo=$_POST["conteudo"];$tab_num=intval($_POST["tab"]);
    echo('Sucesso.');
    $resu=DBCon::dbQuery("INSERT INTO inova_produto_classe VALUES(null,'$titulo','$conteudo',$tab_num);");
    echo('<br/>Query executada.<script>window.history.back();</script>');
  //header('location: ');
//echo('Publicado com sucesso.');

  }else{echo('Há campos ausentes.'.
    '<br/>Titulo='.$_POST['titulo'].'<br/>Tab='.
    $_POST["tab"].'<br/>Conteudo='.$_POST['conteudo']);}

  } else if( array_key_exists('tipo',$_POST)&&($_POST['tipo']=='2') ){//====================================================================


    if(array_key_exists('titulo',$_POST)&&isset($_FILES["prod_img"]["name"])&&(intval($_POST["id_prod"])>-1)){
      $titulo=$_POST["titulo"];$prod_num=intval($_POST["id_prod"]);

      $regras_upload=array(
        'path_name'=>'images/catalogo/',
        'extension'=>array('jpg','png','bmp','jpeg'),
        'renbymd5_fname'=>true,
        'prefix_name'=>'catal_'
      );
      $uploader=new FileUpload($regras_upload);
      $instancia = $uploader->upload($_FILES["prod_img"]);

      if( $instancia['ok'] ){
        echo('Sucesso.');
      $nome_arquivo=$instancia["name"];
      $resu=DBCon::dbQuery("INSERT INTO inova_produto_cor VALUES(null,$prod_num,'$titulo','$nome_arquivo');");
      echo('<br/>Query executada.<script>window.history.back();</script>');
    //header('location: ');

    }else{
      echo("Ops... Parece que estamos com problemas de upload...<br/>Mensagem: ".$uploader->getErrorStatus()['value']);
    }

  //echo('Publicado com sucesso.');

    }else{echo('Há campos ausentes.<br/>'.'Imagem='.$_FILES["prod_img"]["name"].
      '<br/>Titulo='.$_POST['titulo'].'<br/>Produto='.$_POST["id_prod"]);}


  }
?>
