<!DOCTYPE html>
<html lang="pt">
<head>

<?php
echo(ObjetoView::$mvw->head(true));
?>

<style>
@keyframes changebk-contact {
<?php echo "
96%{opacity:1;}
97%{opacity:.7;}
98%{background-image: url(".URLPos::getURLDirRoot()."/images/Site_Replace/INOVA-3.jpg);}
99%{background-image: url(".URLPos::getURLDirRoot()."/images/Site_Replace/INOVA-1.jpg);}
0%{
  background-image: url(".URLPos::getURLDirRoot()."/images/Site_Replace/INOVA-1.jpg);
  opacity:.7;
}
1%{opacity:1;}


29%{opacity:1;}
30%{opacity:.7;}
31%{background-image: url(".URLPos::getURLDirRoot()."/images/Site_Replace/INOVA-1.jpg);}
32%{background-image: url(".URLPos::getURLDirRoot()."/images/Site_Replace/INOVA-2.jpg);}
33%{
  background-image: url(".URLPos::getURLDirRoot()."/images/Site_Replace/INOVA-2.jpg);
  opacity:.7;
}
34%{opacity:1;}

62%{opacity:1;}
63%{opacity:.7;}
64%{background-image: url(".URLPos::getURLDirRoot()."/images/Site_Replace/INOVA-2.jpg);}
65%{background-image: url(".URLPos::getURLDirRoot()."/images/Site_Replace/INOVA-3.jpg);}
66%{
  background-image: url(".URLPos::getURLDirRoot()."/images/Site_Replace/INOVA-3.jpg);
  opacity:.7;
}
67%{opacity:1;}";
?>
}
@keyframes changebk-presentation {
<?php echo "
96%{opacity:1;}
97%{opacity:.7;}
98%{background-image: url(".URLPos::getURLDirRoot()."/images/Site_Replace/INOVA-6.jpg);}
99%{background-image: url(".URLPos::getURLDirRoot()."/images/homescreen/homesc-inovabck.jpg);}
0%{
  background-image: url(".URLPos::getURLDirRoot()."/images/homescreen/homesc-inovabck.jpg);
  opacity:.7;
}
1%{opacity:1;}


29%{opacity:1;}
30%{opacity:.7;}
31%{background-image: url(".URLPos::getURLDirRoot()."/images/homescreen/homesc-inovabck.jpg);}
32%{background-image: url(".URLPos::getURLDirRoot()."/images/Site_Replace/INOVA-5.jpg);}
33%{
  background-image: url(".URLPos::getURLDirRoot()."/images/Site_Replace/INOVA-5.jpg);
  opacity:.7;
}
34%{opacity:1;}

62%{opacity:1;}
63%{opacity:.7;}
64%{background-image: url(".URLPos::getURLDirRoot()."/images/Site_Replace/INOVA-5.jpg);}
65%{background-image: url(".URLPos::getURLDirRoot()."/images/Site_Replace/INOVA-6.jpg);}
66%{
  background-image: url(".URLPos::getURLDirRoot()."/images/Site_Replace/INOVA-6.jpg);
  opacity:.7;
}
67%{opacity:1;}";
?>
}
div#contact-us.parallax{
   background-color: rgb(0,10,15);
}

.blackyStyle{
  background-color: rgba(0, 0, 0, 0.67);
border-color: rgba(255, 255, 255, 0.47);
border-radius: 0;
box-shadow: none;
height: auto;
resize: none;
}
}
</style>

<script>

$(function(){
var nulo = new FormData();
callbackajx('http://ip-api.com/json/',nulo,
function(){
},function(data){
  var dados_ip=new FormData();
  dados_ip.append('client',JSON.stringify(data));
  callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/ip',dados_ip,
  function(){
  },function(data){//Done

  },function(e){console.log(e);}
  );

},function(e){console.log(e);}
);


});

var debug_lvl=0;

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
	     if(debug_lvl>1) console.log(data.code+' -> '+data.msg);
	  }else{
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
if(debug_lvl>1) console.log(folioTextos.find("div.folio-overview span.folio-expand"));
$(folioTextos.find("div.folio-overview span.folio-expand")[0]).find("a").attr('href',"<?php echo URLPos::getURLDirRoot(); ?>images/catalogo/"+lastProdutosArr[chgID]['link_imagem']); //Muda imagem a ser exibida em modo album
$(folioTextos.find("div.folio-overview span.folio-expand")[1]).find("a").attr('href',"javascript:addCompra("+lastProdutosArr[chgID]['id_cor']+");"); //Muda ID de compra

}
//Função responsável por remover linhas de tabs posteriores
function navCatalogoRemoveNext(idatual){
  var div_menus=$("div.row.navbarscatalog").children();
  div_menus.each(function(id,obj){
    if (parseInt($(obj).attr("data-page")) >= idatual) $(obj).delay(20).fadeOut().remove();
  });
}

