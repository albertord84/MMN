
<div class="container">
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4">
            <div class="login-box">

                <div class="login-logo"><b><?php echo $site_name; ?></b></div>

                <div class="login-box-body">
                    <p class="login-box-msg">Sign up</p>
                    <?php echo $form->open(); ?>
                    <?php echo $form->messages(); ?>
                    <?php echo $form->bs3_text('First Name', 'first_name'); ?>
                    <?php echo $form->bs3_text('Last Name', 'last_name'); ?>
                    <?php echo $form->bs3_text('Email', 'email'); ?>
                    <?php echo $form->bs3_password('Password', 'password'); ?>
                    <?php echo $form->bs3_password('Confirm Password', 'password_confirm'); ?>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember"> Remember Me</label>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <?php echo $form->bs3_submit('Sign Up', 'btn btn-primary btn-block btn-flat'); ?>
                        </div>
                    </div>
                    <?php echo $form->close(); ?>
                </div>

            </div>
        </div>
        <div class="col-md-4">

        </div>
    </div>

</div>