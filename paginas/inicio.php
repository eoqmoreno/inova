<!DOCTYPE html>
<html lang="pt">
<head>

<?php echo(ObjetoView::$mvw->head(true)); ?>

<style>
@keyframes changebk-contact {
<?php echo "0%   {background-image: url(".URLPos::getURLDirRoot()."/images/slider/1.jpg);}
  50%  {background-image: url(".URLPos::getURLDirRoot()."/images/slider/2.jpg);}
  100% {background-image: url(".URLPos::getURLDirRoot()."/images/homescreen/homesc-inovabck.jpg);}";
?>
}
</style>

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

function alteraCor(ObjetoBtn,chgID){
var folioItem=$(ObjetoBtn).parent().parent().parent().parent().parent().parent().parent().parent();
folioItem.find("div.folio-image img").attr('src',"<?php echo URLPos::getURLDirRoot(); ?>images/catalogo/"+lastProdutosArr[chgID]['link_imagem']); //Altera imagem visível
var folioTextos=folioItem.find("div.overlay div.overlay-content div.overlay-text");
folioTextos.find("div.folio-info p").html(lastProdutosArr[chgID]['nome_cor']); //Altera nome da cor no canto inferior
console.log(folioTextos.find("div.folio-overview span.folio-expand"));
$(folioTextos.find("div.folio-overview span.folio-expand")[0]).find("a").attr('href',"<?php echo URLPos::getURLDirRoot(); ?>images/catalogo/"+lastProdutosArr[chgID]['link_imagem']); //Muda imagem a ser exibida em modo album
$(folioTextos.find("div.folio-overview span.folio-expand")[1]).find("a").attr('href',"javascript:addCompra("+lastProdutosArr[chgID]['id_cor']+");"); //Muda ID de compra

}

function navCatalogoRemoveNext(idatual){
  var div_menus=$("div.row.navbarscatalog").children();
  div_menus.each(function(id,obj){
    if (parseInt($(obj).attr("data-page")) >= idatual) $(obj).delay(20).fadeOut().remove();
  });
}

var lastProdutosArr=[];
function processaProdutos(produtosArr){
  $("div.catalogobuild").hide(50).html('');//Limpa catálogo
//  console.log(produtosArr);
if(produtosArr.length>0)
for (var id in produtosArr) {
  var obj=produtosArr[id];
  var qntCores=0;

  var coresListaBtn=$("<ul class='dropdown-menu'></ul>");
  for (var idval in obj['cores']){
    lastProdutosArr[ obj['cores'][idval]['id_cor'] ]=obj['cores'][idval];
    coresListaBtn.append(
      $("<li></li>").append(
        $("<a></a>").html(obj['cores'][idval]['nome_cor']).attr('onclick',"alteraCor(this,"+obj['cores'][idval]['id_cor']+");").css({"cursor":"pointer"})
      )
    );
    ++qntCores;
  }
  var corEscolhida=Math.floor(Math.random() * qntCores);
  console.log(obj['cores']);
  console.log('ID='+corEscolhida);
  var escolhida={'id_cor':obj['cores'][corEscolhida]['id_cor'],
                 'nome_cor':obj['cores'][corEscolhida]['nome_cor'],
                 'link_imagem':obj['cores'][corEscolhida]['link_imagem'],};
    //console.log(obj);
  //  obj['id_itm'] obj['titulo'] obj['link_imagem'] obj['descricao'] obj['data'] obj['tab']
var itemOrigin=$('<div class="col-sm-3"></div>');
var item=$('<div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="300ms"></div>');
itemOrigin.append(item);
item.append(
  $('<div class="folio-image"></div>').append(
    $('<img class="img-responsive" alt=""></img>').attr('src','<?php echo URLPos::getURLDirRoot(); ?>images/catalogo/'+escolhida['link_imagem'])
)
).append(
  $('<div class="overlay"></div>').append(
    $('<div class="overlay-content"></div>').append(
      $('<div class="overlay-text"></div>').append(
        $('<div class="folio-info"></div>').append( $('<h3></h3>').html(obj['titulo']) ).append( $('<p></p>').html(escolhida['nome_cor']) ).append(
          $("<div class='btn-group'></div>").append(
          $("<button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'></button>").html("Alterar cor <span class='caret'></span>")
          ).append(coresListaBtn)

          //$('<a></a>').html('Alterar cor <i class="fa fa-angle-double-down"></i>').addClass("btn").addClass("btn-danger").attr('href','javascript:alteraCor('+obj['id_cor']+');' )
        )
      ).append(
        $('<div class="folio-overview"></div>').append(
          $('<span class="folio-link"></span>').append( $('<a class="folio-read-more" href="#"></a>').html('<i class="fa fa-link"></i>').attr('data-single_url','<?php echo URLPos::getURLDirRoot(); ?>catalogo_item.php/'+produtosArr[id]['id_itm']) )
        ).append(
          $('<span class="folio-expand"></span>').append( $('<a data-lightbox="portfolio"></a>').html('<i class="fa fa-search-plus"></i>').attr('href','<?php echo URLPos::getURLDirRoot(); ?>images/catalogo/'+escolhida['link_imagem'] ) )
        ).append(
          $('<span class="folio-expand"></span>').append( $('<a></a>').html('<i class="fa fa-cart-plus"></i>').attr('href','javascript:addCompra('+escolhida['id_cor']+');' ) )
        )
      )
    )
  )
);
console.log('Objeto inserido.');console.log(itemOrigin);
$("div.catalogobuild").show(0).append( itemOrigin.delay(20).fadeIn() );

}//Fim do loop

}