var lastProdutosArr=[];
//Função chamada ao receber JSON com lista de produtos do catálogo
function processaProdutos(produtosArr){
  $("div.catalogobuild").hide(50).html('');//Limpa catálogo
//  console.log(produtosArr);
if(produtosArr.length>0)
for (var id in produtosArr) {
  var obj=produtosArr[id];
  var qntCores=0;
  var descric=obj['descricao'];

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
  if(debug_lvl>1)console.log(obj['cores']);
  if(debug_lvl>3)console.log('ID='+corEscolhida);
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
        $('<div class="folio-overview"></div>')/*.append(
          $('<span class="folio-link"></span>').append( $('<a class="folio-read-more" href="#"></a>').html('<i class="fa fa-link"></i>').attr('data-single_url','<?php echo URLPos::getURLDirRoot(); ?>catalogo_item.php/'+produtosArr[id]['id_itm']) )
        )*/.append(
          $('<span class="folio-link"></span>').append( $('<a data-lightbox="portfolio"></a>').html('<i class="fa fa-search-plus"></i><br/>Aproximar').attr('href','<?php echo URLPos::getURLDirRoot(); ?>images/catalogo/'+escolhida['link_imagem'] ) )
        ).append($("<span class=\"folio-expand\"></span>").append( $("<a></a>").html("<i class=\"fa fa-cart-plus\"></i><br/>Adicionar").attr("href","javascript:addCompra("+escolhida["id_cor"]+");" ) ))
        <?php /*if(Cookie::get("UID")!==false) echo(''); */ ?>
      ).append(
        $('<div class="folio-info"></div>').append(
          $('<br/>')
        ).append(
          $('<p></p>').html('Descrição:')
        ).append(
          $('<p></p>').addClass("descricao").html(descric)
        )
      )
    )
  )
);
if(debug_lvl>2){console.log('Objeto inserido.');console.log(itemOrigin);}
$("div.catalogobuild").show(0).append( itemOrigin.delay(20).fadeIn() );

}//Fim do loop

}

//Função que invoca primeira listagem do catálogo
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
    if(debug_lvl>2)console.log(data);
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
  setarHabilitado($("#botaoFinalizarPedido"),qnt>0);
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

  <div id="modalCompras" class="modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gridSystemModalLabel">Lista <?php if(Usuario::$ativo) echo('de Pedidos'); else echo('do orçamento'); ?></h4>
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
          <button id="botaoFinalizarPedido" type="button" onclick="FinalizarPedido();" class="btn disabled btn-primary">Validar <?php if(Usuario::$ativo) echo('pedido'); else echo('orçamento'); ?></button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div id="modalLogin" class="modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
      <form>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gridSystemModalLabel">Login do Representante</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                  <label for="emailLogin">E-mail:</label>
                  <input type="email" class="form-control" id="emailLogin" placeholder="E-mail">
                </div>
                <div class="form-group">
                  <label for="senhaLogin">Senha:</label>
                  <input type="password" class="form-control" id="senhaLogin" placeholder="Senha">
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" onclick="modalRegistro();" class="btn btn-warning">Registrar-se</button>
          <button id="fechar" onclick="$('#modalLogin').modal('toggle');" type="button" class="btn btn-default">Fechar</button>
          <button type="button" onclick="doLogin(this);" class="btn btn-primary">Entrar</button>
        </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<script>
//Máscaras dos formulários
$("#telefone").mask("(99) 999999999");
$("#cep").mask("99999-999");
$("#cpf").mask("999.999.999-99");
$("#cnpj").mask("99.999.999/9999-99");

$("input.maskDinheiro").mask("####,##",{reverse: true,clearIfNotMatch: true,placeholder: "__,__"});

//Função de troca entre opções de pessoa física ou jurídica
function pessoaChange(objeto){
  var opcao = $(objeto).val();
  $("div.pessoaFisicaForm").hide();
  $("div.pessoaJuridicaForm").hide();
if (opcao=="1") $("div.pessoaFisicaForm").show();
else if (opcao=="2") $("div.pessoaJuridicaForm").show();
}
//Função que insere classe de desabilitado, ou remove
function setarHabilitado(objeto,estado){
  if(!estado) objeto.addClass("disabled").attr("disabled","disabled");
  else objeto.removeClass("disabled").removeAttr("disabled");
}

function apresentaErro(objeto,verdadeiro){
  if(verdadeiro) objeto.parent().addClass("has-error");
  else objeto.parent().removeClass("has-error");
}

function apresentaSucesso(objeto,verdadeiro){
  if(verdadeiro) objeto.parent().addClass("has-success");
  else objeto.parent().removeClass("has-success");
}

