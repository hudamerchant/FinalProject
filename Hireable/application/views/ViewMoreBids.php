<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-header">
                    <h3>View Bids</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_SESSION['projectsBidsPresent'])) {
    if($data_project_bids){

    foreach ($data_project_bids as $project_bid) {
        ?>
        <section class="job-detail section dashboard-section">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-8 col-md-12 col-xs-12">
                        <div class="content-area">
                            <div class="manager-resumes-item">
                                <div class="manager-content">
                                    <a href="resume.html"><img class="resume-thumb" src="<?php echo base_url(); ?>assets/img/jobs/avatar-1.jpg" alt=""></a>
                                    <div class="manager-info">
                                        <div class="manager-name">
                                            <h4 class="view-bids-h4"><a href="#"><?php echo $project_bid['bid_username'] ?></a></h4>
                                            <h5><?php echo $project_bid['bid_email'] ?></h5>
                                        </div>
                                        <div class="manager-meta view-bids-button">
                                            <span><a href="<?php echo site_url('FreelancerProfileForClients/index/'.$project_bid['bid_user_id']) ?>" class="btn btn-common view-bids-anchor">View Profile</a></span>
                                        </div>
                                        <div class="manager-meta view-bids-button">
                                            <span><a href="<?php echo site_url('HireFreelancer/index/'.$project_bid['bid_user_id'].'/'.$project_bid['bid_project_id']) ?>" class="btn btn-common view-bids-anchor">Hire</a></span>
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
    }
    } 
    else {
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
                                        <a href="<?php echo site_url('Client'); ?>"><button class="btn btn-common " type="submit" name="submit" value="">Dashboard</button></a>
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