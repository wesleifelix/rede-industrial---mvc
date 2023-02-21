
<?php 
$data = View::$model;
?>

<div class="col-md-12 p-3">
    <div class="card">
        <div class="header">
            
            <fieldset class=""><legend><h4 class="title">Usuários<a href="?controller=users&action=create" class="btn btn-success pull-right btn-create"><i class="fa fa-plus"></i>Cadastrar</a></h4></legend>
        </div>
        <div class="content table-responsive table-full-width">
            <table class="table table-striped">
                <thead>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </thead>
                <tbody>
                    <?php foreach ($data as $item):?>
                    <tr>
                        <td><?=$item->id?></td>
                        <td><?=$item->nome?></td>
                        <td><?=$item->email?></td>
                        
                        <td>
                            <a class="btn btn-info edituser" href="index.php?controller=users&action=details&id=<?=$item->id?>"><i class="fa fa-pencil"></i>
                            <a class="btn btn-danger deleteuser" href="index.php?controller=users&action=delete&id=<?=$item->id?>"><i class="fa fa-trash"></i>

                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script type="text/javascript" src="assets/js/users.js" ></script>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>