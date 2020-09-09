<?php

require_once(__DIR__ . '/../../db/Db.php');
require_once(__DIR__ . '/../../model/Fornecedor.php');
require_once(__DIR__ . '/../../dao/DaoFornecedor.php');
require_once(__DIR__ . '/../../config/config.php');

$conn = Db::getInstance();

if (! $conn->connect()) {
    die();
}

$daoFornecedor = new DaoFornecedor($conn);
$daoFornecedor->inserir( new Fornecedor($_POST['nome'], $_POST['endereco'], $_POST['telefone'], $_POST['categoria'], $_POST['cidade'], $_POST['estado']));
    
header('Location: ./index.php');

?>


