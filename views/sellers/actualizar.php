<main class="container section">
    <h1>Actualizar Vendedor</h1>

    <a href="/admin" class="button button-green">Volver</a>

    <?php foreach ($errors as $error) : ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="form">
        <?php include __DIR__ . '/form.php'; ?>

        <input type="submit" class="button button-green" value="Actualizar Vendedor">
    </form>
</main>