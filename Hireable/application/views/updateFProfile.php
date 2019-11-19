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
                    <form class="form-ad" method="post">
                        <h3>Profile information</h3>
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $freelancer_info->name ?>">
                            <?php echo form_error('name') ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label"></label>
                            <label class="control-label">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Your@domain.com" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $freelancer_info->email ?>">
                            <?php echo form_error('email') ?>
                        </div>
                        <div class="form-group ">
                            <label class="control-label"></label>   
                            <label class="control-label">Skills</label><br>
                            <select class="js-example-basic-multiple col-md-12" name="skills[]" multiple="multiple">
                            <option value="kuch">Kuch</option>
                            <option value="bhi">Bhi</option>
                            </select>
                            <?php echo form_error('skills') ?>
                        </div>
                        <div class="form-group ">
                            <label class="control-label"></label>   
                            <label class="control-label">Categories</label><br>
                            <select class="js-example-basic-multiple col-md-12" name="skills[]" multiple="multiple">
                            <option value="kuch">Kuch</option>
                            <option value="bhi">Bhi</option>
                            </select>
                            <?php echo form_error('skills') ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Profile Description</label>
                            <textarea name="p_description" class="form-control" rows="7"></textarea>
                            <?php echo form_error('p_description') ?>
                        </div>
                        
                            <input type="submit" name="submit" value="Save" class="btn btn-common">
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</section>