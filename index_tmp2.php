<?php
include('CAPISPHP.php'); //Apenas para uso dos módulos
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Inova Utilidades">
  <title>Inova Utilidades</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/lightbox.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link id="css-preset" href="css/presets/preset1.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">


  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="images/favicon.ico">
</head><!--/head-->

<body>

  <!--.preloader-->
  <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
  <!--/.preloader-->

  <header id="inicio">
    <div id="home-slider" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <div class="item active" style="background-image: url(images/slider/1.jpg)">
          <div class="caption">
            <div class="animated fadeInLeftBig"><center><a href="./"><img class="img-responsive" src="images/logo_mini.png" alt="Inova"></a></center></div>
            <h1 style="font-size:1em;" class="animated fadeInLeftBig">Nossos <span>produtos</span> são <span>projetados</span> pensando no seu bem estar</h1>
            <!--<p class="animated fadeInRightBig">Nossos <span>móveis</span> são <span>projetados</span> pensando no seu bem estar.</p>-->
            <a class="btn btn-start animated fadeInUpBig objScrollLento" href="#servicos">Comece agora</a>
          </div>
        </div>
        <div class="item" style="background-image: url(images/slider/2.jpg)">
          <div class="caption">
            <h1 class="animated fadeInLeftBig">Entregamos em todo o <span>País</span></h1>
            <p class="animated fadeInRightBig">Veja o catálogo e conheça nossos produtos</p>
            <a data-scroll class="btn btn-start animated fadeInUpBig" href="#servicos">Comece agora</a>
          </div>
        </div>
      </div>
      <a class="left-control" href="#home-slider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
      <a class="right-control" href="#home-slider" data-slide="next"><i class="fa fa-angle-right"></i></a>

      <a id="tohash" href="#servicos"><i class="fa fa-angle-down"></i></a>

    </div><!--/#home-slider-->
    <div class="main-nav">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Alterar navegação</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./">
            <h1><img class="img-responsive" style="height:40px;" src="images/logo_mini.png" alt="logo"></h1>
          </a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="scroll active"><a href="#inicio">Início</a></li>
            <li class="scroll"><a href="#servicos">Serviços</a></li>
            <li class="scroll"><a href="#sobre-nos">Sobre Nós</a></li>
            <li class="scroll"><a href="#portfolio">Catálogo</a></li>
            <li class="scroll"><a href="#team">Time</a></li>
            <li class="scroll"><a href="#opinioes">Opiniões</a></li>
            <li class="scroll"><a href="#contact">Contato</a></li>
          </ul>
        </div>
      </div>
    </div><!--/#main-nav-->
  </header><!--/#home-->
  <section id="servicos">
    <div class="container">
      <div class="heading wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
        <div class="row">
          <div class="text-center col-sm-8 col-sm-offset-2">
            <h2>Serviços</h2>
            <p>Nossos produtos e serviços são feitos sob os mesmos conceitos</p>
          </div>
        </div>
      </div>
      <div class="text-center our-services">
        <div class="row">
          <div class="col-sm-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="service-icon">
              <i class="fa fa-flask"></i>
            </div>
            <div class="service-info">
              <h3>Qualidade</h3>
              <p>Desde a seleção da matéria-prima até o aperfeiçoamento mais suave, <b>a qualidade é o nosso diferencial</b>.</p>
            </div>
          </div>
          <div class="col-sm-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="450ms">
            <div class="service-icon">
              <i class="fa fa-umbrella"></i>
            </div>
            <div class="service-info">
              <h3>Inovações</h3>
              <p>O design dos nossos produtos se baseia em originalidade e bem estar. Nós não só criamos, mas moldamos seu conceito.</p>
            </div>
          </div>
          <div class="col-sm-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="550ms">
            <div class="service-icon">
              <i class="fa fa-truck"></i>
            </div>
            <div class="service-info">
              <h3>Logística</h3>
              <p>Temos redes de entrega por todo o país. Não se limite pela distância. <b>Você pode ter o melhor onde quiser pois vamos onde estiver.</b></p>
            </div>
          </div>
          <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="650ms">
            <div class="service-icon">
              <i class="fa fa-group"></i>
            </div>
            <div class="service-info">
              <h3>Colaboradores</h3>
              <p>Os colaboradores formam a imagem e caráter da empresa, além da excelência dos nossos serviços. A atenção com nossos contribuidores é mais que uma obrigação. É um princípio.  </p>
            </div>
          </div>
          <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="750ms">
            <div class="service-icon">
              <i class="fa fa-warning"></i>
            </div>
            <div class="service-info">
              <h3>Produtos Certificados</h3>
              <p>Realizamos diversos testes nos nossos produtos antes de sua liberação. Justamente por isso <b>temos a certificação de qualidade do Inmetro</b>.</p>
            </div>
          </div>
          <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="850ms">
            <div class="service-icon">
              <i class="fa fa-question"></i>
            </div>
            <div class="service-info">
              <h3>Alguma dúvida?</h3>
              <p>Acesse a área de Contato.<br/>Nossa equipe está sempre disponível para melhor atendê-lo.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!--/#servicos-->


  <section id="sobre-nos" class="parallax">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="about-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <h2>Sobre nós</h2>
            <p>A INOVA – Indústria e Comércio de Utilidades para o lar, foi fundada em 31 de outubro de 2015. O corpo técnico é composto por profissionais das áreas de Engenharia, Administração, Recursos Humanos, Ciências Contábeis, e demais com formação técnica nas áreas de Eletrotécnica e Mecânica Industrial.</p>
            <p>A empresa tem se baseado na busca constante pela qualidade, na viabilização de uma gestão dinâmica e eficiente e, sobretudo, no compromisso em desenvolver seus profissionais.</p>
