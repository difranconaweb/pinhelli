<?php 
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 22MAI23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 29MAI23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 07JUN23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645

     ARQUIVO PARA REGISTRO DE MERCADORIAS */

     
     session_start();
     $usuario = $_SESSION['usuario'];  // VARIÁVEL DE SESSÃO, QUE VEM COM O NOME DO USUÁRIO LOGADO //


     require "Utilidades/conexao.php";

     if(empty($usuario))
     {
          header('location:http://www.difranconaweb.com.br/pinhelli/index.php');
     }

     else
     {// BLOCO PARA CARREGAR O FRONT COM O ÚLTIMO REGISTRO //

       // VERIFICA SE HÁ CARGA NO CAMPO DE PESQUISA //
            $obj = mysql_query("SELECT ponPesquisa FROM ponteiro WHERE ponResponsavel LIKE '$usuario'");
            while($_obj = mysql_fetch_array($obj))
            {
                 $objPesquisa = $_obj['ponPesquisa'];
            }

            // ## LIMPA O CAMPO DE PESQUISA ## //
            mysql_query("UPDATE ponteiro SET ponPesquisa = '' WHERE ponResponsavel LIKE '$usuario'");

            if(empty($objPesquisa))
            {// SE A PESQUISA VIER VÁZIA; ENTRA NESTE BLOCO //
                   $st = mysql_query("SELECT merCodigo, merCodigoProduto, merMarca, merMercadoria, merQuantidade, merCompra, merFrete, merEncargos, merPercentual, merVenda, merPrecoVendaUnid, merPrecoCompraUnid, merLucroFinal, merGrupo, gruNome FROM mercadorias LEFT JOIN grupo ON mercadorias.merGrupo = grupo.gruCodigo WHERE merExcluir = 0");
                   while($mer = mysql_fetch_array($st))
                   {
                       $id            = $mer['merCodigo'];
                       $codigoProduto = $mer['merCodigoProduto'];
                       $marca         = $mer['merMarca'];
                       $mercadoria    = $mer['merMercadoria'];
                       $quantidade    = $mer['merQuantidade'];
                       $nome_grupo    = utf8_encode($mer['gruNome']);
                       $compra        = $mer['merCompra'];
                       $frete         = $mer['merFrete'];
                       $encargos      = $mer['merEncargos'];
                       $percentual    = $mer['merPercentual'];
                       $venda         = $mer['merVenda'];
                       $vendaUnit     = $mer['merPrecoVendaUnid'];
                       $compraUnit    = $mer['merPrecoCompraUnid'];
                       $lucroFinal    = $mer['merLucroFinal'];
                       $fornecedor    = $mer['merFornecedor'];
                       $dataCompra    = $mer['merData'];
                    }
            }

            else
            {
                   $st = mysql_query("SELECT merCodigo, merCodigoProduto, merMarca, merMercadoria, merQuantidade, merCompra, merFrete, merEncargos, merPercentual, merVenda, merPrecoVendaUnid, merPrecoCompraUnid, merLucroFinal, merGrupo, gruNome FROM mercadorias LEFT JOIN grupo ON mercadorias.merGrupo = grupo.gruCodigo WHERE merExcluir = 0 AND merCodigo = '$objPesquisa'");
                   while($mer = mysql_fetch_array($st))
                   {
                       $id            = $mer['merCodigo'];
                       $codigoProduto = $mer['merCodigoProduto'];
                       $marca         = $mer['merMarca'];
                       $mercadoria    = $mer['merMercadoria'];
                       $quantidade    = $mer['merQuantidade'];
                       $nome_grupo    = utf8_encode($mer['gruNome']);
                       $compra        = $mer['merCompra'];
                       $frete         = $mer['merFrete'];
                       $encargos      = $mer['merEncargos'];
                       $percentual    = $mer['merPercentual'];
                       $venda         = $mer['merVenda'];
                       $vendaUnit     = $mer['merPrecoVendaUnid'];
                       $compraUnit    = $mer['merPrecoCompraUnid'];
                       $lucroFinal    = $mer['merLucroFinal'];
                       $fornecedor    = $mer['merFornecedor'];
                       $dataCompra    = $mer['merData'];
                    }
            }           
     }
?> 
<!-- ## INICIO DE PÁGINA PARA CADASTRO DE MERCADORIA ##  -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php print  $usuario;  ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="difranconaweb.">
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



<!--  ###   ROTINA JAVASCRIPT  ###  -->
<script>


</script>



<style>
/*  CLASSE DE ESTILO E EXCESSAO PARA VALIDAÇÃO   */


/* ###  ATENÇÃO / ATENÇÃO / ATENÇÃO - USAR ESTA CSS CASO NÃO DE CERTO NA QUE ESTÁ ATIVA ####  */
/*.excessao_pesquisa{position:absolute;width:100%;height:70%;top:10%;left:00%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:02;overflow:auto;}
body .excessao_pesquisa   {background-color:#BEBEBE;}*/

