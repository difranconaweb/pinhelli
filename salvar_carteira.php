<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 06JUL23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 15JUL23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 05AGO23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    ROTINA DE PEDIDOS - SALVAR O PEDIDO BOLETO */
     require 'Utilidades/conexao.php';

     $pedido     = $_GET['pedido'];
     $dataPgto   = $_GET['dataPgto'];
     $valor      = $_GET['valor'];
     $idCliente  = $_GET['idCliente'];
     $km         = $_GET['km'];
     $desconto   = $_GET['desconto'];
     $mecanico   = $_GET['mecanico'];
     $garantia   = strtoupper($_GET['garantia']);
     $comentario = strtoupper($_GET['comentario']);
     $usuario    = strtoupper($_GET['usuario']);
     $desconto   = str_replace(',','.',$desconto);


     // PEGA O VALOR DO PEDIDO BEM COMO O DESCONTO E LANÇA O VALOR REAL NA TABELA //
     $valor = ($valor - $desconto); // VALOR COM O DESCONTO //

// COLETANDO AS DATA E HORA NO SERVIDOR //     
     $data = Date('d/m/Y'); // PEGA A DATA DO SERVIDOR //
     $hora = Date('H:i:s'); // PEGA O HORÁRIO DO SERVIDOR //
     $dia  = Date('d');
     $mes  = Date('m');
     $ano  = Date('y');


     // ## CRIANDO ROTINA PARA A DATA DE VENCIMENTO DO PEDIDO EM CARTEIRA ## //
     switch($mes)
     {
        case $mes == 1:
        $mes = 'JAN';
        break;

        case $mes == 2:
        $mes = 'FEV';
        break;
        
        case $mes == 3:
        $mes = 'MAR';
        break;

        case $mes == 4:
        $mes = 'ABR';
        break;

        case $mes == 5:
        $mes = 'MAI';
        break;

        case $mes == 6:
        $mes = 'JUN';
        break;

        case $mes == 7:
        $mes = 'JUL';
        break;

        case $mes == 8:
        $mes = 'AGO';
        break;

        case $mes == 9:
        $mes = 'SET';
        break;

        case $mes == 10:
        $mes = 'OUT';
        break;

        case $mes == 11:
        $mes = 'NOV';
        break;

        case $mes == 12:
        $mes = 'DEZ';
        break;

        default:
        $mes > 12;$mes == 'JAN';
     }

     $priData = '10'.$mes.$ano;

    // ALTERAR A FORMA DE PAGAMENTO //
         
         // ## OPÇÃO PARA PAGAMENTO..: 0 - SELECIONE / 1 - CARTEIRA / 2 - CARTÃO CRÉDITO / 3 - DINHEIRO / 4 - DÉBITO / 5 - PIX ## //
          $sql = mysql_query("UPDATE carteira SET pagCliente_fk = '$idCliente', pagPedido_fk = '$pedido', pagStatus = 'ABERTO', pagFormaPagto = 1, pagBandeira = 'CARTEIRA', pagParcela = 1, pagValor = '$valor', pagDataPag = '$priData', pagData = '$data', pagHora = '$hora', pagResponsavel = '$usuario' WHERE pagPedido_fk = '$pedido'");
          mysql_query("UPDATE pedidos SET pedValor = '$valor', pedDesconto = '$desconto', pedHora = '$hora', pedPedido_fk = 2, pedData = '$data', pedKm = '$km', pedGarantia = '$garantia', pedComentario = '$comentario', pedMecanico = '$mecanico', pedDia = '$dia', pedMes = '$mes', pedAno = '$ano' WHERE pedCodigo = '$pedido'"); // FECHA O PEDIDO NA TABELA DE PEDIDOS //

           // APÓS REGISTRAR O VALOR DO PEDIDO INSERE O MECANICO  //
           mysql_query("UPDATE pedido_itens SET  pedIteMecanico = '$mecanico' WHERE pedItePedido_fk = '$pedido'");

// CASO NÃO CONSIGA ALTERAR A FORMA DE PAGAMENTO EXISTENTE, VOLTA O VALOR ZERO PARA MENSAGEM DE EXCEÇÃO //
            if(empty($sql))
            {
               print 0;
            }

            else
            {
               print 1;
            }
?>