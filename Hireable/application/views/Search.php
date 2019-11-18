<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-header">
                    <h3><?php if (isset($_SESSION['freelancerRole'])) {
                            echo "Search Projects";
                        } else {
                            echo "Search Freelancers";
                        } ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_SESSION['freelancerRole'])) {
    ?>
    <div class="col-lg-8 col-md-8 col-xs-8">
        <div class="manager-resumes-item">
            <div class="manager-content">
                <a href="resume.html"><img class="resume-thumb" src="<?php echo base_url(); ?>assets/img/jobs/avatar-1.png" alt=""></a>
                <div class="manager-info">
                    <div class="manager-name">
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
                    <p>Kuch bhi</p>
                    <b>Project Description</b>
                    <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi umsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit</p>
                </div>
                <div class="resume-skills">
                    <div class="tag-list float-left">
                        <span>HTML5</span>
                        <span>CSS3</span>
                        <span>Bootstrap</span>
                        <span>Wordpress</span>
                    </div>
                    <div class="resume-exp float-right">
                        <a href="#" class="btn btn-common btn-xs">Apply</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-xs-8">
        <div class="manager-resumes-item">
            <div class="manager-content">
                <a href="resume.html"><img class="resume-thumb" src="<?php echo base_url(); ?>assets/img/jobs/avatar-1.png" alt=""></a>
                <div class="manager-info">
                    <div class="manager-name">
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
                    <p>Kuch bhi</p>
                    <b>Project Description</b>
                    <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi umsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit</p>
                </div>
                <div class="resume-skills">
                    <div class="tag-list float-left">
                        <span>HTML5</span>
                        <span>CSS3</span>
                        <span>Bootstrap</span>
                        <span>Wordpress</span>
                    </div>
                    <div class="resume-exp float-right">
                        <a href="#" class="btn btn-common btn-xs">Apply</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-xs-8">
        <div class="manager-resumes-item">
            <div class="manager-content">
                <a href="resume.html"><img class="resume-thumb" src="<?php echo base_url(); ?>assets/img/jobs/avatar-1.png" alt=""></a>
                <div class="manager-info">
                    <div class="manager-name">
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
                    <p>Kuch bhi</p>
                    <b>Project Description</b>
                    <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi umsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit</p>
                </div>
                <div class="resume-skills">
                    <div class="tag-list float-left">
                        <span>HTML5</span>
                        <span>CSS3</span>
                        <span>Bootstrap</span>
                        <span>Wordpress</span>
                    </div>
                    <div class="resume-exp float-right">
                        <a href="#" class="btn btn-common btn-xs">Apply</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-xs-8">
        <div class="manager-resumes-item">
            <div class="manager-content">
                <a href="resume.html"><img class="resume-thumb" src="<?php echo base_url(); ?>assets/img/jobs/avatar-1.png" alt=""></a>
                <div class="manager-info">
                    <div class="manager-name">
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
                    <p>Kuch bhi</p>
                    <b>Project Description</b>
                    <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi umsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit</p>
                </div>
                <div class="resume-skills">
                    <div class="tag-list float-left">
                        <span>HTML5</span>
                        <span>CSS3</span>
                        <span>Bootstrap</span>
                        <span>Wordpress</span>
                    </div>
                    <div class="resume-exp float-right">
                        <a href="#" class="btn btn-common btn-xs">Apply</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
    ?>
    <div class="col-lg-8 col-md-12 col-xs-12">
        <div class="job-alerts-item candidates">
            <!-- <h3 class="alerts-title">Manage Resumes</h3> -->
            <div class="manager-resumes-item">
                <div class="manager-content">
                    <a href="resume.html"><img class="resume-thumb" src="<?php echo base_url(); ?>assets/img/jobs/avatar-1.jpg" alt=""></a>
                    <div class="manager-info">
                        <div class="manager-name">
                            <h4><a href="#">Zane Joyner</a></h4>
                            <h5>Front-end developer</h5>
                        </div>
                        <div class="manager-meta">
                            <span class="location"><i class="lni-map-marker"></i> Cupertino, CA, USA</span>
                            <span class="rate"><i class="lni-alarm-clock"></i> $55 per hour</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="manager-resumes-item">
                <div class="manager-content">
                    <a href="resume.html"><img class="resume-thumb" src="<?php echo base_url(); ?>assets/img/jobs/avatar-1.jpg" alt=""></a>
                    <div class="manager-info">
                        <div class="manager-name">
                            <h4><a href="#">Zane Joyner</a></h4>
                            <h5>Front-end developer</h5>
                        </div>
                        <div class="manager-meta">
                            <span class="location"><i class="lni-map-marker"></i> Cupertino, CA, USA</span>
                            <span class="rate"><i class="lni-alarm-clock"></i> $55 per hour</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="manager-resumes-item">
                <div class="manager-content">
                    <a href="resume.html"><img class="resume-thumb" src="<?php echo base_url(); ?>assets/img/jobs/avatar-1.jpg" alt=""></a>
                    <div class="manager-info">
                        <div class="manager-name">
                            <h4><a href="#">Zane Joyner</a></h4>
                            <h5>Front-end developer</h5>
                        </div>
                        <div class="manager-meta">
                            <span class="location"><i class="lni-map-marker"></i> Cupertino, CA, USA</span>
                            <span class="rate"><i class="lni-alarm-clock"></i> $55 per hour</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="manager-resumes-item">
                <div class="manager-content">
                    <a href="resume.html"><img class="resume-thumb" src="<?php echo base_url(); ?>assets/img/jobs/avatar-1.jpg" alt=""></a>
                    <div class="manager-info">
                        <div class="manager-name">
                            <h4><a href="#">Zane Joyner</a></h4>
                            <h5>Front-end developer</h5>
                        </div>
                        <div class="manager-meta">
                            <span class="location"><i class="lni-map-marker"></i> Cupertino, CA, USA</span>
                            <span class="rate"><i class="lni-alarm-clock"></i> $55 per hour</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php
}
?>