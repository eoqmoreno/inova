<!DOCTYPE html>
<html lang="pt">
<head>


<?php CAPISPHP_Structure::setTitl("Adicionar Produtos"); echo(ObjetoView::$mvw->head()); ?>
<link href="<?php echo URLPos::getURLDirRoot(); ?>css/outrasPaginas.css" rel="stylesheet">
<link href="<?php echo URLPos::getURLDirRoot(); ?>css/responsive.css" rel="stylesheet">
<link href="<?php echo URLPos::getURLDirRoot(); ?>css/widgEditor.css" rel="stylesheet">
<script src="<?php echo URLPos::getURLDirRoot(); ?>js/widgEditor.js"></script>
<script>
$("#preco").mask('0000,00');
</script>
</head><!--/head-->
<body>
  <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
				<form id="posta_publica" enctype="multipart/form-data" method="POST" action="<?php echo URLPos::getURLDirRoot(); ?>index.php/publish_products">
          <br/><br/>
        <input id="tipo" name="tipo" value="1" type="hidden"/>
    <div class="row">
      <div class="col-xs-12 col-md-12">
				<input class="form-control" placeholder="Nome do produto" id="titulo" name="titulo" type="text"/><br/>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-12">
        <textarea rows="15" placeholder="Produto" class="form-control widgEditor nothing" id="conteudo" name="conteudo"></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
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
      </div>
      <!--
      <div class="col-md-4">
        <input class="form-control" placeholder="0000,00" id="preco" name="preco" type="text"/><br/>
      </div> -->
    </div>
        <br/>
				<button type="submit" class="btn btn-primary">Publicar</button>
				</div>
            </div>
        </div>
    </article>
</body>
</html>
