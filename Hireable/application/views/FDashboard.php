
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-header">
                    <h3>Freelancer Dashboard</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_SESSION['Bid'])){
    ?>
    <p class="alert alert-info"><?php  echo $this->session->flashdata("Bid");?></p>
    <?php
}
?>
<?php
if (isset($_SESSION['projectsPresent'])) {
    foreach ($projects as $project) {

        ?>
        <div class="col-lg-8 col-md-8 col-xs-8">
            <div class="manager-resumes-item">
                <div class="manager-content">
                    <a href="resume.html"><img class="resume-thumb" src="<?php echo base_url(); ?>assets/img/jobs/avatar-1.png" alt=""></a>
                    <div class="manager-info">
                        <div class="manager-name">
                            <h4><a href="#"><?php echo $project['name'] ?></a></h4>
                            <h5><?php echo $project['email'] ?></h5>
                        </div>
                    </div>
                </div>
                <div class="item-body">
                    <div class="content">
                        <b>Project Title</b>
                        <p><?php echo $project['title'] ?></p>
                        <b>Project Description</b>
                        <p><?php echo $project['description'] ?></p>
                    </div>
                    <div class="resume-skills">
                        <div class="tag-list">

                            <?php 
                            foreach ($project['categories'] as  $category) {
                            ?>
                                <span><?php echo $category ?></span>

                            <?php 
                            }  
                            ?>
                            
                        </div>
                        <div class="resume-exp float-right">
                            
                            <a href="<?php echo site_url('Freelancer/index/'.$project['project_id']) ?>"  name="submit" class="btn btn-common btn-xs">Apply</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
        }
    } else {
        ?>
    <section class="job-detail section dashboard-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-8 col-md-12 col-xs-12">
                    <div class="content-area">
                        <h5 class="client-dashboard-center">No projects yet</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
}
?>