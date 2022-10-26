<main class="container section center-content">
    <h1>Iniciar Sesión</h1>

    <?php foreach ($errors as $error) : ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="form container">
        <fieldset>
            <!-- <legend>Email y Contraseña</legend> -->

            <label for="inputEmail">E-mail</label>
            <input id="inputEmail" name="email" type="email" placeholder="correo@correo.com" required>

            <label for="inputPassword">Contraseña</label>
            <input id="inputPassword" name="password" type="password" placeholder="**********" required>
        </fieldset>

        <input type="submit" class="button button-green" value="Iniciar Sesión">
    </form>
</main>