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
                    <h4>Client Details
                        <!-- <a href='<?php // echo site_url('updateCProfile') ?>' class="profile-anchor"> Edit </a> -->
                    </h4>
                    <ul class="list-item">
                        <li><span class="profile-li-span">Name:</span><?php echo $clientDetail['name'] ?></li>
                        <li><span class="profile-li-span">Date Of Birth:</span><?php echo $clientDetail['dob'] ?></li>
                        <li><span class="profile-li-span">Gender:</span><?php echo $clientDetail['gender'] ?></li>
                        <li><span class="profile-li-span">Email:</span><?php echo $clientDetail['email'] ?></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-xs-12">
                <div class="inner-box my-resume">
                    <div class="author-resume">
                        <div class="col-md-3 d-inline-block">
                            <div class="user-pic">
                                <img src="<?php echo base_url(); ?>assets/img/dp.png" class="img-thumbnail" alt="">
                                <a href="#" class="btn btn-common mt-2 ml-2 faltu-anchor"></a>
                            </div>
                        </div>
                        <div class="author-info d-inline-block ml-3">
                            <h3><b><?php echo $clientDetail['name'] ?></b></h3>
                            <p class="sub-title">UI/UX Designer</p>
                            <p><span class="address"><i class="lni-map-marker"></i>Mahattan, NYC, USA</span> <span><i class="ti-phone"></i>(+01) 211-123-5678</span></p>
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
                                        <a href="<?php echo site_url('AddFreelancerReview/index/'.$clientDetail['user_id'])?>"   class="btn btn-common btn-xs "  >Add Review</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        
                                        <?php
                                        $where  = [ 'email' => $this->session->userdata('user_info') ];
                                         $user   = $this->Users->getData($where)->row();
                                        if($user->role_id == 1)
                                        {
                                         foreach($comment as $comments)
                                                    {
                                                     ?>
                                        <div class="manager-resumes-item">
                                            <div class="manager-content">
                                                <a href="resume.html"><img class="resume-thumb" src="<?php echo base_url(); ?>assets/img/jobs/avatar-1.png" alt=""></a>
                                                <div class="manager-info">
                                                    <div class="manager-name">
                                                        <h4><a href="#"><?php echo $clientDetail['name'] ?></a></h4>
                                                        <h5><?php echo $clientDetail['email'] ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-body">
                                                <div class="content">
                                                    <b>Review</b>
                                                    
                                                    <P><?php echo $comments?>
                                                    
                                                </p>

                                                </div>
                                            </div>
                                        </div>
                                        <?php } 
                                        }?>

            </div>
        </div>
    </div>
</div>                                           
<?php } ?>