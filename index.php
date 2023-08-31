<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 10JUN23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 10JUN23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 10JUN23
     

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 11JUN23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 15JUN23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 06JUL23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 07JUL23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 11JUL23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 13JUL23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 14JUL23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 15JUL23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 14AGO23   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645
 

    ROTINA DE PEDIDOS - PRIMEIRA PÁGINA  */

     session_start();
     $usuario = $_SESSION['usuario'];  // VARIÁVEL DE SESSÃO, QUE VEM COM O NOME DO USUÁRIO LOGADO //


     require 'Utilidades/conexao.php';


     $Data = Date('d/m/Y');   //  CRIANDO DATA PARA O SISTEMA //

     if(empty($usuario))
     { 
         header('location:http://www.difranconaweb.com.br/pinhelli/index.php');
     }

     else
     {
       //  SE A VARIÁVEL DE SESSÃO USUARIO ESTIVER VÁZIA, ENTÃO NÃO TEM LOG E JOGA PRA FORA DO SISTEMA //

                 
                           $st = mysql_query("SELECT conStatus, conCodigoPedido_fk FROM container_pedido WHERE conResponsavel LIKE '$usuario'"); //  VERIFICA NA TABELA QUAL É O VALOR //
                           while($objSt = mysql_fetch_array($st))
                           {
                               $status = $objSt['conStatus']; // ESTE VALOR DE STATUS DIVIDE AS ESTRUTURAS PARA PODER ASSUMIR O QUE FAZER //
                               $conPedido = $objSt['conCodigoPedido_fk']; // ESTE É O ID DO PEDIDO //
                           }

                           if($status == 0)
                           {//  SE $status  ESTIVER VALENDO ZERO, ENTRA AQUI POR QUE VEIO DO MENU OU DA OPÇÃO DE SALVAR O PEDIDO.... ENTÃO CARREGA O ÚLTIMO PEDIDO FEITO ATUALIZANDO A TELA  //
                                    $sql = mysql_query("SELECT pedCodigo, pedValor, pedDesconto, pedData, pedPedido_fk, cliCodigo, cliNome, cliEndereco, cliNumero, cliCidade, cliTelefone, cliVeiculo, cliPlaca, cliAno FROM pedidos LEFT JOIN clientes ON pedidos.pedCliente_fk = clientes.cliCodigo WHERE pedResponsavel = '$usuario'");  
                                    while($obj = mysql_fetch_array($sql))
                                    {

                                         $codigoCliente   = $obj['cliCodigo'];
                                         $nomeCliente     = $obj['cliNome'];
                                         $enderecoCliente = $obj['cliEndereco'];
                                         $numeroCliente   = $obj['cliNumero'];
                                         $cidadeCliente   = $obj['cliCidade'];
                                         $telefoneCliente = $obj['cliTelefone'];
                                         $veiculoCliente  = $obj['cliVeiculo'];
                                         $placaCliente    = $obj['cliPlaca'];
                                         $anoCliente      = $obj['cliAno'];
                                         $codigoPedido    = $obj['pedCodigo'];
                                         $desconto        = $obj['pedDesconto'];
                                         $totalPedido     = $obj['pedValor'];
                                         $dataPedido      = $obj['pedData'];
                                         $pedEnviado      = $obj['pedPedido_fk'];
                                    }
                           }

                           else if($status == 1)
                           {//  SE $status  ESTIVER VALENDO UM, ENTRA AQUI POR QUE VEIO DO FECHAR_PEDIDO.PHP E CARREGA O ÚLTIMO PEDIDO OU PODE TER VINDO DO DIRECIONAR PEDIDO QUE VEM DO CADASTRO DO CLIENTE  //
                                 $sql = mysql_query("SELECT  pedCodigo, pedCliente_fk, pedValor, pedDesconto, pedData, pedPedido_fk, cliCodigo, cliNome, cliEndereco, cliNumero, cliCidade, cliTelefone, cliVeiculo, cliPlaca, cliAno FROM pedidos LEFT JOIN clientes ON pedidos.pedCliente_fk = clientes.cliCodigo WHERE pedResponsavel = '$usuario'");

                                  while($obj = mysql_fetch_array($sql))
                                  {
                                         $codigoCliente   = $obj['cliCodigo'];
                                         $nomeCliente     = $obj['cliNome'];
                                         $enderecoCliente = $obj['cliEndereco'];
                                         $numeroCliente   = $obj['cliNumero'];
                                         $cidadeCliente   = $obj['cliCidade'];
                                         $telefoneCliente = $obj['cliTelefone'];
                                         $veiculoCliente  = $obj['cliVeiculo'];
                                         $placaCliente    = $obj['cliPlaca'];
                                         $anoCliente      = $obj['cliAno'];
                                         $codigoPedido    = $obj['pedCodigo'];
                                         $desconto        = $obj['pedDesconto'];
                                         $totalPedido     = $obj['pedValor'];
                                         $dataPedido      = $obj['pedData'];
                                         $pedEnviado      = $obj['pedPedido_fk'];
                                  } 
                           }

                           else if($status == 2)
                           {// SE A VARIÁVEL STATUS ESTIVER VALENDO 2, ELA VEIO DO NOVO CLIENTE //
                                $sql = mysql_query("SELECT  pedCodigo, pedCliente_fk, pedValor, pedDesconto, pedData, pedPedido_fk, cliCodigo, cliNome, cliEndereco, cliNumero, cliCidade, cliTelefone, cliVeiculo, cliPlaca, cliAno FROM pedidos LEFT JOIN clientes ON pedidos.pedCliente_fk = clientes.cliCodigo WHERE pedCodigo = '$conPedido'");    
                                while($obj = mysql_fetch_array($sql))
                                {
                                     $codigoCliente   = $obj['cliCodigo'];
                                     $nomeCliente     = $obj['cliNome'];
                                     $enderecoCliente = $obj['cliEndereco'];
                                     $numeroCliente   = $obj['cliNumero'];
                                     $cidadeCliente   = $obj['cliCidade'];
                                     $telefoneCliente = $obj['cliTelefone'];
                                     $veiculoCliente  = $obj['cliVeiculo'];
                                     $placaCliente    = $obj['cliPlaca'];
                                     $anoCliente      = $obj['cliAno'];
                                     $codigoPedido    = $obj['pedCodigo'];
                                     $desconto        = $obj['pedDesconto'];
                                     $totalPedido     = $obj['pedValor'];
                                     $dataPedido      = $obj['pedData'];
                                     $pedEnviado      = $obj['pedPedido_fk']; // ESTE CAMPO É PRA INFORMAR SE O PEDIDO ESTÁ FECHADO OU NÃO! //
                                }
                           }

                           else if($status == 3)
                           {// SE VIER VALENDO 3, ENTÃO PORQUE VEIO DO ALTERAR PEDIDO E NESTE CASO, CARREGA O PEDIDO QUE ESTÁ NA TABELA CONTAINER_PEDIDO //
                                $sql = mysql_query("SELECT  pedCodigo, pedCliente_fk, pedValor, pedDesconto, pedData, pedPedido_fk, cliCodigo, cliNome, cliEndereco, cliNumero, cliCidade, cliTelefone, cliVeiculo, cliPlaca, cliAno FROM pedidos LEFT JOIN clientes ON pedidos.pedCliente_fk = clientes.cliCodigo WHERE pedCodigo = '$conPedido'");

                                  while($obj = mysql_fetch_array($sql))
                                  {
                                         $codigoCliente   = $obj['cliCodigo'];
                                         $nomeCliente     = $obj['cliNome'];
                                         $enderecoCliente = $obj['cliEndereco'];
                                         $numeroCliente   = $obj['cliNumero'];
                                         $cidadeCliente   = $obj['cliCidade'];
                                         $telefoneCliente = $obj['cliTelefone'];
                                         $veiculoCliente  = $obj['cliVeiculo'];
                                         $placaCliente    = $obj['cliPlaca'];
                                         $anoCliente      = $obj['cliAno'];
                                         $codigoPedido    = $obj['pedCodigo'];
                                         $desconto        = $obj['pedDesconto'];
                                         $totalPedido     = $obj['pedValor'];
                                         $dataPedido      = $obj['pedData'];
                                         $pedEnviado      = $obj['pedPedido_fk'];
                                  } 
                           }


                           else
                           {//  SE $status  ESTIVER VALENDO QUATRO, ENTRA AQUI POR QUE VEIO DA PESQUISA DE CLIENTE... ENTAO DEVERÁ CARREGAR NOVO PEDIDO COM CLIENTE OU EM CASO NAO, É PORQUE FOI ABERTO UM NOVO PEDIDO E AINDA NÃO FOI FECHADO, PORTANTO ESTE BLOCO É ÚTIL PARA CARREGAR SEM TER DE ALTERAR O STATUS DO CLIENTE  //
                                  $cli = mysql_query("SELECT conCodigoCliente, conCodigoPedido_fk FROM container_pedido"); //RECEBE NESTE CAMPO O CÓDIGO DO CLIENTE PESQUISADO //
                                  while($objCli = mysql_fetch_array($cli))
                                  {
                                    $cliente = $objCli['conCodigoCliente'];   // CARREGA O CODIGO DO CLIENTE
                                    $pedido  = $objCli['conCodigoPedido_fk']; // CARREGA O CÓDIGO DO PEDIDO
                                  }
                              
                                  $sql = mysql_query("SELECT cliCodigo, cliNome, cliEndereco, cliNumero, cliCidade, cliTelefone, cliVeiculo, cliPlaca, cliAno FROM clientes WHERE cliCodigo LIKE '$cliente'");
                                  while($obj = mysql_fetch_array($sql))
                                  {
                                       $codigoCliente   = $obj['cliCodigo'];
                                       $nomeCliente     = $obj['cliNome'];
                                       $enderecoCliente = $obj['cliEndereco'];
                                       $numeroCliente   = $obj['cliNumero'];
                                       $cidadeCliente   = $obj['cliCidade'];
                                       $telefoneCliente = $obj['cliTelefone'];
                                       $veiculoCliente  = $obj['cliVeiculo'];
                                       $placaCliente    = $obj['cliPlaca'];
                                       $anoCliente      = $obj['cliAno'];
                                       $codigoPedido    = $obj['pedCodigo'];
                                  } 

                                  //  ESTE BLOCO AGORA CHAMA A TABELA DA GRID, PORQUE NUMA SÓ QUERY NÃO DEU CERTO  //
                                  $grid = mysql_query("SELECT pedCodigo, pedValor, pedData, pedPedido_fk FROM pedidos WHERE pedCliente_fk = '$codigoCliente' AND pedCodigo = '$pedido'");
                                  while($ob = mysql_fetch_array($grid))
                                  {
                                       $codigoPedido    = $ob['pedCodigo'];
                                       $datapPedido     = $ob['pedData'];
                                       $totalPedido     = $ob['pedValor'];
                                       $pedEnviado      = $ob['pedPedido_fk']; // ESTE CAMPO É PRA INFORMAR SE O PEDIDO ESTÁ FECHADO OU NÃO! //
                                  }
                           }
     }
