<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
  <meta name="description" content="">
  <meta name="author" content="Inova Utilidades">
  <title>Gerenciador de Tabs - Inova</title>
  <link href="<?php echo URLPos::getURLDirRoot(); ?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo URLPos::getURLDirRoot(); ?>css/animate.min.css" rel="stylesheet">
  <link href="<?php echo URLPos::getURLDirRoot(); ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo URLPos::getURLDirRoot(); ?>css/lightbox.css" rel="stylesheet">
  <link href="<?php echo URLPos::getURLDirRoot(); ?>css/main.css" rel="stylesheet">
  <link id="css-preset" href="<?php echo URLPos::getURLDirRoot(); ?>css/presets/preset1.css" rel="stylesheet">
  <link href="<?php echo URLPos::getURLDirRoot(); ?>css/responsive.css" rel="stylesheet">


  <script type="text/javascript" src="<?php echo URLPos::getURLDirRoot(); ?>js/jquery.js"></script>
  <script type="text/javascript" src="<?php echo URLPos::getURLDirRoot(); ?>js/bootstrap.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyD8hFUlenk2HWG8MFJk7TCouZJTi3xStZ8"></script>
  <script type="text/javascript" src="<?php echo URLPos::getURLDirRoot(); ?>js/jquery.inview.min.js"></script>
  <script type="text/javascript" src="<?php echo URLPos::getURLDirRoot(); ?>js/wow.min.js"></script>
  <script type="text/javascript" src="<?php echo URLPos::getURLDirRoot(); ?>js/mousescroll.js"></script>
  <script type="text/javascript" src="<?php echo URLPos::getURLDirRoot(); ?>js/smoothscroll.js"></script>
  <script type="text/javascript" src="<?php echo URLPos::getURLDirRoot(); ?>js/jquery.countTo.js"></script>
  <script type="text/javascript" src="<?php echo URLPos::getURLDirRoot(); ?>js/lightbox.min.js"></script>
  <script type="text/javascript" src="<?php echo URLPos::getURLDirRoot(); ?>js/jquery.mask.js"></script>
  <script type="text/javascript" src="<?php echo URLPos::getURLDirRoot(); ?>js/main.js"></script>

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="<?php echo URLPos::getURLDirRoot(); ?>images/favicon.ico">

<script>
function updtTable(){
  var nulo=new FormData();
  console.log("Tentando...");
  nulo.append('funcao','c');
  nulo.append('spec','');
callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/tabs_access',nulo,
function(){//BeforeSend
$("#refresh_bnt").attr("disabled",'disabled'); //Bloquei botão
},function(data){//Done
  console.log("Carregando.");
  var campo=$("table tbody").html('');
$("#refresh_bnt").removeAttr("disabled");//Libera botão
  if(data.code==0){
    var exec=0,cont=0;
    var lista_opti="<option value=\"-1\">Herdado de...</option>\n";
      for (var val in data.lista) {
      var item= $("<tr></tr>");
      lista_opti+="<option value=\""+data.lista[val]['id_tab']+"\">"+data.lista[val]['titulo']+"</option>\n";
      item.html("<td>"+data.lista[val]['id_tab']+"</td><td>"+data.lista[val]['titulo']+"</td><td>"+data.lista[val]['localizacao']+"</td><td><a class=\"btn btn-danger\" onclick=\"remvTab("+data.lista[val]['id_tab']+",this);\"><span class=\"glyphicon glyphicon-remove\"></span></a></td>");
      exec+=(++cont)*10;
      campo.append( item.hide().delay(exec).fadeIn() );
    }
    $("#tab_herd").html(lista_opti);
  }
},function(e){console.log("ERRO. Verifique a variável ab.");console.log(e);}
);
}

function remvTab(numTab,objeto){
  var nulo=new FormData();
  var prod_nome=$("#tab_nome").val(),prod_herd=$("#tab_herd").val();

  nulo.append('funcao','r');
  nulo.append('id',numTab);
callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/tabs_access',nulo,
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

function addTab(origem){
  var nulo=new FormData();
  var prod_nome=$("#tab_nome").val(),prod_herd=$("#tab_herd").val();

  nulo.append('funcao','a');
  nulo.append('nome',prod_nome);
  nulo.append('herdado',prod_herd);
if(prod_herd!=-1)
callbackajx('<?php echo URLPos::getURLDirRoot(); ?>index.php/tabs_access',nulo,
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
); else alert('Por favor, escolha uma classe.');
}
</script>
</head>
<body onload="updtTable();">
  <div class="jumbotron">
  <h1>Registro de Tabs <small>para produtos/pesquisas</small></h1>
<br/>
  <div class="input-group-addon">
<div class="col-xs-12 col-sm-offset-2 col-sm-3">
  <input style="background-color:rgb(255, 255, 255);" id="tab_nome" type="text" class="form-control" placeholder="Nome da Tab" />
</div>

<div class="col-xs-12 col-sm-3">
<select style="background-color:rgb(255, 255, 255);" id="tab_herd" class="form-control"></select>
</div>

<div style="padding-top:8px;" class="col-xs-12 col-sm-2">
  <a id="refresh_bnt" onclick="updtTable();" class="btn btn-info"><span class="glyphicon glyphicon-refresh"></span></a>
  <a onclick="addTab(this);" class="btn btn-success">Adicionar</a>
</div>
</div>

</div>
<div class="container">
  <div class="row">

  <div class="col-xs-12">
    <table class="table table-striped">
      <thead>
        <tr><th>#</th><th>Nome da Tab</th><th>Herdando</th><th>Apagar</th></tr>
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
