<?php

  session_start();
  $assunto = $_POST['nTema'];
  $mensagem = $_POST['nDescricao'];
  $email_contatos = $_POST['marcar'];
  $email = 'carina-moveis@gmail.com';
?>

<?php

  include "../../includes/conexao.php";
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
      } else {
          //salva envio
          $sql = "INSERT INTO mala_direta (`ID_TipoAssuntoMalaDireta`,`EMAILDESTINO_MalaDireta`,`INFORMACAO_MalaDireta`)VALUES(" . $_POST["nTema"] . ",'" . $contato . "','" . $_POST["nDescricao"] . "')";
          $resultado = $conn->query($sql);
      }
  }
  $telaResp = isset($_POST['nDescricaoResp']) ? true : false;
  if ($error == null) {
      header("location:../php/result_mala_direta.php?envio=sucesso&resp = " . $telaResp . "");
  } else {
      header("location:../php/result_mala_direta.php?envio=erro&resp = " . $telaResp . "");
  }
  session_abort();
?>
  