<?php

?>
<section style="padding:0 0;" id="contact">
  <div id="contact-us" class="parallax">
    <div class="container">
      <div class="row">
        <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
          <h2>Fale Conosco</h2>
          <p id="form-contato-focus">Se deseja fazer algum pedido ou solicitar suporte use um dos nossos canais abaixo.</p>
        </div>
      </div>
      <div class="contact-form wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
        <div class="row">
          <div class="col-sm-6">
            <form id="main-contact-form" name="contact-form" method="post" action="contato_send.php">
              <div class="row  wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" id="name" class="form-control" placeholder="Nome" required="required">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="email" id="email" class="form-control" placeholder="Endereço de email" required="required">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" id="subject" class="form-control" placeholder="Assunto" required="required">
              </div>
              <div class="form-group">
                <textarea name="message" id="message" class="form-control" rows="4" placeholder="Digite sua mensagem" required="required"></textarea>
              </div>
              <div class="form-group">
                <button type="submit" class="btn-submit">Enviar agora</button>
              </div>
            </form>
          </div>
          <div class="col-sm-6">
            <div class="contact-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
              <p>Ou solicite uma visita por outros meios:</p>
              <ul class="address">
                <li><i class="fa fa-phone"></i> <span> Telefones:</span> (85) 3293-1000 | (85) 99251-6999  </li>
                <li><i class="fa fa-envelope"></i> <span> Email Institucional:</span><a href="mailto:inovautilidades@inovautilidades.com.br"> inovautilidades@inovautilidades.com.br</a></li>
                <li><i class="fa fa-envelope"></i> <span> Email Financeiro:</span><a href="mailto:financeiro@inovautilidades.com.br"> financeiro@inovautilidades.com.br</a></li>
                <li><i class="fa fa-envelope"></i> <span> Email Comercial:</span><a href="mailto:comercial@inovautilidades.com.br"> comercial@inovautilidades.com.br</a></li>
                <li><i class="fa fa-map-marker"></i> <span> Endereço:</span> Rua Leste I, 500 - Galpão D - Distrito Industrial, Maracanaú-CE, 61.939-190</li>
                <li>
                 <div style="height:200px;" id="google-map" class="wow fadeIn" data-latitude="-3.854939" data-longitude="-38.594829" data-wow-duration="1000ms" data-wow-delay="400ms"></div></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!--/#contact-->
