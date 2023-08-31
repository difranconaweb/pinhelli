<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 14AGO23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 14AGO23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 14AGO23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 14AGO23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    ROTINA DE CORREÇÃO DE PEDIDO - SALVAR O PEDIDO  */
     require 'Utilidades/conexao.php';

     $pedido     = $_GET['pedido'];
     $valor      = $_GET['valor'];
     $desconto   = $_GET['desconto'];
     $desconto   = str_replace(',','.',$desconto);
     $valor      = str_replace(',', '.',$valor);
// PEGA O VALOR DO PEDIDO BEM COMO O DESCONTO E LANÇA O VALOR REAL NA TABELA //
     

      
     $data = Date('d/m/Y'); // PEGA A DATA DO SERVIDOR //
     $hora = Date('H:i:s'); // PEGA O HORÁRIO DO SERVIDOR //
     $dia  = Date('d');
     $mes  = Date('m');
     $ano  = Date('Y');


     


 // ## ALTERANDO O VALOR NA TABELA DE PEDIDO ## //
        $sql = mysql_query("UPDATE pedidos SET pedValor = '$valor', pedDesconto = '$desconto' WHERE pedCodigo = '$pedido'");
        
         // ATUALIZANDO A TABELA DE PAGAMENTOS ## //
          mysql_query("UPDATE carteira SET pagValor = '$valor' WHERE pagPedido_fk = '$pedido'");


        // ATUALIZANDO A TABELA DE PEDIDO DEDICADA DO USUARIO  //
          mysql_query("UPDATE $usuario SET Valor = '$valor', Desconto = '$desconto'");

         // ##   VERIFICA SE CONSTA ESTE PEDIDO DA VIARÁVEL NA TABELA DE CAIXA ## //
          $cax = mysql_query("SELECT caxCodigo FROM caixa WHERE caxIdPedido_fk = '$pedido'");
          while($_cax = mysql_fetch_array($cax))
          {
              $caxPedido = $_cax['caxCodigo'];
          }

          mysql_query("UPDATE caixa SET caxVlrEntrada = '$valor' WHERE caxCodigo = '$caxPedido'");
          // ##  FINAL DE ROTINA ## //

          // ALTERA O PONTEIRO PARA MUDAR DE ARQUIVO APÓS SALVAR A FORMA DE PAGAMENTO //
          mysql_query("UPDATE ponteiro SET ponPonteiro = 5, ponData = '$data', ponHora = '$hora' WHERE ponResponsavel = '$usuario'");

// CASO NÃO CONSIGO INSERIR A FORMA DE PAGAMENTO A VISTA, RETORNA ZERO PARA MENSAGEM DE EXCEÇÃO //
        if(empty($sql))
        {
           print 0;
        }

        else
        {
           header('Location:http://www.difranconaweb.com.br/pinhelli/controller.php');
        }
  
?>