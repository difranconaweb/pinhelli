<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 06MAI19
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 06MAI19
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 06MAI19

  
     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA  03AGO19 - RES000101/13BR
                                                                    (19)3017-3460
                                                                    (19)99272-0159
                                                                    (19)99751-7645


     ARQUIVO PARA ENVIO DE EMAIL  */
     require 'Utilidades/conexao.php'; // CHAMA O ARQUIVO DE CONEXÃO //

     $dt = Date('d/m/Y');
     $hr = Date('H:i:s');


     $nome    = trim(strtoupper($_GET['fname']));
     $sobre   = trim(strtoupper($_GET['lname']));
     $email   = trim(strtolower($_GET['email']));
     $assunto = trim(strtoupper($_GET['assunto']));
     $message = trim(strtoupper($_GET['message']));
     
     $nome    = $nome." ".$sobre;

     /* ####  INSERE OS DADOS NA TABELA PARA REGISTRAR O E-MAIL   #####  */
     $sql = mysqli_query($conecta,"INSERT INTO email_fotos (efoNome, efoEmail, efoAssunto, efoMessage, efoData, efoHorario) VALUES ('$nome','$email','$assunto','$message','$dt','$hr')");

     if(empty($sql))
     {
     	  print 0;
     }

     else
     {
	     	 //  ESTE BLOCO CONSISTE NO ENVIO DA SENHA PARA O USUÁRIO //
	         $email_remetente = "contato@elitesporte.com.br"; // DEVE SER UM EMAIL DO DOMÍNIO //
	    
	         $to      = 'contato@elitesporte.com.br,'.$email; //  INSERE A VARIÁVEL QUE VEM COM O EMAIL DO COMPRADOR
	         $subject = "CONTATO";



	  

	         $cabecario .= "MIME-Version: 1.0" . "\r\n";
	         $cabecario .= "Content-type: text/html; charset=iso-8859-1;" . "\r\n";

      

			      $objContent[0] .= "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>"."</br>";
			      $objContent[0] .= "<html style='width:100%;font-family:arial, 'helvetica neue', helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;'>"."</br>";
			      $objContent[0] .= "<head>"."</br>";
			      $objContent[0] .= "<meta charset='UTF-8'>"."</br>";
			      $objContent[0] .= "<meta content='width=device-width, initial-scale=1' name='viewport'>"."</br>";
			      $objContent[0] .= "<meta name='x-apple-disable-message-reformatting'>"."</br>";
			      $objContent[0] .= "<meta http-equiv='X-UA-Compatible' content='IE=edge'>"."</br>";
			      $objContent[0] .= "<meta content='telephone=no' name='format-detection'>"."</br>"; 
			      $objContent[0] .= "<title>New email</title>"."</br>";
			      $objContent[0] .= "<!--[if (mso 16)]>"."</br>";
			      $objContent[0] .= "<style type='text/css'>"."</br>";
			      $objContent[0] .= "a {text-decoration: none;}"."</br>";
			      $objContent[0] .= "</style>"."</br>";
			      $objContent[0] .= "<![endif]-->"."</br>";
			      $objContent[0] .= "<!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->"."</br>";
			      $objContent[0] .= "<style type='text/css'>"."</br>";
			      $objContent[0] .= "@media only screen and (max-width:600px) {p, ul li, ol li, a { font-size:16px!important; line-height:150%!important } h1 { font-size:30px!important; text-align:center; line-height:120%!important } h2 { font-size:26px!important; text-align:center; line-height:120%!important } h3 { font-size:20px!important; text-align:center; line-height:120%!important } h1 a { font-size:30px!important } h2 a { font-size:26px!important } h3 a { font-size:20px!important } .es-menu td a { font-size:16px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:16px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class='gmail-fix'] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } a.es-button { font-size:20px!important; display:block!important; border-width:10px 0px 10px 0px!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } .es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } .es-desk-menu-hidden { display:table-cell!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } }"."</br>";
			      $objContent[0] .= "#outlook a {padding:0;}.ExternalClass {width:100%;}.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div {line-height:100%;}.es-button {mso-style-priority:100!important;text-decoration:none!important;}a[x-apple-data-detectors] {color:inherit!important;text-decoration:none!important;font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;line-height:inherit!important;}.es-desk-hidden {display:none;float:left;overflow:hidden;width:0;max-height:0;line-height:0;
			      mso-hide:all;}"."</br>";
			      $objContent[0] .= "</style>"."</br>";
			      $objContent[0] .= "</head>"."</br>";
			      $objContent[0] .= "<body style='width:100%;font-family:arial, 'helvetica neue', helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;'>"."</br>";
			      $objContent[0] .= "<div class='es-wrapper-color' style='background-color:#F6F6F6;'>"."</br>";
			      $objContent[0] .= "<!--[if gte mso 9]>"."</br>";
			      $objContent[0] .= "<v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'>"."</br>";
			      $objContent[0] .= "<v:fill type='tile' color='#f6f6f6'></v:fill>"."</br>";
			      $objContent[0] .= "</v:background>"."</br>";
			      $objContent[0] .= "<![endif]-->"."</br>";
			      $objContent[0] .= "<table cellpadding='0' cellspacing='0' class='es-wrapper' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;'>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td valign='top' style='padding:0;Margin:0;'>"."</br>";
			      $objContent[0] .= "<table cellpadding='0' cellspacing='0' class='es-content' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;'>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td align='center' style='padding:0;Margin:0;'>"."</br>";
			      $objContent[0] .= "<table class='es-content-body' align='center' cellpadding='0' cellspacing='0' width='600' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;'>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td align='left' style='padding:20px;Margin:0;'>"."</br>"; 
			      $objContent[0] .= "<!--[if mso]><table width='560'><tr><td width='356' valign='top'><![endif]-->"."</br>";
			      $objContent[0] .= "<table cellpadding='0' cellspacing='0' class='es-left' align='left' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;'>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td width='356' class='es-m-p0r es-m-p20b' valign='top' align='center' style='padding:0;Margin:0;'>"."</br>";
			      $objContent[0] .= "<table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td align='left' class='es-infoblock es-m-txt-c' style='padding:0;Margin:0;line-height:14px;font-size:12px;color:#CCCCCC;'> <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:12px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:14px;color:#CCCCCC;'> ".$prova." <br></p> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "</table> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "</table>"."</br>";
			      $objContent[0] .= "<!--[if mso]></td><td width='20'></td><td width='184' valign='top'><![endif]-->"."</br>";
			      $objContent[0] .= "<table cellpadding='0' cellspacing='0' align='right' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td width='184' align='left' style='padding:0;Margin:0;'>"."</br>";
			      $objContent[0] .= "<table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td align='center' style='padding:0;Margin:0;display:none;'></td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "</table> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "</table>"."</br>";
			      $objContent[0] .= "<!--[if mso]></td></tr></table><![endif]--> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "</table> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "</table>"."</br>";
			      $objContent[0] .= "<table cellpadding='0' cellspacing='0' class='es-content' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;'>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td align='center' style='padding:0;Margin:0;'>"."</br>";
			      $objContent[0] .= "<table class='es-content-body' align='center' cellpadding='0' cellspacing='0' width='600' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;'>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td align='left' style='padding:20px;Margin:0;'>"."</br>"; 
			      $objContent[0] .= "<table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td width='560' align='center' valign='top' style='padding:0;Margin:0;'>"."</br>";
			      $objContent[0] .= "<table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td align='left' style='padding:0;Margin:0;padding-bottom:15px;'> <h2 style='Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#333333;'>OBRIGADO PELA SUA MENSAGEM</h2> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td align='center' style='padding:0;Margin:0;'> <img class='adapt-img' src='http://www.elitesporte.com.br/img/carta.jpg' alt='' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;' width='560' height='182'></td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td align='left' style='padding:0;Margin:0;padding-top:20px;'> <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;'>Seu e-mail ser&aacute; respondido o quanto antes!</p> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "</table> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "</table> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td align='left' style='Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px;'>"."</br>";
			      $objContent[0] .= "<!--[if mso]><table width='560'><tr><td width='270' valign='top'><![endif]-->"."</br>";
			      $objContent[0] .= "<table cellpadding='0' cellspacing='0' class='es-left' align='left' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;'>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td width='270' class='es-m-p20b' align='left' style='padding:0;Margin:0;'>"."</br>";
			      $objContent[0] .= "<table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'>"."</br>";
			     
			      $objContent[0] .= "</table> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "</table>"."</br>";
			      $objContent[0] .= "<!--[if mso]></td><td width='20'></td><td width='270' valign='top'><![endif]-->"."</br>";
			      $objContent[0] .= "<table cellpadding='0' cellspacing='0' class='es-right' align='right' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;'>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td width='270' align='left' style='padding:0;Margin:0;'>"."</br>";
			      $objContent[0] .= "<table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td align='center' style='padding:0;Margin:0;display:none;'></td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "</table> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "</table>"."</br>";
			      $objContent[0] .= "<!--[if mso]></td></tr></table><![endif]--> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "</table> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "</table>"."</br>";
			      $objContent[0] .= "<table cellpadding='0' cellspacing='0' class='es-footer' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;'>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td align='center' style='padding:0;Margin:0;'>"."</br>";
			      $objContent[0] .= "<table class='es-footer-body' align='center' cellpadding='0' cellspacing='0' width='600' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;'>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td align='left' style='padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;'>"."</br>";
			      $objContent[0] .= "<table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td width='560' align='center' valign='top' style='padding:0;Margin:0;'>"."</br>";
			      $objContent[0] .= "<table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td align='center' style='padding:20px;Margin:0;'>"."</br>";
			      $objContent[0] .= "<table border='0' width='75%' height='100%' cellpadding='0' cellspacing='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td style='padding:0;Margin:0px 0px 0px 0px;border-bottom:1px solid #CCCCCC;background:none;height:1px;width:100%;margin:0px;'> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "</table> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td align='center' style='padding:0;Margin:0;padding-top:10px;padding-bottom:10px;'> <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:11px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:17px;color:#333333;'>ELITE ESPORTE&nbsp; ATIVIDADE E SA&Uacute;DE</p> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "<tr style='border-collapse:collapse;'>"."</br>";
			      $objContent[0] .= "<td align='center' style='padding:0;Margin:0;padding-top:10px;padding-bottom:10px;'> <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:11px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:17px;color:#333333;'>&copy; 2019 - www.elitesporte.com.br</p> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "</table> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "</table> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "</table> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "</table> </td>"."</br>";
			      $objContent[0] .= "</tr>"."</br>";
			      $objContent[0] .= "</table>"."</br>";
			      $objContent[0] .= "</div>"."</br>";
			      $objContent[0] .= "</body>"."</br>";
			      $objContent[0] .= "</html>"."</br>";


			            for ( $i = 0; $i < count( $objContent ); $i++ )
			            {
			                 $body_message = utf8_decode($objContent[0]);

			            }



			   //SETA OS HEADERS (ALTERAR SOMENTE CASO NECESSÁRIO)
			   //====================================================
			      $email_headers = implode ( "\n",array ( "From: $email_remetente", "Reply-To: $email_remetente", "Return-Path:  $email_remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );
			   // ==================================================== //
			      mail($to, $subject, $body_message, $email_headers);
			 
			      print 1;
    }
?>