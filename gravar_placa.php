<?php

/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645 */



     require 'Utilidades/conexao.php';

     $data    = Date('d/m/Y');
     $horario = Date('H:i:s');


     $codigo     = trim($_GET['codigo']);  // CÓDIGO DO CLIENTE //
     $placa      = strtoupper(trim($_GET['placa'])); // NOVA PLACA DO CLIENTE //


     // ## CARREGA OS DADOS DO CLIENTE PARA O NOVO REGISTRO ## //
     $sql = mysql_query("SELECT * FROM clientes WHERE cliCodigo = '$codigo'");
     while($obj = mysql_fetch_array($sql))
     {
         $nome      = $obj['cliNome'];
         $cep       = $obj['cliCep'];
         $endereco  = $obj['cliEndereco'];
         $numero    = $obj['cliNumero'];
         $bairro    = $obj['cliBairro'];
         $cidade    = $obj['cliCidade'];
         $telefone  = $obj['cliTelefone'];
         $celular   = $obj['cliCelular'];
         $dataNasc  = $obj['cliDataNasc'];
         $cpf       = $obj['cliCPF'];
         $cnpj      = $obj['cliCNPJ'];
         $inscricao = $obj['cliInscricao'];
         $rg        = $obj['cliRG'];
         $email     = $obj['cliEmail'];
     }
     // ## FINAL DE CARGA ## //

      // ##  INSERE A NOVA PLACA DO VEÍCULO NA TABELA PLACA ## //
      /* ##  APÓS ESTA ALTERAÇÃO, NÃO HÁ NECESSIDADE DA TABELA PLACA. PORÉM NÃO A APAGUEI, PORQUE PODE SER QUE FUTURAMENTE EU NECESSITE DELA PARA ALGO ## */
      $_sql = mysql_query("INSERT INTO placas (plaPlaca, plaCliente_fk, plaData, plaHorario) VALUES ('$placa','$codigo','$data','$horario')");

      // ## INSERE O REGISTRO DUPLICADO COM NOVA PLACA ## //
      mysql_query("INSERT INTO clientes (cliNome, cliCep, cliEndereco, cliNumero, cliBairro, cliCidade, cliTelefone, cliCelular, cliDataNasc, cliCPF, cliCNPJ, cliInscricao, cliRG, cliEmail, cliData, cliPlaca) VALUES ('$nome','$cep','$endereco','$numero','$bairro','$cidade','$telefone','$celular','$dataNasc','$cpf','$cnpj','$inscricao','$rg','$email','$data','$placa')");


      if(empty($_sql))
      {
         print 0;
      }

      else
      {
         print 1;
      }

?>