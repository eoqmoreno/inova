<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Inova Utilidades">
  <title>Inova Utilidades</title>
  <link href="<?php echo URLPos::getURLDirRoot(); ?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo URLPos::getURLDirRoot(); ?>css/animate.min.css" rel="stylesheet">
  <link href="<?php echo URLPos::getURLDirRoot(); ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo URLPos::getURLDirRoot(); ?>css/lightbox.css" rel="stylesheet">
  <link href="<?php echo URLPos::getURLDirRoot(); ?>css/main.css" rel="stylesheet">
  <link id="css-preset" href="<?php echo URLPos::getURLDirRoot(); ?>css/presets/preset1.css" rel="stylesheet">
  <link href="<?php echo URLPos::getURLDirRoot(); ?>css/responsive.css" rel="stylesheet">


  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="images/favicon.ico">
</head><!--/head-->

<!--.preloader-->
<div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
<!--/.preloader-->

<body>
<?php
$sectAdm = new HTMLSection(array('pager_one'));
?>

  <footer id="footer">
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <p>&copy; Inova Utilidades</p>
          </div>
          <div class="col-sm-6">
            <p class="pull-right"><a target="_blank" href="http://jeimison.me.pn/">Jeimison M. Lima</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>

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

</body>
</html>