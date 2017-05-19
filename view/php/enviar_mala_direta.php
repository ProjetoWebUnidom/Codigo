<?php

  session_start();
  var_dump($_POST);
  $assunto = $_POST['nTema'];
  $mensagem = $_POST['nDescricao'];
  $email_contatos = $_POST['marcar'];
  $email = 'carina-moveis@gmail.com';
?>

<?php

  $error = array();
  foreach ($email_contatos as $key => $contato) {
      $to = $contato;
      $subject = "$assunto";
      $mensage = "<strong>E-mail:</strong>$email<br /><br /><strong>Mensagem:</strong>$mensagem<br /><br />";
      $header = "MIME-Version: 1.0\n";
      $header .= "Content-type: text/html; charset=iso-88559-1\n";
      $header .= "From: $email\n";
//      $envio = mail($to, $subject, $mensage, $header);
      $envio = true;
      if (!$envio) {
          $error[] = $contato;
      }
  }
  if ($error == null) {
      header("location:../php/result_mala_direta.php?envio=sucesso");
  } else {
      header("location:../php/result_mala_direta.php?envio=erro");
  }
  session_abort();
?>
  