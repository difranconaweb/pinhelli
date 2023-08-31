<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 14AGO23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 14AGO23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 14AGO23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 14AGO23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645 */

// ### INICIO DE ARQUIVO DE CORREÇÃO DE PEDIDO ###  //
     session_start();
     $usuario = $_SESSION['usuario']; // NOME DE USUÁRIO ENVIADO PELA SESSÃO //
     $Data    = date('d/m/Y'); // PEGA A DATA NO SERVIDOR //

     require 'Utilidades/conexao.php';

     if(empty($usuario))
     {
          header('Location:http://www.difranconaweb.com.br/pinhelli/index.php');
     }

     else
     {
      // ## ESTA QUERY, VEM PARA CARREGAR A TELA  ## //
            $sql = mysql_query("SELECT ponPesquisa FROM ponteiro WHERE ponResponsavel LIKE '$usuario'");
            while($obj = mysql_fetch_array($sql))
            {
               $codigo = $obj['ponPesquisa']; // CARREGA AQUI O NÚMERO DO PEDIDO A SER CORRIGIDO //
            }

            // CARREGA AGORA O PEDIDO COM O VALOR //
            $pes = mysql_query("SELECT pedValor, pedDesconto FROM pedidos WHERE pedCodigo = '$codigo'");
            while($p3s = mysql_fetch_array($pes))
            {
                $valor    = $p3s['pedValor'];
                $desconto = $p3s['pedDesconto'];
            }
     }
?>  


<!-- ROTINA DE CORREÇÃO DE PEDIDO - PRIMEIRA PÁGINA  -->    
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php print  $usuario;  ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="difranconaweb">
    <meta name="keywords" content="pinhelli pneus suspensao">
    <meta name="author" content="Franco V. Morales">
    
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="img/fevico.png">
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
    <!-- IMPORTANTO SCRIPT JQUERY PARA CEP -->



<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
 // ## FUNÇÃO PARA SALVAR VALOR DO PEDIDO QUE DEVE SER CORRIGIDA ## //
   function salvar_valor()
   {
       var desconto  = document.getElementById('novo_desconto').value;
       var valor     = document.getElementById('novo_valor').value;
       var pedido    = document.getElementById('pedCodigo').value;

       // ENVIA OS NOVOS VALORES //
       window.location.href="http://www.difranconaweb.com.br/pinhelli/pedidos/salvar_valor.php?pedido="+escape(pedido)+"&desconto="+escape(desconto)+"&valor="+escape(valor);
   }
 // ## FINAL DE FUNÇÃO DE CORREÇÃO DE VALOR DE PEDIDO ## //

</script> 
<!--  ####    ESTILO PARA PÁGINA DE CORREÇÃO DE PEDIDO  ###  -->
<style type="text/css">
#gridPed {padding: 5px; text-align: center; background-color: #FF0000; border: solid 1px #c3c3c3;}
#panel {padding: 5px; display: none; background-color: #e5eecc; border: solid 1px #c3c3c3; width:100%; height:100%;}


