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
if (isset($_SESSION['projectsPresent'])) {
    if ($projects) {
        //var_dump($projects);die;
        foreach ($projects as $project) {
            ?>
            <section class="job-detail section dashboard-section">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-lg-8 col-md-12 col-xs-12">
                            <div class="content-area">
                            <div class="manager-info">
                                    <div class="manager-meta search-manager-meta">
                                        <span><a class="btn btn-common view-more-bids-anchor float-right ml-1" href="<?php echo site_url('DeleteProject/index/'.$project['project_id']) ?>">Delete Project</a></span>
                                        <?php //'DeleteProject/index/'.$project['project_id'] ?>
                                    </div>
                                </div>
                                <div class="manager-info">
                                    <div class="manager-meta search-manager-meta">
                                        <span><a class="btn btn-common view-more-bids-anchor float-right" href="<?php echo site_url('EditProject/index/'.$project['project_id']) ?>">Edit Project</a></span>
                                    </div>
                                </div>
                                <h4>Project</h4>
                                <h5>Project Title</h5>
                                <p><?php echo $project['title'] ?></p>
                                <h5>Project Description</h5>
                                <p><?php echo $project['description'] ?></p>
                                <h5>Project Skills</h5>
                                <div class="manager-resumes-item client-dashboard-manager">
                                    <div class="item-body client-dashboard-item">
                                        <div class="resume-skills client-dashboard-resume">
                                            <div class="tag-list">
                                                <?php foreach ($project['categories'] as  $category) 
                                                {
                                                ?>
                                                    <span><?php echo $category ?></span>
                                                <?php 
                                                }  
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h5>Project Bids</h5>
                                <div class="manager-info">
                                    <div class="manager-meta">
                                        <?php //if($project['project_id'] =) ?>
                                        <span><a class="btn btn-common view-more-bids-anchor" href="<?php echo site_url('/ViewMoreBids/index/' . $project['project_id']); ?>">View bids</a></span>
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
    else 
        {
            redirect($this->uri->uri_string());
        }
} 
else 
{
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
                                        <a href="<?php echo site_url('AddProject'); ?>"><button class="btn btn-common " type="submit" name="submit" value=""> Add Project</button></a>
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