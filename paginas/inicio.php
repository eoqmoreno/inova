<!DOCTYPE html>
<html lang="pt">
<head>

<?php echo(ObjetoView::$mvw->head(true)); ?>

<script>

$('.nav-tabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show');
});

function setItemCatalogo(ItmClass,classNum){
	$('.catalog-nav ul li.class'+classNum).removeClass('active');
	$(ItmClass.parentElement).addClass('active').html();
	//var nomevalor=$(ItmClass).html();
	var idvalor=$(ItmClass).attr('data-id');
	  var nulo=new FormData();
	  nulo.append('funcao','nxt');
    nulo.append('nxt-id',idvalor);

	callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/tabs_catalogo_get',nulo,
	function(){//BeforeSend
	},function(data){//Done
    processaProdutos(data.produtos);
    var proximo_nivel=classNum+1;
    var div_menus=$("div.row.navbarscatalog");
    var menu=$('<div class="catalog-nav col-xs-12"></div>').attr('data-page',proximo_nivel);
    var submenu=$('<ul class="nav navbar-nav"></ul>');
    var item= $('<li class="scroll active class'+proximo_nivel+'"></li>');
    item.html('<a data-noexpand="1" data-id="'+idvalor+'" onclick="setItemCatalogo(this,'+proximo_nivel+');">Todos</a>');

    navCatalogoRemoveNext(proximo_nivel);//Exclui menus anteriores

    var exibirNovaLista= ($(ItmClass).attr("data-noexpand")!="1") && (data.code!=7);
    if(exibirNovaLista){
      div_menus.append(menu.append(submenu.append( item.hide().delay(exec).fadeIn() ).fadeIn())).fadeIn();//Aloca novo menu
    }

	  if((data.code==0)||(data.code==7)){
	    var exec=0,cont=0;

	      for (var val in data.lista) {
          exec+=(++cont)*10;
          if($(ItmClass).attr("data-noexpand")!="1"){
	           var item= $('<li class="scroll class'+proximo_nivel+'"></li>');
	            item.html('<a data-id="'+data.lista[val]['id_tab']+'" onclick="setItemCatalogo(this,'+proximo_nivel+');">'+data.lista[val]['titulo']+'</a>');
               submenu.append( item.hide().delay(exec).fadeIn() );
             }//Evitar processamento desnecessário...
	    }
	  }else if(data.code>0){
	    $('div.jumbotron').append( $('<div class="form_status"></div>').html('<p class="text-warning">Ops... Parece que aconteceu um problema.<br/>Erro cód.: '+data.code+' -> '+data.msg+'</p>').fadeIn().delay(20000).fadeOut() );
	  }else{
	    $('div.jumbotron').append( $('<div class="form_status"></div>').html('<p class="text-warning">Ops... Parece que aconteceu um problema.<br/>Abra o console para ver os dados.</p>').fadeIn().delay(20000).fadeOut() );
	    console.log(data);
	  }
	},function(e){console.log("ERRO. Verifique a variável ab.");console.log(e);}
	);

	//alert(nomevalor);
}

function navCatalogoRemoveNext(idatual){
  var div_menus=$("div.row.navbarscatalog").children();
  div_menus.each(function(id,obj){
    if (parseInt($(obj).attr("data-page")) >= idatual) $(obj).delay(20).fadeOut().remove();
  });
}


function processaProdutos(produtosArr){
  $("div.catalogobuild").html('');//Limpa catálogo
//  console.log(produtosArr);
if(produtosArr.length>0)
for (var id in produtosArr) {
  var obj=produtosArr[id];
    //console.log(obj);
  //  obj['id_itm'] obj['titulo'] obj['link_imagem'] obj['descricao'] obj['data'] obj['tab']
var itemOrigin=$('<div class="col-sm-3"></div>');
var item=$('<div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="300ms"></div>');
itemOrigin.append(item);
item.append(
  $('<div class="folio-image"></div>').append(
    $('<img class="img-responsive" alt=""></img>').attr('src','<?php echo URLPos::getURLDirRoot(); ?>images/catalogo/'+obj['link_imagem'])
)
).append(
  $('<div class="overlay"></div>').append(
    $('<div class="overlay-content"></div>').append(
      $('<div class="overlay-text"></div>').append(
        $('<div class="folio-info"></div>').append( $('<h3></h3>').html(obj['titulo']) ).append( $('<p></p>').html('TAB ID='+obj['tab']) )
      ).append(
        $('<div class="folio-overview"></div>').append(
          $('<span class="folio-link"></span>').append( $('<a class="folio-read-more" href="#"></a>').html('<i class="fa fa-link"></i>').attr('data-single_url','<?php echo URLPos::getURLDirRoot(); ?>catalogo_item.php/'+obj['id_itm']) )
        ).append(
          $('<span class="folio-expand"></span>').append( $('<a data-lightbox="portfolio"></a>').html('<i class="fa fa-search-plus"></i>').attr('href','<?php echo URLPos::getURLDirRoot(); ?>images/catalogo/'+obj['link_imagem'] ) )
        )
      )
    )
  )
);
$("div.catalogobuild").append( itemOrigin.delay(20).fadeIn() );

}//Fim do loop
}

function flCatalogo(idvalor){
	  var nulo=new FormData();
	  nulo.append('funcao','i');
    var proximo_nivel=1;
    var div_menus=$("div.row.navbarscatalog");
    var menu=$('<div class="catalog-nav col-xs-12"></div>');
    menu.attr('data-page',proximo_nivel);
    var submenu=$('<ul class="nav navbar-nav"></ul>');

	callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/tabs_catalogo_get',nulo,
	function(){//BeforeSend
	},function(data){//Done
    console.log(data);
    processaProdutos(data.produtos);
    div_menus.append(menu.append(submenu));
	  if((data.code==0)||(data.code==7)){
	    var exec=0,cont=0;
	      for (var val in data.lista) {
	      var item= $('<li class="scroll class'+proximo_nivel+'"></li>');
	      item.html('<a data-id="'+data.lista[val]['id_tab']+'" onclick="setItemCatalogo(this,'+proximo_nivel+');">'+data.lista[val]['titulo']+'</a>');
        exec+=(++cont)*10;
	      submenu.append( item.hide().delay(exec).fadeIn() );
	    }
	  }else if(data.code>0){
	    $('div.jumbotron').append( $('<div class="form_status"></div>').html('<p class="text-warning">Ops... Parece que aconteceu um problema.<br/>Erro cód.: '+data.code+' -> '+data.msg+'</p>').fadeIn().delay(20000).fadeOut() );
	  }else{
	    $('div.jumbotron').append( $('<div class="form_status"></div>').html('<p class="text-warning">Ops... Parece que aconteceu um problema.<br/>Abra o console para ver os dados.</p>').fadeIn().delay(20000).fadeOut() );
	    console.log(data);
	  }
	},function(e){console.log("ERRO. Verifique a variável ab.");console.log(e);}
	);

	//alert(nomevalor);
}
</script>

</head><!--/head-->

<!--.preloader-->
<div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
<!--/.preloader-->

<body onload="flCatalogo();">
<?php
$sectAdm = new HTMLSection(array('pager_one'));
?>

  <footer id="footer">
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <p>&copy; Inova Utilidades</p>
          </div>
          <div class="col-sm-6">
            <p class="pull-right"><a target="_blank" href="http://jeimison.me.pn/">Jeimison M. Lima</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>



</body>
</html>
