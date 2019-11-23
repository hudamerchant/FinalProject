<div class="container">
    <div class="row">
        <div class="col-md-11">
        <form class="form-ad" method="post">
                        <div class="form-group">
                            <label class="control-label pt-3"><h6>Please add your reviews here</h6></label>
                            <textarea class="form-control" rows="5" name="review"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="button-group">
                                <div class="action-buttons">
                                <!-- <div class="action-buttons"> -->
                                    <div class="upload-button">
                                        

                                            <input class="btn btn-common" type="submit" name="submit" value="Submit">
                                        </form>
                                       
                                        <form action="" method="post" enctype='multipart/form-data'>
                                            <div class="form-group col-md-5">
                                                <div>
                                                    <?php
                                                    if (isset($_SESSION['reviewInserted'])) {
                                                        ?>
                                                        <p class="alert alert-success mt-3"><?php echo $this->session->flashdata("reviewInserted"); ?></p>

                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <!-- <label for="profile">Profile Photo</label> -->
                                                <input class="form-control" type="file" name="profile" id="profile">

                                            </div>
                                        </form>
                                        <h6><b class="mt-5 text-dark">REVIEWS</b></h6>
                                        <?php //foreach($comment as $comments)
                                                    //{
                                                     ?>
                                        <div class="manager-resumes-item">
                                            <div class="manager-content">
                                                <a href="resume.html"><img class="resume-thumb" src="<?php echo base_url(); ?>assets/img/jobs/avatar-1.png" alt=""></a>
                                                <div class="manager-info">
                                                    <div class="manager-name">
                                                        <h4><a href="#">Client</a></h4>
                                                        <h5>client@example.com</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-body">
                                                <div class="content">
                                                    <b>Review</b>
                                                    
                                                    <P><?php //echo $comments?>
                                                    
                                                </p>

                                                </div>
                                            </div>
                                        </div>
                                        <?php //} ?>
                                    </div>
                                <!-- </div> -->
                            </div>
                        </div>

                   
    
        </div>
    </div>
</div>