function flCatalogo(){
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

//A partir daqui, códigos referentes às compras
var itensCompra = [];

function updateListaCompras(){
  var qnt=0;
  for (var val in itensCompra) ++qnt;
  $("#itens-comprados").html(qnt);
}

function addCompra(numID){
  var preloadQuant=1;
  if(itensCompra[numID]!==undefined){
  preloadQuant = itensCompra[numID]['quant'];
  }
  var quant = prompt("Quantidade?",preloadQuant);
  if((quant!==null)&&(parseInt(quant)>=1)){
  itensCompra[numID]={"quant":parseInt(quant),"id":numID};
  //.push(numID);
  updateListaCompras();
  }
}


</script>

</head><!--/head-->

<!--.preloader-->
<div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
<!--/.preloader-->

<body onload="flCatalogo();">

  <div id="modalCompras" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gridSystemModalLabel">Lista de Pedidos</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-xs-12">
              <table class="table table-striped">
                <thead>
                </thead>
                <tbody id="tab-produtos-lista">
                  <tr><td style="text-align:center;" colspan="4">Aguarde</td></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary">Validar pedido</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div id="modalRegistro" class="modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
      <form>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gridSystemModalLabel">Cadastro de Cliente</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group">
                <label for="nome">Razão social / Nome</label>
                <input type="text" class="form-control" id="nome" placeholder="">
              </div>
              <div class="row">
              <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                  <label for="ptipo">Tipo do cliente</label>
                  <select class="form-control" id="ptipo" onchange="pessoaChange(this);">
                    <option value="-1">Escolha</option>
                    <option value="1">Pessoa física</option>
                    <option value="2">Pessoa jurídica</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                  <label for="email">E-mail</label>
                  <input type="email" class="form-control" id="email" placeholder="endereco@provedor.com">
                </div>
              </div>
              </div>
                <div class="row">
                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" id="senha" placeholder="Senha">
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label for="senha2">Repetir a senha</label>
                    <input type="password" class="form-control" id="senha2" placeholder="Digite sua senha novamente">
                  </div>
                </div>
                </div>
                <div class="row">
                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label for="cep">CEP</label>
                    <div class="input-group">
                      <input onchange="cepDigitado(this);" type="text" class="form-control" id="cep" placeholder="XXXXX-XXX">
                      <span class="input-group-addon">
                        <button onclick="cepDigitado($('#cep'));" id="btnGetLocal" class="btn btn-info" type="button"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></button>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label for="rua">Rua</label>
                    <input type="text" class="form-control" id="rua" placeholder="ex. Rua...">
                  </div>
                </div>
                </div>
                <div class="row">
                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label for="estado">Estado</label>
                    <select onchange="estadoChange(this);" class="form-control" id="estado">
                      <option value="-1">Escolha um estado</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <select class="form-control" id="cidade">
                      <option value="-1">Aguardando escolha de estado.</option>
                    </select>
                  </div>
                </div>
                </div>
                <div style="display: none;" class="pessoaFisicaForm">
                  <div class="row">
                  <div class="col-sm-offset-2 col-sm-8 col-xs-12">
                    <div class="form-group">
                      <label for="cpf">CPF</label>
                      <input type="text" class="form-control" id="cpf" placeholder="XXX.XXX.XXX-XX">
                    </div>
                  </div>
                  </div>
                </div>
                <div style="display: none;" class="pessoaJuridicaForm">
                  <div class="col-sm-offset-2 col-sm-8 col-xs-12">
                    <div class="form-group">
                      <label for="cnpj">CNPJ</label>
                      <input type="text" class="form-control" id="cnpj" placeholder="XX.XXX.XXX/XXXX-XX">
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <span style="color:red;">* todos os campos são obrigatórios</span>
          <button id="fechar" onclick="$('#modalRegistro').modal('toggle');" type="button" class="btn btn-default">Fechar</button>
          <button type="button" class="btn btn-success">Registrar</button>
        </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div id="modalLogin" class="modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
      <form>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gridSystemModalLabel">Login do Cliente</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Endereço de e-mail:</label>
                  <input type="email" class="form-control" id="email" placeholder="E-mail">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Senha:</label>
                  <input type="password" class="form-control" id="senha" placeholder="Senha">
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" onclick="modalRegistro();" class="btn btn-warning">Registrar-se</button>
          <button id="fechar" onclick="$('#modalLogin').modal('toggle');" type="button" class="btn btn-default">Fechar</button>
          <button type="button" class="btn btn-primary">Entrar</button>
        </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<script>
$("#cep").mask("99999-999");


function pessoaChange(objeto){
  var opcao = $(objeto).val();
  $("div.pessoaFisicaForm").hide();
  $("div.pessoaJuridicaForm").hide();
if (opcao=="1") $("div.pessoaFisicaForm").show();
else if (opcao=="2") $("div.pessoaJuridicaForm").show();
}

function cepDigitado(objeto){
var valor=$(objeto).val();
  if(valor.length==9){
    $("#estado").addClass("disabled").attr("disabled","disabled");
    $("#cidade").addClass("disabled").attr("disabled","disabled");
    $("#rua").addClass("disabled").attr("disabled","disabled");
    $("#btnGetLocal").addClass("disabled").attr("disabled","disabled");
    var nulo=new FormData();
    callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/cep_req/'+valor,nulo,
  	function(){//BeforeSend
  	},function(data){//Done
      console.log(data);
  	  if(data.code==0){
        $("#rua").val(data.dados.rua);
        $("#estado").val(data.dados.uf);
        if( $("#cidade option[value='"+data.dados.cidade+"']").length > 0 )
        $("#cidade").val(data.dados.cidade);
        else $("#cidade").html("<option value='"+data.dados.cidade+"'>"+data.dados.cidade+"</option>"+$("#cidade").html());

        $("#estado").removeClass("disabled").removeAttr("disabled");
        $("#cidade").removeClass("disabled").removeAttr("disabled");
        $("#rua").removeClass("disabled").removeAttr("disabled");
        $("#btnGetLocal").removeClass("disabled").removeAttr("disabled");

        }else{
        console.log("Erro!");
  	    console.log(data);
  	  }
  	},function(e){console.log("ERRO.");console.log(e);}
  	);

  }
}
var cidades_estados_arr;
$('#modalRegistro').on('show.bs.modal', function (event) {
  var nulo=new FormData();
  callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/cep_req/estados',nulo,
  function(){//BeforeSend
  },function(data){//Done
    console.log(data);
    if(data.code==0){
      cidades_estados_arr=data.estados;
      var lista_est="<option value='-1'>Escolha um estado</option>\n";
      for (var uf in data.estados) {
        var obj=data.estados[uf];
        lista_est+="<option value='"+obj['uf']+"'>"+obj['nome']+"</option>\n";
        console.log('Estado='+obj['nome']);
      }
      $("#estado").html(lista_est);

      }else{
      console.log("Erro!");
      console.log(data);
    }
  },function(e){console.log("ERRO.");console.log(e);}
  );
});

