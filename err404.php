<?php
    $mvw = new MainView();
    CAPISPHP_Structure::setTitl("Erro 404");
    echo($mvw->head());
    echo "<center><h2>Ops... A página que tentou acessar não existe :/</h2></center>";

?>
