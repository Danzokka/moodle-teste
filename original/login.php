<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <?php include 'header_2.php' ?>



    <div class="container_login">
        <div class="container_login_int">
            <div class="area_login">
                <div class="area_login_int">
                    <img src="img/login.svg" alt="">

                    <div class="title_login">
                        <h2>
                            Login
                        </h2>
                    </div>

                    <form action="#" method="POST" id="login">

                        <div class="area_form_login">
                            <input type="text" placeholder="Login" required>

                            <input type="password" placeholder="Senha" required>
                        </div>

                        <div class="area_enviar_login">
                            <input type="submit" value="Enviar mensagem">

                            <div class="info_senha">
                                <p>
                                    Esqueci a senha
                                </p>
                            </div>
                        </div>
                   

                    </form>

                </div>
            </div>
        </div>
    </div>

  
    <?php include 'footer.php' ?> 

    <script src="js/script.js"></script>
</body>

</html>