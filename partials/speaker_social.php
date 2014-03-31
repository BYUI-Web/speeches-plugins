<?php 
$facebook = get_post_meta($speaker_id, "facebook", true);
$twitter = get_post_meta($speaker_id, "twitter", true);
$google_plus = get_post_meta($speaker_id, "google_plus", true);
$website = get_post_meta($speaker_id, "website", true);
?>

<div class="speaker-social">
    <?php
        if (!empty($facebook)) {
            echo "<a href='$facebook' target='_blank'><img src='". get_bloginfo('template_url') ."/images/facebook.png' alt='Facebook Icon'/></a>";
        }
        if (!empty($twitter)) {
            echo "<a href='$twitter' target='_blank'><img src='/wp-content/themes/speeches-theme/images/twitter.png' alt='Twitter Icon'/></a>";
        }
        if (!empty($google_plus)) {
            echo "<a href='$google_plus' target='_blank'><img src='/wp-content/themes/speeches-theme/images/google_plus.png' alt='Google+ Icon'/></a>";
        }
        if (!empty($website)) {
            echo "<a href='$website' target='_blank'><i class='icon-earth'></i></a>";
        }
    ?>
</div>