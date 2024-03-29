<div>
<?php
    if(isset($_SESSION['reviewInserted'])) 
    {
?>
        <p class="alert alert-success mt-3"><?php echo $this->session->flashdata("reviewInserted"); ?></p>
<?php
    }
?>
</div>
<section id="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-12 col-xs-12">
                <div class="add-resume box">
                    <form class="form-ad" method="post">
                        <h3>Rating And Reviews</h3>
                        <div class="form-group">
                            <label class="control-label pt-3"><h6>Please add your reviews here</h6></label>                            
                            <textarea class="form-control" rows="5" name="review"></textarea>
                            <?php echo form_error('review') ?>
                        </div>
                        <div id="rateYo"></div>
                        <input type ="hidden" name="stars" class="rating">
                        <div class="form-group mt-3">
                            <div class="button-group">
                                <div class="action-buttons">
                                <!-- <div class="action-buttons"> -->
                                    <div class="upload-button">
                                        <input class="btn btn-common" type="submit" name="submit" value="Submit">
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