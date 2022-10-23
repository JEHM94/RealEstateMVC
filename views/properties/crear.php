<main class="container section">

    <h1>Crear</h1>

    <?php foreach ($errors as $error) : ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <a href="/admin" class="button button-green">Volver</a>

    <form class="form" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/form.php'; ?>
        <input type="submit" class="button button-green" value="Crear Propiedad">
    </form>

</main>