?>


<!-- ROTINA DE PEDIDOS - PRIMEIRA PÁGINA  -->    
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
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <!-- IMPORTANTO SCRIPT JQUERY PARA CEP -->



<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script>

// ### FUNÇÃO PARA APONTAR À CORREÇÃO DE PEDIDO  ### //
function corretor()
{
   var pedido = document.getElementById('pedido').value;
   window.location.href="http://www.difranconaweb.com.br/pinhelli/ponteiro.php?pesquisa="+escape(pedido)+"&sender="+escape(25);
}


//  ###   FUNÇÃO PARA CARREGAR A TELA DE PEDIDO DO SISTEMA  ###  //
function load_pedido()
{  
     var tela = "<?php  print $pedEnviado; ?>";
    

     if(tela == 0)  // ##  SE ESTE VALOR FOR ZERO, O PEDIDO AINDA ESTÁ EM ABERTO OU NOVO PEDIDO //
     { 
          document.getElementById('pesquisa').disabled                      = false;
          document.getElementById('pesquisa').style.backgroundColor         = "#FFFFFF";
          document.getElementById('pesquisa').style.color                   = "#000000";
          document.getElementById('buscar').disabled                        = false; 
          document.getElementById('grupo').disabled                         = false;
          document.getElementById('grupo').style.backgroundColor            = "#FFFFFF";
          document.getElementById('grupo').style.color                      = "#000000";
          document.getElementById('cidade').disabled                        = true;
          document.getElementById('cidade').style.backgroundColor           = "#DCDCDC";
          document.getElementById('cidade').style.color                     = "#000000";
          document.getElementById('cliente').disabled                       = true;
          document.getElementById('cliente').style.backgroundColor          = "#DCDCDC";
          document.getElementById('cliente').style.color                    = "#000000";
          document.getElementById('id_cliente').disabled                    = true;
          document.getElementById('id_cliente').style.backgroundColor       = "#DCDCDC";
          document.getElementById('id_cliente').style.color                 = "#000000";
          document.getElementById('endereco').disabled                      = true;
          document.getElementById('endereco').style.backgroundColor         = "#DCDCDC";
          document.getElementById('endereco').style.color                   = "#000000";
          document.getElementById('numero').disabled                        = true;
          document.getElementById('numero').style.backgroundColor           = "#DCDCDC";
          document.getElementById('numero').style.color                     = "#000000";
          document.getElementById('telefone').disabled                      = true;
          document.getElementById('telefone').style.backgroundColor         = "#DCDCDC";
          document.getElementById('telefone').style.color                   = "#000000";
          document.getElementById('veiculo').disabled                       = true;
          document.getElementById('veiculo').style.backgroundColor          = "#DCDCDC";
          document.getElementById('veiculo').style.color                    = "#000000";
          document.getElementById('placa').disabled                         = true;
          document.getElementById('placa').style.backgroundColor            = "#DCDCDC";
          document.getElementById('placa').style.color                      = "#000000";
          document.getElementById('ano').disabled                           = true;
          document.getElementById('ano').style.backgroundColor              = "#DCDCDC";
          document.getElementById('ano').style.color                        = "#000000";
          document.getElementById('marca').disabled                         = true;
          document.getElementById('marca').style.backgroundColor            = "#808080";
          document.getElementById('marca').style.color                      = "#000000";
          document.getElementById('total').disabled                         = true;
          document.getElementById('total').style.backgroundColor            = "#808080";/*#FFA500*/
          document.getElementById('total').style.color                      = "#000000";
          document.getElementById('codigoMercadoria').disabled              = true;
          document.getElementById('codigoMercadoria').style.backgroundColor = "#808080";
          document.getElementById('codigoMercadoria').style.color           = "#000000";
          document.getElementById('mercadoria').disabled                    = false;
          document.getElementById('mercadoria').style.backgroundColor       = "#FFFFFF";
          document.getElementById('mercadoria').style.color                 = "#000000";
          document.getElementById('quantidade').disabled                    = false;
          document.getElementById('quantidade').style.backgroundColor       = "#FFFFFF";
          document.getElementById('quantidade').style.color                 = "#000000";
          document.getElementById('preco').disabled                         = true;
          document.getElementById('preco').style.backgroundColor            = "#808080";
          document.getElementById('preco').style.color                      = "#000000";
          document.getElementById('salvar').disabled                        = false;
          document.getElementById('novo').disabled                          = true;
          document.getElementById('novo').style.backgroundColor             = '#BEBEBE';
          document.getElementById('acrescentar').disabled                   = false;
          document.getElementById('editar').disabled                        = true;
          document.getElementById('editar').style.backgroundColor           = '#BEBEBE';
          document.getElementById('apagar').disabled                        = false;
          document.getElementById('imprimir').disabled                      = false;
          document.getElementById('gridPed').disabled                       = false;
          document.getElementById('gridPed').style.backgroundColor          = '#FF0000';
          document.getElementById('editar_ref').value                       = 0;
     }

     else if(tela == 1)
     {// SENÃO, O PEDIDO SEMI-FECHADO // 
          document.getElementById('pesquisa').disabled                      = true;
          document.getElementById('pesquisa').style.backgroundColor         = "#DCDCDC";
          document.getElementById('pesquisa').style.color                   = "#000000";
          document.getElementById('buscar').disabled                        = true; 
          document.getElementById('grupo').disabled                         = true;
          document.getElementById('grupo').style.backgroundColor            = "#DCDCDC";
          document.getElementById('grupo').style.color                      = "#000000";
          document.getElementById('cidade').disabled                        = true;
          document.getElementById('cidade').style.backgroundColor           = "#DCDCDC";
          document.getElementById('cidade').style.color                     = "#000000";
          document.getElementById('cliente').disabled                       = true;
          document.getElementById('cliente').style.backgroundColor          = "#DCDCDC";
          document.getElementById('cliente').style.color                    = "#000000";
          document.getElementById('id_cliente').disabled                    = true;
          document.getElementById('id_cliente').style.backgroundColor       = "#DCDCDC";
          document.getElementById('id_cliente').style.color                 = "#000000";
          document.getElementById('endereco').disabled                      = true;
          document.getElementById('endereco').style.backgroundColor         = "#DCDCDC";
          document.getElementById('endereco').style.color                   = "#000000";
          document.getElementById('numero').disabled                        = true;
          document.getElementById('numero').style.backgroundColor           = "#DCDCDC";
          document.getElementById('numero').style.color                     = "#000000";
          document.getElementById('telefone').disabled                      = true;
          document.getElementById('telefone').style.backgroundColor         = "#DCDCDC";
          document.getElementById('telefone').style.color                   = "#000000";
          document.getElementById('veiculo').disabled                       = true;
          document.getElementById('veiculo').style.backgroundColor          = "#DCDCDC";
          document.getElementById('veiculo').style.color                    = "#000000";
          document.getElementById('placa').disabled                         = true;
          document.getElementById('placa').style.backgroundColor            = "#DCDCDC";
          document.getElementById('placa').style.color                      = "#000000";
          document.getElementById('ano').disabled                           = true;
          document.getElementById('ano').style.backgroundColor              = "#DCDCDC";
          document.getElementById('ano').style.color                        = "#000000";
          document.getElementById('marca').disabled                         = true;
          document.getElementById('marca').style.backgroundColor            = "#FFA500";
          document.getElementById('marca').style.color                      = "#000000";
          document.getElementById('total').disabled                         = true;
          document.getElementById('total').style.backgroundColor            = "#FFA500";
          document.getElementById('total').style.color                      = "#000000";
          document.getElementById('marca').disabled                         = true;
          document.getElementById('marca').style.backgroundColor            = "#808080";
          document.getElementById('marca').style.color                      = "#000000";
          document.getElementById('total').disabled                         = true;
          document.getElementById('total').style.backgroundColor            = "#808080";/*#FFA500*/
          document.getElementById('total').style.color                      = "#000000";
          document.getElementById('codigoMercadoria').disabled              = true;
          document.getElementById('codigoMercadoria').style.backgroundColor = "#808080";
          document.getElementById('codigoMercadoria').style.color           = "#000000";
          document.getElementById('mercadoria').disabled                    = true;
          document.getElementById('mercadoria').style.backgroundColor       = "#DCDCDC";
          document.getElementById('mercadoria').style.color                 = "#000000";
          document.getElementById('quantidade').disabled                    = true;
          document.getElementById('quantidade').style.backgroundColor       = "#DCDCDC";
          document.getElementById('quantidade').style.color                 = "#000000";
          document.getElementById('preco').disabled                         = true;
          document.getElementById('preco').style.backgroundColor            = "#808080";
          document.getElementById('preco').style.color                      = "#000000";
          document.getElementById('btn_obra').disabled                      = true; 
          document.getElementById('btn_obra').style.backgroundColor         = '#BEBEBE';
          document.getElementById('salvar').disabled                        = true; 
          document.getElementById('salvar').style.backgroundColor           = '#BEBEBE';
          document.getElementById('novo').disabled                          = false;
          document.getElementById('acrescentar').disabled                   = true;
          document.getElementById('acrescentar').style.backgroundColor      = '#BEBEBE';
          document.getElementById('editar').disabled                        = false;
          document.getElementById('apagar').disabled                        = false;
          document.getElementById('imprimir').disabled                      = false;
          document.getElementById('gridPed').disabled                       = false;
          document.getElementById('gridPed').style.backgroundColor          = '#FF0000';
          document.getElementById('editar_ref').value                       = 1;
     }

     else
     {// PEDIDO FECHADO //
          document.getElementById('pesquisa').disabled                      = true;
          document.getElementById('pesquisa').style.backgroundColor         = "#DCDCDC";
          document.getElementById('buscar').disabled                        = true; 
          document.getElementById('buscar').style.backgroundColor           = '#DCDCDC';
          document.getElementById('grupo').disabled                         = true;
          document.getElementById('grupo').style.backgroundColor            = "#808080";
          document.getElementById('grupo').style.color                      = "#000000";
          document.getElementById('cidade').disabled                        = true;
          document.getElementById('cidade').style.backgroundColor           = "#DCDCDC";
          document.getElementById('cidade').style.color                     = "#000000";
          document.getElementById('cliente').disabled                       = true;
          document.getElementById('cliente').style.backgroundColor          = "#DCDCDC";
          document.getElementById('cliente').style.color                    = "#000000";
          document.getElementById('id_cliente').disabled                    = true;
          document.getElementById('id_cliente').style.backgroundColor       = "#DCDCDC";
          document.getElementById('id_cliente').style.color                 = "#000000";
          document.getElementById('endereco').disabled                      = true;
          document.getElementById('endereco').style.backgroundColor         = "#DCDCDC";
          document.getElementById('endereco').style.color                   = "#000000";
          document.getElementById('numero').disabled                        = true;
          document.getElementById('numero').style.backgroundColor           = "#DCDCDC";
          document.getElementById('numero').style.color                     = "#000000";
          document.getElementById('telefone').disabled                      = true;
          document.getElementById('telefone').style.backgroundColor         = "#DCDCDC";
          document.getElementById('telefone').style.color                   = "#000000";
          document.getElementById('veiculo').disabled                       = true;
          document.getElementById('veiculo').style.backgroundColor          = "#DCDCDC";
          document.getElementById('veiculo').style.color                    = "#000000";
          document.getElementById('placa').disabled                         = true;
          document.getElementById('placa').style.backgroundColor            = "#DCDCDC";
          document.getElementById('placa').style.color                      = "#000000";
          document.getElementById('ano').disabled                           = true;
          document.getElementById('ano').style.backgroundColor              = "#DCDCDC";
          document.getElementById('ano').style.color                        = "#000000";
          document.getElementById('marca').disabled                         = true;
          document.getElementById('marca').style.backgroundColor            = "#808080";
          document.getElementById('marca').style.color                      = "#000000";
          document.getElementById('total').disabled                         = true;
          document.getElementById('total').style.backgroundColor            = "#808080";/*#FFA500*/
          document.getElementById('total').style.color                      = "#000000";
          document.getElementById('codigoMercadoria').disabled              = true;
          document.getElementById('codigoMercadoria').style.backgroundColor = "#808080";
          document.getElementById('codigoMercadoria').style.color           = "#000000";
          document.getElementById('mercadoria').disabled                    = true;
          document.getElementById('mercadoria').style.backgroundColor       = "#808080";
          document.getElementById('mercadoria').style.color                 = "#000000";
          document.getElementById('quantidade').disabled                    = true;
          document.getElementById('quantidade').style.backgroundColor       = "#808080";
          document.getElementById('quantidade').style.color                 = "#000000";
          document.getElementById('preco').disabled                         = true;
          document.getElementById('preco').style.backgroundColor            = "#808080";
          document.getElementById('preco').style.color                      = "#000000";
          document.getElementById('salvar').disabled                        = true;
          document.getElementById('salvar').style.backgroundColor           = "#BEBEBE";
          document.getElementById('novo').disabled                          = false;
          document.getElementById('acrescentar').disabled                   = true;
          document.getElementById('acrescentar').style.backgroundColor      = "#BEBEBE";
          document.getElementById('editar').disabled                        = false;
          document.getElementById('apagar').disabled                        = false;
          document.getElementById('imprimir').disabled                      = false;
          document.getElementById('imprimir').style.backgroundColor         = "";
          document.getElementById('btn_obra').disabled                      = true;
          document.getElementById('btn_obra').style.backgroundColor         = '#BEBEBE';
          document.getElementById('gridPed').disabled                       = false;
          document.getElementById('gridPed').style.backgroundColor          = '#FF0000';
          document.getElementById('editar_ref').value                       = 2; // PARA A CARGA DE TELA CONDIÇÃO FALSE //
     }
}
//  ###    FIM DE FUNÇÃO LOAD DE TELA   ###  //
/****************************************************************************/