//Função que reseta ALERTAS campos de registro
function resetarCamposRegistro(){
apresentaErro( $("#nomeClient") , false ); apresentaSucesso( $("#nomeClient") , false );
apresentaErro( $("#ptipo") , false ); apresentaSucesso( $("#ptipo") , false );
apresentaErro( $("#cep") , false ); apresentaSucesso( $("#cep") , false );
apresentaErro( $("#telefonClient") , false ); apresentaSucesso( $("#telefonClient") , false );
apresentaErro( $("#emailClient") , false ); apresentaSucesso( $("#emailClient") , false );
apresentaErro( $("#bairroClient") , false ); apresentaSucesso( $("#bairroClient") , false );
apresentaErro( $("#estadoClient") , false ); apresentaSucesso( $("#estadoClient") , false );
apresentaErro( $("#cidadeClient") , false ); apresentaSucesso( $("#cidadeClient") , false );
apresentaErro( $("#logradClient") , false ); apresentaSucesso( $("#logradClient") , false );
apresentaErro( $("#numeroClient") , false ); apresentaSucesso( $("#numeroClient") , false );
apresentaErro( $("#cpfCSet") , false ); apresentaSucesso( $("#cpfCSet") , false );
apresentaErro( $("#cnpjCSet") , false ); apresentaSucesso( $("#cnpjCSet") , false );
apresentaErro( $("#condpgto") , false ); apresentaSucesso( $("#condpgto") , false );
apresentaErro( $("#przpgto") , false ); apresentaSucesso( $("#przpgto") , false );
}

//Função de envio do formulário de registro
function registraCliente(objeto){
  var sucesso = nomeStt&&tipoCliStt&&telefoneStt&&emailStt&&senha1Stt&&senha2Stt&&cepStt&&bairroStt&&estadoStt&&cidadeStt&&logradouroStt&&numeroStt;
  if(debug_lvl>3)console.log(sucesso);
  if(sucesso){
  var dados=new FormData();
  dados.append('nome',$("#nome").val());
  dados.append('cpf',$("#cpf").val());
  dados.append('cnpj',$("#cnpj").val());
  dados.append('telefone',$("#telefone").val());
  dados.append('email',$("#email").val());
  dados.append('senha',$("#senha").val());
  dados.append('cep',$("#cep").val());
  dados.append('bairro',$("#bairro").val());
  dados.append('uf',$("#estado").val());
  dados.append('estado', cidades_estados_arr[$("#estado").val()]['nome'] );
  dados.append('cidade',$("#cidade").val());
  dados.append('logradouro',$("#logradouro").val());
  dados.append('numero',$("#numero").val());

callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/cliente_reg/cadastro',dados,
function(){//BeforeSend

setarHabilitado($(objeto),false);
},function(data){//Done
  setarHabilitado($(objeto),true);
  if(data.code==0){
    if(debug_lvl>1)console.log(data.msg);//Exibe o "OK!" no console
    $('#modalRegistro').modal('hide'); //Fecha a tela de cadastro
    $('#modalLogin').modal('show'); //Abre a tela de login
    $("#emailLogin").val($("#email").val());
    apresentaSucesso( $("#emailLogin") , true );
  }else if (data.code>0) alert(data.msg);
  else {alert('Erro.');console.log(data);}
},function(e){console.log("ERRO=");console.log(e);setarHabilitado($(objeto),true);}
);
} //Fim de IF SUCESSO

}


function estadoChange(obJQ){
  var cidads=cidades_estados_arr[$(obJQ).val()].cidades;
  var strCids="";
  for (var id in cidads) {
    strCids+="<option value='"+cidads[id]+"'>"+cidads[id]+"</option>"
  }
  $("#cidadeClient").html(strCids);
}

