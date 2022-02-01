<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="<?=$base;?>/assets/css/login.css"/>
    <title>Login | ThisDev</title>
</head>
<body>
    
    <div class="sidebar"></div>
    <div class="container-login">
        <div class="logo-area">
            <h1>THIS DEV SOCIAL</h1>
            <span>O This Dev Social ajuda você a se conectar e compartilhar com as pessoas que fazem parte da sua vida.</span>
        </div>
        <div class="form-area-login">
            <form action="<?=$base;?>/login" method="POST" class="form">

                <?php if(!empty($flash)):?>
                    <div class="flash-message">
                        <?=$flash;?>
                    </div>
                <?php endif; ?>

                <input type="email" name="email" placeholder="Digite o seu email"/>
                <input type="password" name="password" placeholder="Digite a sua senha"/>
                <input type="submit" value="Entrar"/>
            </form>
            <div class="link-area">
                <span>Ainda não tem cadastro? <a href="<?=$base;?>/cadastro">Crie sua conta</a></span>
            </div>
        </div>
    </div>

</body>
</html>