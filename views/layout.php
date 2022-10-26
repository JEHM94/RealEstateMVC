<?php
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? null;

if (!isset($isIndex)) {
    $isIndex = false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raíces</title>
    <link rel="stylesheet" href="../build/css/app.css">
</head>

<body>
    <header class="header <?php echo $isIndex ? 'index' : '' ?> ">
        <div class="container <?php echo $isIndex ? 'header-content' : 'header-container' ?>">
            <div class="bar">
                <div class="mobile-header">
                    <a href="/">
                        <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raíces">
                    </a>

                    <div class="mobile-menu">
                        <img src="/build/img/barras.svg" alt="Ícono Menú Responsive">
                    </div>
                </div> <!-- .mobile-header -->

                <div class="right">
                    <div class="dark-mode">
                        <img class="dark-mode-btn" src="/build/img/dark-mode.svg" alt="Botón de Modo Oscuro">
                    </div>
                    <nav class="navigation">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if ($auth) : ?>
                            <a href="/admin">Admin</a>
                            <a href="/logout">Cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div><!-- .right -->
            </div> <!-- .bar -->
            <?php echo $isIndex ? '<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>' : '' ?>
        </div> <!-- .header-container -->
    </header>

    <?php echo $content; ?>

    <footer class="section footer">
        <div class="container footer-container">
            <div class="container ">
                <nav class="navigation nav-footer">
                    <a href="/nosotros">Nosotros</a>
                    <a href="/propiedades">Anuncios</a>
                    <a href="/blog">Blog</a>
                    <a href="/contacto">Contacto</a>
                </nav>
            </div>

            <p class="copyright">Todos los derechos reservados. <?php echo date('Y'); ?> &copy;</p>
        </div>
    </footer>

    <script src="../build/js/bundle.min.js"></script>
</body>

</html>