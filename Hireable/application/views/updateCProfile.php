<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-header">
                    <h3>Update Profile</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<section id="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-12 col-xs-12">
                <div class="add-resume box">
                    <form class="form-ad"  method="post">
                        <h3>Profile Information</h3>
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $client_info->name ?>">
                            <?php echo form_error('name') ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">DOB</label>
                            <input type="text" class="form-control" name="dob" value="<?php echo isset($_POST['dob']) ? $_POST['dob'] : $client_info->dob ?>">
                            <?php echo form_error('dob') ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Gender</label>
                            <input type="radio" name="gender" value="male" <?php echo isset($_POST['gender']) && $_POST['gender']=="male" ? "checked" : $client_info->gender == "male" ? 'checked' : '' ?>> Male
                            <input type="radio" name="gender" value="female" <?php  echo isset($_POST['gender']) && $_POST['gender']=="female" ? "checked" : $client_info->gender == "female" ? 'checked' : '' ?> >   Female
                            <?php echo form_error('gender') ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input type="text" class="form-control" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $client_info->email ?>">
                            <?php echo form_error('email') ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Organization Description</label>
                            <textarea name="org_description" class="form-control" rows="7"></textarea>
                        </div>
                        
                        <input type="submit" name="submit" value="Save" class="btn btn-common">

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>