function estadoChange(obJQ){
  var cidads=cidades_estados_arr[$(obJQ).val()].cidades;
  var strCids="";
  for (var id in cidads) {
    strCids+="<option value='"+cidads[id]+"'>"+cidads[id]+"</option>"
  }
  $("#cidade").html(strCids);
}


function modalComprasShow(){
  $('#modalCompras').modal('show');
}

$('#modalCompras').on('show.bs.modal', function (event) {
  var itmCont=0,tmDelayExec=0;
  $("#tab-produtos-lista").html('');
for(var index in itensCompra){
  var nulo=new FormData();
  nulo.append('funcao','e');
  nulo.append('id',index);

  callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/produtos_access',nulo,
	function(){//BeforeSend
	},function(data){//Done
    console.log(data);
	  if(data.code==0){
      var tbbody=$("#tab-produtos-lista");
        var item= $("<tr></tr>");
        var unidades=1;
        if(itensCompra[index]!==undefined){
        unidades = itensCompra[ data.objeto['id'] ]['quant'];
        }

        item.html("<td><img height='60px' src='"+data.objeto['img_link']+"'></img></td><td><h4>"+data.objeto['nome']+"</h4><h4>Unidade(s): "+unidades+"</td><td><a class=\"btn btn-danger\" onclick=\"remvProduto("+data.objeto['id']+",this);\"><span class=\"glyphicon glyphicon-remove\"></span></a></td>");
        tmDelayExec+=(++itmCont)*10;
	      tbbody.append( item.hide().delay(tmDelayExec).fadeIn() );
	  }else{
	    $("#tab-produtos-lista").append( $('<div class="form_status"></div>').html('<p class="text-warning">Ops... Parece que aconteceu um problema.<br/>Abra o console para ver os dados.</p>').fadeIn().delay(20000).fadeOut() );
	    console.log(data);
	  }
	},function(e){console.log("ERRO.");console.log(e);}
	);
}
});


function modalRegistro(){
  $('#modalLogin').modal('hide');
  $('#modalRegistro').modal('show');
}

function modalLoginShow(){
  $('#modalLogin').modal('show');
}
</script>

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
