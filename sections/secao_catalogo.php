<?php

?>
<section id="portfolio">
  <div class="container">
    <div class="row">
      <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
        <h2 class="title_catalogo">Catálogo</h2>
        <p>Veja nossos produtos mais populares, mas não se limite! Trabalhamos também com produtos personalizados.</p>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="catalog-nav col-xs-12">
        <ul class="nav navbar-nav">
          <li class="scroll active"><a onclick="setItemCatalogo(this);">Todos os produtos</a></li>
          <li class="scroll"><a onclick="setItemCatalogo(this);">Banquetas</a></li>
          <li class="scroll"><a onclick="setItemCatalogo(this);">Mesas</a></li>
          <li class="scroll"><a onclick="setItemCatalogo(this);">Personalizados</a></li>
          <li class="scroll"><a onclick="setItemCatalogo(this);">Poltronas</a></li>
        </ul>
      </div>
    </div>
    <div class="row">
      <?php echo BCatalogo::getHTML(); ?>
    </div>
  </div>
  <div id="portfolio-single-wrap">
    <div id="portfolio-single">
    </div>
  </div><!-- /#portfolio-single-wrap -->
</section><!--/#portfolio-->
