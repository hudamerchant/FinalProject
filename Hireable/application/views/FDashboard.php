
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-header">
                    <h3>Freelancer Dashboard(Bids)</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_SESSION['freelancerBidsPresent'])) {
    foreach ($results as $result) {
        // var_dump($results['remainingData']);die;
        // yahan start

        // if($results['profilePicPath']){

            if($result->profile_pic != ''){
                $profilePicPath = $this->data['image_path'];
               $profilePicVariable = $result->profile_pic;
            }
            elseif($result->profile_pic == ''){
                $profilePicVariable = '';
            }
        // }

        // yahan khatam
        
        
        ?>
        <div class="col-lg-8 col-md-8 col-xs-8">
            <div class="manager-resumes-item">
                <div class="manager-content ">
                <?php 
                        if(isset($profilePicVariable) && $profilePicVariable != ''){
                            ?>
                            <img class="resume-thumb" src="<?php echo $profilePicPath.$profilePicVariable ?>" alt="">
                            <?php
                        }
                        else{
                            ?>                            
                            <img class="resume-thumb" src="<?php echo base_url(); ?>assets/img/jobs/avatar-1.png" alt="">
                            <?php
                        }
                    ?>
                    <div class="manager-info">
                        <div class="manager-name">
                            
                            <h4><a href="#"><?php echo $result->name ?></a></h4>
                            <h5><?php echo $result->email ?></h5>
                        </div>
                    </div>
                </div>
                <div class="item-body">
                    <div class="content project-details-content">
                        <b>Project Title</b>
                        <p><?php echo $result->project_title ?></p>
                    </div>        
                    <div class="manager-content project-details-manager-content">
                        <div class="item-body">            
                            <div class="resume-skills project-details-resume-skills">
                                <div class="resume-exp float-right">
                                    <a href="<?php echo site_url('ProjectDetails/index/'.$result->project_id) ?>"  name="submit" class="btn btn-common btn-xs "  >View project</a>
                                </div>
                            </div>
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
                        <h5 class="client-dashboard-center">No bids yet</h5>
                        <p class="client-dashboard-center">Go back to your dashboard</p>
                        <div class="form-group">
                            <div class="button-group">
                                <div class="action-buttons">
                                    <div class="client-dashboard-center">
                                        <a href="<?php echo site_url('Freelancer'); ?>"><button class="btn btn-common " type="submit" name="submit" value="">Dashboard</button></a>
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