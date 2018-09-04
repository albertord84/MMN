
<div class="container">
    <p>HOME</p><br />
    <h1>pantalla de bienvenida al usuario logeado. se le mostrara la opcion </h1></br>
    <h1>de reistrarse en DUMBO si no es usuario de este y aparecen las  </h1></br>
    <h1>opciones de invitaciones, pago y desloguearse </h1></br>
    <?php if (!$user_dumbu && isset($dumbu_link)): ?>
        Desea registrarse en Dumbu? <br />

        <a href="<?php echo $dumbu_link; ?>">Registrarse ahora</a>
    <?php endif; ?>
</div>