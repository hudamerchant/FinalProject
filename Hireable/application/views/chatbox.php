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
                <div class="scroll_body">
                    <ul class="chatbox-listing">
                    
                    </ul>
                </div>
                <div class="chatarea">
                    <form method="post" class="chatbox-form" autocomplete="off" onsubmit="return false;">
                            <div class="view chatbox-view">
<!--                                 <div class="col-80 chatbox-column"> -->
                                    <input class="form-control chatbox-form-control receiver_id" type="hidden" value="<?php echo $receiver_id; ?>"> 
 <!--                                </div> -->
                                <div class="col-80 chatbox-column">
                                    <input class="form-control chat-filed chatbox-form-control message" name="message" class="message-text" type="text">
                                    <?php echo form_error('message') ?> 
                                </div>
                                <div class="col-20">
                                    <input id="text-button" class="btn btn-danger send chatbox-button" type="button" name="send" value="send">
                                </div>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>