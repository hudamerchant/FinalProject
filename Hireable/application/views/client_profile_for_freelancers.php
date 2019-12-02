<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-header">
                    <h3>Client Profile</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if ($clientDetail) {
    ?>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="right-sideabr">
                        <h4>Client Details</h4>
                        <ul class="list-item">
                            <li><span class="profile-li-span">Name:</span><?php echo $clientDetail['name'] ?></li>
                            <li><span class="profile-li-span">Date Of Birth:</span><?php echo $clientDetail['dob'] ?></li>
                            <li><span class="profile-li-span">Gender:</span><?php echo $clientDetail['gender'] ?></li>
                            <li><span class="profile-li-span">Email:</span><?php echo $clientDetail['email'] ?></li>
                            <li><span class="profile-li-span">Organization Description:</span><p class="para-description"><?php echo isset($orgDescription) ? $orgDescription : 'None' ?></p></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-xs-12">
                    <div class="inner-box my-resume">
                        <div class="author-resume">
                            <div class="col-md-3 d-inline-block">
                                <div class="user-pic">
                                    <?php
                                        if(isset($clientDetail['profile_pic'])) 
                                        {
                                    ?>
                                            <img src="<?php echo $clientDetail['profile_pic'] ?>" class="img-thumbnail" alt="">
                                    <?php
                                        } 
                                        else 
                                        {
                                    ?>
                                        <img src="<?php echo base_url(); ?>assets/img/dp.png" class="img-thumbnail" alt="">
                                    <?php
                                        }
                                    ?>
                                    <a href="#" class="btn btn-common mt-2 ml-2 faltu-anchor"></a>
                                </div>
                            </div>
                            <div class="author-info d-inline-block ml-3">
                                <h3><b><?php echo $clientDetail['name'] ?></b></h3>
                                <p class="sub-title"><?php echo $clientDetail['email'] ?></p>
                                <div class="social-link">
                                    <a href="#" class="Twitter"><i class="lni-twitter-filled"></i></a>
                                    <a href="#" class="facebook"><i class="lni-facebook-filled"></i></a>
                                    <a href="#" class="google"><i class="lni-google-plus"></i></a>
                                    <a href="#" class="linkedin"><i class="lni-linkedin-fill"></i></a>
                                </div>
                            </div>
                        </div>
                        <h6 class="client-profile-h6"><b class="mt-5 text-dark">REVIEWS</b></h6>
                        <div class="manager-resumes-item client-profile-manager">
                            <div class="manager-content project-details-manager-content">
                                <div class="item-body">
                                    <div class="resume-skills project-details-resume-skills profile-view-resume-skills client-profile-manager-content">
                                        <div class="resume-exp float-right">
                                            <a href="<?php echo site_url('Add_review/index/'.$clientDetail['user_id']) ?>" class="btn btn-common btn-xs ">Add Review</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php                            
                            if(!empty($reviewResults)) 
                            {
                                foreach ($reviewResults as $reviewResult) {                                    
                                    if ($reviewResult->profile_pic != '') 
                                    {
                                        $profilePicPath = $this->data['image_path'];
                                        $profilePicVariable = $reviewResult->profile_pic;
                                    } 
                                    elseif ($reviewResult->profile_pic == '') 
                                    {
                                        $profilePicVariable = '';
                                    }
                        ?>
                                <div class="manager-resumes-item">
                                    <div class="manager-content">
                                        <?php
                                            if (isset($profilePicVariable) && $profilePicVariable != '') 
                                            {
                                        ?>
                                                <img class="resume-thumb" src="<?php echo $profilePicPath . $profilePicVariable ?>" alt="">
                                        <?php
                                            } 
                                            else 
                                            {
                                        ?>
                                                <img class="resume-thumb" src="<?php echo base_url(); ?>assets/img/jobs/avatar-1.png" alt="">
                                        <?php
                                            }
                                        ?>
                                        <div class="manager-info">
                                            <div class="manager-name">
                                                <h4><a href="#"><?php echo $reviewResult->name ?></a></h4>
                                                <h5><?php echo $reviewResult->email ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-body">
                                        <div class="content">
                                            <b>Review</b>
                                            <p>
                                                <?php echo $reviewResult->review ?>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                        <?php
                                }
                            } 
                            else 
                            {
                        ?>
                            <div class="row justify-content-between dashboard-section">                              
                                <h6 class="client-dashboard-center profile-h6">No Reviews yet</h6>                               
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
} 
?>