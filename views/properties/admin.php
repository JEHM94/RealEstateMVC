<main class="container section">
    <h1>Administrador de Bienes Raices</h1>

    <?php
    $message = getResultMessage($message);
    // If there's a valid message then show the Alert
    if ($message) :
    ?>
        <p class="alert successful"><?php echo cleanInput($message); ?></p>
    <?php endif; ?>

    <h2>Propiedades</h2>

    <a href="/properties/crear" class="button button-green">Crear Propiedad</a>

    <a href="/sellers/crear" class="button button-yellow">Crear Vendedor</a>

    <table class="properties">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <!-- Show properties result -->
            <?php foreach ($properties as $property) : ?>
                <tr>
                    <td><?php echo $property->id; ?></td>
                    <td><?php echo $property->tittle; ?></td>
                    <td> <img src="/images/<?php echo $property->image; ?>" class="table-image" alt="Imagen de la Propiedad"></td>
                    <td>$<?php echo $property->price; ?></td>
                    <td>
                        <a href="/properties/actualizar?id=<?php echo $property->id; ?>" class="button-yellow-block">Actualizar</a>
                        <form method="POST" class="w-100" action="/properties/eliminar">
                            <input type="hidden" name="id" value="<?php echo $property->id; ?>">
                            <input type="hidden" name="type" value="property">
                            <input type="submit" class="button-red-block" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="properties">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <!-- Show properties result -->
            <?php foreach ($sellers as $seller) : ?>
                <tr>
                    <td><?php echo $seller->id; ?></td>
                    <td><?php echo $seller->name . " " . $seller->lastname; ?></td>
                    <td>(+58)<?php echo $seller->phone; ?></td>
                    <td>
                        <a href="/sellers/actualizar?id=<?php echo $seller->id; ?>" class="button-yellow-block">Actualizar</a>
                        <form method="POST" class="w-100" action="/sellers/eliminar">
                            <input type="hidden" name="id" value="<?php echo $seller->id; ?>">
                            <input type="hidden" name="type" value="seller">
                            <input type="submit" class="button-red-block" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>