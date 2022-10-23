<main class="container section">
    <h1>Registrar Nuevo Vendedor</h1>

    <a href="/admin" class="button button-green">Volver</a>

    <?php foreach ($errors as $error) : ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form action="/sellers/crear" method="POST" class="form">
        <?php include __DIR__ . '/form.php'; ?>

        <input type="submit" class="button button-green" value="Registrar Vendedor">
    </form>
</main>