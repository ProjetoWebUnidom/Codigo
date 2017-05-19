<?php

  define('FPDF_FONTPATH', '../pdf/font/');
  require ('pdf/fpdf.php');
  include "../../includes/conexao.php";

  function formataCPF($cpf) {

      if (strlen($cpf) < 11) {
          $cpf = str_pad($cpf, 11, "0", STR_PAD_LEFT);
      }
      $prt1 = substr($cpf, 0, 3);
      $prt2 = substr($cpf, 3, 3);
      $prt3 = substr($cpf, 6, 3);
      $prt4 = substr($cpf, 9);
      $cpf = $prt1 . '.' . $prt2 . '.' . $prt3 . '-' . $prt4;
      return $cpf;
  }


  $pdf = new FPDF('L', 'cm', 'A4');
  $pdf->SetFont('arial', '', 0);
  $pdf->AddPage();
  $pdf->SetTitle('Relatório de Clientes', true);
        $sql = "SELECT CPF_Cliente,
	NOME_Cliente,
        DTNASC_Cliente AS DATA_NASC, 
        UF_Cliente, 
        CIDADE_Cliente, 
        BAIRRO_Cliente,
        EMAIL_Cliente,
        DDD_Telefone,
        NUMERO_Telefone FROM cliente
        INNER join telefone_cliente ON (cliente.ID_Cliente = telefone_cliente.ID_Cliente)";

  $resultado = $conn->query($sql);

  $pdf->SetX(1.9);
  $pdf->Cell(26.5, 0, '', 0, 1, 'C', true);
  $pdf->Ln();
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFontSize(10);
  $pdf->SetXY(2.5, 2);
  $pdf->SetFont('times', 'B', 35);
  $title = utf8_decode('Karina Modulados');
  $pdf->Cell(24.5, 1, '. ' . $title . ' .', 0, 1, 'C');
  $pdf->Ln();
  $pdf->SetXY(1.9, 3.5);
  $pdf->SetFont('times', '', 15);
  $title = utf8_decode(' -- Móveis Planejados --');
  $pdf->Cell(24.5, 0, $title, 0, 1, 'C');
  $pdf->SetTextColor(169, 169, 169);
  $pdf->SetXY(1.9, 4);
  $pdf->Cell(26.5, 0, '', 0, 1, 'C', true);
  $pdf->Ln();
  $pdf->SetFontSize(11);
  $pdf->SetFont('times', 'B', 35);
  $pdf->SetTextColor(220, 220, 220);
  $pdf->SetXY(1.9, 5);
  $title = utf8_decode('. Clientes Cadastrados');
  $pdf->Cell(8, 2, $title, 0, 1, 'L');


  $pdf->SetX(2);
  $pdf->SetFont('arial', 'B', 15);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFontSize(10);
  $pdf->SetFillColor(211, 211, 211);
  $pdf->Cell(1, 0.5, '#', 1, 0, 'C', true);
  $pdf->Cell(3, 0.5, 'CPF', 1, 0, 'C', true);
  $pdf->Cell(6, 0.5, 'Nome', 1, 0, 'C', true);
  $pdf->Cell(2.5, 0.5, 'Nascimento', 1, 0, 'C', true);
  $pdf->Cell(3, 0.5, 'Telefone', 1, 0, 'C', true);
  $pdf->Cell(4, 0.5, 'Cidade/Estado', 1, 0, 'C', true);
  $pdf->Cell(6, 0.5, 'E-mail', 1, 1, 'C', true);
  

  $rowAtual = 0;
  if ($resultado->num_rows > 0) {
      $indice = 0;
      $pdf->SetFont('arial', '', 15);
      $pdf->SetTextColor(0, 0, 0);
      $pdf->SetFontSize(10);
      $pdf->Ln(0.5);
      while ($row = $resultado->fetch_assoc()) {
          $pdf->SetX(2);
          if ($row["CPF_Cliente"] != $rowAtual) {
              $row['CPF_Cliente'] = formataCPF($row['CPF_Cliente']);
              $pdf->Cell(1, 1, $indice, 1, 0, 'C', true);
              $pdf->Cell(3, 1, $row['CPF_Cliente'], 1, 0, 'C');
              $pdf->Cell(6, 1, $row['NOME_Cliente'], 1, 0, 'C');
              $pdf->Cell(2.5, 1, $row['DATA_NASC'], 1, 0, 'C');
              $pdf->Cell(3, 1, '(' . $row['DDD_Telefone'] . ') ' . $row['NUMERO_Telefone'], 1, 0, 'C');
              $pdf->Cell(4, 1, $row['CIDADE_Cliente'] . ' - ' . $row['UF_Cliente'], 1, 0, 'C');
              $pdf->Cell(6, 1, $row['EMAIL_Cliente'], 1, 1, 'C');
          }
          $indice++;
          $rowAtual = $row["CPF_Cliente"];
      }
  }
  $pdf->SetY(8);
  $pdf->SetFont('Arial', 'I', 8);
  $pdf->SetTextColor(128);
  $pdf->Cell(0, 10,  $pdf->PageNo(), 0, 0, 'C');
  $conn->close();
  $pdf->Output();
?>