.excessao-validacao   {position:absolute;width:100%;height:15%;top:50%;left:00%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:02;color:#0000FF;}
body .excessao-validacao  {background-color:#BEBEBE;}

.excessao-erro   {position:absolute;width:100%;height:15%;top:50%;left:00%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:02;color:#B22222;}
body .excessao-erro  {background-color:#BEBEBE;}

.confirmacao    {color:#0000FF;}
.exception      {color:#FF0000;}
.ex_gravar      {color:#FF0000;}
.fundo          {background-color:#FFFFFF;}



table, th, td {width:10px; border: 1px solid black;}
table {margin-left: auto; margin-right: auto; width:100%;}



.btn {
  border-radius: 30px; }
  .btn:hover, .btn:active, .btn:focus {
    outline: none;
    -webkit-box-shadow: none !important;
    box-shadow: none !important; }
  .btn.btn-black {
    color: #fff;
    background-color: #000; }
  .btn.btn-blackRed {
    color: #fff;
    background-color: #8B0000; }
  .btn.btn-green {
    color: #fff;
    background-color: #006400; }
    .btn.btn-black:hover {
      color: #000;
      background-color: #fff; }
    .btn.btn-green:hover {
      color: #7fff00;
      background-color: #006400; }
  .btn.btn-outline-white {
    border: 2px solid #fff; }
    .btn.btn-outline-white:hover {
      background: #fff;
      color: #ef6c57 !important; }
  .btn.btn-md {
    padding: 15px 30px;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: .1em; }

</style>


</head>
  <body onload="load_caixa()">
  

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
      <a>PINHELLI PNEUS SUSPENSÃO</a>
    </div>
    
    <div class="d-inline-block d-xl-none ml-md-0 ml-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

    <div class="main-menu">
      <ul class="js-clone-nav">
        <li><a href="http://www.difranconaweb.com.br/pinhelli/ponteiro.php?sender=2">cliente</a></li>
        <li><a href="http://www.difranconaweb.com.br/pinhelli/ponteiro.php?sender=3">fornecedor</a></li>
        <li><a href="http://www.difranconaweb.com.br/pinhelli/ponteiro.php?sender=4">mercadorias</a></li>
        <li><a href="http://www.difranconaweb.com.br/pinhelli/menu/pedido_ponteiro.php">pedidos</a></li>
        <li><a href="http://www.difranconaweb.com.br/pinhelli/ponteiro.php?sender=6">orçamentos</a></li>
        <li><a href="#">admin</a></li>
        <li><a href="http://www.difranconaweb.com.br/pinhelli/ponteiro.php?sender=13">relatório</a></li>
        <li><a href="http://www.difranconaweb.com.br/pinhelli/ponteiro.php?sender=1">voltar</a></li>
        <!--li><a href="photos.php">Fotos</a></li-->
        <!--li><a href="blog.html">Blog</a></li-->
      </ul>
      <ul class="social js-clone-nav">
         <!-- SAIDA DE EXCESSAO PARA CONFIRMAÇÃO  -->
        <!--li><a href="#"><span class="icon-facebook"></span></a></li>
        <li><a href="#"><span class="icon-twitter"></span></a></li>
        <li><a href="#"><span class="icon-instagram"></span></a></li-->
      </ul>

<!-- ## INICIO DE FORMULÁRIO DE CORREÇÃO DE PEDIDO ## -->
    </div>
  </header> 


  <main class="main-content">
    <div class="container-fluid photos">
      <div class="row justify-content-center">
        
        <div class="col-md-6 pt-4"  data-aos="fade-up">
          <h2 class="text-white mb-4">CORRETOR PEDIDO</h2>

              <div class="row">
                <div class="col-md-12">

                          <span id="confirma"></span>   <!-- SAIDA DE EXCESSAO PARA CONFIRMAÇÃO  -->
                          <span id="excessao"></span>   <!-- SAIDA DE EXCESSAO PARA TODOS OS ERROS DO ARQUIVO  -->
                          <!--  ####  FINAL DE CORREÇÃO DE PEDIDO / EXCEÇÃO   ##### -->


                      <!-- ### COLEÇÃO DE VARIÁVEIS OCULTAS  ###  -->

                       <input type="hidden" name="usuario" id="usuario" value="<?php  print $usuario; ?>"><!-- VARIÁVEL OCULTA PRA ENVIAR O NOME DO RESPONSAVEL  -->
                       <input type="hidden" name="pedCodigo" id="pedCodigo" value="<?php  print $codigo; ?>"><!--  ESTA VARIÁVEL É PARA ENVIAR O CÓDIGO DO PEDIDO -->

              <!-- ### FINAL DE COLEÇÃO DE VARIÁVEIS OCULTAS ####  -->
                


                        <!-- ### CAMPO DE PESQUISA  ###  -->
                        <div class="row form-group">
                          <!-- ### INSERINDO DATA  ###  -->
                          <div class="col-md-6">
                            <label class="text-white" for="registro"><strong>DATA DE HOJE..: </strong>&ensp;<?php print $Data;  ?></label> 
                          </div>
                        </div>
                        <!-- ### FINAL DE DATA  ###  -->

                        
                        <a>##################################################</a>
                        <!-- ###   INICIO DE FORMULÁRIO  #### -->
                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-white" for="entrada"><strong>DESCONTO</strong></label>
                                <input type="text" name="desconto" id="desconto" class="form-control" value="<?php print $desconto; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="text-white" for="valorDesconto"><strong>NOVO DESCONTO</strong></label>
                                <input type="text" name="novo_desconto" id="novo_desconto" class="form-control" onKeyPress="return(MascaraMoeda(this,'.',',',event))">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-white" for="valor"><strong>VALOR</strong></label>
                                <input type="text" id="valor" class="form-control" value="<?php print $valor;  ?>" >
                            </div>
                            <div class="col-md-6">
                                <label class="text-white" for="novoValor"><strong>NOVO VALOR</strong></label>
                                <input type="text" name="novo_valor" id="novo_valor" class="form-control" onKeyPress="return(MascaraMoeda(this,'.',',',event))">
                            </div>
                        </div>
                       
<!--  ###  FIM DE FORMULÁRIO  ## -->

                           <!--a>##################################################</a-->
                        
                        </div>
<!-- ### FINAL DE VALOR DE PEDIDO  ###  -->

                           <a>###################################################</a>


                        <ul class="copyright">
                           <li>&copy;<?php print Date('Y') ?>. PINHELLI PNEUS SUSPENSÃO -  Corretor.</li>
                        </ul></br>

                        <div class="row form-group">
                          <div class="col-md-12">
                            <input type="button" id="salvar" value="Gravar" class="btn btn-primary btn-md text-white"  onclick="salvar_valor()"/>
                            <input type="button" id="cancel" value="Cancelar" class="btn btn-primary btn-md text-white" onclick="cancelar()"/>
                          </div>
                        </div>
                 <!-- ###   FINAL DE FORMULÁRIO DE CORREÇÃO DE PEDIDO  ###  -->
                  
                </div>
                
              </div>
            <!--/div-->
          </div>
        </div>

      </div>

      <!--div class="row justify-content-center">
        <div class="col-md-12 text-center py-5">
          <p>
        <Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
       <!-- Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos os direitos reservados | Site desenvolvido por DiFranconaWeb  para <a href="http://www.difranconaweb.com.br" target="_blank" >Auto Eletrica e Mecanica Fernandes - Versão 1.5</a-->
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. >
      </p>
        </div>
      </div-->
    </div>
  </main>

</div> <!-- .site-wrap -->
  <!--  JAVASCRIPT  -->
  <script src="caixa/js/script.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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