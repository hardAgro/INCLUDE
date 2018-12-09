<!-- Modal -->
<div class="modal fade" id="modal_cadastrar_categorias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastro de Imagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">

          <div class="col-sm-12">

            <form method="post" <?php Helper::action('categoria.inserir');?>

              <div class="form-group">
                <label for="enome">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome"  placeholder="Nome do Usuário">
              </div>

             <div class="list-group">
              <label class="list-group-item" style="text-transform:uppercase">
                <input type="checkbox" name="categoria_geral" id="categoria_geral">
                geral
              </label>
              </div>

          </div>
          
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>

      </form>
    </div>
  </div>
</div>