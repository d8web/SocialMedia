<?=$render('header', [ 'loggedUser' => $loggedUser ]);?>

<section class="container main">
    <?=$render('sidebar', [ 'activeMenu' => 'settings' ]);?>

    <section class="feed mt-10">

        <h1>Configurações</h1>

        <?php if(!empty($flash)): ?>
            <div class="flash"><?php echo $flash; ?></div>
        <?php endif; ?>

        <form class="config-form" method="POST" enctype="multipart/form-data" action="<?=$base;?>/settings">

            <label>
                <div>Novo Avatar</div>
                <input type="file" name="avatar" /><br/>
                <img class="image-edit-avatar" src="<?=$base;?>/media/avatars/<?=$user->avatar; ?>" />
            </label>

            <label>
                <div>Nova capa</div>
                <input type="file" name="cover" /><br/>
                <img class="image-edit-cover" src="<?=$base;?>/media/covers/<?=$user->cover; ?>" />
            </label>

            <div class="line"></div>

            <label>
                <div>Nome completo</div>
                <input type="text" name="name" value="<?=$user->name;?>" />
            </label>

            <label>
                <div>Data de nascimento</div>
                <input type="text" name="birthdate" value="<?=date('d/m/Y', strtotime($user->birthdate));?>" />
            </label>

            <label>
                <div>E-mail</div>
                <input type="email" name="email" value="<?=$user->email?>" />
            </label>

            <label>
                <div>Cidade</div>
                <input type="text" name="city" value="<?=$user->city;?>" />
            </label>

            <label>
                <div>Trabalho</div>
                <input type="text" name="work" value="<?=$user->work;?>" />
            </label>

            <div class="line"></div>

            <label>
                <div>Nova senha</div>
                <input type="password" name="password" />
            </label>

            <label>
                <div>Confirmar Senha</div>
                <input type="password" name="password_confirm" />
            </label>

            <input type="submit" value="Salvar" class="button"/>

        </form>

    </section>

</section>
<script src="https://unpkg.com/imask"></script>
<script>
IMask(
    document.getElementById('birthdate'),
    {
        mask:'00/00/0000'
    }
);
</script>
<?=$render('footer');?>