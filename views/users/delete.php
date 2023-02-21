<?php 
$data = View::$model;
?>
<div class="col-12">
    <div class="card">

        <div class="header">
            <h1 class="title alert alert-danger">
                <span class="alert-heading">Tem certeza que quer remover este usuário?</span>
            </h1>
        </div>

        <div class="content">
            <form method="POST" id="formdelete" action="?controller=users&action=delete&id=<?= $data->id ?>">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Nome</label>
                            <input readonly type="text" class="form-control border-input" id="title" name="title" placeholder="Nome" value="<?=$data->nome;?>" maxlength="200">
                            <input readonly type="hidden" class="form-control border-input" id="id" name="id"  value="<?=$data->id;?>">
                           
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-danger btn-fill btn-wd btndeleteuser">Remover</button>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>

    </div>
</div>