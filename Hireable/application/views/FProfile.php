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
                    </ul>
                </div>
                <div>
                <!-- <h6><b>*Please add your reviews here</b></h6> -->
                    <!-- <form method="POST">
                             <div class="form-group col-xs-12">
                              <label>REVIEWS</label>
                             <input type="text" class="form-control"> -->
                             <!-- <label>REVIEWS:</label>
                             <textarea id="comments" rows="6" cols="30">
                             </textarea>
                             </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>  --> 
                </div>
                    </div>
            <div class="col-lg-8 col-md-8 col-xs-12">
                <div class="inner-box my-resume">
                    <div class="author-resume">
                        <div class="thumb">
                            <img src="<?php echo base_url(); ?>assets/img/testimonial/img4.png" alt="">
                        </div>

                        <div class="author-info">
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

                        <form action="" method="POST" enctype='multipart/form-data'>
                            <div class="form-group col-md-5">
                                <!-- <label for="profile">Profile Photo</label> -->
                                <input class="form-control" type="file" name="profile" id="profile">

                            </div>
                        </form>
                    </div>
                    <div class="about-me item">
                        <h3>About Me</h3>
                        <p>Nullam semper erat arcu, ac tincidunt sem venenatis vel. Curabitur a dolor ac ligula fermentum eusmod ac ullamcorper nulla. Integer blandit uitricies aliquam. Pellentesque quis dui varius, dapibus vilit id, ipsum. Morbi ac eros feugiat, lacinia elit ut, elementum turpis. Curabitur justo sapien, tempus sit amet ruturm eu, commodo eu lacus. Morbi in ligula nibh. Maecenas ut mi at odio hendririt eleif end tempor vitae augue. Fusce eget arcu et nibh dapibus maximus consectetur in est. Sed iaculis Luctus nibh sed veneatis. </p>
                    </div>
                    <form class="form-ad">
                        <h6><b class="mt-5">REVIEWS</b></h6>
                        <div class="form-group">
                            <label class="control-label">Freelancer Reviews</label>
                            <textarea class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="button-group">
                                <div class="action-buttons">
                                    <div class="upload-button">
                                        <button class="btn btn-common">Submit</button>
                                        <!-- <input id="cover_img_file_2" type="file"> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>      
    </div> 
<!-- </div> -->

