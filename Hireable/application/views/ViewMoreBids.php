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
        // var_dump($data_project_bids);die;
    foreach ($data_project_bids as $project_bid) {
        ?>

        <section class="job-detail section dashboard-section">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-8 col-md-12 col-xs-12">                        
                        <div class="content-area"> 
                            <div class="content-area">
                                <div class="manager-info">
                                <h5 class="freelancer-details-h6">Project Details</h5>
                                    <h6><b>Project Title</b></h6>
                                    <p><?php echo $project_title ?></p>
                                    <h6><b>Project Skills</b></h6>
                                    <div class="manager-resumes-item client-dashboard-manager">
                                        <div class="item-body client-dashboard-item">
                                            <div class="resume-skills client-dashboard-resume">
                                                <?php 
                                                    foreach($projects as $project){
                                                        ?>
                                                            <div class="tag-list">
                                                                <?php foreach ($project['categories'] as  $category) 
                                                                {
                                                                ?>
                                                                    <span><?php echo $category ?></span>
                                                                <?php 
                                                                }  
                                                                ?>
                                                            </div>
                                                        <?php
                                                    }
                                                ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
              
                            <div class="manager-resumes-item">
                                
                                <h5 class="freelancer-details-h6">Freelancer Details</h5>
                                <div class="manager-content">
                                <?php 
                                    if(isset($project_bid['profile_pic'])){
                                        ?>
                                        <img class="resume-thumb" height="64" src="<?php echo $project_bid['profile_pic'] ?>" alt="">
                                        <?php
                                    }
                                    else{
                                        ?>                            
                                        <img class="resume-thumb" src="<?php echo base_url(); ?>assets/img/jobs/avatar-1.png" alt="">
                                        <?php
                                    }
                                ?>
                                    <div class="manager-info">
                                        <div class="manager-name">
                                            <h4 class="view-bids-h4"><a href="#"><?php echo $project_bid['bid_username'] ?></a></h4>
                                            <h5><?php echo $project_bid['bid_email'] ?></h5>              
                                        </div>
                                        <div class="manager-resumes-item client-dashboard-manager">
                                                <div class="item-body client-dashboard-item">
                                                    <div class="resume-skills client-dashboard-resume">
                                                    
                                                    <div class="tag-list freelancer-tag-skills">
                                                        
                                                        <?php foreach ($project_bid['categories'] as  $category) 
                                                        {
                                                        ?>
                                                            <span><?php echo $category ?></span>
                                                        <?php 
                                                        }  
                                                        ?>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        <div class="manager-meta view-bids-button">
                                            <span><a href="<?php echo site_url('HireFreelancer/index/'.$project_bid['bid_user_id'].'/'.$project_bid['bid_project_id'].'/'.$project_bid['project_user_id']) ?>" class="btn btn-common view-bids-anchor">Hire</a></span>
                                        </div>
                                        <div class="manager-meta view-bids-button">
                                            <span><a href="<?php echo site_url('FreelancerProfileForClients/index/'.$project_bid['bid_user_id']) ?>" class="btn btn-common view-bids-anchor">View Profile</a></span>
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
                                        <a href="<?php echo site_url('Client_dashboard'); ?>"><button class="btn btn-common " type="submit" name="submit" value="">Dashboard</button></a>
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