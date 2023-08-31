<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 18MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 18MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 18MAI23

     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 18MAI23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 13JUN23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645  */


/* ### INICIO DE ARQUIVO PARA O PINHELLI PNEUS - PÁGINA INDEX ###  */
require 'Utilidades/conexao.php';

    
    $dt     = Date('Y');  // PEGANDO A DATA ATUAL NO SERVIDOR //
    
?>  
<!DOCTYPE html>
<html>
      <head>
        <title>Pinhelli Pneus</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="Content-Language" content="pt-br,en,fr">
        <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700,900" rel="stylesheet">
        <link rel="stylesheet" href="fonts/icomoon/style.css">
        <!-- FAVICON -->
        <link rel="icon" type="image/png" href="img/fvicon.png">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/magnific-popup.css">
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <link rel="stylesheet" href="css/owl.theme.default.min.css">

        <link rel="stylesheet" href="css/bootstrap-datepicker.css">

        <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

        <link rel="stylesheet" href="css/aos.css">
        <link rel="stylesheet" href="css/fancybox.min.css">

        <link rel="stylesheet" href="css/style.css">
<script>
// ## ROTINA JQUERY PARA BOTAO DE ENTRADA ## // 
      document.addEventListener("keypress",function(e){if(e.key === 'Enter'){var btn = document.querySelector("#submit");btn.click();}});

</script>
      </head>
 <body onload="load_tela()">
  

      <div class="site-wrap">

      <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>

      <header class="header-bar d-flex d-lg-block align-items-center" data-aos="fade-left">
        <div class="site-logo">
          <a href="http://www.difranconaweb.com.br/Pinhelli/index.php">PINHELLI PNEUS SUSPENSÃO</a>
        </div>
        
        <div class="d-inline-block d-xl-none ml-md-0 ml-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

        <div class="main-menu">
          <ul class="js-clone-nav">
            

          </ul>
          <ul class="social js-clone-nav">
            <!--li><a><span class="icon-facebook"></span></a></li>
            <li><a><span class="icon-twitter"></span></a></li>
            <li><a><span class="icon-instagram"></span></a></li-->
          </ul>
        </div>
      </header> 
      <main class="main-content">
        <div class="container-fluid photos">
          <div class="row justify-content-center">
            
            <div class="col-md-6 pt-4"  data-aos="fade-up">
              <h2 class="text-white mb-4">Entrar no Sistema</h2>

              <div class="row">
                <div class="col-md-12">
                               

                  <div class="row">
                    <div class="col-md-12">
                      <form name="login" id="login" method="get" action="">
                          
                            <div class="row form-group">
                              <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-white" for="nome">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control">
                              </div>
                            </div>

                            <div class="row form-group">
                              
                              <div class="col-md-6">
                                <label class="text-white" for="senha">Senha</label> 
                                <input type="password" name="senha" id="senha" class="form-control">
                              </div>
                            </div>

                            <div class="row form-group">
                              <div class="col-md-12">
                                <input type="button" name="submit" id="submit" value="Entrar" class="btn btn-primary btn-md text-white" onclick="log()">
                              </div>
                              <span id="confirmacao"></span>
                              <span id="excessao"></span>
                            </div>
                      </form>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

    </div> <!-- .site-wrap -->
      <!--  JAVASCRIPT  -->
      <script src="js/script.js"></script>
      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/jquery-migrate-3.0.1.min.js"></script>
      <script src="js/jquery-ui.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/owl.carousel.min.js"></script>
      <script src="js/jquery.stellar.min.js"></script>
      <script src="js/jquery.countdown.min.js"></script>
      <script src="js/jquery.magnific-popup.min.js"></script>
      <script src="js/bootstrap-datepicker.min.js"></script>
      <script src="js/aos.js"></script>

      <script src="js/jquery.fancybox.min.js"></script>

      <script src="js/main.js"></script>
    
  </body>
</html>