// ## ROTINA JQUERY PARA GRID DE PEDIDO ## // 
      $(document).ready(function(){
      $("#_gridPed").click(function(){
        $("#_panel").slideToggle("slow");
      });
    });  

// ## FINAL DE ROTINA PARA GRID ## //

</script> 
<!--  ####    ESTILO PARA PÁGINA DE PEDIDOS  ###  -->
<style type="text/css">
#_gridPed {padding: 5px; text-align: center; background-color: #FF0000; border: solid 1px #c3c3c3;}
#_panel {padding: 5px; display: none; background-color: #e5eecc; border: solid 1px #c3c3c3; width:100%; height:100%;}


.apagar_pedido{position:absolute;width:100%;height:20%;top:50%;left:00%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:02;}
body .apagar_pedido   {background-color:#BEBEBE;}


.excessao-buscar-cliente   {position:absolute;width:100%;height:40%;top:01%;left:00%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:02;color:#B22222;}
body .excessao-erro  {background-color:#BEBEBE;}


.excessao-duas-parc{position:absolute;width:100%;height:30%;top:35%;left:00%;border-style:ridge;border-radius:05px; box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:02;}
body .excessao-duas-parc{background-color:#BEBEBE;}
input .excessao-duas-parc{background-color:#FFFFFF;}


.excessao-estoque{position:absolute;width:100%;height:15%;top:55%;left:00%;border-style:ridge;border-radius:05px; box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:02; color:#FF0000;}
body .excessao-estoque{background-color:#BEBEBE;}


.excessao-kilometragem{position:absolute;width:100%;height:40%;top:35%;left:00%;border-style:ridge;border-radius:05px; box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:02;}
body .excessao-kilometragem{background-color:#BEBEBE;}
input .excessao-kilometragem{background-color:#FFFFFF;}
textarea .excessao-kilometragem{background-color:#FFFFFF;}


.excessao-mao-de-obra {position:absolute;width:100%;height:30%;top:40%;left:00%;border-style:ridge;border-radius:05px;z-index:01;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;}
body .excessao-mao-de-obra{background-color:#BEBEBE;}


.excessao-novo{position:absolute;width:100%;height:15%;top:35%;left:00%;border-style:ridge;border-radius:05px; box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:02; color:#FF0000;}
body .excessao-novo{background-color:#BEBEBE;}

.excessao-pagamento{position:absolute;width:100%;height:22%;top:35%;left:00%;border-style:ridge;border-radius:05px; box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:02;}
body .excessao-pagamento{background-color:#BEBEBE;}
input .excessao-pagamento{background-color:#FFFFFF;}


.excessao-parc-cartao{position:absolute;width:100%;height:40%;top:35%;left:00%;border-style:ridge;border-radius:05px; box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:02;}
body .excessao-parc_cartao{background-color:#BEBEBE;}
input .excessao-parc-cartao{background-color:#FFFFFF;}


.excessao_pesquisa{position:absolute;width:100%;height:70%;top:10%;left:00%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:02;}
body .excessao_pesquisa   {background-color:#BEBEBE;}


.excessao-tres-parc{position:absolute;width:100%;height:40%;top:35%;left:00%;border-style:ridge;border-radius:05px; box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:02;}
body .excessao-tres-parc{background-color:#BEBEBE;}
input .excessao-tres-parc{background-color:#FFFFFF;}


.excessao-validacao   {position:absolute;width:100%;height:15%;top:50%;left:00%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:02;color:#0000FF;}
body .excessao-validacao  {background-color:#BEBEBE;}

.excessao-erro   {position:absolute;width:100%;height:15%;top:50%;left:00%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:02;color:#B22222;}
body .excessao-erro  {background-color:#BEBEBE;}

.excessao-erro-editar {position:absolute;width:100%;height:20%;top:50%;left:00%;border-style:ridge;border-radius:05px;box-shadow: 5px 5px 5px rgba(0,0,0,0.5);padding-left:05%;padding-top:02%;z-index:02;color:#B22222;}
body .excessao-erro-editar {background-color:#BEBEBE;}

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
    .btn.btn-blue {
    color: #fff;
    background-color: #008080; }
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
  <body onload="load_pedido()">
  

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
        <li><a href="http://www.difranconaweb.com.br/pinhelli/ponteiro.php?sender=6">orçamentos</a></li>
        <li><a href="#">admin</a></li><!-- http://www.difranconaweb.com.br/teste/ponteiro.php?sender=7 -->
        <li><a href="http://www.difranconaweb.com.br/pinhelli/ponteiro.php?sender=9&pesquisa=<?php print  $codigoPedido; ?>">caixa</a></li>
        <li><a href="http://www.difranconaweb.com.br/pinhelli/ponteiro.php?sender=14">relatório</a></li>
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

<!-- ## INICIO DE FORMULÁRIO DE ITENS DE PEDIDO ## -->
    </div>
  </header> 

  <main class="main-content">
    <div class="container-fluid photos">
      <div class="row justify-content-center">
        
        <div class="col-md-6 pt-4"  data-aos="fade-up">
          <h2 class="text-white mb-4">FORMULÁRIO PEDIDOS</h2>

              <div class="row">
                <div class="col-md-12">

                <!--  ###  INICIO DE FORMULÁRIO DE CADASTRO DE PEDIDOS  ###  -->
                  <form name="cadastro" id="cadastro" method="get" action="">
                          <span id="confirma"></span>   <!-- SAIDA DE EXCESSAO PARA CONFIRMAÇÃO  -->
                          <span id="excessao"></span>   <!-- SAIDA DE EXCESSAO PARA TODOS OS ERROS DO ARQUIVO  -->
                          <!--  ####  FINAL DE CAIXA DE SAIDA DE EXCEÇÃO   ##### -->


                 <!-- ### COLEÇÃO DE VARIÁVEIS OCULTAS  ###  -->

                       <input type="hidden" name="usuario" id="usuario" value="<?php  print $usuario; ?>"><!-- VARIÁVEL OCULTA PRA ENVIAR O NOME DO RESPONSAVEL  -->
                       <input type="hidden" name="pedido" id="pedido" value="<?php  print $codigoPedido; ?>"><!-- VARIÁVEL OCULTA PRA ENVIAR O NÚMERO DO PEDIDO  -->
                       <!-- VARIÁVEL OCULTA SALVA O NÚMERO DO CLIENTE NO PEDIDO A SER FEITO. NÃO PODE ESTAR SEM ESTA VARIÁVEL OCULTA...  -->
                        <input type="hidden" name="_nome" id="_nome"><!-- VARIÁVEL OCULTA -->
                       <!-- ENVIANDO A NOME  -->
                        <input type="hidden" name="_veiculo" id="_veiculo"><!-- VARIÁVEL OCULTA -->
                       <!-- ENVIANDO A VEICULO  -->
                        <input type="hidden" name="_placa" id="_placa"><!-- VARIÁVEL OCULTA -->
                       <!-- ENVIANDO A PLACA  -->
                        <input type="hidden" name="_telefone" id="_telefone"><!-- VARIÁVEL OCULTA -->
                       <!-- ENVIANDO O TELEFONE  -->
                       <input type="hidden" name="_km" id="_km"><!-- VARIÁVEL OCULTA -->
                       <!-- ENVIANDO A KILOMETRAGEM  -->
                       <input type="hidden" name="_desconto" id="_desconto"><!-- VARIÁVEL OCULTA -->
                       <!-- ENVIANDO O DESCONTO  -->
                       <input type="hidden" name="_garantia" id="_garantia"><!-- VARIÁVEL OCULTA -->
                       <!-- ENVIANDO A GARANTIA  -->
                       <input type="hidden" name="_mecanico" id="_mecanico"><!-- VARIÁVEL OCULTA -->
                       <!-- ENVIANDO O MECANICO  -->
                       <input type="hidden" name="_pagamento" id="_pagamento"><!-- VARIÁVEL OCULTA -->
                       <!-- ENVIANDO O COMENTÁRIO  -->
                       <input type="hidden" name="_parcelas" id="_parcelas"><!-- VARIÁVEL OCULTA -->
                       <!-- ENVIANDO A QUANTIDADE DE PARCELAS CRÉDITO  --> 
                       <input type="hidden" name="_comentario" id="_comentario"><!-- VARIÁVEL OCULTA -->
                       <!-- ENVIANDO O COMENTARIO PARA ESTE PEDIDO  --> 


                       <?php  $_SESSION['codigoPedido'] = $codigoPedido; ?><!--  ###   VARIÁVEL DE SESSÃO PARA A TELA DE IMPRESSÃO LOCALIZAR O PEDIDO E O CLIENTE  -->
                       <input type="hidden" name="editar_ref" id="editar_ref" value=""><!--  ESTA VARIÁVEL É PARA ENVIAR VALOR À ROTINA DE SALVAR REGISTROS -->
                       <input type="hidden" name="pedCodigo" id="pedCodigo" value="<?php  print $codigo; ?>"><!--  ESTA VARIÁVEL É PARA ENVIAR O CÓDIGO DO PEDIDO -->
                       
              <!-- ### FINAL DE COLEÇÃO DE VARIÁVEIS OCULTAS ####  -->
                


                        <!-- ### CAMPO DE PESQUISA  ###  -->
                        <div class="row form-group">
                          <div class="col-md-6">
                            <label class="text-white" for="registro"><strong>NÚMERO DE PEDIDO ..: </strong>&ensp;<?php print $codigoPedido; ?></label> 
                          </div>
                          <!-- ### INSERINDO DATA  ###  -->
                          <div class="col-md-6">
                            <label class="text-white" for="registro"><strong>DATA DE HOJE..: </strong>&ensp;<?php print $Data;  ?></label> 
                          </div>
                        </div>
                        <!-- ### FINAL DE DATA  ###  -->

                        <!-- ### CAMPO PARA PESQUISA  ###  -->
                        <div class="row form-group">
                          <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-white" for="pesquisa"><strong>PESQUISAR</strong></label> 
                                <input type="text" id="pesquisa" class="form-control" placeholder="DIGITE NOME/PLACA">
                          </div>
                          <div class="col-md-6">
                            <input type="button" id="buscar" value="Buscar" class="btn btn-primary btn-md text-white" onclick="buscarClientes()"/>
                          </div>
                        </div>
                        <a>##################################################</a>
                        
                        <!-- ### FINAL DE PESQUISA  ###  -->



                        <!-- ###   INICIO DE FORMULÁRIO  #### -->
                        <div class="row form-group">
                            <div class="col-md-9 mb-3 mb-md-0">
                                <label class="text-white" for="cliente"><strong>NOME CLIENTE</strong></label>
                                <input type="text" id="cliente" class="form-control" value="<?php print utf8_encode($nomeCliente); ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="text-white" for="idCliente"><strong>ID. CLIENTE</strong></label>
                                <input type="text" id="id_cliente" class="form-control" value="<?php print $codigoCliente ?>">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-9 mb-3 mb-md-0">
                                <label class="text-white" for="endereco"><strong>ENDEREÇO</strong></label>
                                <input type="text" id="endereco" class="form-control" value="<?php print utf8_encode($enderecoCliente); ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="text-white" for="numero"><strong>NÚMERO</strong></label>
                                <input type="text" id="numero" class="form-control" value="<?php print $numeroCliente; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label class="text-white" for="cidade"><strong>CIDADE</strong></label>
                                <input type="text" id="cidade"  class="form-control" value="<?php print utf8_encode($cidadeCliente); ?>">
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label class="text-white" for="telefone"><strong>TELEFONE</strong></label>
                                <input type="text" id="telefone" class="form-control" value="<?php print $telefoneCliente; ?>">
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label class="text-white" for="dtPedido"><strong>DATA PEDIDO</strong></label>
                                <label class="text-white"> <?php print $dataPedido; ?></label>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label class="text-white" for="veiculo"><strong>VEÍCULO</strong></label>
                                <input type="text" id="veiculo" class="form-control" value="<?php print utf8_encode($veiculoCliente);?>">
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label class="text-white" for="placa"><strong>PLACA</strong></label>
                                <input type="text" id="placa"  class="form-control" value="<?php print $placaCliente; ?>">
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label class="text-white" for="ano"><strong>ANO</strong></label>
                                <input type="text" id="ano" class="form-control" value="<?php print $anoCliente; ?>">
                            </div>
                        </div>
<!--  ###  FIM DE PRIMEIRO FORMULÁRIO  ## -->
                           <span id="impressao"></span>   <!-- SAIDA DE EXCESSAO PARA MENSAGEM DE IMPRESSÃO  -->
                           <a>##################################################</a>
                       <!-- ### VALOR DO PEDIDO  ###  -->
                       <div class="row form-group">
                            <div class="col-md-12"><?php
                              if($ponteiro == 1)
                                 {// SE ENTRAR NESTE BLOCO VEM DA TABELA PRINCIPAL
                                      $ped = mysql_query("SELECT pedValor, pedDesconto FROM pedidos  WHERE pedCodigo = '$codigoPedido'");
                                 }

                                 else
                                 {//  SE ENTRAR NESTE BLOCO ENTÃO PORQUE VEIO DA TABELA ARQUIVADA //
                                      $ped = mysql_query("SELECT pedValor, pedDesconto FROM pedidos  WHERE pedCodigo = '$codigoPedido'");
                                 }
                                 while($tot = mysql_fetch_array($ped))
                                 {
                                        $valor_pedido   = $tot['pedValor'];
                                        $valor_desconto = $tot['pedDesconto'];
                                 }
                                 ?>
                              <h3 class="text-white" for="registro"><strong>VALOR PEDIDO..: </strong>&ensp;<?php  print $valor_pedido ?></h3> 
                            </div>
                            <div class="col-md-12">
                              <input type="button" id="_gridPed" value="Grid" class="btn btn-primary btn-md text-white"/>

                              <div id="_panel">
                                   <table name="registros" border="1">

                                        <tr>
                                           <th>ID PEÇA</th>
                                           <th>QUANT.</th>                            
                                           <th>DESCRIÇÃO</th>
                                           <th>VAL. UNIT</th>
                                           <th>VAL. TOTAL</th>
                                           <th>REMOVER</th>
                                        </tr>
                                        <tr><?php  // #####  SEGUE NESTE BLOCO ABAIXO A DIVISÃO PARA CARREGAR A GRID... O PRÓXIMO BLOCO É PARA CARREGAR O VALOR FINAL DA GRID (SOMENTE O VALOR DA GRID)  #### //
                                        
                                            $itens = mysql_query("SELECT pedItePedido_fk, pedIteIdProduto_fk, pedIteQuantidade,pedIteDescricao,pedItePreco,pedIteTotal FROM pedido_itens WHERE pedItePedido_fk = '$codigoPedido'"); 
                              
                                        while($objItens = mysql_fetch_array($itens))
                                        {?>
                                        <tr>
                                            <td><?php print $objItens['pedIteIdProduto_fk']; ?></td>
                                            <td><?php print $objItens['pedIteQuantidade']; ?></td>
                                            <td><?php print utf8_encode($objItens['pedIteDescricao']); ?></td>
                                            <td><?php print $objItens['pedItePreco']; ?></td>
                                            <td><?php print $objItens['pedIteTotal']; ?></td>
                                            <?php $codigoGrid = $objItens['pedItePedido_fk'];?> <!--  VARIÁVEL VEM COM O NUMERO DO PEDIDO -->
                                            <td width="100"><div  align="center"><a href="pedidos/excluirItemPedido.php?codigoGrid=<?php print $codigoGrid; ?>&quantidade=<?php print $objItens['pedIteQuantidade'];?>&pedIteIdProduto_fk=<?php print $objItens['pedIteIdProduto_fk'];?>">SIM</a></div></td>
                                        </tr>
                                        <?php  }  ?>                                     
                                        <tr>

                                         <?php 
                                              $ped = mysql_query("SELECT SUM(pedIteTotal) AS total FROM pedido_itens  WHERE pedItePedido_fk = '$codigoPedido'");
                                              while($tot = mysql_fetch_array($ped))
                                              {
                                                  $valor_pedido = $tot['total'];   // PEGA O VALOR TOTAL DO PEDIDO SOMADO NA QUERY ACIMA //
                                              }
// ##########   FINAL DE BLOCO PARA CARREGAR PREÇO TOTAL DO PEDIDO E ESCOLHA DE TABELA PRINCIPAL E TABELA ARQUIVADA  ######  //
                                         // FOI INSERIDO UM TRATAMENTO PARA O VALOR DO PEDIDO DEVIDO AO VALOR ENTRAR FALTANDO ZERO NA CASA DECIMAL //
                                         if($desconto == 0.00)
                                         {
                                             $valor_pedido;   // ESTA LINHA TRATA O VALOR PRA ENTRAR CORRETAMENTE NA TELA //
                                             $valor_pedido = number_format($valor_pedido,2);
                                         }

                                         else
                                         {
                                             $valor_pedido = $valor_pedido - $desconto;  // APLICA O DESCONTO NO FINAL DA GRID DO PEDIDO  // 
                                             $valor_pedido = number_format($valor_pedido,2);
                                         }
                                          // FIM DE TRATAMENTO DE VALOR NA TELA //
                                   ?>
                                        <tr>
                                            <td colspan="03"><strong>VALOR DESCONTO.: </strong></td>
                                            <td colspan="03" align="center"><strong><?php print $desconto;?></strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="03"><strong>VALOR TOTAL PEDIDO.: </strong></td>
                                            <td colspan="03" align="center"><strong><?php print $valor_pedido;?></strong></td>
                                            <!--  VARIÁVEL OCULTA PARA ATUALIZAR A TABELA DE PEDIDO E OUTRAS NECESSIDADES  -->
                                            <input type="hidden" name="valor_pedido" id="valor_pedido" value="<?php print $valor_pedido;?>">
                                            <input type="hidden" name="desconto" id="desconto" value="<?php print $desconto;?>">
                                        </tr>
                                        </tr>
                                   </table>
                              </div>
                            </div>
                        </div>
<!-- ### FINAL DE VALOR DE PEDIDO  ###  -->

                         <a>###################################################</a>
<!-- ####   ESTE SEGUNDO FRAME DE PREENCIMENTO DO PEDIDO  ### -->
                        <div class="row form-group">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label class="text-white" for="grupo"><strong>GRUPO</strong></label>
                                <select id="grupo" class="form-control" onChange="ajaxGet('pedidos/filtro.php?grupo='+this.value, document.getElementById('mercadoria'), true);">
                                  <?php $gr = mysql_query("SELECT 'SELEC', 'GRUPO' FROM grupo  UNION SELECT gruCodigo, gruNome AS 'GRUPO' FROM grupo  ORDER BY 'GRUPO' ASC");while($grupo = mysql_fetch_array($gr)){?>
                                             <option value="<?php print $grupo['SELEC'];?>"><?php print utf8_encode($grupo['GRUPO']); ?></option> <?php  }?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label class="text-white" for="mercadoria"><strong>MERCADORIA</strong></label>
                                <select id="mercadoria"  class="form-control" value="<?php print $mercadoria;?>" onChange="buscarValor()">
                                  <option value="SELECIONE">SELECIONE</option>
                                        <?php  $mer = mysql_query("SELECT merCodigo, merCodigoProduto, merMercadoria, merPrecoVendaUnid FROM mercadorias ");
                                             while($objSel = mysql_fetch_array($mer))
                                        {?>
                                             <option size="50" maxlength="50"><?php print  utf8_encode($objSel['merMercadoria']);?></option>
                                      <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label class="text-white" for="marca"><strong>MARCA</strong></label>
                                <input type="text" id="marca" class="form-control">
                            </div>
                        </div>
<!-- ####  FINAL DE FOMULÁRIO DE BUSCA DE MERCADORIA #### -->
                        <div class="row form-group">
                            <div class="col-md-3 mb-3 mb-md-0">
                              <label class="text-white" for="codigo"><strong>CÓDIGO</strong></label>
                              <input type="text" id="codigoMercadoria" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3 mb-md-0">
                              <label class="text-white" for="quantidade"><strong>QUANTIDADE</strong></label>
                              <input type="text" id="quantidade" class="form-control" onchange="calcula_quantidade()">
                            </div>
                            <div class="col-md-3 mb-3 mb-md-0">
                              <label class="text-white" for="preco"><strong>PREÇO</strong></label>
                              <input type="text" id="preco" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3 mb-md-0">
                              <label class="text-white" for="total"><strong>TOTAL</strong></label>
                              <input type="text" id="total" class="form-control">
                            </div>
                        </div>





                        <ul class="copyright">
                           <li>&copy;<?php print Date('Y') ?>. PINHELLI PNEUS SUSPENSÃO -  Pedidos.</li>
                        </ul></br>

                        <div class="row form-group">
                          <div class="col-md-12">
                            <input type="button" id="salvar" value="Gravar" class="btn btn-primary btn-md text-white"  onclick="salvar_pedido()"/>
                            <input type="button" id="novo" value="Novo" class="btn btn-primary btn-md text-white"  onclick="novo_pedido()"/>
                            <input type="button" id="acrescentar" value="Adicionar" class="btn btn-primary btn-md text-white"  onclick="acrescenta()"/>
                            <input type="button" id="apagar" value="Apagar" class="btn btn-primary btn-md text-white"  onclick="apagar_pedido()"/>
                            </br></br>
                            <input type="button" id="editar" value="Editar" class="btn btn-primary btn-md text-white"  onclick="editarPedido()"/>
                            <input type="button" id="imprimir" value="Imprimir" class="btn btn-primary btn-md text-white" onclick="imprime_pedido()"/>
                            <input type="button" id="btn_obra" value="Mão Obra" class="btn btn-primary btn-md text-white" onclick="mao_de_obra()"/>
                            <input type="button" id="cancelar" value="Cancelar" class="btn btn-primary btn-md text-white" onclick="cancel()"/></br></br>
                            <input type="button" id="correcao" value="Corretor" class="btn btn-pimary btn btn-blackRed text-white" onclick="corretor()"/>
                            <input type="button" id="tabela" value="Tabela Preços" class="btn btn-pimary btn btn-blackRed text-white" onclick="prices()"/>
                            <select name="selPrint" id="selPrint" class="btn btn-pimary btn btn-blackRed text-white">   
                                  <option value="dual">DUAL</option>
                                  <option value="tinta">TINTA</option>
                            </select>
                          </div>
                        </div>
                   </form>
                 <!-- ###   FINAL DE FORMULÁRIO DE CADASTRO DE PEDIDOS  ###  -->
                  
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
  <script src="pedidos/js/script.js"></script>
  <script src="pedidos/js/scripts.js"></script>
  <script src="pedidos/js/scripts_1.js"></script>
  <script src="pedidos/js/micoxAjax.js"></script>
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