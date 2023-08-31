<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

  
     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA  22MAI23 - RES000101/13BR
                                                                    (19)3017-3460
                                                                    (19)99272-0159
                                                                    (19)99751-7645


     PÁGINA  PARA REGISTRAR NOVO CLIENTE - ELETRICA FERNANDES  */
     session_start();
     $usuario = $_SESSION['usuario'];
     $data = Date('d/m/Y');  // CARREGA A DATA
     $hora = Date('H:i:s');  // CARREGA A HORA

     require 'Utilidades/conexao.php';
     
     if(empty($usuario))
     {
          header('location:http://www.difranconaweb.com.br/pinhelli/index.php');
     }

     else
     {
          // VERIFICA SE HÁ CARGA NO CAMPO DE PESQUISA //
            $obji = mysql_query("SELECT ponPesquisa FROM ponteiro WHERE ponResponsavel LIKE '$usuario'");
            while($_obj = mysql_fetch_array($obji))
            {
                $objPesquisa = $_obj['ponPesquisa'];
            }

            // ## LIMPA O CAMPO DE PESQUISA ## //
            mysql_query("UPDATE ponteiro SET ponPesquisa = '' WHERE ponResponsavel LIKE '$usuario'");

            if(empty($objPesquisa))
            {
                 $sql = mysql_query("SELECT * FROM clientes WHERE cliExcluir  = 0");
                  while($obj = mysql_fetch_array($sql))
                  {// QUERY PARA CARREGAR NA TELA O ULTIMO REGISTRO  //
                        $codigo     = $obj['cliCodigo'];
                        $nome       = $obj['cliNome'];
                        $cep        = $obj['cliCep'];
                        $endereco   = $obj['cliEndereco'];
                        $numero     = $obj['cliNumero'];
                        $bairro     = $obj['cliBairro'];
                        $cidade     = $obj['cliCidade'];
                        $telefone   = $obj['cliTelefone'];
                        $celular    = $obj['cliCelular'];
                        $nascimento = $obj['cliDataNasc'];
                        $cpf        = $obj['cliCPF'];
                        $rg         = $obj['cliRG'];
                        $cnpj       = $obj['cliCNPJ'];
                        $inscricao  = $obj['cliInscricao'];
                        $email      = $obj['cliEmail'];
                        $veiculo    = $obj['cliVeiculo'];
                        $marca      = $obj['cliMarca'];
                        $placa      = $obj['cliPlaca'];
                        $ano        = $obj['cliAno'];
                  }
            }

            else
            {
                  $sql = mysql_query("SELECT * FROM  clientes WHERE cliCodigo = '$objPesquisa' AND cliExcluir = 0");
                  while($obj = mysql_fetch_array($sql))
                  {// QUERY PARA CARREGAR NA TELA NO REGISTRO PESQUISADO  //
                        $codigo     = $obj['cliCodigo'];
                        $nome       = $obj['cliNome'];
                        $cep        = $obj['cliCep'];
                        $endereco   = $obj['cliEndereco'];
                        $numero     = $obj['cliNumero'];
                        $bairro     = $obj['cliBairro'];
                        $cidade     = $obj['cliCidade'];
                        $telefone   = $obj['cliTelefone'];
                        $celular    = $obj['cliCelular'];
                        $nascimento = $obj['cliDataNasc'];
                        $cpf        = $obj['cliCPF'];
                        $rg         = $obj['cliRG'];
                        $cnpj       = $obj['cliCNPJ'];
                        $inscricao  = $obj['cliInscricao'];
                        $email      = $obj['cliEmail'];
                        $veiculo    = $obj['cliVeiculo'];
                        $marca      = $obj['cliMarca'];
                        $placa      = $obj['cliPlaca'];
                        $ano        = $obj['cliAno'];
                  }
            }

            // ## ROTINA PARA VERIFICAR QUAL VARIÁVEL DOCUMENTO ESTÁ CARREGADA ## //
            if(empty($cpf))
            {// SE A VARIÁVEL CPF ESTIVER VÁZIA, CARREGA O CNPJ
                $geralDoc = $cnpj;
            }

            else
            {// ## SENÃO CARREGA O CPF ## //
                $geralDoc = $cpf;
            }


            if(empty($rg))
            {// SE A VARIÁVEL RG ESTIVER VÁZIA, CARREGA INSCRICAO //
                $rg_insc = $inscricao;
            }

            else
            {
                $rg_insc = $rg;
            }
            // ## FINAL DE VERIFICAÇÃO DCUMENTO ## //
     }
?>
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



