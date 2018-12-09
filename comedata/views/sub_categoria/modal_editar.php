<!-- Modal -->
<div class="modal fade" id="modal_editar<?php echo $subCategoria->id_sub_categoria;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edição de Sub Imagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">

          <div class="col-sm-12">

            <form method="post" enctype="multipart/form-data" <?php Helper::action('subCategoria.alterar');?>
              <input type="hidden" name="idSubCategoria" value="<?php echo $subCategoria->id_sub_categoria;?>">
              <input type="hidden" name="caminho_imagem" value="<?php echo $subCategoria->imagem;?>">
              <input type="hidden" name="idCategoria" value="<?php echo Input::inGet("idCategoria");?>">

              <div class="form-group">
                <label for="enome">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome"  placeholder="Nome da Sub Imagem"
                value="<?php echo $subCategoria->sub_nome;?>">
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