1.1.	MISSÃO

Ofertar ao mercado de utilidades plásticas, produtos acessíveis com garantia de qualidade, com foco em gestão de resultados e desenvolvimento das pessoas, gerando valor ao negócio.

1.2.	VISÃO

Ser referência no mercado consumidor Norte-Nordeste na comercialização de produtos em utilidades para o lar.

1.3.	 VALORES









<p><ul class="fa-ul">
  <li><i class="fa-li fa fa-check-square"></i>Clientes satisfeitos</li>
  <li><i class="fa-li fa fa-check-square"></i>Foco em Resultados</li>
  <li><i class="fa-li fa fa-check-square"></i>Ética</li>
  <li><i class="fa-li fa fa-check-square"></i>Compromisso</li>
  <li><i class="fa-li fa fa-check-square"></i>Trabalho</li>
  <li><i class="fa-li fa fa-check-square"></i>Fé</li>
  <li><i class="fa-li fa fa-check-square"></i>INOVAÇÃO</li>
</ul></p>

            </div>
        </div>
        <div class="col-sm-6">
          <div class="our-skills wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="single-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
              <p class="lead">Satisfação dos clientes</p>
              <div class="progress">
                <div class="progress-bar progress-bar-primary six-sec-ease-in-out" role="progressbar"  aria-valuetransitiongoal="90">90%</div>
              </div>
            </div>
            <div class="single-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="400ms">
              <p class="lead">Satisfação em produtos personalizados</p>
              <div class="progress">
                <div class="progress-bar progress-bar-primary six-sec-ease-in-out" role="progressbar"  aria-valuetransitiongoal="98">98%</div>
              </div>
            </div>
            <div class="single-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="500ms">
              <p class="lead">Outra estatística atraente</p>
              <div class="progress">
                <div class="progress-bar progress-bar-primary six-sec-ease-in-out" role="progressbar"  aria-valuetransitiongoal="80">80%</div>
              </div>
            </div>
            <div class="single-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
              <p class="lead">Algo que deixe boas expectativas</p>
              <div class="progress">
                <div class="progress-bar progress-bar-primary six-sec-ease-in-out" role="progressbar"  aria-valuetransitiongoal="75">75%</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!--/#sobre-nos-->

  <section id="portfolio">
    <div class="container">
      <div class="row">
        <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
          <h2>Catálogo</h2>
          <p>Veja nossos produtos mais populares, mas não se limite! Trabalhamos também com produtos personalizados.</p>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <?php echo BCatalogo::getHTML(); ?>
      </div>
    </div>
    <div id="portfolio-single-wrap">
      <div id="portfolio-single">
      </div>
    </div><!-- /#portfolio-single-wrap -->
  </section><!--/#portfolio-->

  <section id="features" class="parallax">
    <div class="container">
      <div class="row count">
        <div class="col-sm-4 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
          <i class="fa fa-user"></i>
          <h3 class="timer">4000</h3>
          <p>Clientes Satisfeitos</p>
        </div>
        <div class="col-sm-4 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
          <i class="fa fa-handshake-o"></i>
          <h3 class="timer">200</h3>
          <p>Parceiros no Percurso</p>
        </div>
        <div class="col-sm-4 col-xs-12 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="900ms">
          <i class="fa fa-pencil-square-o"></i>
          <h3 class="timer">800</h3>
          <p>Produtos Personalizados</p>
        </div>
      </div>
    </div>
  </section><!--/#features-->


  <section id="team">
    <div class="container">
      <div class="row">
        <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
          <h2>O Time</h2>
          <p>Alguns dos contribuidores de mais longa data na empresa</p>
        </div>
      </div>
      <div class="team-members">
        <div class="row">
          <div class="col-sm-3">
            <div class="team-member wow flipInY" data-wow-duration="1000ms" data-wow-delay="300ms">
              <div class="member-image">
                <img class="img-responsive" src="images/team/1.jpg" alt="">
              </div>
              <div class="member-info">
                <h3>Pessoa 01</h3>
                <h4>CEO &amp; Founder</h4>
                <p>Uma curta descrição válida das atividades da pessoa aqui</p>
              </div>
              <div class="social-icons">
                <ul>
                  <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                  <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                  <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                  <li><a class="rss" href="#"><i class="fa fa-rss"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="team-member wow flipInY" data-wow-duration="1000ms" data-wow-delay="500ms">
              <div class="member-image">
                <img class="img-responsive" src="images/team/2.jpg" alt="">
              </div>
              <div class="member-info">
                <h3>Pessoa 02</h3>
                <h4>UI/UX Designer</h4>
                <p>Uma curta descrição válida das atividades da pessoa aqui</p>
              </div>
              <div class="social-icons">
                <ul>
                  <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                  <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                  <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                  <li><a class="rss" href="#"><i class="fa fa-rss"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="team-member wow flipInY" data-wow-duration="1000ms" data-wow-delay="800ms">
              <div class="member-image">
                <img class="img-responsive" src="images/team/3.jpg" alt="">
              </div>
              <div class="member-info">
                <h3>Pessoa 03</h3>
                <h4>Developer</h4>
                <p>Uma curta descrição válida das atividades da pessoa aqui</p>
              </div>
              <div class="social-icons">
                <ul>
                  <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                  <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                  <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                  <li><a class="rss" href="#"><i class="fa fa-rss"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="team-member wow flipInY" data-wow-duration="1000ms" data-wow-delay="1100ms">
              <div class="member-image">
                <img class="img-responsive" src="images/team/4.jpg" alt="">
              </div>
              <div class="member-info">
                <h3>Pessoa 04</h3>
                <h4>Support Manager</h4>
                <p>Uma curta descrição válida das atividades da pessoa aqui</p>
              </div>
              <div class="social-icons">
                <ul>
                  <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                  <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                  <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                  <li><a class="rss" href="#"><i class="fa fa-rss"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!--/#team-->

  <section id="opinioes" class="parallax">
    <div>
      <a style="left:70px;z-index: 200; top:50%;" class="twitter-left-control" href="#opinioes-carousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
      <a style="right:70px;z-index: 200; top:50%;" class="twitter-right-control" href="#opinioes-carousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2 col-xs-12">
            <div class="text-center">
              <i style="font-size: 5em;" class="fa fa-commenting-o"></i>
              <h4>Opiniões</h4>
            </div>
            <div id="opinioes-carousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="item active wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
                  <p>Nenhuma das concorrentes jamais <span>fez</span> o que a <span>Inova</span> propõe.<br/>
                  -<i> Jeimison Moreno. Desenvolvedor e estagiário.</i></p>
                </div>
                <div class="item">
                  <p><span>Podemos</span> inserir opiniões de parceiros neste espaço<br/>Podem ser de parceiros...</p>
                </div>
                <div class="item">
                  <p>Claro, são apenas <span>ideias</span>.<br/>Essa parte já não posso definir.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!--/#opinioes-->

  <section style="padding:0 0;" id="contact">
    <div style="height:400px;" id="google-map" class="wow fadeIn" data-latitude="-3.854939" data-longitude="-38.594829" data-wow-duration="1000ms" data-wow-delay="400ms"></div>
    <div id="contact-us" class="parallax">
      <div class="container">
        <div class="row">
          <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <h2>Contato</h2>
            <p>Se deseja solicitar algum pedido ou suporte use nossos canais abaixo.</p>
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
                  <li><i class="fa fa-envelope"></i> <span> Email:</span><a href="mailto:inova@inovautilidades.com"> inova@inovautilidades.com</a></li>
                  <li><i class="fa fa-map-marker"></i> <span> Endereço:</span> Rua Leste I, 500 - Galpão D - Distrito Industrial, Maracanaú-CE </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!--/#contact-->
  <footer id="footer">
    <div class="footer-top wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
      <div class="container text-center">
        <div class="footer-logo">
          <a href="./"><img class="img-responsive" src="images/logo_mini.png" alt=""></a>
        </div>
        <div class="social-icons">
          <ul>
            <li><a class="envelope" href="#"><i class="fa fa-envelope"></i></a></li>
            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
            <li><a class="tumblr" href="#"><i class="fa fa-tumblr-square"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <p>&copy; Inova Utilidades</p>
          </div>
          <div class="col-sm-6">
            <p class="pull-right"><a target="_blank" href="http://jeimison.me.pn/">Jeimison M. Lima</a>|<a target="_blank" href="http://www.themeum.com/">Themeum</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyD8hFUlenk2HWG8MFJk7TCouZJTi3xStZ8"></script>
  <script type="text/javascript" src="js/jquery.inview.min.js"></script>
  <script type="text/javascript" src="js/wow.min.js"></script>
  <script type="text/javascript" src="js/mousescroll.js"></script>
  <script type="text/javascript" src="js/smoothscroll.js"></script>
  <script type="text/javascript" src="js/jquery.countTo.js"></script>
  <script type="text/javascript" src="js/lightbox.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>

</body>
</html>