function doLogin(botn){
  setarHabilitado($(botn),false);


  var nulo=new FormData();
  nulo.append('unm',$("#emailLogin").val());
  nulo.append('pass',$("#senhaLogin").val());

  callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/logg_utils/login',nulo,
	function(){//BeforeSend
	},function(data){//Done
    if(debug_lvl>2)console.log(data);
	  if(data.code==0){
      $(botn).hide(200);
      apresentaSucesso($("#emailLogin"),true);
      apresentaSucesso($("#senhaLogin"),true);
      $("#modalLogin").modal("hide");
      window.location.reload();
    }else if(data.code>0){
    alert(data.msg);
    apresentaErro($("#emailLogin"),true);
    apresentaErro($("#senhaLogin"),true);
    }else{
	    console.log(data);
	  }
    setarHabilitado($(botn),true);
	},function(e){console.log("ERRO.");console.log(e);setarHabilitado($(botn),true);}
	);
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
    if(debug_lvl>2)console.log(data);
	  if(data.code==0){
      var tbbody=$("#tab-produtos-lista");
        var item= $("<tr></tr>");
        var unidades=1;
        if(itensCompra[index]!==undefined){
        unidades = itensCompra[ data.objeto['id'] ]['quant'];
        }

        item.html("<td><img height='70px' src='<?php echo URLPos::getURLDirRoot(); ?>"+data.objeto['img_link']+"'></img></td><td><h4>"+data.objeto['nome']+"</h4><h4>Unidade(s): "+unidades+"</td><td><a class=\"btn btn-danger\" onclick=\"remvProduto("+data.objeto['id']+");\"><span class=\"glyphicon glyphicon-remove\"></span></a></td>");
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

function limpaPedidos(){
  itensCompra=[];
  updateListaCompras();
}

function remvProduto(prodID){
itensCompra.splice(prodID, 1);
$('#modalCompras').modal("show"); //Força re-verificação da lista
updateListaCompras();//Atualiza numero
}

function modalRegistro(){
  $('#modalLogin').modal('hide');
  $('#modalRegistroRepresentante').modal('show');
}

function modalLoginShow(){
  $('#modalLogin').modal('show');
}
</script>

<div id="modalFinalComp" class="modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <form>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel"><?php if(Usuario::$ativo) echo('Sr(a). Representante, conclua o envio do pedido'); else echo('Finalizar Envio de Pedido de Orçamento'); ?></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
            <label for="nomeClient">Nome / Razão Social</label>
            <input type="text" class="form-control normalForm" id="nomeClient" placeholder="Nome / Razão Social">
          </div>

          <div class="col-xs-12 col-md-6">
              <label for="ptipo">Tipo do cliente</label>
              <select class="form-control normalForm" id="ptipo" onchange="pessoaChangePedido(this);">
                <option value="-1">Escolha</option>
                <option value="1">Pessoa física</option>
                <option value="2">Pessoa jurídica</option>
              </select>
          </div>

          <div class="col-xs-12 col-md-6">
            <div style="display: none;" id="cnpjClientSet">
              <label for="cnpjCSet">CNPJ</label>
              <input type="text" class="form-control normalForm" id="cnpjCSet" data-mask="" clearifnotmatch="true" placeholder="XX.XXX.XXX/XXXX-XX" />
            </div>
            <div style="display: none;" id="cpfClientSet">
              <label for="cpfCSet">CPF</label>
              <input type="text" class="form-control normalForm" id="cpfCSet" data-mask="999.999.999-99" placeholder="XXX.XXX.XXX-XX" />
            </div>
          </div>
        </div>

        <div class="row" style="padding-top:12px;">
          <div class="col-md-6 col-xs-12">
            <div style="margin-bottom: 0px;" class="form-group">
              <label for="cep">CEP</label>
              <div class="input-group">
                <input onchange="cepDigitado(this);" type="text" class="form-control" id="cep" placeholder="XXXXX-XXX">
                <span class="input-group-addon">
                  <button onclick="cepDigitado($('#cep'));" id="btnGetLocal" class="btn btn-info" type="button"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></button>
                </span>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-md-6">
            <label for="numeroClient">Número</label>
            <input type="text" class="form-control normalForm" id="numeroClient" placeholder="Nº, bloco ou SN">
          </div>
        </div>

        <div class="row" style="padding-top:12px;">
          <div class="col-xs-12 col-md-6">
            <label for="logradClient">Logradouro</label>
            <input type="text" class="form-control normalForm" id="logradClient" placeholder="Ex.: Rua X">
          </div>
          <div class="col-xs-12 col-md-6">
            <label for="bairroClient">Bairro</label>
            <input type="text" class="form-control normalForm" id="bairroClient" placeholder="Nome do Bairro">
          </div>
          <div class="col-xs-12 col-md-6">
            <label for="estUfDestin">Estado/UF</label>
            <select onchange="estadoChange(this);" class="form-control normalForm" id="estadoClient">
              <option value="-1">Escolha um estado</option>
            </select>
          </div>

          <div class="col-xs-12 col-md-6">
            <label for="cidadeClient">Cidade</label>
            <select class="form-control normalForm" id="cidadeClient">
              <option value="-1">Aguardando escolha de estado.</option>
            </select>
          </div>
        </div>
        <div class="row" style="padding-top:12px;">
          <div class="col-xs-12 col-md-6">
            <label for="telefonClient">Telefone</label>
            <input type="text" class="form-control normalForm" id="telefonClient" placeholder="(XX) XXXXXXXX">
          </div>
          <div class="col-xs-12 col-md-6">
            <label for="emailClient">E-mail</label>
            <input type="text" class="form-control normalForm" id="emailClient" placeholder="exemplo@provedor.com">
          </div>
        </div><div class="row" style="padding-top:12px;">
          <div class="col-xs-12">
            <table class="table table-striped">
              <thead>
                <tr><th>Produto</th><?php if(Usuario::$ativo) echo('<th>Preço</th>'); ?><th>Unidades</th></tr>
              </thead>
              <tbody id="tab-produtos-lista-final">
                <tr><td style="text-align:center;" colspan="4">Aguarde</td></tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row" style="padding-top:12px;">
          <div class="col-xs-12 col-md-6">
              <label for="condpgto">Condição de Pagamento</label>
              <select class="form-control normalForm" id="condpgto">
                <option value="-1">Escolha a condição</option>
                <option value="Boleto Bancário">Boleto Bancário</option>
                <option value="Cheque">Cheque</option>
                <option value="Transferência Bancária">Transferência Bancária</option>
                <option value="Em Espécie">Em Espécie</option>
              </select>
          </div>
          <div class="col-xs-12 col-md-6">
              <label for="przpgto">Prazo de Pagamento</label>
              <select class="form-control normalForm" id="przpgto" onchange="pessoaChangePrazo(this);">
                <option value="-1">Escolha o prazo</option>
                <option value="30">Prazo médio: 30 dias</option>
                <option value="45">Prazo médio: 45 dias</option>
                <option value="60">Prazo médio: 60 dias</option>
                <option value="90">Prazo médio: 90 dias</option>
                <option value="120">Prazo médio: 120 dias</option>
                <option value="?">Digitar nº de dias</option>
              </select>
          </div>
        </div>



      </div>
      <div class="modal-footer">
        <button type="button" onclick="confirmarPedido(this);" class="btn btn-success">Confirmar <?php if(Usuario::$ativo) echo('Pedido'); else echo('Orçamento'); ?></button>
        <button id="cancela-pedido" onclick="$('#modalFinalComp').modal('toggle');" type="button" class="btn btn-default">Cancelar Pedido</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
$("#cnpjCSet").mask("00.000.000/0000-00",{clearIfNotMatch:true});
$("#cpfCSet").mask("000.000.000-00",{clearIfNotMatch:true});


$("#telefonClient").mask("(00) 0000-00009");
$('#telefonClient').blur(function(event) {
   if($(this).val().length == 15){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
      $('#telefonClient').mask('(00) 00000-0009');
   } else {
      $('#telefonClient').mask('(00) 0000-00009');
   }
});

$("#telefoneRepr").mask("(00) 0000-00009");
$('#telefoneRepr').blur(function(event) {
   if($(this).val().length == 15){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
      $('#telefoneRepr').mask('(00) 00000-0009');
   } else {
      $('#telefoneRepr').mask('(00) 0000-00009');
   }
});

$("#teleph").mask("(00) 0000-00009");
$('#teleph').blur(function(event) {
   if($(this).val().length == 15){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
      $('#teleph').mask('(00) 00000-0009');
   } else {
      $('#teleph').mask('(00) 0000-00009');
   }
});


function pessoaChangePrazo(combobox){
  var escolh = $(combobox).val();
  if(escolh=="?"){
    var nprazo = prompt("Prefere um prazo de quantos dias? (digite apenas números)","150");
    if(!isNaN(nprazo)&&(nprazo!='0')){
      var diasPrazo = parseInt(nprazo);
      $(combobox).html($(combobox).html()+"<option value='"+diasPrazo+"'>Prazo médio: "+diasPrazo+" dias</option>");
      $(combobox).val(diasPrazo);
    } else {
      alert('Número de dias digitados inválido.\nTem certeza que "'+nprazo+'" é um número?');
      $(combobox).val("-1");
    }
  }
}

var cidades_estados_arr;
//Quando modal de registro inicia, requisita campo de estados e cidades
$('#modalFinalComp').on('show.bs.modal', function (event) {
  var nulo=new FormData();
  callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/cep_req/estados',nulo,
  function(){//BeforeSend
  },function(data){//Done
    if(data.code==0){
      cidades_estados_arr=data.estados;
      var lista_est="<option value='-1'>Escolha um estado</option>\n";
      for (var uf in data.estados) {
        var obj=data.estados[uf];
        lista_est+="<option value='"+obj['uf']+"'>"+obj['nome']+"</option>\n";
      }
      $("#estadoClient").html(lista_est);

      }else{
      console.log("Erro!");
      console.log(data);
    }
  },function(e){console.log("ERRO.");console.log(e);}
  );
});


