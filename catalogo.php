<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Inova Utilidades">
  <title>Inova Utilidades</title>
  <link href="<?php echo URLPos::getURLDirRoot(); ?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo URLPos::getURLDirRoot(); ?>css/animate.min.css" rel="stylesheet">
  <link href="<?php echo URLPos::getURLDirRoot(); ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo URLPos::getURLDirRoot(); ?>css/lightbox.css" rel="stylesheet">
  <link href="<?php echo URLPos::getURLDirRoot(); ?>css/main.css" rel="stylesheet">
  <link href="<?php echo URLPos::getURLDirRoot(); ?>css/outrasPaginas.css" rel="stylesheet">
  <link id="css-preset" href="<?php echo URLPos::getURLDirRoot(); ?>css/presets/preset1.css" rel="stylesheet">
  <link href="<?php echo URLPos::getURLDirRoot(); ?>css/responsive.css" rel="stylesheet">
  <link href="<?php echo URLPos::getURLDirRoot(); ?>css/widgEditor.css" rel="stylesheet">
  <script src="<?php echo URLPos::getURLDirRoot(); ?>js/widgEditor.js"></script>
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
				<form id="posta_publica" enctype="multipart/form-data" method="POST" action="<?php echo URLPos::getURLDirRoot(); ?>index.php/produto_publish">
          <br/><br/>
				<input class="form-control" placeholder="Título do produto" id="titulo" name="titulo" type="text"/><br/>
        <input id="prod_img" name="prod_img" type="file"/><br/>
        <textarea rows="15" placeholder="Descrição do produto" class="form-control widgEditor nothing" id="conteudo" name="conteudo"></textarea>
				<select class="form-control" name="tab" id="tab" type="text"/>
<?php
$data=DBCon::dbQuery("SELECT * FROM inova_catalogo_tabs;");
if($data->num_rows>0){
	while($item_port = $data->fetch_array(MYSQLI_BOTH)){
    echo("<option value=".$item_port['id_tab'].">".$item_port['titulo']."</option>\n");
	}
}
?>
        </select>
        <br/>
				<button type="submit" class="btn btn-primary">Publicar</button>
				</div>
            </div>
        </div>
    </article>
</body>
</html>
