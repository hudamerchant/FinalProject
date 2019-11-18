<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-header">
                    <h3>Update Profile</h3>
                </div>
            </div>
        </div>
    </div>
</div>


<section id="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-12 col-xs-12">
                <div class="add-resume box">
                    <form class="form-ad">
                        <h3>Profile information</h3>
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label class="control-label"></label>
                            <label class="control-label">Email</label>
                            <input type="text" class="form-control" placeholder="Your@domain.com">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Pre Hour</label>
                            <input type="text" class="form-control" placeholder="Salary, e.g. 85">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Profile Description</label>
                            <textarea class="form-control" rows="7"></textarea>
                        </div>
                            <a href="<?php echo site_url('/UpdateProfile'); ?>" class="btn btn-common">Save</a>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</section>