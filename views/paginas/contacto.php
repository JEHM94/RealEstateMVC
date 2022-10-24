<main class="container section">
    <h1>Contacto</h1>

    <picture>
        <source srcset="build/img/destacada3.avif" type="image/avif">
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <img loading="lazy" width="200" height="300" src="build/img/destacada3.jpg" alt="Imagen Página de Contacto">
    </picture>

    <h2>Llene el formulario de Contacto</h2>
    <?php
    // If there's a valid message then show the Alert
    if ($resultMessage) :
    ?>
        <p class="alert successful"><?php echo cleanInput($resultMessage); ?></p>
    <?php endif; ?>

    <form method="POST" class="form center-content container">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="inputName">Nombre</label>
            <input id="inputName" type="text" placeholder="Jesús Hamel" name="contact[name]" required>

            <label for="inputMessage">Mensaje</label>
            <textarea id="inputMessage" name="contact[message]" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la Propiedad</legend>

            <label for="selectOptions">Quiero</label>
            <select id="selectOptions" name="contact[type]" required>
                <option value="" disabled selected>-Seleccionar-</option>
                <option value="Comprar">Comprar</option>
                <option value="Vender">Vender</option>
            </select>

            <label for="inputAmount">Mi Presupuesto / Precio ($)</label>
            <input id="inputAmount" type="number" placeholder="$100,000" min="0" name="contact[price]" required>
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>

            <p>Deseo ser contactado por:</p>

            <div class="contact-by">
                <label for="radioPhone">Teléfono</label>
                <input id="radioPhone" name="contact[contact]" type="radio" value="Telefono" required>

                <label for="radioEmail">E-mail</label>
                <input id="radioEmail" name="contact[contact]" type="radio" value="Email" required>
            </div>

            <div id="contact">

            </div>
        </fieldset>

        <input type="submit" class="button-green" value="Enviar">
    </form>

</main>