<!--  ###   ROTINA PARA CEP E ENDEREÇO DINAMICO  ###  -->
<script>/*$(document).ready(function() {function limpa_formulário_cep(){$("#endereco").val("");}$("#cep").blur(function(){var cep = $(this).val().replace(/\D/g, '');if (cep != ""){var validacep = /^[0-9]{8}$/;if(validacep.test(cep)){$("#endereco").val("...");$("#cidade").val("...");$("#estado").val("...");$.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados){if (!("erro" in dados)){$("#endereco").val(dados.logradouro);$("#cidade").val(dados.localidade);$("#estado").val(dados.uf);}else{limpa_formulário_cep();alert("CEP NÃO ENCONTRADO!");}});}else{limpa_formulário_cep();alert("FORMATO DE CEP INVÁLIDO!");}}else{limpa_formulário_cep();}});});*/
$(document).ready(function(){function limpa_formulario_cep(){/* Limpa valores do formulário de cep.*/$("#endereco").val("");$("#bairro").val("");$("#cidade");}/*Quando o campo cep perde o foco.*/$("#cep").blur(function(){
/*/Nova variável "cep" somente com dígitos*/var cep = $(this).val().replace(/\D/g, '');/*Verifica se campo cep possui valor informado.*/if (cep != ""){/*Expressão regular para validar o CEP.*/var validacep = /^[0-9]{8}$/;/*Valida o formato do CEP.*/if(validacep.test(cep)){/*Preenche os campos com "..." enquanto consulta webservice.*/$("#endereco").val("...");$("#bairro").val("...");
$("#cidade").val("...");/*Consulta o webservice viacep.com.br*/$.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados){if (!("erro" in dados)){/*Atualiza os campos com os valores da consulta.*/$("#endereco").val(dados.logradouro);$("#bairro").val(dados.bairro);$("#cidade").val(dados.localidade);} /*end if.*/else{/*CEP pesquisado não foi encontrado.*/limpa_formulário_cep();alert("CEP NÃO ENCONTRADO!");}});} /*end if.*/else{/*cep é inválido.*/limpa_formulário_cep();alert("FORMATO DE CEP INVÁLIDO!");}} /*end if.*/else{/*cep sem valor, limpa formulário.*/limpa_formulário_cep();}document.getElementById('numero').focus();  // APÓS SAIR DO CAMPO CEP, PREENCHE TODOS OS CAMPOS E ENTRA NO CAMPO NÚMERO //
document.getElementById('numero').style.background = "#D3D3D3";});});


//   https://sweetalert.js.org/guides/


</script>



