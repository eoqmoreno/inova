<?php
class PageControl{

//Redirecionamentos URL referenciada após o /index.php/[1]
private static $indexes=array(
'paginas/inicio.php'=>'inicio',
'paginas/man_tabs.php'=>'tabs',
'controllers/tabs_return.php'=>'tabs_access',
'paginas/man_catalogo.php'=>'catalogo',
'postar_produto.php'=>'produto_publish',
'paginas/man_produtos.php'=>'produtos',
'controllers/produtos_return.php'=>'produtos_access',
'paginas/man_main.php'=>'gestor',
);
private static $DEFAULT='inicio';

private static $ERRORS=array(
404 => 'err404.php');



public static function navegar_para($navEnter){
  if(!isset($navEnter[1])) $navEnter[1]=self::$DEFAULT;
  elseif(strlen($navEnter[1])==0) $navEnter[1]=self::$DEFAULT;

  $key_found=array_search($navEnter[1],self::$indexes);
  if($key_found) include_once($key_found);
  else include_once(self::$ERRORS[404]);
}
}
?>
