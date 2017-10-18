<?php
include('./CAPISPHP.php'); //Apenas para uso dos módulos
//ID de referência:
// -> URLPos::getURLObjects()[1]
if(isset(URLPos::getURLObjects()[1])&&(intval(URLPos::getURLObjects()[1])>0)){
  $objSel=DBCon::dbQuery("SELECT * FROM inova_produto_classe WHERE id_itm=".intval(URLPos::getURLObjects()[1]).";");
  if($objSel->num_rows==1){
    $extracao = $objSel->fetch_array(MYSQLI_BOTH);
  }
}
?>
<div id="single-portfolio">
	<div id="portfolio-details" class="container">
		<a class="close-folio-item" href="#"><i class="fa fa-times"></i></a>
		<img class="img-responsive" src="images/catalogo/<?php if(isset($extracao)) echo $extracao['link_imagem']; ?>" alt="">
		<div class="row">
			<div class="col-sm-9">
				<div class="project-info">
					<h3><?php if(isset($extracao)) echo $extracao['titulo']; ?></h3>
<?php if(isset($extracao)) echo $extracao['descricao']; ?>
				</div>
			</div>
      <!--
			<div class="col-sm-3">
				<div class="project-details">
					<h3>Detalhes do Projeto</h3>
					<p><span>Publicado:</span> <?php if(isset($extracao)) echo $extracao['data']; ?></p>
					<p><span>Classe:</span> <?php if(isset($extracao)) echo $extracao['tab']; ?></p>
				</div>
			</div>
    -->
		</div>
	</div>
</div>
