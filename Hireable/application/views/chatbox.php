<!-- <div id="content">
    <div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-12 col-xs-12">
        <div class="right-sideabr">
        <h4>Users</h4>
    <ul class="list-item">
        <li><a href="resume.html">user 1</a></li>
        <li><a href="bookmarked.html">user 2</a></li>
        <li><a href="notifications.html">user 3 <span class="notinumber">2</span></a></li>
        <li><a href="manage-applications.html">user 4</a></li> -->
        <!--<li><a href="index.html">Sing Out</a></li>-->
    <!-- </ul>
    </div>
</div> --> 


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="chatbox">
                <ul class="chatbox-listing">
                    
                </ul>
                <div class="chatarea">
                    <form method="post" class="chatbox-form">
                            <div class="view chatbox-view">
                                <div class="col-80 chatbox-column">
                                    <input class="form-control chatbox-form-control receiver_id" name="message" class="message-text" type="hidden" value="<?php echo $receiver_id ?>"> 
                                </div>
                                <div class="col-80 chatbox-column">
                                    <input class="form-control chatbox-form-control message" name="message" class="message-text" type="text"> 
                                </div>
                                <div class="col-20">
                                    <input class="btn btn-danger send chatbox-button" type="button" name="send" value="send">
                                </div>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>