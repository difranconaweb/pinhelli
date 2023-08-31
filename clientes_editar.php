<?php

/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645 */



     require 'Utilidades/conexao.php';

     $data = Date('d/m/Y');
 
//  VEM COM OS VALORES DO ARQUIVO DE JS //
     $codigo     = trim($_GET['codigo']);
     $nome       = strtoupper(trim($_GET['nome']));
     $cep        = strtoupper(trim($_GET['cep']));
     $endereco   = strtoupper(trim($_GET['endereco']));
     $numero     = trim($_GET['numero']);
     $bairro     = strtoupper(trim($_GET['bairro']));
     $cidade     = strtoupper(trim($_GET['cidade']));
     $telefone   = trim($_GET['telefone']);
     $celular    = trim($_GET['celular']);
     $nascimento = trim($_GET['nascimento']);
     $cpf        = trim($_GET['cpf']);
     $inscricao  = trim($_GET['inscricao']);
     $email      = strtolower(trim($_GET['email']));
     $veiculo    = strtoupper(trim($_GET['veiculo']));
     $marca      = strtoupper(trim($_GET['marca']));
     $placa      = strtoupper(trim($_GET['placa']));
     $ano        = trim($_GET['ano']);
     $comentario = strtoupper(trim($_GET['comentario']));  


     /*  EMPREGANDO MASCARA NO CPF/CNPJ  DEVIDO AO DIFICIL CONTROLE DE MASCARA NO FRONT END
         ESTA MASCARA SERÁ DEVOLVIDA NA ROTINA DE RELATORIO E PESQUISA - NOTA.: CASO SEJA NECESSÁRIO O ENVIO DO NÚMERO PARA ALGUMA
         TRATATIVA BANCÁRIA DEVERÁ SER REMOVIDA E ENVIADA SEM PONTOS, TRAÇOS E BARRA  */

       // COLEÇÃO DE MASCARA DINAMIPARA O INSCRIÇAO ESTADUAL       
       // MASCARA PARA O CPF
       function Mask_cpf($mask,$cpf)  
       {
            $cpf = str_replace(" ","",$cpf);
            for($i=0;$i<strlen($cpf);$i++)
            {
                $mask[strpos($mask,"#")] = $cpf[$i];
            }

            return $mask;
       }

       
       // MASCARA PARA O CNPJ
       function Mask_cnpj($mask,$cpf) 
       {
            $cpf = str_replace(" ","",$cpf);
            for($i=0;$i<strlen($cpf);$i++)
            {
                $mask[strpos($mask,"#")] = $cpf[$i];
            }

            return $mask;
       }


       // MASCARA PARA O INSCRIÇAO ESTADUAL
       function Mask_inscricao($mask,$inscricao) 
       {
            $inscricao = str_replace(" ","",$inscricao);
            for($i=0;$i<strlen($inscricao);$i++)
            {
                $mask[strpos($mask,"#")] = $inscricao[$i];
            }

            return $mask;
       }
//  ###   FINAL DE COLEÇÃO PARA MASCARA DINAMICA  ###  //


      // VERIFICA SE VEIO COM MASCARA OU SEM //
      $pos  = strpos($cpf,'.'); 

      if(empty($pos))// VERIFICA SE A VARIÁVEL ESTÁ LIVRE DE MASCARA //
      {
          // VERIFICA O TAMANHO DA STRING... SE FOR 11 ENTÃO É CPF E SE FOR 14 ENTÃO É CNPJ //
          $size = strlen($cpf); 
      }

      else
      {
          $ponto    = str_replace('.','',$cpf);// TRANTANDO A VARIÁVEL CPF, REMOVENDO PONTOS     
          $cpf      = str_replace('-','',$ponto);// TRANTANDO A VARIÁVEL CPF, REMOVENDO TRAÇOS     
          // VERIFICA O TAMANHO DA STRING... SE FOR 11 ENTÃO É CPF E SE FOR 14 ENTÃO É CNPJ //
          $size = strlen($cpf); 
      }

     

          

             if($size == 11)
             {
                    // ##  ROTINA PARA INSERIR PONTOS E TRACOS EM CPF  ## //
                     $cpf = Mask_cpf('###.###.###-##',$cpf);
                    // ##   FINAL DE ROTINA DE TRATAMENTO DE CPF  ###  //

                     $sql = mysql_query("UPDATE clientes SET cliNome = '$nome', cliCep = '$cep', cliEndereco = '$endereco', cliNumero = '$numero',cliBairro = '$bairro', cliCidade = '$cidade', cliTelefone = '$telefone', cliCelular = '$celular', cliDataNasc = '$nascimento', cliCPF = '$cpf', cliCNPJ = '', cliInscricao = '', cliRG = '$inscricao', cliEmail = '$email', cliComentario = '$comentario', cliDtUltAlteracao = '$data', cliVeiculo = '$veiculo', cliPlaca ='$placa', cliMarca = '$marca', cliAno = '$ano' WHERE cliCodigo LIKE '$codigo'");

                     if(empty($sql))
                     {
                         print 0;
                     }

                     else
                     {
                         print 1;
                     }
             }

             else if($size == 14)
             {
                     // ##  ROTINA PARA INSERIR PONTOS E TRACOS EM CPF  ## //
                     $cpf = Mask_cnpj('##.###.###/####-##',$cpf);
                     // ##   FINAL DE ROTINA DE TRATAMENTO DE CPF  ###  //

                     $sql = mysql_query("UPDATE clientes SET cliNome = '$nome', cliCep = '$cep', cliEndereco = '$endereco', cliNumero = '$numero',cliBairro = '$bairro', cliCidade = '$cidade', cliTelefone = '$telefone', cliCelular = '$celular', cliDataNasc = '$nascimento', cliCPF = '', cliCNPJ = '$cpf', cliInscricao = '$inscricao', cliRG = '', cliEmail = '$email', cliComentario = '$comentario', cliDtUltAlteracao = '$data', cliVeiculo = '$veiculo', cliPlaca ='$placa', cliMarca = '$marca', cliAno = '$ano' WHERE cliCodigo LIKE '$codigo'");

                     if(empty($sql))
                     {
                         print 0;
                     }

                     else
                     {
                         print 1;
                     }
             }

             else
             {
                  // ##  ROTINA PARA INSERIR PONTOS E BARRA EM CNPJ E INSCRIÇÃO ESTADUAL ## //
                    $cpf       = '000.000.000-00';
                    $cnpj      = '00.000.000/0000-00';
                    $inscricao = '000.000.000.000';
                    $rg        = '00.000.000-0';

                    // ##   FINAL DE ROTINA DE TRATAMENTO DE CNPJ E INSCRIÇÃO ESTADUAL  ###  //

                
                    $sql = mysql_query("UPDATE clientes SET cliNome = '$nome', cliCep = '$cep', cliEndereco = '$endereco', cliNumero = '$numero', cliBairro = '$bairro', cliCidade = '$cidade', cliTelefone = '$telefone', cliCelular = '$celular', cliDataNasc = '$nascimento', cliCPF = '$cpf', cliCNPJ = '$cnpj', cliInscricao = '$inscricao', cliRG = '$rg', cliEmail = '$email', cliComentario = '$comentario', cliDtUltAlteracao = '$data', cliVeiculo = '$veiculo', cliPlaca = '$placa', cliMarca = '$marca', cliAno = '$ano' WHERE cliCodigo LIKE '$codigo'");

                     if(empty($sql))
                     {
                        print 0;
                     }

                     else
                     {
                        print 1;
                     }
              }
?>     