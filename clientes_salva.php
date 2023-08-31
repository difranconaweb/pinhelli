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

     $data = Date('d/m/Y');
     $hora = Date('H:i:s');
 

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
    
     
     /*  EMPREGANDO MASCARA NO CPF/CNPJ  DEVIDO AO DIFICIL CONTROLE DE MASCARA NO FRONT END
         ESTA MASCARA SERÁ DEVOLVIDA NA ROTINA DE RELATORIO E PESQUISA - NOTA.: CASO SEJA NECESSÁRIO O ENVIO DO NÚMERO PARA ALGUMA
         TRATATIVA BANCÁRIA DEVERÁ SER REMOVIDA E ENVIADA SEM PONTOS, TRAÇOS E BARRA  */
      
      
// COLEÇÃO DE MASCARA DINAMICA PARA A INSCRIÇAO ESTADUAL       
       // MASCARA PARA O CPF

// VERIFICA O TAMANHO DA STRING... SE FOR 11 ENTÃO É CPF E SE FOR 14 ENTÃO É CNPJ //
         $size = strlen($cpf);
         
        if($size == 11)
        {
         /* ##  PRIMEIRO INSERE A MASCARA PARA O CPF ## */
                   function Mask_cpf($mask,$cpf)  
                   {
                        $cpf = str_replace(" ","",$cpf);
                        for($i=0;$i<strlen($cpf);$i++)
                        {
                            $mask[strpos($mask,"#")] = $cpf[$i];
                        }

                        return $mask;
                   }

                   // ### VERIFICA SE O CLIENTE JÁ ESTÁ CADASTRADO COM A PLACA INFORMADA  ### //
                   $check = mysql_query("SELECT cliPlaca FROM clientes WHERE cliPlaca LIKE '$placa'");
                   while($ob = mysql_fetch_array($check))
                   {
                       $register = $ob['cliPlaca'];
                   }


                   // ##   NÃO HAVENDO REGISTRO NA TABELA COM A PLACA INFORMADA, SALVA!  ### //
                   if(empty($register))
                   {
                       // ##  ROTINA PARA INSERIR PONTOS E TRACOS EM CPF  ## //
                       if(empty($cpf))
                       {//  ESTE CAMPO FOI CRIADO PORQUE A MASCARA NÃO ACEITA CAMPO VÁZIO //
                            $cpf = '000.000.000-00';
                            $incricao = '00.000.000-0';

                        //  ESTANDO TUDO CERTO E NÃO HAVENDO AINDA NENHUM REGISTRO COM A PLACA, SALVA O NOVO REGISTRO NA TABELA //
                            $sql = mysql_query("INSERT INTO clientes (cliNome,cliCep,cliEndereco,cliNumero,cliBairro,cliCidade,cliTelefone,cliCelular,cliDataNasc,
                            cliCPF,cliRG,cliEmail,cliData,cliHora,cliveiculo,cliPlaca,cliMarca,cliAno) VALUES ('$nome','$cep',$endereco','$numero','$bairro','$cidade','$telefone','$celular','$nascimento','$cpf','$inscricao','$email','$comentario','$data','$hora','$veiculo','$placa','$marca','$ano')");

                          // ##  APÓS SALVAR O REGISTRO DO NOVO CLIENTE, BUSCA O ID DO CLIENTE PARA SALVAR NA TABELA DE PLACA ## //
                               $_sql = mysql_query("SELECT cliCodigo FROM clientes");
                               while($obj = mysql_fetch_array($_sql))
                               {
                                    $id = $obj['cliCodigo'];
                               }
                          // ##  FINAL DA BUSCA DO ID DO CLIENTE ## //
                          // ## ROTINA PARA INSERIR A PLACA COM O ID DO CLIENTE NA TABELA DE PLACAS ## //
                               mysql_query("INSERT INTO placas (plaPlaca, plaCliente_fk, plaData, plaHorario) VALUES ('$placa','$id','$data','$hora')");
                               
                          // ##  FINAL DE ROTINA ## //
                       }

                       else
                       {
                           $cpf = Mask_cpf('###.###.###-##',$cpf);
                           // ##   FINAL DE ROTINA DE TRATAMENTO DE CPF  ###  //

                           //  ESTANDO TUDO CERTO E NÃO HAVENDO AINDA NENHUM REGISTRO COM A PLACA, SALVA O NOVO REGISTRO NA TABELA //
                            $sql = mysql_query("INSERT INTO clientes (cliNome,cliCep,cliEndereco,cliNumero,cliBairro,cliCidade,cliTelefone,cliCelular,cliDataNasc,
                            cliCPF,cliRG,cliEmail,cliData,cliHora,cliveiculo,cliPlaca,cliMarca,cliAno) VALUES ('$nome','$cep','$endereco','$numero','$bairro','$cidade','$telefone','$celular','$nascimento','$cpf','$inscricao','$email','$data','$hora','$veiculo','$placa','$marca','$ano')");

                          // ##  APÓS SALVAR O REGISTRO DO NOVO CLIENTE, BUSCA O ID DO CLIENTE PARA SALVAR NA TABELA DE PLACA ## //
                               $_sql = mysql_query("SELECT cliCodigo FROM clientes");
                               while($obj = mysql_fetch_array($_sql))
                               {
                                    $id = $obj['cliCodigo'];
                               }
                          // ##  FINAL DA BUSCA DO ID DO CLIENTE ## //
                          // ## ROTINA PARA INSERIR A PLACA COM O ID DO CLIENTE NA TABELA DE PLACAS ## //
                               mysql_query("INSERT INTO placas (plaPlaca, plaCliente_fk, plaData, plaHorario) VALUES ('$placa','$id','$data','$hora')");
                               
                          // ##  FINAL DE ROTINA ## //
                       }
                       

                         if(empty($sql))
                         {
                            print 0;
                         }

                         else
                         {
                            print 1;
                         }
                   }

                   else //  SE ENTRAR NESTE BLOCO, ENTÃO PORQUE JÁ CONSTA REGISTRO NA TABELA //
                   {
                        print 2;
                   }

                   

        }

        else if($size == 14)
        {
         // ##  MASCARA PARA O CNPJ  ### //
                  function mask($val, $mask)
                  {
                     $maskared = '';
                     $k = 0;
                     for($i = 0; $i<=strlen($mask)-1; $i++)
                     {
                        if($mask[$i] == '#')
                        {
                          if(isset($val[$k]))
                              $maskared .= $val[$k++];
                        }

                        else
                        {
                            if(isset($mask[$i]))
                                    $maskared .= $mask[$i];
                        }  
                     }

                     return $maskared;

                  }

                   // MASCARA PARA O INSCRIÇAO ESTADUAL
                  /* function Mask_inscricao($mask,$inscricao) 
                   {
                        $inscricao = str_replace(" ","",$inscricao);
                        for($i=0;$i<strlen($inscricao);$i++)
                        {
                            $mask[strpos($mask,"#")] = $inscricao[$i];
                        }

                        return $mask;
                   } */


                   // ### VERIFICA SE O CLIENTE JÁ ESTÁ CADASTRADO COM A PLACA INFORMADA  ### //
                   $check = mysql_query("SELECT cliPlaca FROM clientes WHERE cliPlaca LIKE '$placa'");
                   while($ob = mysql_fetch_array($check))
                   {
                       $register = $ob['cliPlaca'];
                   }


                   // ##   NÃO HAVENDO REGISTRO NA TABELA COM A PLACA INFORMADA, SALVA!  ### //
                   if(empty($register))
                   {
                                // ##  ROTINA PARA INSERIR PONTOS E BARRA EM CNPJ E INSCRIÇÃO ESTADUAL ## //
                                if(empty($cpf))
                                {//  ESTE CAMPO FOI CRIADO PORQUE A MASCARA NÃO ACEITA CAMPO VÁZIO //
                                     $cpf = '00.000.000/0000-00';
                                     $incricao = '000.000.000.000';

                                     $sql = mysql_query("INSERT INTO clientes (cliNome,cliCep,cliEndereco,cliNumero,cliBairro,cliCidade,cliTelefone,cliCelular,cliDataNasc,
                                    cliCNPJ,cliInscricao,cliEmail,cliData,cliHora,cliVeiculo,cliPlaca,cliMarca,cliAno) VALUES ('$nome','$cep','$endereco','$numero','$bairro','$cidade','$telefone','$celular','$nascimento','$cpf','$inscricao','$email','$data','$hora','$veiculo','$placa','$marca','$ano')");

                                     // ##  APÓS SALVAR O REGISTRO DO NOVO CLIENTE, BUSCA O ID DO CLIENTE PARA SALVAR NA TABELA DE PLACA ## //
                                     $_sql = mysql_query("SELECT cliCodigo FROM clientes");
                                     while($obj = mysql_fetch_array($_sql))
                                     {
                                          $id = $obj['cliCodigo'];
                                     }
                                    // ##  FINAL DA BUSCA DO ID DO CLIENTE ## //
                                    // ## ROTINA PARA INSERIR A PLACA COM O ID DO CLIENTE NA TABELA DE PLACAS ## //
                                     mysql_query("INSERT INTO placas (plaPlaca, plaCliente_fk, plaData, plaHorario) VALUES ('$placa','$id','$data','$hora')");
                                    // ##  FINAL DE ROTINA ## //
                                }

                                else
                                {
                                    $cpf       = mask($cpf,'##.###.###/####-##');
// ### FECHADO MOMENTANEAMENTE                                   // $inscricao = Mask_inscricao('###.###.###.###');// 
                                    // ##   FINAL DE ROTINA DE TRATAMENTO DE CNPJ E INSCRIÇÃO ESTADUAL  ###  //

                                    $sql = mysql_query("INSERT INTO clientes (cliNome,cliCep,cliEndereco,cliNumero,cliBairro,cliCidade,cliTelefone,cliCelular,cliDataNasc,
                                    cliCNPJ,cliInscricao,cliEmail,cliData,cliHora,cliVeiculo,cliPlaca,cliMarca,cliAno) VALUES ('$nome','$cep','$endereco','$numero','$bairro','$cidade','$telefone','$celular','$nascimento','$cpf','$inscricao','$email','$data','$hora','$veiculo','$placa','$marca','$ano')");


                                    // ##  APÓS SALVAR O REGISTRO DO NOVO CLIENTE, BUSCA O ID DO CLIENTE PARA SALVAR NA TABELA DE PLACA ## //
                                     $_sql = mysql_query("SELECT cliCodigo FROM clientes");
                                     while($obj = mysql_fetch_array($_sql))
                                     {
                                          $id = $obj['cliCodigo'];
                                     }
                                    // ##  FINAL DA BUSCA DO ID DO CLIENTE ## //
                                    // ## ROTINA PARA INSERIR A PLACA COM O ID DO CLIENTE NA TABELA DE PLACAS ## //
                                     mysql_query("INSERT INTO placas (plaPlaca, plaCliente_fk, plaData, plaHorario) VALUES ('$placa','$id','$data','$hora')");
                                    // ##  FINAL DE ROTINA ## //
                                }
                                

                                 if(empty($sql))
                                 {
                                    print 0;
                                 }

                                 else
                                 {
                                    print 1;
                                 }
                   }

                   else  //  SE ENTRAR NESTE BLOCO, ENTÃO PORQUE JÁ CONSTA REGISTRO NA TABELA //
                   {
                        print 2;
                   }
        }
 
        else
        {

                // ### VERIFICA SE O CLIENTE JÁ ESTÁ CADASTRADO COM A PLACA INFORMADA  ### //
                $check = mysql_query("SELECT cliPlaca FROM clientes WHERE cliPlaca LIKE '$placa'");
                while($ob = mysql_fetch_array($check))
                {
                    $register = $ob['cliPlaca'];
                }


                // ##   NÃO HAVENDO REGISTRO NA TABELA COM A PLACA INFORMADA, SALVA!  ### //
                if(empty($register))
                {
                      // ##  ROTINA PARA INSERIR PONTOS E BARRA EM CNPJ E INSCRIÇÃO ESTADUAL ## //
                      $sql = mysql_query("INSERT INTO clientes (cliNome,cliCep,cliEndereco,cliNumero,cliBairro,cliCidade,cliTelefone,cliCelular,cliDataNasc,cliCPF,
                      cliCNPJ,cliInscricao,cliRG,cliEmail,cliData,cliHora,cliveiculo,cliPlaca,cliMarca,cliAno) VALUES ('$nome','$cep','$endereco','$numero','$bairro','$cidade','$telefone','$celular','$nascimento','000.000.000-00','00.000.000/0000-00','000.000.000.000','00.000.000-0','$email','$data','$hora','$veiculo','$placa','$marca','$ano')");


                      // ##  APÓS SALVAR O REGISTRO DO NOVO CLIENTE, BUSCA O ID DO CLIENTE PARA SALVAR NA TABELA DE PLACA ## //
                                     $_sql = mysql_query("SELECT cliCodigo FROM clientes");
                                     while($obj = mysql_fetch_array($_sql))
                                     {
                                          $id = $obj['cliCodigo'];
                                     }
                                    // ##  FINAL DA BUSCA DO ID DO CLIENTE ## //
                                    // ## ROTINA PARA INSERIR A PLACA COM O ID DO CLIENTE NA TABELA DE PLACAS ## //
                                     mysql_query("INSERT INTO placas (plaPlaca, plaCliente_fk, plaData, plaHorario) VALUES ('$placa','$id','$data','$hora')");
                                    // ##  FINAL DE ROTINA ## //

                      if(empty($sql))
                      {
                          print 0;
                      }

                      else
                      {
                          print 1;
                                       
                      }
                }

                else  //  SE ENTRAR NESTE BLOCO, ENTÃO PORQUE JÁ CONSTA REGISTRO NA TABELA //
                {
                    print 2;
                } 
        }
?>     