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
    <div class="row space-100 justify-content-center">
        <div class="col-lg-10 col-md-12 col-xs-12">
            <div class="contents">
                <div class="job-search-form freelancer-search">
                    <form action="<?php echo site_url('/Search'); ?>">
                        <div class="row">
                            <div class="col-md-11 ">
                                <div class="form-group">
                                    <input name='required-skill' class="form-control" type="text" placeholder="Search for any project">
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-6 col-xs-12">
                                <button type="submit" class="button"><i class="lni-search"></i></button>
                            </div>
                        </div>
                    </form>
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
    // var_dump($projects);die;
    foreach ($projects as $project) {

        ?>
        <div class="col-lg-8 col-md-8 col-xs-8 project">
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
                            <?php if(in_array($project['project_id'], $applied))
                            {?>
                            <a href="<?php echo site_url('Freelancer/index/'.$project['project_id']) ?>"  name="submit" class="btn btn-common btn-xs disabled bg-success"  >Applied</a>
                            <?php }else{?>
                                <a href="<?php echo site_url('Freelancer/index/'.$project['project_id']) ?>"  name="submit" class="btn btn-common btn-xs "  >Apply</a>
                            <?php }  ?>
                            
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
<?php
} else {
    ?>
    <div class="row space-100 justify-content-center">
        <div class="col-lg-10 col-md-12 col-xs-12">
            <div class="contents">
                <div class="job-search-form freelancer-search">
                    <form action="<?php echo site_url('/Search'); ?>">
                        <div class="row">
                            <div class="col-md-11 ">
                                <div class="form-group">
                                    <input name ='skill' class="form-control" type="text" placeholder="Search for any skill" value="<?php echo ($this->session->flashdata('search') != null ? $this->session->flashdata('search') : '' ) ?>">
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-6 col-xs-12">
                                <button type="submit" class="button"><i class="lni-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-12 col-xs-12">
        <div class="job-alerts-item candidates">
            <!-- <h3 class="alerts-title">Manage Resumes</h3> -->

<?php
    if(isset($msg))
    {?>
        <p><?php echo $msg ?></p>
    <?php }
    elseif(isset($freelancers)){
        foreach ($freelancers as $freelancer) {
        
?>

            <div class="manager-resumes-item">
                <div class="manager-content">
                    <a href="resume.html"><img class="resume-thumb" src="<?php echo base_url(); ?>assets/img/jobs/avatar-1.jpg" alt=""></a>
                    <div class="manager-info">
                        <div class="manager-name">
                            
                            <h4><a href="#"><?php echo $freelancer->name ?></a></h4>
                            <h5><?php echo $freelancer->email ?></h5>
                        </div>
                        <div class="manager-info">
                            <div class="manager-meta search-manager-meta">
                                <span><a class="btn btn-common view-more-bids-anchor" href="<?php echo site_url('FreelancerProfileForClients/index/'.$freelancer->user_id) ?>">View Profile</a></span>
                            </div>
                        </div>
                        <div class="manager-info">
                            <div class="manager-meta search-manager-meta">
                                <span><a class="btn btn-common view-more-bids-anchor" href="">Contact</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php
        }
    }
?>

        </div>
    </div>
    </div>
<?php
}
?>