<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-header">
                    <h3>Freelancer Profile</h3>
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
                    <h4>Manage Account<a href='<?php echo site_url('updateFProfile') ?>'> Edit </a></h4>

                    <ul class="list-item">
                        <li><?php echo $freelancer_info->name ?></li>
                        <li><?php echo $freelancer_info->dob ?></li>
                        <li><?php echo $freelancer_info->gender ?></li>
                        <li><?php echo $freelancer_info->email ?></li>
                        <li>Skills
                            <ul>
                            <li class="skill-list" >skill 1</li>
                            <li class="skill-list" >skill 1</li>
                            <li class="skill-list" >skill 1</li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div>
                </div>
                    </div>
            <div class="col-lg-8 col-md-8 col-xs-12">
                <div class="inner-box my-resume">
                    <div class="author-resume">
                    
                        <div class="col-md-3 d-inline-block">
                         <div class="user-pic">
                         <img src="<?php echo base_url();?>assets/img/dp.png" class="img-thumbnail" alt="">
                         <a href="#"  class="btn btn-common mt-2 ml-2">Upload</a>
                         </div>
                        </div>
                        <!-- <form action="" method="POST" enctype='multipart/form-data'>
                        <div class="form-group">
                          <label for="profile">Profile</label>
                          <input class="form-control" type="file" name="profile" id="profile">
                        </div> 
                        </form> -->
                        <div class="author-info d-inline-block ml-3">
                            <h3><b><?php echo $freelancer_info->name ?></b></h3>
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
                    <div class="about-me item">
                        <h3>About Me</h3>
                        <p>Nullam semper erat arcu, ac tincidunt sem venenatis vel. Curabitur a dolor ac ligula fermentum eusmod ac ullamcorper nulla. Integer blandit uitricies aliquam. Pellentesque quis dui varius, dapibus vilit id, ipsum. Morbi ac eros feugiat, lacinia elit ut, elementum turpis. Curabitur justo sapien, tempus sit amet ruturm eu, commodo eu lacus. Morbi in ligula nibh. Maecenas ut mi at odio hendririt eleif end tempor vitae augue. Fusce eget arcu et nibh dapibus maximus consectetur in est. Sed iaculis Luctus nibh sed veneatis. </p>
                    </div>
                    <form class="form-ad" method="post">


                        <div class="form-group">
                            <label class="control-label pt-3"><h6>Please add your reviews here</h6></label>
                            <textarea class="form-control" name='review' rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="button-group">
                                <div class="action-buttons">
                                    <div class="upload-button">
                                        <button class="btn btn-common" name="submit">Submit</button>
                                        <div>
                            <?php
                               if(isset($_SESSION['reviewInserted'])){
                             ?>
                         <p class="alert alert-success mt-3"><?php  echo $this->session->flashdata("reviewInserted");?></p>
    
                          <?php
                          }
                          ?>
                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                    <!-- <div class="col-lg-8 col-md-8 col-xs-8"> -->
    <h6><b class="mt-5 text-dark">REVIEWS</b></h6>
        <div class="manager-resumes-item">
            <div class="manager-content">
                <a href="resume.html"><img class="resume-thumb" src="<?php echo base_url(); ?>assets/img/jobs/avatar-1.png" alt=""></a>
                <div class="manager-info">
                    <div class="manager-name">
                        <h4><a href="#">Freelancer</a></h4>
                        <h5>freelancer@example.com</h5>
                    </div>
                </div>
            </div>
            <div class="item-body">
                <div class="content">
                    <b>Review</b>
                    <p>4 Kabla ya kusanyiko wazazi fulani wameona inafaa kuzungumza na watoto wao kuhusu mwenendo unaofaa.</p>
        </div>
            </div>
                </div>
            </div>
        </div>      
    </div>  
<!-- </div> -->

