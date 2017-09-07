<?php
class WebView{
  public static function html(){
    CAPISPHP_Structure::setTitl("Erro 404");
    return "<center><h2>Ops... A página que tentou acessar não existe :/</h2></center>";
  }
}
?>
