<?php 
$data = View::$model;
?>

<div class="col-lg-8 col-md-7">
    <div class="card">
        <div class="content">
            <form name="formcreate" id="formcreate" method="post" action="?controller=users&action=details&id=<?= $data->id ?>">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control border-input" id="nome" name="nome" value="<?= $data->nome ?>" placeholder="Nome">
                        </div>
                    </div>
                    <div class="col-md-6  col-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="email" id="email" name="email"  class="form-control border-input" value="<?= $data->email ?>" placeholder="Email" >
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" id="senha" name="senha" class="form-control border-input" value="<?= $data->senha ?>" placeholder="Senha" value="">
                        </div>
                    </div>
                </div>
                <div class="form-group return-error badge text-center w-100 badge-danger" style="display: none;">
                    <p></p>
                </div>
                <div class="text-center">
                    <button type="submit" id="submitupdateusers" class="btn btn-info btn-fill btn-wd">Atualizar</button>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
