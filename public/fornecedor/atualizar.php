<?php

require_once(__DIR__ . '/../../templates/template-html.php');

require_once(__DIR__ . '/../../db/Db.php');
require_once(__DIR__ . '/../../model/Fornecedor.php');
require_once(__DIR__ . '/../../dao/DaoFornecedor.php');
require_once(__DIR__ . '/../../config/config.php');

$conn = Db::getInstance();

if (! $conn->connect()) {
    die();
}

$daoFornecedor = new DaoFornecedor($conn);
$fornecedor = $daoFornecedor->porId( $_POST['id'] );
    
if ( $fornecedor )
{  
  $fornecedor->setNome( $_POST['nome'] );
  $fornecedor->setEndereco( $_POST['endereco'] );
  $fornecedor->setCategoria( $_POST['categoria'] );
  $fornecedor->setTelefone( $_POST['telefone'] );
  $fornecedor->setCidade( $_POST['cidade'] );
  $fornecedor->setEstado( $_POST['estado'] );
  $daoFornecedor->atualizar( $fornecedor );
}

header('Location: ./index.php');