function pessoaChangePedido(objeto){
  var opcao = $(objeto).val();
  $("#cnpjClientSet").hide();
  $("#cpfClientSet").hide();
if (opcao=="1") $("#cpfClientSet").show();
else if (opcao=="2") $("#cnpjClientSet").show();
}

//Função de recolher dados via CEP
function cepDigitado(objeto){
var valor=$(objeto).val();
  if(valor.length==9){ //Se CEP tem 9 números
    setarHabilitado($("#estadoClient"),false); //Desabilita campos de endereço
    setarHabilitado($("#cidadeClient"),false);
    setarHabilitado($("#logradClient"),false);
    setarHabilitado($("#btnGetLocal"),false);
    setarHabilitado($("#bairroClient"),false);
    var nulo=new FormData();
    callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/cep_req/'+valor,nulo,
  	function(){//BeforeSend
  	},function(data){//Done
  	  if(data.code==0){
        $("#logradClient").val(data.dados.logradouro);
        $("#estadoClient").val(data.dados.uf);
        if( $("#cidadeClient option[value='"+data.dados.localidade+"']").length > 0 )
        $("#cidadeClient").val(data.dados.localidade);
        else $("#cidadeClient").html("<option value='"+data.dados.localidade+"'>"+data.dados.localidade+"</option>"+$("#cidadeClient").html());
        $("#bairroClient").val(data.dados.bairro);

        $("#estadoClient").removeClass("disabled").removeAttr("disabled");
        $("#cidadeClient").removeClass("disabled").removeAttr("disabled");
        $("#logradClient").removeClass("disabled").removeAttr("disabled");
        $("#btnGetLocal").removeClass("disabled").removeAttr("disabled");
        setarHabilitado($("#estadoClient"),true); //Habilita campos de endereço ao final, após preenchê-los
        setarHabilitado($("#cidadeClient"),true);
        setarHabilitado($("#logradClient"),true);
        setarHabilitado($("#btnGetLocal"),true);
        setarHabilitado($("#bairroClient"),true);

        }else{
        console.log("Erro!");
  	    console.log(data);
  	  }
  	},function(e){
      setarHabilitado($("#estadoClient"),true); //Se ocorreu erro, habilita campos
      setarHabilitado($("#cidadeClient"),true);
      setarHabilitado($("#logradClient"),true);
      setarHabilitado($("#btnGetLocal"),true);
      setarHabilitado($("#bairroClient"),true);
      alert('CEP inválido.'); //E alerta CEP inválido
      console.log("ERRO.");console.log(e);
  }
  	);

  }
}

