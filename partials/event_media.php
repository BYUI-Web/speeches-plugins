<!-- TO DO -->
<!-- 1. After state of media has been added
            - Show a different message based on the state of the mediacy
              in the generic banner
            - Gray out boxes and put message of status of media
-->


<?php
//determine which video player to use
$post_status = postTimeStatus(get_the_ID());
//has the event already past?
if ($post_status == "past") {
    //check to see if the video has been provided
    if ($video_status == "yes") {
        $video_player = $video_embed;
    } else if ($video_status == "not_yet") {
        $video_player = "<img src='/wp-content/themes/speeches-theme/images/speech-banner.jpg'/>";
        $video_player .= "<p>The video for this event is not yet available. Please check back later.</p>";
    } else if ($video_status == "never") {
        $video_player = "<img src='/wp-content/themes/speeches-theme/images/speech-banner.jpg'/>";
        $video_player .= "<p>There will not be a video provided for this event.</p>";
    }
    if ($audio_status == "yes") {
        $audio_player = $audio_embed;
    } else if ($audio_status == "not_yet") {
        $audio_player = "<p>The audio for this event is not yet available. Please check back later.</p>";
    } else if ($audio_status == "never") {
        $audio_player = "<p>There will not be audio provided for this event.</p>";
    }
}
//could be during the event
else if ($post_status == "present") {
    //do they have a live stream embed code?
    if ($live_stream == "yes") {
        $video_player = $live_stream_embed;
    }
    //if not then we must show the generic banner
    else {
        $video_player = "<img src='/wp-content/themes/speeches-theme/images/speech-banner.jpg'/>";
        $video_player .= "<p>This event is currently not available. Attend the event ";
        $video_player .= "on " . date('l, F jS, Y \a\t g:i A', $event_date) . "</p>";
    }
}
//the event is in the future
else {
    //we need some sort of banner to display instead of just text
    //Reanna is working on that
    $video_player = "<img src='/wp-content/themes/speeches-theme/images/speech-banner.jpg'/>";
    $video_player .= "<p>This event is currently not available. Attend the event ";
    if ($live_stream == "yes") {
        $video_player .= "or watch the live stream";
    }
    $video_player .= "on " . date('l, F jS, Y \a\t g:i A', $event_date) . "</p>";
}
?>

<div class="event-featured">
    <div>
        <div id="video-player">
            <?php echo $video_player; ?>
        </div>
        <div id="audio-player">
            <?php echo $audio_player; ?>
        </div>
    </div>
    <div class="additional-featured group">
        <div class="custom-box <?php echo ($video_status != "yes") ? 'disabled' : ''; ?>">
            <a href="javascript:void(0)" onclick="dispVideo(this)">
                <img class="feat_icon" src="<?php bloginfo('template_url'); ?>/images/tv.png" >
                <div class="right">
                    <h3>Watch</h3>
                </div>
            </a>
        </div>
        <div class="custom-box <?php echo ($transcript_status != "yes") ? 'disabled' : ''; ?>">
            <a href="javascript:void(0)" onclick="dispRead(this)">
                <img class="feat_icon" src="<?php bloginfo('template_url'); ?>/images/read.png" >
                <div class="right">
                    <h3>Read</h3>
                </div>
            </a>
        </div>
        <div class="custom-box <?php echo ($audio_status != "yes") ? 'disabled' : ''; ?>">
            <a href="javascript:void(0)" onclick="dispListen(this)">
                <img class="feat_icon" src="<?php bloginfo('template_url'); ?>/images/headphones.png" >
                <div class="right">
                    <h3>Listen</h3>
                </div>
            </a>
        </div>
        <div class="custom-box last">
            <a href="javascript:void(0)" onclick="dispDiscuss()">
                <img class="feat_icon" src="<?php bloginfo('template_url'); ?>/images/chatbubble.png" >
                <div class="right">
                    <h3>Discuss</h3>
                </div>
            </a>
        </div>
    </div>
    <div class="addition-featured-more">
        <div id="watch">
            <ul>
                <li><a href="<?php echo $video_download; ?>" download>Download Video</a></li>
                <li><a href="#">Share (embed link)</a></li>
            </ul>
        </div>
        <div id="read">
            <ul>
                <li><a href="#">Download Transcript</a></li>
                <li><a href="#">Share (embed link)</a></li>
            </ul>
        </div>
        <div id="listen">
            <ul>
                <li><a href="<?php echo $audio_download; ?>" download>Download MP3</a></li>
                <li><a href="#">Share (embed link)</a></li>
            </ul>
        </div>
    </div>
</div>