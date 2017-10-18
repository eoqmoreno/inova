<!DOCTYPE html>
<html lang="pt">
<head>

<?php CAPISPHP_Structure::setTitl("Controle de Ferramentas"); echo(ObjetoView::$mvw->head()); ?>


<script>
function updtTable(){
  var nulo=new FormData();
  nulo.append('funcao','c');
callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/produtos_access',nulo,
function(){//BeforeSend
},function(data){//Done
  var campo=$("table tbody").html('');
  if(data.code==0){
    var exec=0,cont=0;
    var lista_opti="<option value=\"-1\">Herdado de...</option>\n";
      for (var val in data.lista) {
      var item= $("<tr></tr>");
      item.html("<td>"+data.lista[val]['id_prod']+"</td><td>"+data.lista[val]['titulo']+"</td><td>"+data.lista[val]['herdando_lst']+"</td><td><a class=\"btn btn-danger\" onclick=\"remvProd("+data.lista[val]['id_prod']+",this);\"><span class=\"glyphicon glyphicon-remove\"></span></a></td>");
      exec+=(++cont)*10;
      campo.append( item.hide().delay(exec).fadeIn() );
    }
  }else if(data.code>0){
    $('div.jumbotron').append( $('<div class="form_status"></div>').html('<p class="text-warning">Ops... Parece que aconteceu um problema.<br/>Erro cód.: '+data.code+' -> '+data.msg+'</p>').fadeIn().delay(20000).fadeOut() );
  }else{
    $('div.jumbotron').append( $('<div class="form_status"></div>').html('<p class="text-warning">Ops... Parece que aconteceu um problema.<br/>Abra o console para ver os dados.</p>').fadeIn().delay(20000).fadeOut() );
    console.log(data);
  }
},function(e){console.log("ERRO. Verifique a variável ab.");console.log(e);}
);
}

function remvProd(numProd,objeto){
  var nulo=new FormData();
  nulo.append('funcao','r');
  nulo.append('id',numProd);
callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/produtos_access',nulo,
function(){//BeforeSend
$(objeto).attr("disabled",'disabled'); //Bloqueia botão
},function(data){//Done
  if(data.code==0){
    updtTable();
  }else if (data.code>0) alert(data.msg);
  else alert('Erro='+data);
},function(e){console.log("ERRO=");ab=e;}
);
}

</script>
</head>
<body>
  <div class="jumbotron">
  <h1>Controle de Ferramentas</h1>
<br/>

</div>
<div class="container">
  <div class="row">
  <div class="col-xs-12 col-sm-offset-4 col-sm-4">
    <a href="<?php echo URLPos::getURLDirRoot(); ?>index.php/tabs" target="_blank" class="btn btn-success btn-lg btn-block">Gestão/Adicionar de Tabs</a>
    <a href="<?php echo URLPos::getURLDirRoot(); ?>index.php/produtos" target="_blank" class="btn btn-info btn-lg btn-block">Gestão de Produtos</a>
    <a href="<?php echo URLPos::getURLDirRoot(); ?>index.php/add_produtos" target="_blank" class="btn btn-info btn-lg btn-block">Adicionar Produtos</a>
    <a href="<?php echo URLPos::getURLDirRoot(); ?>index.php/add_produtos_cor" target="_blank" class="btn btn-info btn-lg btn-block">Adicionar Variedades</a>
  </div>
</div>
</div>

</body>
</html>
