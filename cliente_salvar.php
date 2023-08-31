<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645
     ARQUIVO PARA SALVAR REGISTRO  ####  */

     require 'Utilidades/conexao.php';
     // ## PEGANDO A DATA E A HORA ## //
     $data = Date('d/m/Y');
     $hora = Date('H:i:s');
 

     $nome       = strtoupper(trim($_GET['nome']));
     $celular    = trim($_GET['telefone']);
     $veiculo    = strtoupper(trim($_GET['veiculo']));
     $placa      = strtoupper(trim($_GET['placa']));
     $pedido     = trim($_GET['pedido']);
     $usuario    = strtoupper(trim($_GET['usuario']));
    

    // ## VERIFICANDO NA TABELA DE CLIENTE SE JÁ CONSTA ALGUMA PLACA REGISTRADA EM NOME DE OUTRA PESSOA ## //
     $_sql = mysql_query("SELECT cliPlaca FROM clientes WHERE cliPlaca LIKE '$placa'");
     while($obj = mysql_fetch_array($_sql))
     {
        $retorno = $obj['cliPlaca'];
     }
     
      // ## SE A PLACA JÁ ESTIVER CADASTRADA, VOLTA MENSAGEM DE EXCESSAO ## //
      if(empty($retorno))
      {
           // ## SALVANDO O REGISTRO NA TABELA DE CLIENTES  ## //
           $sql = mysql_query("INSERT INTO clientes (cliNome,cliCelular,cliData,cliHora,cliVeiculo,cliPlaca) VALUES ('$nome','$celular','$data','$hora','$veiculo','$placa')");

           // ##  BUSCANDO O NUMERO DO CLIENTE PARA INSERIR NO PEDIDO  ## //
           $_cli = mysql_query("SELECT cliCodigo FROM clientes");
           while($obj = mysql_fetch_array($_cli))
           {
               $cliCodigo = $obj['cliCodigo']; // CARREGANDO O NUMERO DO CLIENTE QUE ACABOU DE SER GERADO //
           }

           // ### INSERINDO O NUMERO DO CLIENTE NO PEDIDO ABERTO NA TELA ### //
           mysql_query("UPDATE pedidos SET pedCliente_fk = '$cliCodigo' WHERE pedCodigo = '$pedido'");
           // ### INSERINDO O NUMERO DO CLIENTE AGORA NA TABELA DEDICADA DO USUARIO DO SISTEMA ### //
           mysql_query("UPDATE $usuario SET Cliente_fk = '$cliCodigo' ");

           if(empty($sql))
           {
               print 0; // SE ENTRAR NESTE CAMPO VOLTA VALO ZERO PORQUE NAO CONSEGUIU SALVAR O REGISTRO //
           }

           else
           {
               print 1; // SE IMPRIMIR O VALOR 1, ENTAO PORQUE ESTÁ TUDO CERTO //
           }
      }

      else
      {
           print 2; // VOLTA INFORMANDO QUE JÁ CONSTA CADASTRO COM A PLACA DIGITADA //
      }


     

                                     
?>     