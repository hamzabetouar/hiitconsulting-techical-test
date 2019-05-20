<h2>Bienvenue sur le tchat</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae corporis dolor est fuga inventore, maiores minus nam nihil officia quaerat quasi sequi, similique, sunt! Corporis ducimus ex iusto nulla voluptates.</p>
<hr>

<div class="row">

    <div class="col-1"></div>
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center">Connexion </h4>
            </div>
            <div class="card-body">
                <form action="<?=$request->server->getPath() ?>user/login" method="post">

                    <?php if(isset($login_err)): ?>
                        <div class="alert alert-danger">
                            <?=$login_err ?>
                        </div>
                    <?php endif ?>
                    <div class="form-group">
                        <label for="lpseudo">Pseudo</label>
                        <input type="text" id="lpseudo" name="username" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="lpassword">Mot de passe</label>
                        <input type="password" id="lpassword" name="password" class="form-control" value="">
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-2"></div>
    <div class="col-4">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center">S'inscrire </h4>
            </div>
            <div class="card-body">

                <form action="<?=$request->server->getPath() ?>user/register" method="post">

                    <?php if(isset($register_err)): ?>
                    <div class="alert alert-danger">
                        <?=$register_err ?>
                    </div>
                    <?php endif ?>
                    <div class="form-group">
                        <label for="rpseudo">Pseudo</label>
                        <input type="text" id="rpseudo" name="username" class="form-control" value="user_<?= uniqid() ?>">
                    </div>
                    <div class="form-group">
                        <label for="rpassword">Mot de passe</label>
                        <input type="text" id="rpassword" name="password" class="form-control" value="0000">
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">S'inscrire</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-1"></div>

</div>