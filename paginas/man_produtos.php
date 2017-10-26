<!DOCTYPE html>
<html lang="pt">
<head>

<?php CAPISPHP_Structure::setTitl("Gerenciador de Produtos"); echo(ObjetoView::$mvw->head()); ?>

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


function addProdut(origem){
  var nulo=new FormData();
  var prod_nome=$("#prod_nome").val(),prod_herd=$("#tab_herd").val();

  nulo.append('funcao','a');
  nulo.append('nome',prod_nome);
  nulo.append('tab',prod_herd);
if(prod_herd!=-1)
callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/produtos_access',nulo,
function(){//BeforeSend
$(origem).attr("disabled",'disabled'); //Bloqueia botão
},function(data){//Done
  var campo=$("table tbody").html('');
  $(origem).removeAttr("disabled");//Libera botão
  if(data.code==0){
    $("div.input-group-addon").addClass("").delay(2000).removeClass("has-success"); //Efeito de sucesso
    updtTable();
  }else if (data.code>0) alert(data.msg);
  else alert('Erro='+data);
},function(e){console.log("ERRO=");retornoJS=e;}
); else alert('Por favor, escolha uma tab.');
}

</script>
</head>
<body onload="updtTable();">
  <div class="jumbotron">
  <h1>Gestão de Produtos</h1>
  <br/>
    <div class="input-group-addon">
  <div class="col-xs-12 col-sm-offset-2 col-sm-3">
    <input style="background-color:rgb(255, 255, 255);" id="prod_nome" type="text" class="form-control" placeholder="Nome do Produto" />
  </div>

  <div class="col-xs-12 col-sm-3">
  <select style="background-color:rgb(255, 255, 255);" id="tab_herd" class="form-control">
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

  <div style="padding-top:8px;" class="col-xs-12 col-sm-2">
    <a id="refresh_bnt" onclick="updtTable();" class="btn btn-info"><span class="glyphicon glyphicon-refresh"></span></a>
    <a onclick="addProdut(this);" class="btn btn-success">Adicionar</a>
  </div>
  </div>
<br/>

</div>
<div class="container">
  <div class="row">

  <div class="col-xs-12">
    <table class="table table-striped">
      <thead>
        <tr><th>#</th><th>Nome do Produto</th><th>Tab Herdada</th><th>Apagar</th></tr>
      </thead>
      <tbody>
        <tr><td style="text-align:center;" colspan="4">Aguarde</td></tr>
      </tbody>
    </table>
  </div>
</div>
</div>

</body>
</html>
