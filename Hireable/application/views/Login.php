<?php
if (isset($_SESSION['error'])) {
    ?>
    <p class="alert alert-info"><?php echo $this->session->flashdata("error"); ?></p>
<?php
}
if (isset($_SESSION['status'])) {
    ?>
    <p class="alert alert-info"><?php echo $this->session->flashdata("status"); ?></p>
<?php
}
?>
<section id="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-12 col-xs-12">
                <div class="add-resume box">
                    <form class="form-ad" method="post" >
                        <h3>Login</h3>
                        <div class="form-group">
                            <label class="control-label">Email*</label>
                            <input class="form-control" name="email" type="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                            <?php echo form_error('email', '<div class="error text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password*</label>
                            <input class="form-control" name="password" type="password">
                            <?php echo form_error('password', '<div class="error text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <div class="button-group">
                                <div class="action-buttons">
                                    <div>
                                        <input class="btn btn-common" type="submit" name="submit" value="Login">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>