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
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="right-sideabr">
                    <h4>Manage Account<a href='<?php echo site_url('updateCProfile') ?>' class="profile-anchor"> Edit </a></h4>
                    <ul class="list-item">
                        <li><span class="profile-li-span">Name:</span><?php echo $client_info->name ?></li>
                        <li><span class="profile-li-span">Date Of Birth:</span><?php echo $client_info->dob ?></li>
                        <li><span class="profile-li-span">Gender:</span><?php echo $client_info->gender ?></li>
                        <li><span class="profile-li-span">Email:</span><?php echo $client_info->email ?></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-xs-12">
                <div class="inner-box my-resume">
                    <div class="author-resume">
                        <div class="col-md-3 d-inline-block">
                            <div class="user-pic">
                                <img src="<?php echo base_url(); ?>assets/img/dp.png" class="img-thumbnail" alt="">
                                <a href="#" class="btn btn-common mt-2 ml-2">Upload</a>
                            </div>
                        </div>
                        <!-- <form action="" method="POST" enctype='multipart/form-data'>
                        <div class="form-group">
                          <label for="profile">Profile</label>
                          <input class="form-control" type="file" name="profile" id="profile">
                        </div> 
                        </form> -->
                        <div class="author-info d-inline-block ml-3">
                            <h3><b><?php echo $client_info->name ?></b></h3>
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



                    <form class="form-ad" method="post">
                        <div class="form-group">
                            <label class="control-label pt-3">
                                <h6>Please add your reviews here</h6>
                            </label>
                            <textarea class="form-control" rows="5" name='review'></textarea>
                        </div>
                        <div class="form-group">
                            <div class="button-group">
                                <div class="action-buttons">
                                    <div class="upload-button">
                                        <button class="btn btn-common" name="submit">Submit</button>
                        <form action="" method="POST" enctype='multipart/form-data'>
                            <div class="form-group col-md-5">
                            <div>
                            <?php
                               if(isset($_SESSION['reviewInserted'])){
                             ?>
                         <p class="alert alert-info mt-3"><?php  echo $this->session->flashdata("reviewInserted");?></p>
    
                          <?php
                          }
                          ?>
                          </div>
                                                </div>
                                                <!-- <label for="profile">Profile Photo</label> -->
                                                <input class="form-control" type="file" name="profile" id="profile">

                                            </div>
                                        </form>
                                        <h6><b class="mt-5 text-dark">REVIEWS</b></h6>
                                        <?php foreach($comments as $comment)
                                                    {
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
                                                    
                                                    <P><?php echo $comment?>
                                                    
                                                </p>

                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>


        </div>
    </div>
</div>
</div>
</div>