<section id="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-12 col-xs-12">
                <div class="add-resume box">
                    <form class="form-ad">
                        <h3>Add new project</h3>
                        <div class="form-group">
                            <label class="control-label">Project title</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Project Description</label>
                            <textarea class="form-control" rows="7"></textarea>
                        </div>
                        <div class="form-group ">
                            <label class="control-label"></label>   
                            <label class="control-label">Skills</label><br>
                            <select class="js-example-basic-multiple col-md-12 " name="categories[]" multiple="multiple" >
                                <?php foreach($categories as $category){?>
                                        <option value="<?php echo $category->category_id ?>"><?php echo $category->category ?></option>            
                                    <?php } ?>
                            </select>
                            <?php echo form_error('skills') ?>
                        </div>
                        <div class="form-group">
                            <div class="button-group">
                                <div class="action-buttons">
                                    <div class="upload-button">
                                        <button class="btn btn-common">Add</button>
                                        <input id="cover_img_file_2" type="file">
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