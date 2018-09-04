<?php echo $form->messages(); ?>

<div class="row">

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Invitacion</h3>
            </div>
            <div class="box-body">
                <?php echo $form->open(); ?>

                <?php echo $form->bs3_text('Usuarios a invitar (correos separados por coma)', 'invitados'); ?>
                <?php echo $form->bs3_textarea('Mensaje', 'message'); ?>

                <?php echo $form->bs3_submit(); ?>

                <?php echo $form->close(); ?>
            </div>
        </div>
    </div>

</div>