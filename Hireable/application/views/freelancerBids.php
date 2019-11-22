<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-header">
                    <h3>Bids</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_SESSION['freelancerBidsPresent'])) {
    foreach ($freelancerBids as $freelancerBid) {
        //var_dump($freelancerBid['project_id']);

        ?>


        <div class="col-lg-8 col-md-8 col-xs-8">
            <div class="manager-resumes-item">
                <div class="manager-content">
                    <a href="resume.html"><img class="resume-thumb" src="<?php echo base_url(); ?>assets/img/jobs/avatar-1.png" alt=""></a>
                    <div class="manager-info">
                        <div class="manager-name">
                            <p><?php echo $freelancerBid['project_id'] ?></p>
                            <h4><a href="#">Client name</a></h4>
                            <h5>client@example.com</h5>
                        </div>
                        <!-- <div class="manager-meta">
                        <span class="location"><i class="ti-location-pin"></i> Cupertino, CA, USA</span>
                        <span class="rate"><i class="ti-time"></i> $55 per hour</span>
                    </div> -->
                    </div>
                </div>
                <div class="item-body">
                    <div class="content">
                        <b>Project Title</b>
                        <p><?php echo $freelancerBid['project_title'] ?></p>

                    </div>
                    <div class="resume-skills">
                        <div class="tag-list float-left">
                            <span>HTML5</span>
                            <span>CSS3</span>
                            <span>Bootstrap</span>
                            <span>Wordpress</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php
        }
    } else {
        ?>
    <section class="job-detail section dashboard-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-8 col-md-12 col-xs-12">
                    <div class="content-area">
                        <h5 class="client-dashboard-center">No bids yet</h5>
                        <p class="client-dashboard-center">Go back to your dashboard</p>
                        <div class="form-group">
                            <div class="button-group">
                                <div class="action-buttons">
                                    <div class="client-dashboard-center">
                                        <a href="<?php echo site_url('Freelancer'); ?>"><button class="btn btn-common " type="submit" name="submit" value="">Dashboard</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
}
?>