$(function(){
    $(document).on("click", ".btn-create", function(e){
        e.preventDefault();
        $(".modal-body").load("index.php?controller=users&action=create");
        $("#exampleModal").modal();
        $(".modal-title").text("Cadastrar usuário");
    });

    $(document).on("click", ".deleteuser", function(e){
        e.preventDefault();
        $(".modal-body").load( $(this).attr("href") );
        $("#exampleModal").modal();
        $(".modal-title").text("Remover usuário");
    });

    $(document).on("click", ".edituser", function(e){
        e.preventDefault();
        $(".modal-body").load( $(this).attr("href") );
        $("#exampleModal").modal();
        $(".modal-title").text("Editar usuário");
    });

});

$(document).on( "click","#submitcreateusers", function(e){
    e.preventDefault();
    $(".return-error").hide();
    if($("#senha").val() == "" || $("#senha").val() == null ){
        $(".return-error p").text("Informe a senha");
        $(".return-error").toggle();
        return;
    }
    if($("#email").val() == "" || $("#email").val() == null ){
        $(".return-error p").text("Informe a e-mail");
        $(".return-error").toggle();
        return;
    }
    if($("#nome").val() == "" || $("#nome").val() == null ){
        $(".return-error p").text("Informe o Nome");
        $(".return-error").toggle();
        return;
    }
    $data = $("#formcreate").serialize();
    
    $.ajax({
        url: "index.php?controller=users&action=create",
        data: $data,
        type : 'post',
        success: function(ret){
            $_data = (ret);

            if($_data.error){
                $(".return-error p").text($_data.message);
                $(".return-error").toggle();
            }
            else{
                if($_data.id > 0){
                    window.location.reload();
                }
            }
        },
        error : function(ret){
            console.log(ret);
                data = ret.responseJSON
                $(".return-error p").text(data.message);
                $(".return-error").show();
        }
        }
    );
});


$(document).on( "click","#submitupdateusers", function(e){
    e.preventDefault();
    $(".return-error").hide();
    if($("#senha").val() == "" || $("#senha").val() == null ){
        $(".return-error p").text("Informe a senha");
        $(".return-error").toggle();
        return;
    }
    if($("#email").val() == "" || $("#email").val() == null ){
        $(".return-error p").text("Informe a e-mail");
        $(".return-error").toggle();
        return;
    }
    if($("#nome").val() == "" || $("#nome").val() == null ){
        $(".return-error p").text("Informe o Nome");
        $(".return-error").toggle();
        return;
    }
    $data = $("#formcreate").serialize();
    
    $.ajax({
        url: $("#formcreate").attr("action"),
        data: $data,
        type : 'post',
        success: function(ret){
           
            window.location.reload();
              
        },
        error : function(ret){
            console.log(ret);
                data = ret.responseJSON
                $(".return-error p").text(data.message);
                $(".return-error").show();
        }
        }
    );
});


$(document).on( "click",".btndeleteuser", function(e){
    e.preventDefault();
    $(".return-error").hide();
    
    $.ajax({
        url: $("#formdelete").attr("action"),
        type : 'post',
        success: function(ret){
           
            window.location.reload();
            
        },
        error : function(ret){
            console.log(ret);
                data = ret.responseJSON
                $(".return-error p").text(data.message);
                $(".return-error").show();
        }
        }
    );
});