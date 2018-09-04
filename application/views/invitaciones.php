
<div class="container">

    <a href="<?php echo site_url('invitaciones/create'); ?>">Crear Invitacion</a>
    <br />
    <br />

    <?php if (!empty($invitationes)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Invitado</th>
                    <th>Estado</th>
                    <th>Fecha Enviado</th>
                    <th>Fecha Aprovado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($invitationes as $invitacion): ?>
                    <tr>
                        <td><?php echo $invitacion->to; ?></td>
                        <td><?php echo $invitacion->status == 1 ? 'Enviado' : ($invitacion->status == 2 ? 'Visto' : 'Acetpado'); ?></td>
                        <td><?php echo $invitacion->sent_at; ?></td>
                        <td><?php echo $invitacion->approved_at; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Usted no ha enviado ninguna invitacion</p>
    <?php endif; ?>

</div>