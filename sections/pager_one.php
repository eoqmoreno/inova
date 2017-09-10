<?php
class pager_one{
  public static function loadPagina($urlAcess){
    include_once(URLPos::getURLDirRoot().HTMLSection::$section_props['path_sections'].'/'.$urlAcess);
  }

  function getHTML(){
    self::loadPagina("secao_inicio.php");
    self::loadPagina("secao_servicos.php");
    self::loadPagina("secao_sobre.php");
    self::loadPagina("secao_catalogo.php");
    self::loadPagina("secao_opinioes.php");
    self::loadPagina("secao_certificacoes.php");
    self::loadPagina("secao_features.php");
    self::loadPagina("secao_contato.php");
    return "";
  }
}
?>
