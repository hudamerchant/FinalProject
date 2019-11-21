<?php
if (isset($_SESSION['status'])) {
    ?>
    <p class="alert alert-info"><?php echo $this->session->flashdata("status"); ?></p>
<?php
} else {
    ?>
    <section id="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-12 col-xs-12">
                    <div class="add-resume box">
                        <form class="form-ad" method="post">
                            <h3>Signup</h3>
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <input class="form-control" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
                                <?php echo form_error('name') ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Dob</label>
                                <input class="form-control" name="dob" type="text" id="datepicker" value="<?php echo isset($_POST['dob']) ? $_POST['dob'] : '' ?>">
                                <?php echo form_error('dob') ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Gender</label>
                                <input type="radio" name="gender" value="male" <?php echo isset($_POST['gender']) && $_POST['gender'] == "male" ? "checked" : '' ?>> Male
                                <input type="radio" name="gender" value="female" <?php echo isset($_POST['gender']) && $_POST['gender'] == "female" ? "checked" : '' ?>> Female
                                <?php echo form_error('gender') ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input class="form-control" name="email" type="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                                <?php echo form_error('email') ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Password</label>
                                <input class="form-control" name="password" type="password">
                                <?php echo form_error('password') ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Confirm Password</label>
                                <input class="form-control" type="password" name="re_password">
                                <?php echo form_error('re_password') ?>
                                <span class="error text-danger"><?php echo isset($error) ? $error : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Register as</label>
                                <input type="radio" name="role" value="1" <?php echo isset($_POST['role']) && $_POST['role'] == "1" ? "checked" : '' ?>> Freelancer
                                <input type="radio" name="role" value="2" <?php echo isset($_POST['role']) && $_POST['role'] == "2" ? "checked" : '' ?>> Client
                                <?php echo form_error('role') ?>
                            </div>
                            <div class="form-group">
                                <div class="button-group">
                                    <div class="action-buttons">
                                        <div>
                                            <input class="btn btn-common" type="submit" name="submit" value="Signup">
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
<?php
}
?>