function confirmarPedido(btnClick){
  resetarCamposRegistro();//Função responsável por limpar alertas.

  var nomeClient=$("#nomeClient"),
  tipoCli=$("#ptipo"),
  cep=$("#cep"),
  telefonClient=$("#telefonClient"),
  emailClient=$("#emailClient"),
  bairroClient=$("#bairroClient"),
  estadoClient=$("#estadoClient"),
  cidadeClient=$("#cidadeClient"),
  logradClient=$("#logradClient"),
  numeroClient=$("#numeroClient"),
  condpgto=$("#condpgto"),
  przpgto=$("#przpgto");


    //Prossegue
    var nomeStt = nomeClient.val().length>5; //Nome com >5 caracteres
    var tipoCliStt = tipoCli.val()!=='-1'; //tipo de cliente selecionado
    var cepStt = cep.val().length==9; // Se CEP tem numero correto de chars
    var telefoneStt = telefonClient.val().length>=13; //Se telefone tem 14 ou mais caracteres. (8 e 9 dígitos, sem '-')
    var emailStt = emailClient.val().indexOf('@')>0;// O @ do e-mail deve estar além da primeira caractere
    var bairroStt = bairroClient.val().length>=1; //Se existe algo escrito em Bairro
    var estadoStt = estadoClient.val()!=="-1";//Se algum estado foi escolhido
    var cidadeStt = cidadeClient.val()!=="-1";//Se alguma cidade foi escolhida
    var logradouroStt = logradClient.val().length>=1; //Se existe algo escrito em Logradouro
    var numeroStt = numeroClient.val().length>=1; //Se existe algo escrito em Número
    var condicaoPag = condpgto.val()!=='-1'; //tipo de cliente selecionado
    var prazPag = przpgto.val()!=='-1'; //tipo de cliente selecionado


    if(!nomeStt) apresentaErro( nomeClient , true ); else apresentaSucesso( nomeClient , true );
    if(!tipoCliStt) apresentaErro( tipoCli , true ); else apresentaSucesso( tipoCli , true );
    if(!telefoneStt) apresentaErro( telefonClient , true ); else apresentaSucesso( telefonClient , true );
    if(!emailStt) apresentaErro( emailClient , true ); else apresentaSucesso( emailClient , true );
    if(!bairroStt) apresentaErro( bairroClient , true ); else apresentaSucesso( bairroClient , true );
    if(!estadoStt) apresentaErro( estadoClient , true ); else apresentaSucesso( estadoClient , true );
    if(!cidadeStt) apresentaErro( cidadeClient , true ); else apresentaSucesso( cidadeClient , true );
    if(!logradouroStt) apresentaErro( logradClient , true ); else apresentaSucesso( logradClient , true );
    if(!numeroStt) apresentaErro( numeroClient , true ); else apresentaSucesso( numeroClient , true );
    if(!cepStt) apresentaErro( cep , true ); else apresentaSucesso( cep , true );
    if(!condicaoPag) apresentaErro( condpgto , true ); else apresentaSucesso( condpgto , true );
    if(!prazPag) apresentaErro( przpgto , true ); else apresentaSucesso( przpgto , true );


  var identificacaoStt=false;
  if( tipoCli.val() == "1" ){ // 1 == pessoa física
    identificacaoStt=$("#cpfCSet").val().length==14;
    if(!identificacaoStt) apresentaErro( $("#cpfCSet") , true ); else apresentaSucesso( $("#cpfCSet") , true );
  }else if( tipoCli.val() == "2" ){ //2 == pessoa jurídica
    identificacaoStt=$("#cnpjCSet").val().length==18;
    if(!identificacaoStt) apresentaErro( $("#cnpjCSet") , true ); else apresentaSucesso( $("#cnpjCSet") , true );
  }



  var tudoPronto = nomeStt&&tipoCliStt&&cepStt&&telefoneStt&&emailStt&&bairroStt&&estadoStt&&cidadeStt&&logradouroStt&&numeroStt&&condicaoPag&&prazPag&&identificacaoStt;


if(tudoPronto){
  //Variáveis necessárias para fechar os modais
  finalizarPedidoAtivo=false;
  desejouCancelar=true;

  $("#modalFinalComp").modal("hide");
  $("#modalCompras").modal("hide");
  var formLoad = showAlert("Aguarde, por favor...","Estamos registrando suas informações.",0);

  setarHabilitado($(btnClick),false);
  var dados = new FormData();
  dados.append('cliente',nomeClient.val());
  dados.append('cpf',$("#cpfCSet").val());
  dados.append('cnpj',$("#cnpjCSet").val());
  dados.append('telefone',telefonClient.val());
  dados.append('email',emailClient.val());
  dados.append('cep',cep.val());
  dados.append('bairro',bairroClient.val());
  dados.append('estado', cidades_estados_arr[estadoClient.val()]['nome']);
  dados.append('uf',estadoClient.val());
  dados.append('cidade',cidadeClient.val());
  dados.append('logradouro',logradClient.val());
  dados.append('numero',numeroClient.val());
  dados.append('condpgto',condpgto.val());
  dados.append('przpgto',parseInt(przpgto.val()));

  var usuarioLogado = <?php if(Usuario::$ativo) echo('true'); else echo('false'); ?>;
  if(usuarioLogado) for(var index in itensCompra){
    itensCompra[ index ]['preco']=$("#precoObj"+index).val();
  }

  dados.append('produtos',JSON.stringify(itensCompra));


  callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/pedido/criar',dados,
  function(){//BeforeSend
  },function(data){//Done
    if(debug_lvl>2)console.log(data);
    if(data.code==0){
      //DEU CERTO
      finalizarPedidoAtivo=false;
      desejouCancelar=true;

      formLoad.modal("hide");
      setarHabilitado($(btnClick),true);
      limpaPedidos();
      var frase = usuarioLogado? "Pedido Enviado!":"Orçamento Solicitado!";
      showAlert(frase,"Agradecemos pela preferência. Nossa equipe irá avaliar os dados enviados, e logo que possível entraremos em contato.",12000);
    }else{
      formLoad.modal("hide");
      setarHabilitado($(btnClick),true);
      alert(data);
      $("#modalFinalComp").modal("show");
    }
  },function(e){console.log("ERRO.");console.log(e);formLoad.modal("hide");}
  );
}//Fim do SUCESSO COM CAMPOS

}


