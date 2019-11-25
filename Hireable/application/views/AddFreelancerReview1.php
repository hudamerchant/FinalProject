<?php
if (isset($_SESSION['error'])) {
    ?>
    <p class="alert alert-info"><?php echo $this->session->flashdata("error"); ?></p>
<?php
}
if (isset($_SESSION['status'])) {
    ?>
    <p class="alert alert-info"><?php echo $this->session->flashdata("status"); ?></p>
<?php
}
?>
<section id="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-12 col-xs-12">
                <div class="add-resume box">
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
                </div>
            </div>
        </div>
    </div>
</section>