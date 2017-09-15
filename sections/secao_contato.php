<?php

?>
<section style="padding:0 0;" id="contact">
  <div id="contact-us" class="parallax">
    <div class="container">
      <div class="row">
        <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
          <h2>Contato</h2>
        </div>
      </div>
      <div class="col-sm-6">
      <div class="contact-form wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
        <div class="row">
          <div class="col-sm-offset-3 col-sm-6">
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#fale-conosco" aria-controls="fale-conosco" role="tab" data-toggle="tab"><i class="fa fa-user-o" aria-hidden="true"></i> SAC</a></li>
              <!--
              <li role="presentation"><a href="#trabalhe-conosco" aria-controls="trabalhe-conosco" role="tab" data-toggle="tab"><i class="fa fa-handshake-o" aria-hidden="true"></i> Trabalhe Conosco</a></li>
            -->
            </ul>
          </div>
          <!-- INÍCIO DAS TABPANELS -->
          <div id="contato-items" class="tab-content col-xs-12">
            <div role="tabpanel" class="tab-pane fade in active" id="fale-conosco">
            <br/>
            <p class="text-center">Utilize este canal para contatos, dúvidas, sugestões e críticas. <br/> Envie o formulário abaixo e responderemos o mais breve possível.</p>
            <br/>
              <!-- FORMULÁRIO DE FALE CONOSCO -->
              <form id="main-contact-form" name="contact-form" method="post" action="contato_send.php">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" id="name" class="form-control" placeholder="Nome *" required="required">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="email" id="email" class="form-control" placeholder="Endereço de email" required="required">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" id="teleph" class="form-control" data-mask="(99) 99999-9999" placeholder="(99) 99999-9999 *" required="required">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <select style="color:#fff;" id="subject" class="form-control" required="required">
                        <option value="-1">Escolha uma opção *</option>
                        <option value="Contato">Contato</option>
                        <option value="Crítica">Crítica</option>
                        <option value="Dúvida">Dúvida</option>
                        <option value="Elogio">Elogio</option>
                        <option value="Sugestão">Sugestão</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <textarea name="message" id="message" class="form-control" rows="4" placeholder="Digite sua mensagem *" required="required"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn-submit">Enviar agora</button>
                  </div>
                </div>
              </form>
              <!-- FIM DO FORMULÁRIO "FALE CONOSCO" -->
            </div>
            <div role="tabpanel" class="tab-pane fade" id="trabalhe-conosco">
              <br/>
              <p class="text-center">Envie seu currículo para nossa equipe.<br/> Os formatos aceitos são PDF ou Imagens (jpg,png,bmp).</p>
              <br/>

              <!-- FORMULÁRIO DE TRABALHE CONOSCO -->
              <form id="formulario-trabalhe-conosco" name="formulario-trabalhe-conosco" method="post" action="contato_send.php">
                <div class="row">
                  <div class="col-sm-12 row">
                    <div style="background-color:rgba(255,255,255,0.4);border-radius:5px;" class="input-group">
                      <span class="input-group-addon" id="sizing-addon2"><h5><i class="glyphicon glyphicon-link" style="color:black;" aria-hidden="true"></i></i></h5></span>
                      <input style="margin-top: 12px;" type="file" name="anexo" id="anexo" aria-describedby="sizing-addon2" required="required" />
                    </div>
                  </div>
                  <div class="input-group form-group col-sm-4">
                    <button type="submit" class="btn-submit">Enviar agora</button>
                  </div>
                </div>
              </form>
              <!-- FIM DO FORMULÁRIO "TRABALHE CONOSCO" -->

            </div>
          </div><!-- FIM DAS TABPANELS -->

        </div>
      </div>
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
</section><!--/#contact-->
