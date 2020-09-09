<?php 
require_once(__DIR__ . '/../model/Fornecedor.php');
require_once(__DIR__ . '/../db/Db.php');

// Classe para persistencia de Marcas 
// DAO - Data Access Object
class DaoFornecedor {
    
  private $connection;

  public function __construct(Db $connection) {
      $this->connection = $connection;
  }
  
  public function porId(int $id): ?Fornecedor {
    $sql = "SELECT nome, endereco, telefone,  categoria, cidade, estado FROM fornecedor where id = ?";
    $stmt = $this->connection->prepare($sql);
    $dep = null;
    if ($stmt) {
      $stmt->bind_param('i',$id);
      if ($stmt->execute()) {
        $stmt->bind_result($nome, $endereco,$telefone,$categoria,$cidade,$estado);
        $stmt->store_result();
        if ($stmt->num_rows == 1 && $stmt->fetch()) {
          $dep = new Fornecedor($nome, $endereco,$telefone,$categoria,$cidade,$estado, $id);
        }
      }
      $stmt->close();
    }
    return $dep;
  }

  public function inserir(Fornecedor $fornecedor): bool {
    $sql = "INSERT INTO fornecedor (nome, endereco, telefone,  categoria, cidade, estado) VALUES(?, ?, ?, ?, ?, ?)";
    $stmt = $this->connection->prepare($sql);
    $res = false;
    if ($stmt) {
      $nome = $fornecedor->getNome();
      $endereco = $fornecedor->getEndereco();
      $telefone = $fornecedor->getTelefone();
      $categoria = $fornecedor->getCategoria();
      $cidade = $fornecedor->getCidade();
      $estado = $fornecedor->getEstado();
      $stmt->bind_param('sdiasw', $nome, $endereco, $telefone, $categoria,  $cidade, $estado);
      if ($stmt->execute()) {
          $id = $this->connection->getLastID();
          $fornecedor->setId($id);
          $res = true;
      }
      $stmt->close();
    }
    return $res;
  }

  public function remover(Fornecedor $fornecedor): bool {
    $sql = "DELETE FROM fornecedor where id=?";
    $id = $fornecedor->getId(); 
    $stmt = $this->connection->prepare($sql);
    $ret = false;
    if ($stmt) {
      $stmt->bind_param('i',$id);
      $ret = $stmt->execute();
      $stmt->close();
    }
    return $ret;
  }

  public function atualizar(Fornecedor $fornecedor): bool {
    $sql = "UPDATE fornecedor SET nome = ?, endereco = ?, telefone = ?, categoria = ?, cidade = ?, estado = ? WHERE id = ?";
    $stmt = $this->connection->prepare($sql);
    $ret = false;      
    if ($stmt) {
      $id   = $fornecedor->getId();
      $nome = $fornecedor->getNome();
      $endereco = $fornecedor->getEndereco();
      $telefone = $fornecedor->getTelefone();
      $categoria = $fornecedor->getCategoria();
      $cidade = $fornecedor->getCidade();
      $estado = $fornecedor->getEstado();
      $stmt->bind_param('sdiiiii', $nome, $endereco, $telefone, $categoria,  $cidade, $estado,  $id);
      $ret = $stmt->execute();
      $stmt->close();
    }
    return $ret;
  }

  
  public function todos(): array {
    $sql = "SELECT id, nome, endereco, telefone,  categoria, cidade, estado from fornecedor";
    $stmt = $this->connection->prepare($sql);
    $fornecedor = [];
    if ($stmt) {
      if ($stmt->execute()) {
        $id = 0; 
        $nome = '';
        $endereco = '';
        $telefone = '';
        $categoria = '';
        $cidade = '';
        $estado = '';
        $stmt->bind_result($id, $nome, $endereco, $telefone,  $categoria, $cidade, $estado);
        $stmt->store_result();
        while($stmt->fetch()) {
          $fornecedor[] = new Fornecedor($nome, $endereco, $telefone,  $categoria, $cidade, $estado, $id);
        }
      }
      $stmt->close();
    }
    return $fornecedor;
  }

};

