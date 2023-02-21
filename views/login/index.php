<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="../../assets/css/login.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

</head>
<body>


<body>
    <div class="container login-container">
      <div class="row">
        <div class="col-md-6 ads">
          <h1><span id="fl">Rede</span><span id="sl">Industrial</span></h1>
        </div>
        <div class="col-md-6 login-form">
          <div class="profile-img">
            <img src="https://redeindustrial.com.br/wp-content/uploads/2020/02/logo-ri-1645x2048.png" alt="profile_img" height="140px" width="140px;">
          </div>
          <h3>Login</h3>
          <form id="form-login" name="form-login" action="#">
            <div class="form-group">
              <input type="email" require class="form-control" name="email" placeholder="E-mail">
            </div>
            <div class="form-group">
              <input type="password" require class="form-control" name="senha" placeholder="Senha">
            </div>
            <div class="form-group return-error badge text-center w-100 badge-danger" style="display: none;">
                <p></p>
            </div>
            <div class="form-group">
              <button type="button" id="submitform" class="btn btn-primary btn-lg btn-block">Entrar</button>
            </div>
            <div class="form-group forget-password">
                <a href="#">Esqueci a senha</a>
            </div>
          </form>
        </div>
      </div>
    </div>
    

    <script>

        $(function(){
            
            $(document).on( "click","#submitform", function(e){
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
                $data = $("#form-login").serialize();
                
                $.ajax({
                    url: "controller=login&action=login",
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
                                window.location.href = "/";
                            }
                        }
                    },
                    error : function(ret){
                            data = ret.responseJSON
                            $(".return-error p").text(data.message);
                            $(".return-error").show();
                           
                        
                    }
                    }
                );
            })
        });

    </script>
</body>
</html>