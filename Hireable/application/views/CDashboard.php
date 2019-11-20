<!-- <div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1 class="col align-self-center">Welcome Client</h1>
        </div>
    </div>
</div> -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-header">
                    <h3>Client Dashboard</h3>
                </div>
            </div>
        </div>
    </div>
</div>
 <?php 
    if(isset($_SESSION['projectsPresent'])){
        foreach ($projects as $project) {
            // var_dump($projects);die;
            
         ?>
        <section class="job-detail section dashboard-section">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-8 col-md-12 col-xs-12">
                        <div class="content-area">
                            <h5>Project Title</h5>
                            <p><?php echo $project['title'] ?></p>
                            <h5>Project Description</h5>
                            <p><?php echo $project['description'] ?></p>
                            <h5>Project Skills</h5>
                            <div class="manager-resumes-item client-dashboard-manager">
                                <div class="item-body client-dashboard-item">
                                    <div class="resume-skills client-dashboard-resume">
                                        <div class="tag-list">
                                            <?php foreach ($project['categories'] as  $category) {
                                               ?>
                                            <span><?php echo $category ?></span>
                                            
                                            <?php }  ?>
                                            <!-- <span>CSS3</span>
                                            <span>Bootstrap</span>
                                            <span>Wordpress</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5>Project Bids</h5>
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
                                            <span><a href="#" class="btn btn-common">Hire</a></span>
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
                                            <span><a href="#" class="btn btn-common">Hire</a></span>
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
else{
    ?>
        <section class="job-detail section dashboard-section">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-8 col-md-12 col-xs-12">
                        <div class="content-area">
                            <h5 class="client-dashboard-center">No projects yet</h5>
                            <p class="client-dashboard-center">Please insert a project first</p>
                            <div class="form-group">
                                <div class="button-group">
                                    <div class="action-buttons">
                                        <div class="client-dashboard-center">
                                            <a href="<?php echo base_url('/index.php/AddProject'); ?>"><button  class="btn btn-common " type="submit" name="submit" value=""> Add Project</button></a>                                            
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
