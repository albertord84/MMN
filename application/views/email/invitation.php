<?php $this->load->view('email/_header'); ?>

<p>Esta es una invitacion a SMM</p>

De click en este <a href="<?php echo $invitation_link; ?>">enlace</a> para registrase

<br /><br />

<p><?php echo $message; ?></p>

<?php $this->load->view('email/_footer'); ?>