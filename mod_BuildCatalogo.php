<?php
class BCatalogo{
  public static $DEFS=array('table' => 'inova_catalogo',
  'limite'=>' LIMIT 0,4');
  public static function listaItens(){
    return DBCon::dbQuery("SELECT * FROM ".self::$DEFS['table'].self::$DEFS['limite'].";");
  }

  public static function getHTML(){
    $arrBD=self::listaItens();
    $strFinal="";
    echo(URLPos::getURLDirRoot());
      if($arrBD->num_rows>0){
        while($item_port = $arrBD->fetch_array(MYSQLI_BOTH)){
          $strFinal.='        <div class="col-sm-3">
                    <div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="300ms">
                      <div class="folio-image">
                        <img class="img-responsive" src="'.URLPos::getURLDirRoot().'images/catalogo/'.$item_port['link_imagem'].'" alt="">
                      </div>
                      <div class="overlay">
                        <div class="overlay-content">
                          <div class="overlay-text">
                            <div class="folio-info">
                              <h3>'.$item_port['titulo'].'</h3>
                              <p>'.$item_port['tab'].'</p>
                            </div>
                            <div class="folio-overview">
                              <span class="folio-link"><a class="folio-read-more" href="#" data-single_url="catalogo_item.php/'.$item_port['id_itm'].'" ><i class="fa fa-link"></i></a></span>
                              <span class="folio-expand"><a href="'.URLPos::getURLDirRoot().'images/catalogo/'.$item_port['link_imagem'].'" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>'."\n";
        }
      }else{$strFinal="Sem resultados.";}
    return $strFinal;
  }
}

?>
