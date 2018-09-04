<?php $this->load->view('email/_header'); ?>

<p>Nuevo usuario cadastrado</p>

Email: <?php echo $email; ?><br />
First Name: <?php echo $first_name; ?><br />
Last Name: <?php echo $last_name; ?><br />
Phone: <?php echo $phone; ?><br />

<?php $this->load->view('email/_footer'); ?>