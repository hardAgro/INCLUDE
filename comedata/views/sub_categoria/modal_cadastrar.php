<!-- Modal -->
<div class="modal fade" id="modal_cadastrar_sub_categorias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastro de Sub Imagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">

          <div class="col-sm-12">

            <form method="post" enctype="multipart/form-data" <?php Helper::action('subCategoria.inserir');?>
              <input type="hidden" name="idCategoria" value="<?php echo Input::inGet("idCategoria");?>">

              <div class="form-group">
                <label for="enome">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome"  placeholder="Nome da Sub Imagem">
              </div>

              <div class="form-group">
                <label for="imagem">Imagem</label>
                <input type="file" class="form-control" name="imagem" id="imagem"  placeholder="Imagem do Usuário">
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