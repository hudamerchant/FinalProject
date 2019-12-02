<?php
if(isset($_SESSION['projectInserted'])){
    ?>
    <p class="alert alert-success"><?php  echo $this->session->flashdata("projectInserted");?></p>
    <?php
}
?>
<section id="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-12 col-xs-12">
                <div class="add-resume box">
                    <form class="form-ad" method="post" autocomplete="off">
                        <h3>Add new project</h3>
                        <div class="form-group">
                            <label class="control-label">Project title</label>
                            <input type="text" class="form-control" name="project-title" value="<?php echo isset($_POST['project-title']) && !empty($_POST['project-title']) ? $_POST['project-title'] : '' ?>">
                            <?php echo form_error('project-title') ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Project Description</label>
                            <textarea class="form-control" rows="7" name="project-description"><?php echo isset($_POST['project-description']) && !empty($_POST['project-description']) ? $_POST['project-description'] : '' ?></textarea>
                            <?php echo form_error('project-description') ?>
                        </div>
                        <div class="form-group ">
                            <label class="control-label"></label>   
                            <label class="control-label">Skills</label><br>
                            <select class="js-example-basic-multiple col-md-12 " name="categories[]" multiple="multiple">
                                <?php foreach($categories as $category){?>
                                    <option value="<?php echo $category->category_id ?>"><?php echo $category->category ?></option>            
                                <?php } ?>
                            </select>
                            <?php echo form_error('categories[]') ?>
                            
                        </div>
                        <div class="form-group">
                            <div class="button-group">
                                <div class="action-buttons">
                                    <div >
                                        <!-- <button ></button> -->
                                        <input class="btn btn-common" type="submit" name="submit" value="Add">
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