.excessao-criar-grupo {position:absolute;height:25%;width:70%;top:40%;left:15%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:01;}
body .excessao-criar-grupo{background-color:#BEBEBE;}

.excessao-confirmacao {position:absolute;height:10%;width:70%;top:40%;left:15%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:01;}
body .excessao-confirmacao{background-color:#7FFFD4;}

.excessao-direcionar {position:absolute;height:23%;width:100%;top:40%;left:15%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:01;}
body .excessao-direcionar{background-color:#BEBEBE;}

.excessao-exclusao   {position:absolute; height:20%;width:90%; top:40%;left:05%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:01;}
body .excessao-exclusao{background-color:#FA8072;}

.excessao-placa {position:absolute;height:25%;width:100%;top:40%;left:15%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:01;}
body .excessao-placa{background-color:#BEBEBE;}

.excessao-validacao   {position:absolute; height:10%;width:70%; top:40%;left:15%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:01;}
body .excessao-validacao{background-color:#FA8072;}

.ex_gravar     {color:#FF0000;}
.confirmacao   {color:#0000FF;}
.linha         {background-color:#FFFFFF;}/* ESTA CLASSE DÁ A COR BRANCA DE FUNDO PARA O INPUT DA CAIXA DO GRUPO */
input.placaExt {background-color:#FFFFFF;}/* FUNDO PARA CAMPO DE PLACA EM POP UP PLACA */

.doc{position:absolute;width:90%;height:10%;top:30%;left:20%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:02;}
body .doc{background-color:#FF0000;}


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
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .1em; }

</style>


  </head>
  <body onload="load_mercadorias()">
  

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
        <li><a href="http://www.difranconaweb.com.br/pinhelli/menu/pedido_ponteiro.php">pedidos</a></li>
        <li><a href="http://www.difranconaweb.com.br/pinhelli/ponteiro.php?sender=6">orçamentos</a></li>
        <li><a href="#">admin</a></li>
        <li><a href="http://www.difranconaweb.com.br/pinhelli/ponteiro.php?sender=9">caixa</a></li>
        <li><a href="http://www.difranconaweb.com.br/pinhelli/ponteiro.php?sender=12">relatório</a></li>
        <li><a href="http://www.difranconaweb.com.br/pinhelli/ponteiro.php?sender=1">voltar</a></li>
        <!--li><a href="photos.php">Fotos</a></li-->
        <!--li><a href="blog.html">Blog</a></li-->
      </ul>
      <ul class="social js-clone-nav">
        <!--li><a href="#"><span class="icon-facebook"></span></a></li>
        <li><a href="#"><span class="icon-twitter"></span></a></li>
        <li><a href="#"><span class="icon-instagram"></span></a></li-->
      </ul>
    </div>
  </header> 

  <main class="main-content">
    <div class="container-fluid photos">
      <div class="row justify-content-center">
        
        <div class="col-md-6 pt-4"  data-aos="fade-up">
          <h2 class="text-white mb-4">FORMULÁRIO MERCADORIAS</h2>
          <input type="hidden" name="user" id="user" value="<?php print $usuario; ?>">

         
           <hr>

              <div class="row">
                <div class="col-md-12">

                <!--  ###  INICIO DE FORMULÁRIO DE CADASTRO DE USUÁRIO  ###  -->
                  <form name="cadastro" id="cadastro" method="get" action="">
                          <span id="confirma"></span>   <!-- SAIDA DE EXCESSAO PARA CONFIRMAÇÃO  -->
                          <span id="excessao"></span>   <!-- SAIDA DE EXCESSAO PARA TODOS OS ERROS DO ARQUIVO  -->
                          <!--  ####  FINAL DE CAIXA DE SAIDA DE EXCEÇÃO   ##### -->


                  <input type="hidden" name="editar_ref" id="editar_ref" value=""><!--  ESTA VARIÁVEL É PARA ENVIAR VALOR À ROTINA DE SALVAR REGISTROS -->
                 <input type="hidden" name="id" id="id" value="<?php print $id; ?>"><!--  ESTA VARIÁVEL É PARA ENVIAR O ID DO REGISTRO -->

                        <div class="row form-group">
                          <div class="col-md-12">
                            <label class="text-white" for="registro">QUANT. MERCADORIA..: &ensp;<?php  $obj =  mysql_query("SELECT merCodigo FROM mercadorias WHERE merExcluir = 0"); 
          $soma =  mysql_num_rows($obj); print $soma;?></label> 
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-md-6 mb-3 mb-md-0">
                            <label class="text-white" for="peca">CÓD. PEÇA</label> 
                            <input type="text" id="codigoPeca" class="form-control" value="<?php print $codigoProduto; ?>">
                          </div>
                          <div class="col-md-6">
                            <label class="text-white" for="marca">MARCA</label> 
                            <input type="text" id="marca" class="form-control" value="<?php print utf8_encode($marca); ?>">
                          </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-white" for="grupo" id="grutxt">GRUPO</label>
                                <input type="text" id="grupotx" class="form-control" value="<?php print $nome_grupo; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="text-white" for="grupo" id="_grutxt">GRUPO</label>
                                <select id="grupo" class="form-control" onChange="group()">
                                   <?php $gr = mysql_query("SELECT 'SELEC', 'SELECIONE' FROM grupo  UNION SELECT gruCodigo, gruNome AS 'SELECIONE' FROM grupo");while($grupo = mysql_fetch_array($gr)){?>
                                   <option value="<?php print $grupo['SELEC'];?>"><?php print utf8_encode($grupo['SELECIONE']); ?></option> <?php  }?>
                                   <option value="0">CRIAR GRUPO</option>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="text-white" for="endereco">DESCRIÇÃO DO PRODUTO</label>
                                <textarea cols="90" rows="2" id="descricao" class="form-control"><?php print utf8_encode($mercadoria); ?></textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label class="text-white" for="quantidade">QUANTIDADE</label>
                                <input type="text" id="quantidade"  class="form-control" value="<?php print $quantidade; ?>" onChange="quantidade_mercadoria()">
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label class="text-white" for="compra">TOTAL COMPRA</label>
                                <input type="text" id="compra" class="form-control" value="<?php print $compra ?>" onBlur="quantidade_da_compra()" onKeyPress="return(MascaraMoeda(this,'.',',',event))">
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label class="text-white" for="frete">FRETE</label>
                                <input type="text" id="frete" class="form-control" value="<?php print $frete; ?>" onBlur="freight()" onKeyPress="return(MascaraMoeda(this,'.',',',event))">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-4 mb-3 mb-md-0">
                                  <label class="text-white" for="encargos">ENCARGO</label>
                                  <input type="text" id="encargos" class="form-control" value="<?php print $encargos; ?>" onBlur="tributos()" onKeyPress="return(MascaraMoeda(this,'.',',',event))">
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                  <label class="text-white" for="lucro">LUCRO</label>
                                  <input type="text" id="lucro"  class="form-control" value="<?php print $percentual; ?>" onBlur="lucro_percentual()">
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label class="text-white" for="celular">PREÇO COMP UN.</label>
                                <input type="text" id="compraUnidade" class="form-control" value="<?php print $compraUnit; ?>">
                            </div>
                        </div>

                        <div class="row form-group">
                          
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label class="text-white" for="telefone">PREÇO VENDA UN.</label>
                                <input type="text" id="vendaUnidade" class="form-control" value="<?php print $vendaUnit; ?>">
                            </div>
                             <div class="col-md-4 mb-3 mb-md-0">
                                <label class="text-white" for="celular">PREÇO TOTAL</label>
                                <input type="text" id="precoTotal" class="form-control" value="<?php print $venda; ?>">
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label class="text-white" for="celular">LUCRO FINAL</label>
                                <input type="text" id="lucroFinal" class="form-control" value="<?php print $lucroFinal; ?>">
                            </div>
                        </div>
<!-- ####  FINAL DE FOMULÁRIO DE CADASTRO DE MERCADORIA #### -->


                        <ul class="copyright">
                           <li>&copy;<?php print Date('Y') ?>. PINHELLI PNEUS SUSPENSÃO -  Mercadorias.</li>
                        </ul></br>

                        <div class="row form-group">
                          <div class="col-md-12">
                            <input type="button" id="mer_gravar" value="Gravar" class="btn btn-primary btn-md text-white"  onclick="salvar_mercadoria()"/>
                            <input type="button" id="mer_novo" value="Novo" class="btn btn-primary btn-md text-white"  onclick="nova_mercadoria()"/>
                            <input type="button" id="mer_editar" value="Alterar" class="btn btn-primary btn-md text-white"  onclick="editar_mercadoria()"/></br></br>
                            <input type="button" id="mer_excluir" value="Excluir" class="btn btn-primary btn-md text-white" onclick="excluir_mercadoria()"/>
                            <input type="button" id="mer_cancelar" value="Cancelar" class="btn btn-primary btn-md text-white" onclick="cancelar_mercadoria()"/>
                          </div>
                        </div>
                   </form>
                 <!-- ###   FINAL DE FORMULÁRIO DE CADASTRO DE USUÁRIO  ###  -->
                  
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
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
      </p>
        </div>
      </div-->
    </div>
  </main>

</div> <!-- .site-wrap -->
  <!--  JAVASCRIPT  -->
  <script src="cadastro/js/script.js"></script>
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