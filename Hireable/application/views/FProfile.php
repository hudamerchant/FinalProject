<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-header">
                    <h3>Freelancer profile</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_SESSION['profilePicUploaded'])) {
    ?>
    <p class="alert alert-success"><?php echo $this->session->flashdata("profilePicUploaded"); ?></p>
<?php
}
?>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="right-sideabr">
                    <h4>Manage Account<a href='<?php echo site_url('updateFProfile') ?>' class="profile-anchor"> Edit </a></h4>
                    <ul class="list-item">
                        <li><span class="profile-li-span">Name:</span><?php echo $freelancer_info->name ?></li>
                        <li><span class="profile-li-span">Date Of Birth:</span><?php echo $freelancer_info->dob ?></li>
                        <li><span class="profile-li-span">Gender:</span><?php echo $freelancer_info->gender ?></li>
                        <li><span class="profile-li-span">Email:</span><?php echo $freelancer_info->email ?></li>
                        <li><span class="profile-li-span">Skills:</span>
                            <ul>
                                <?php
                                    foreach ($results as $result) 
                                    { 
                                ?>
                                        <li class="skill-list profile-li-skill-list"><?php echo $result->category ?></li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </li>
                        <li><span class="profile-li-span">Profile Description:</span><p class="para-description"><?php echo isset($profileDescription) ? $profileDescription : 'None' ?></p></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-xs-12">
                <div class="inner-box my-resume">
                    <div class="author-resume">
                        <div class="col-md-3 d-inline-block client-profile-margin">
                            <div class="user-pic">
                                <?php
                                    if(isset($profile_pic)) 
                                    {
                                ?>
                                        <img src="<?php echo $profile_pic ?>" class="img-thumbnail" alt="">
                                <?php
                                    } 
                                    else 
                                    {
                                ?>
                                        <img src="<?php echo base_url(); ?>assets/img/dp.png" class="img-thumbnail" alt="">
                                <?php
                                    }
                                ?>
                                <form enctype="multipart/form-data" method="post">                                
                                    <?php //echo form_error('userfile') ?>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input freelancer-image" name="userfile" id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                    <!-- <input type="submit" value="Upload" name="file_submit" class="btn btn-common mt-2 ml-2"> -->
                                    <?php 
                                    // var_dump($file_error_key);die;
                                        if(isset($file_error_key)){
                                            ?><p><?php echo $file_error_key; ?></p><?php
                                        }
                                    ?>
                                    
                                </form>
                            </div>
                        </div>
                        <div class="author-info d-inline-block ml-3">
                            <h3><b><?php echo $freelancer_info->name ?></b></h3>
                            <p class="sub-title"><?php echo $freelancer_info->email ?></p>
                            <div class="rating-star">
                                <div id="rateYoReadOnly-<?php echo $freelancer_info->user_id ?>" data-rating="<?php echo isset($ratings[$freelancer_info->user_id]['avg(rating)'] ) ? $ratings[$freelancer_info->user_id]['avg(rating)'] : 0 ;  ?>" class="fetch-rating"> 
                                </div>
                            </div>
                            
                            <div class="social-link">
                                <a href="#" class="Twitter"><i class="lni-twitter-filled"></i></a>
                                <a href="#" class="facebook"><i class="lni-facebook-filled"></i></a>
                                <a href="#" class="google"><i class="lni-google-plus"></i></a>
                                <a href="#" class="linkedin"><i class="lni-linkedin-fill"></i></a>
                            </div>
                        </div>
                    </div>
            
                    <h6 class="client-profile-h6"><b class="mt-5 text-dark">REVIEWS</b></h6>
                    <?php
                        if(!empty($reviewResults)) 
                        {
                            foreach ($reviewResults as $reviewResult) 
                            {
                                //  var_dump($reviewResult);die;
                                if($reviewResult->profile_pic != '') 
                                {
                                    $profilePicPath = $this->data['image_path'];
                                    $profilePicVariable = $reviewResult->profile_pic;
                                } 
                                elseif($reviewResult->profile_pic == '') 
                                {
                                    $profilePicVariable = '';
                                }
                    ?>
                            <div class="manager-resumes-item">
                                <div class="manager-content">
                                    <?php
                                        if(isset($profilePicVariable) && $profilePicVariable != '') 
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
                                        <div class="manager-meta view-bids-button">
                                            <span><a href="<?php echo site_url('ClientProfileForFreelancers/index/'.$reviewResult->user_id) ?>" class="btn btn-common view-bids-anchor">View Profile</a></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-body">
                                    <div class="content">
                                        <b>Review</b>
                                        <p><?php echo $reviewResult->review ?>
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
