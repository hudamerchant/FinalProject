<?php
    if(isset($_SESSION['error'])){
        ?>
        <p class="alert alert-danger"><?php  echo $this->session->flashdata("error");?></p>
        <?php
    }
    
?>
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <form method="post">
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
                    <input class="btn btn-primary" name="submit" type="submit" value="Login">
                </div>
            </form>
        </div>
    </div>
</div>