var finalizarPedidoAtivo=false;

function FinalizarPedido(){
  $('#modalFinalComp').modal('show');
  finalizarPedidoAtivo=true;
  $('#modalCompras').modal("show");
}

$('#modalFinalComp').on('show.bs.modal', function (event) {

  $("#tab-produtos-lista-final").html('');
for(var index in itensCompra){
  var nulo=new FormData();
  nulo.append('funcao','e');
  nulo.append('id',index);

  callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/produtos_access',nulo,
	function(){//BeforeSend
	},function(data){//Done
    if(debug_lvl>2)console.log(data);
	  if(data.code==0){
      var tbbody=$("#tab-produtos-lista-final");
        var item= $("<tr></tr>");
        var unidades=1;
        if(itensCompra[index]!==undefined){
        unidades = itensCompra[ data.objeto['id'] ]['quant'];
        }
        var usuarioLogado=<?php if(Usuario::$ativo) echo('true');else echo('false'); ?>;
        var campoExtra="";
        if(usuarioLogado) campoExtra="<td><input type='text' placeholder='0,00' style='height:34px;' maxlength='7' class='form-control normalForm maskDinheiro' id='precoObj"+data.objeto['id']+"'></td>";
        item.html("<td>"+data.objeto['nome']+"</td>"+campoExtra+"<td>"+unidades+"</td>");
        //tmDelayExec+=(++itmCont)*10;
	      tbbody.append( item ); //.hide().delay(tmDelayExec).fadeIn()
	  }else{
	    $("#tab-produtos-lista-final").append( $('<div class="form_status"></div>').html('<p class="text-warning">Ops... Parece que aconteceu um problema.<br/>Abra o console para ver os dados.</p>').fadeIn().delay(20000).fadeOut() );
	    console.log(data);
	  }
	},function(e){console.log("ERRO.");console.log(e);}
	);
}
});

var desejouCancelar=false;
$('#modalFinalComp').on('hide.bs.modal', function (event) {
  if(finalizarPedidoAtivo){
    if(confirm('Deseja cancelar o envio do pedido?')){
      finalizarPedidoAtivo=false;
      desejouCancelar=true;
      //E mais alguma coisa pra limpar a lista
    }else desejouCancelar=false;
  }
});

$('#modalFinalComp').on('hidden.bs.modal', function (event) {
  if(!desejouCancelar) FinalizarPedido();
});


</script>
<div id="modalAlert" class="modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <form>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabelTitle"></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
            <label id="modalAlertConteudo"></label>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

function showAlert(titulo,mensagem,tempo){
  $("#gridSystemModalLabelTitle").html(titulo);
  $("#modalAlertConteudo").html(mensagem);
  if(tempo!=0){
    setTimeout(function(){
      $("#modalAlert").modal("hide");
    }, tempo);
  }
  if(debug_lvl>1) console.log("Mensagem exibida.");
  return $("#modalAlert").modal("show");
}

</script>

<div id="modalCliente" class="modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Opções do Representante</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12 col-sm-offset-2 col-sm-8">
            <button onclick="logoutCliente(this);" class="btn btn-danger btn-lg btn-block">Sair</button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="$('#modalCliente').modal('toggle');" data-dismiss="modal">Fechar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
function logoutCliente(btnObj){
setarHabilitado($(btnObj),false);
$("#modalCliente").modal("hide");
showAlert("Aguarde...","Encerrando sessão aberta.",20000);
  var dados = new FormData();
  callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/logg_utils/logout',dados,
  function(){//BeforeSend
  },function(data){//Done
    if(debug_lvl>2) console.log(data);
    if(data.code==0){
      window.location.reload();
    }else{
      console.log(data);
    }
    setarHabilitado($(btnObj),true);
  },function(e){console.log("ERRO.");console.log(e);setarHabilitado($(btnObj),true);}
  );

}

