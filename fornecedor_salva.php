<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645

     ARQUIVO PARA SALVAR REGISTRO DE FORNECEDOR */
     require 'Utilidades/conexao.php';

       $data = Date('d/m/Y');
 

        $razao      = strtoupper(trim($_GET['razao']));
        $fantasia   = strtoupper(trim($_GET['fantasia']));
        $cep        = strtoupper(trim($_GET['cep']));
        $endereco   = strtoupper(trim($_GET['endereco']));
        $numero     = strtoupper(trim($_GET['numero']));
        $cidade     = strtoupper(trim($_GET['cidade']));
        $telefone   = trim($_GET['telefone']);
        $celular    = trim($_GET['celular']);
        $cnpj       = trim($_GET['cnpj']);
        $inscricao  = trim($_GET['inscricao']);
        $contato    = strtoupper(trim($_GET['contato']));
        $email      = strtolower(trim($_GET['email']));
        
        
           /*  $query = mysql_query("SELECT forCNPJ FROM fornecedores WHERE forCNPJ LIKE '$CNPJ'");
             while($obj = mysql_fetch_array($cnpj))
             {
                  $objCNPJ = $obj['forCNPJ'];
             }

             if($objCNPJ == $CNPJ)
             {
                  print 2;
             }

             else
             { */
                   $sql = mysql_query("INSERT INTO fornecedores (forRazao,forFantasia,forCep, forEndereco,forNumero,forCidade,forCNPJ,forInscricao,
                    forTelefone,forCelular,forResponsavel,forEmail,forData) VALUES ('$razao','$fantasia','$cep','$endereco','$numero','$cidade','$cnpj','$inscricao','$telefone','$celular','$contato','$email','$data')");

                   if(empty($sql))
                   {
                      print 0;
                   }

                   else
                   {
                      print 1;
                   } 
             //}
            
?>     