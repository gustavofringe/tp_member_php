<?php 
$title_page = "Se connecter";
require 'partials/header.php'; ?>
    <h1>Se connecter</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="">Pseudo ou e-mail</label>
            <input type="text" name="username" class="form-control"/>
        </div>

        <div class="form-group">
            <label for="">Mot de passe <a href="forget.php">(mot de passe oublié)</a></label>
            <input type="password" name="password" class="form-control"/>
        </div>

        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>

<?php require 'partials/footer.php'; ?>