function clienteModal(){
  $("#modalCliente").modal("show");
}

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
</script>

<div id="modalRegistroRepresentante" class="modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <form>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Cadastro de Representante</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="nomeRepr">Nome</label>
              <input type="text" class="form-control" id="nomeRepr" placeholder="">
            </div>
            <div class="row">
              <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                  <label for="telefone">Telefone / Celular</label>
                  <input type="tel" class="form-control" id="telefoneRepr" placeholder="(XX) XXXXXXXXX">
                </div>
              </div>
            <div class="col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="emailRepr" placeholder="endereco@provedor.com">
              </div>
            </div>
            </div>
              <div class="row">
              <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                  <label for="senha">Senha <small>(no mínimo 5 caracteres)</small></label>
                  <input type="password" class="form-control" id="senhaRepr" placeholder="Senha">
                </div>
              </div>
              <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                  <label for="senha2">Repetir a senha</label>
                  <input type="password" class="form-control" id="senha2Repr" placeholder="Digite sua senha novamente">
                </div>
              </div>
              </div>
              <div class="row">
                <div class="col-sm-offset-2 col-sm-8 col-xs-12">
                  <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" id="cpfRepr" placeholder="XXX.XXX.XXX-XX">
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <span style="color:red;">* todos os campos são obrigatórios</span>
        <button id="fechar" onclick="resetarCamposRegistro();$('#modalRegistroRepresentante').modal('toggle');" type="button" class="btn btn-default">Fechar</button>
        <button type="button" onclick="registraRepres(this);" class="btn btn-success">Registrar</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
function registraRepres(objeto){
//resetarCamposRegistro();
  //Prossegue
  var nomeStt = $("#nomeRepr").val().length>5; //Nome com >5 caracteres
  var telefoneStt = $("#telefoneRepr").val().length>=13; //Se telefone tem 14 ou mais caracteres. (8 e 9 dígitos, sem '-')
  var emailStt = $("#emailRepr").val().indexOf('@')>0;// O @ do e-mail deve estar além da primeira caractere
  var senha1Stt = $("#senhaRepr").val().length>4;//Senha contem mais de 4 caracteres
  var senha2Stt = $("#senhaRepr").val() == $("#senha2Repr").val(); //Se senhas estão iguais

  if(!nomeStt) apresentaErro( $("#nomeRepr") , true ); else apresentaSucesso( $("#nomeRepr") , true );
  if(!telefoneStt) apresentaErro( $("#telefoneRepr") , true ); else apresentaSucesso( $("#telefoneRepr") , true );
  if(!emailStt) apresentaErro( $("#emailRepr") , true ); else apresentaSucesso( $("#emailRepr") , true );
  if(!senha1Stt) apresentaErro( $("#senhaRepr") , true ); else apresentaSucesso( $("#senhaRepr") , true );
  if(!senha2Stt) apresentaErro( $("#senha2Repr") , true ); else apresentaSucesso( $("#senha2Repr") , true );

  var identificacaoStt=$("#cpfRepr").val().length==14;
    if(!identificacaoStt) apresentaErro( $("#cpfRepr") , true ); else apresentaSucesso( $("#cpfRepr") , true );


  var sucesso = nomeStt&&telefoneStt&&emailStt&&senha1Stt&&senha2Stt;
  if(debug_lvl>3) console.log(sucesso);
  if(sucesso){
    $('#modalRegistroRepresentante').modal('hide'); //Fecha a tela de cadastro
    $('#modalLogin').modal('hide');
    //Fecha modais ativos, e inicia somente um
    var formLoad = showAlert("Aguarde...","Estamos registrando suas informações.<br/>Ao fim do processo, verifique seu e-mail.",0);

  var dados=new FormData();
  dados.append('nome',$("#nomeRepr").val());
  dados.append('cpf',$("#cpfRepr").val());
  dados.append('telefone',$("#telefoneRepr").val());
  dados.append('email',$("#emailRepr").val());
  dados.append('senha',$("#senhaRepr").val());

callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/representante/cadastro',dados,
function(){//BeforeSend

setarHabilitado($(objeto),false);
},function(data){//Done
  setarHabilitado($(objeto),true);
  if(data.code==0){
    if(debug_lvl>1) console.log(data.msg);//Exibe o "OK!" no console
    formLoad.modal('hide');
    $('#modalLogin').modal('show'); //Abre a tela de login
    $("#emailLogin").val($("#emailRepr").val());
    apresentaSucesso( $("#emailLogin") , true );
  }else if (data.code>0) {alert(data.msg); formLoad.modal('hide');}
  else {alert('Erro.');console.log(data); formLoad.modal('hide');}
},function(e){console.log("ERRO=");console.log(e);setarHabilitado($(objeto),true);}
);
} //Fim de IF SUCESSO

}

$("#cpfRepr").mask("999.999.999-99");

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
