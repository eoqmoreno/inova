<?php
include('CAPISPHP.php'); //Apenas para uso dos módulos
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Inova Utilidades">
  <title>Inova Utilidades</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/lightbox.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link id="css-preset" href="css/presets/preset1.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">
  <link href="css/widgEditor.css" rel="stylesheet">
  <script src="js/widgEditor.js"></script>
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>

A estrutura de datas é: 2017-08-02

  <![endif]-->

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="images/favicon.ico">
</head><!--/head-->
<body>
  <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
				<form id="posta_publica" method="POST" action="postar_publicacao.php">
				<input class="form-control" placeholder="Título da postagem" id="titulo" name="titulo" type="text"/>
				<textarea placeholder="Descrição simples" class="form-control" id="descricao" name="descricao"></textarea>
				<input class="form-control" placeholder="Tags(sep. por vírgula)" name="tags" id="tags" type="text"/>
				<textarea rows="15" placeholder="Conteúdo..." class="form-control widgEditor nothing" id="conteudo" name="conteudo"></textarea>
				<button type="submit" class="btn">Publicar</button>
				</div>
            </div>
        </div>
    </article>
</body>
</html>
