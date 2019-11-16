<?php
    if($this->session->userdata('logged_in')){
        redirect('Home');
    }
    else{
        ?>
            <?php
    if(isset($_SESSION['status'])){
        ?>
        <p class="alert alert-success"><?php  echo $this->session->flashdata("status");?></p>
        <?php
    }
?>
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <form method="post">
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" name="name" >
                    <?php echo form_error('name', '<div class="error text-danger">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label>Dob</label>
                    <input class="form-control" name="dob" type="date">
                    <?php echo form_error('dob', '<div class="error text-danger">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <input type="radio" name="gender" value="Male" > Male
                    <input type="radio" name="gender" value="female">   Female
                    <?php echo form_error('gender', '<div class="error text-danger">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" name="email" type="email" >
                    <?php echo form_error('email', '<div class="error text-danger">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" name="password" type="password" >
                    <?php echo form_error('password', '<div class="error text-danger">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input class="form-control" type="password" name="re_password">
                    <?php echo form_error('re_password', '<div class="error text-danger">', '</div>'); ?>
                    <span class="error text-danger"><?php echo isset($error) ? $error : '' ?></span>
                    
                 
                </div>
                <div class="form-group">
                    <label>Register as</label>
                    <input type="radio" name="role" value="1" > Freelancer
                    <input type="radio" name="role" value="2">   Client
                    <?php echo form_error('role', '<div class="error text-danger">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" name="submit" type="submit" value="Signup">
                </div>

            </form>
        </div>
    </div>
</div>
        <?php
    }
?>
