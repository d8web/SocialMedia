<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="<?=$base;?>/assets/css/login.css"/>
    <title>Cadastro | ThisDev</title>
</head>
<body>
    
    <div class="sidebar"></div>
    <div class="container-login">
        <div class="logo-area">
            <h1>THIS DEV SOCIAL</h1>
            <span>O This Dev Social ajuda você a se conectar e compartilhar com as pessoas que fazem parte da sua vida.</span>
        </div>
        <div class="form-area-login">
            <form action="<?=$base;?>/cadastro" method="POST" class="form">
            
                <!-- Flash message php dinamic -->
                <?php if(!empty($flash)):?>
                    <div class="flash-message">
                        <?=$flash;?>
                    </div>
                <?php endif; ?>

                <input type="text" name="name" placeholder="Digite o seu Nome"/>
                <input type="email" name="email" placeholder="Digite o seu email"/>
                <input type="password" name="password" placeholder="Digite a sua senha"/>
                <input placeholder="Digite sua Data de Nascimento" type="text" name="birthdate" id="birthdate"/>
                <input type="submit" value="Cadastrar"/>
            </form>
            <div class="link-area">
                <span>Já tem cadastro? <a href="<?=$base;?>/login">Fazer Login</a></span>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/imask"></script>
    <script>
        IMask(
            document.getElementById('birthdate'),
            {
                mask: '00/00/0000'
            }
        );
    </script>

</body>
</html>