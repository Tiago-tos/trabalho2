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
$fornecedor = $daoFornecedor->porId( $_GET['id'] );
    
if (! $fornecedor )
    header('Location: ./index.php');

else {  
    ob_start();

?>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Cadastro de Fornecedores</h2>
        </div>
        <div class="row">
            <div class="col-md-12" >

              <form action="atualizar.php" class="card p-2 my-4" method="POST">
                  <div class="input-group">
                      <input type="hidden" name="id" 
                          value="<?php echo $fornecedor->getId(); ?>">                      

                          <input type="text" placeholder="Nome do Fornecedor" 
                          value="<?php echo $fornecedor->getNome(); ?>"
                          class="form-control" name="nome" required>

                        <input type="text" placeholder="Endereço" 
                        value="<?php echo $fornecedor->getEndereco(); ?>"
                            class="form-control" name="endereco" required>
                
                        <input type="text" placeholder="Telefone" 
                        value="<?php echo $fornecedor->getTelefone(); ?>"
                            class="form-control" name="telefone" required>
                
                        <input type="text" placeholder="Categoria" 
                        value="<?php echo $fornecedor->getCategoria(); ?>"
                            class="form-control" name="categoria" required>
                
                        <input type="text" placeholder="Cidade" 
                        value="<?php echo $fornecedor->getCidade(); ?>"
                            class="form-control" name="cidade">
                    
                        <input type="text" placeholder="Estado" 
                        value="<?php echo $fornecedor->getEstado(); ?>"
                            class="form-control" name="estado">


                      <div class="input-group-append">
                          <button type="submit" class="btn btn-primary">
                              Salvar
                          </button>
                      </div>
                  </div>
              </form>
              <a href="index.php" class="btn btn-secondary ml-1" role="button" aria-pressed="true">Cancelar</a>

            </div>
        </div>
    </div>
<?php

    $content = ob_get_clean();
    echo html( $content );
} // else-if

?>
