
<?php 
    if($project_data){
        $selected_categories = $project_data['categories'];
?>
<section id="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-12 col-xs-12">
                <div class="add-resume box">
                    <form class="form-ad" method="post" autocomplete="off">
                        <h3>Edit your project</h3>
                        <div class="form-group">
                            <input type="hidden" class="form-control user_id" name="project_id" value="<?php echo $project_data['project_id'] ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Project title</label>
                            <input type="text" class="form-control" name="project-title" value="<?php echo $project_data['project_title'] ?>">
                            <?php echo form_error('project-title') ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Project Description</label>
                            <textarea class="form-control" rows="7" name="project-description"><?php echo $project_data['project_description'] ?></textarea>
                            <?php echo form_error('project-description') ?>
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
                            <div class="button-group">
                                <div class="action-buttons">
                                    <div >
                                       
                                        <input class="btn btn-common" type="submit" name="submit" value="Update">
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
<?php } ?>
