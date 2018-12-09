<!-- Modal -->
<div class="modal fade" id="modal_editar_categorias<?php echo $categoria->id_categoria;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edição de Imagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">

          <div class="col-sm-12">

            <form method="post" <?php Helper::action('categoria.alterar');?>

              <input type="hidden" name="idCategoria" value="<?php echo $categoria->id_categoria;?>">

              <div class="form-group">
                <label for="enome">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome"  placeholder="Nome do Usuário"
                value="<?php echo $categoria->nome;?>">
              </div>

              <div class="list-group">
                <label class="list-group-item" style="text-transform:uppercase">
                  <input type="checkbox" name="categoria_geral" id="categoria_geral" 
                    <?php echo ($categoria->categoria_geral == 1) ? "checked" : ''; ?>>
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