<style>
/*  CLASSE DE ESTILO E EXCESSAO PARA VALIDAÇÃO   */
.excessao-criar-grupo {position:absolute;height:25%;width:70%;top:40%;left:15%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:01;}
body .excessao-criar-grupo{background-color:#BEBEBE;}

.excessao-confirmacao {position:absolute;height:10%;width:70%;top:40%;left:15%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:01;}
body .excessao-confirmacao{background-color:#7FFFD4;}

.excessao-direcionar {position:absolute;height:23%;width:100%;top:40%;left:15%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:01;}
body .excessao-direcionar{background-color:#BEBEBE;}

.excessao-exclusao   {position:absolute; height:20%;width:90%; top:40%;left:05%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:01;}
body .excessao-exclusao{background-color:#FA8072;}

.excessao-placa {position:absolute;height:25%;width:100%;top:40%;left:00%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:01;}
body .excessao-placa{background-color:#BEBEBE;}

.excessao-validacao   {position:absolute; height:10%;width:70%; top:40%;left:15%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:01;}
body .excessao-validacao{background-color:#FA8072;}

.ex_gravar     {color:#FF0000;}
.confirmacao   {color:#0000FF;}
.linha         {background-color:#FFFFFF;}/* ESTA CLASSE DÁ A COR BRANCA DE FUNDO PARA O INPUT DA CAIXA DO GRUPO */
input.placaExt {background-color:#FFFFFF;}/* FUNDO PARA CAMPO DE PLACA EM POP UP PLACA */

.doc{position:absolute;width:90%;height:10%;top:30%;left:00%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:02;}
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
  <body onload="load_cliente()">
  

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
        <li><a href="http://www.difranconaweb.com.br/pinhelli/ponteiro.php?sender=3">fornecedor</a></li>
        <li><a href="http://www.difranconaweb.com.br/Ppinhelli/ponteiro.php?sender=4">mercadoria</a></li>
        <li><a href="http://www.difranconaweb.com.br/pinhelli/menu/pedido_ponteiro.php">pedidos</a></li>
        <li><a href="http://www.difranconaweb.com.br/pinhelli/ponteiro.php?sender=6">orçamentos</a></li>
        <li><a href="#">admin</a></li>
        <li><a href="http://www.difranconaweb.com.br/pinhelli/ponteiro.php?sender=9">caixa</a></li>
        <li><a href="http://www.difranconaweb.com.br/pinhelli/ponteiro.php?sender=10">relatório</a></li>
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
          <h2 class="text-white mb-4">FORMULÁRIO CLIENTES</h2>
           <hr>

              <div class="row">
                <div class="col-md-12">

                <!--  ###  INICIO DE FORMULÁRIO DE CADASTRO DE USUÁRIO  ###  -->
                  <form name="cadastro" id="cadastro" method="get" action="">
                          <span id="confirma"></span>   <!-- SAIDA DE EXCESSAO PARA CONFIRMAÇÃO  -->
                          <span id="excessao"></span>   <!-- SAIDA DE EXCESSAO PARA TODOS OS ERROS DO ARQUIVO  -->
                          <!--  ####  FINAL DE CAIXA DE SAIDA DE EXCEÇÃO   ##### -->


                  <input type="hidden" name="editar_ref" id="editar_ref" value=""><!--  ESTA VARIÁVEL É PARA ENVIAR VALOR À ROTINA DE SALVAR REGISTROS -->
                  <input type="hidden" name="cliCodigo" id="cliCodigo" value="<?php  print $codigo; ?>"><!--  ESTA VARIÁVEL É PARA ENVIAR O CÓDIGO DO CLIENTE -->
                  <input type="hidden" name="user" id="user" value="<?php  print $usuario; ?>"><!--  ESTA VARIÁVEL É PARA ENVIAR O NOME DO USUÁRIO -->

                        <div class="row form-group">
                          <div class="col-md-12">
                            <label class="text-white" for="registro">REGISTRO..: <?php print $codigo; ?></label> 
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-md-6 mb-3 mb-md-0">
                            <label class="text-white" for="Nome">PERFIL</label> 
                            <select name="tipo" id="tipo" onChange="chave_documento()"> 
                                  <option value="selecionar">-- Selec. Documento --</option>
                                  <option value="J">-- Pessoa Jurídica --</option>
                                  <option value="F">-- Pessoa Física --</option>
                            </select>
                          </div>
                          <div class="col-md-6 mb-3 mb-md-0">
                            <label class="text-white" for="Nome">NOME</label> 
                            <input type="text" id="nome" class="form-control" value="<?php print utf8_encode($nome) ?>">
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col-md-12">
                            <label class="text-white" for="email">E-MAIL</label> 
                            <input type="email" id="email" class="form-control" value="<?php print $email ?>">
                          </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-white" for="nascimento">Data Nascimento</label>
                                <input type="date" id="nascimento" class="form-control" value="<?php print $nascimento ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="text-white" for="cep">CEP</label>
                                <input type="text" id="cep" size="09" maxlength="09" class="form-control" value="<?php print $cep ?>">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-white" for="endereco">ENDEREÇO</label>
                                <input type="text" id="endereco" class="form-control" value="<?php print utf8_encode($endereco) ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="text-white" for="numero">NUMERO</label>
                                <input type="text" id="numero"  class="form-control" value="<?php print $numero ?>">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-white" for="bairro">BAIRRO</label>
                                <input type="text" id="bairro" class="form-control" value="<?php print utf8_encode($bairro) ?>">
                            </div>
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-white" for="cidade">CIDADE</label>
                                <input type="text" id="cidade" class="form-control" value="<?php print utf8_encode($cidade)  ?>">
                            </div>
                        </div>
                       
                          
                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-white" for="telefone">TELEFONE</label>
                                <input type="text" id="telefone" size="13" maxlength="13" class="form-control" onkeypress="mascaraTelefone(this,'(##)####-####')" value="<?php print $telefone ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="text-white" for="celular">CELULAR</label>
                                <input type="text" id="celular" size="14" maxlength="14" class="form-control" onkeypress="mascaraCelular(this,'(##)#####-####')" value="<?php print $celular ?>">
                            </div>
                        </div>


                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-white" for="cpf">CPF/CNPJ</label>
                                <input type="text" id="cpf" size="11" maxlength="11" class="form-control" value="<?php print $geralDoc ?>"  onblur="validando()">
                            </div>
                            <div class="col-md-6">
                                <label class="text-white" for="inscricao">RG/INSC. ESTADUAL</label>
                                <input type="text" id="inscricao" size="18" maxlength="18" class="form-control" value="<?php print $rg_insc ?>">
                            </div>
                        </div>   


                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-white" for="veiculo">VEICULO</label>
                                <input type="text" id="veiculo" size="20" maxlength="20" class="form-control" value="<?php print $veiculo ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="text-white" for="marca">MARCA</label>
                                <input type="text" id="marca" size="15" maxlength="15" class="form-control" value="<?php print $marca ?>">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-white" for="placa">PLACA</label>
                                <input type="text" id="placa" size="07" maxlength="07" class="form-control" value="<?php print $placa ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="text-white" for="ano">ANO</label>
                                <input type="text" id="ano" size="04" maxlength="04" class="form-control" value="<?php print $ano ?>">
                            </div>
                        </div>
                        <ul class="copyright">
                           <li>&copy;<?php print Date('Y') ?>. PINHELLI PNEUS SUSPENSÃO -  Clientes.</li>
                        </ul></br>

                        <div class="row form-group">
                          <div class="col-md-12">
                            <input type="button" id="gravar" value="Gravar" class="btn btn-primary btn-md text-white"  onclick="salvar_cliente()"/>
                            <input type="button" id="novo" value="Novo" class="btn btn-primary btn-md text-white"  onclick="novo_cliente()"/>
                            <input type="button" id="alterar" value="Alterar" class="btn btn-primary btn-md text-white"  onclick="editar_cliente()"/></br></br>
                            <input type="button" id="delete" value="Excluir" class="btn btn-primary btn-md text-white" onclick="excluir_cliente()"/>
                            <input type="button" id="cancelar" value="Cancelar" class="btn btn-primary btn-md text-white" onclick="cancelar_cliente()"/>
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