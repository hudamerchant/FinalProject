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

<?php if($freelancer_info){
    // var_dump($freelancer_info);die;
        $selected_categories = $freelancer_info['categories'];
?>
<section id="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-12 col-xs-12">
                <div class="add-resume box">
                    <form class="form-ad" method="post" autocomplete="off">
                        <h3>Profile information</h3>
                        <div class="form-group">
                            <input type="hidden" class="form-control user_id" name="freelancer_id" value="<?php echo $freelancer_info['id'] ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $freelancer_info['name'] ?>">
                            <?php echo form_error('name') ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label"></label>
                            <label class="control-label">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Your@domain.com" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $freelancer_info['email'] ?>">
                            <?php echo form_error('email') ?>
                        </div>
                        <div class="form-group ">
                            <label class="control-label"></label>   
                            <label class="control-label">Skills</label><br>
                            <select class="edit-project-category col-md-12 " name="categories[]" multiple="multiple">
                                    <?php 
                                    foreach($categories as $category){
                                        ?>
                                        <option  value="<?php echo $category->category_id ?>"<?php echo (in_array($category->category,$selected_categories) ? 'selected' : ''  ) ?>><?php echo $category->category ?> </option>            
                                        <?php 
                                    } 
                                    ?>
                                    <?php 
                                    
                                    // $count = 0;
                                    // foreach ($project_data['categoryDetails']['project_categories'] as $categoryDetails) {
                                        
                                            ?>
                                                <!-- <option selected value="<?php //echo $project_data['categoryDetails']['category_id'][$count] ?>"><?php echo $project_data['categoryDetails']['project_categories'][$count] ?></option> -->
                                            <?php
                                       
                                    //     $count++;
                                    // }
                                    ?>
                            </select>
                            <?php echo form_error('categories[]') ?>
                            
                        </div>
                        <div class="form-group">
                            <label class="control-label">Profile Description</label>
                            <textarea name="p_description" class="form-control" rows="7"><?php echo $freelancer_info['profile_description']?></textarea>
                            <?php echo form_error('p_description') ?>
                        </div>
                        
                            <input type="submit" name="submit" value="Save" class="btn btn-common">
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<?php
} ?>
