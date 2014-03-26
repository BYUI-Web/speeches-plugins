<?php
// Include Model
require_once 'event_model.php';
get_header();
$calendar = getCalendar(strtotime('now'));
?>
<div class="row">
    <div class="col-xs-12">
        <h1 class="">Speeches Calendar</h1>
        <div class="calendar-switch">
            <a href="#timeline" class="btn btn-speeches">Timeline</a>
            <a href="#calendar" class="btn btn-speeches cal-active">Calendar</a>
        </div>
    </div>
</div>
<?php foreach ($calendar as $month => $posts) : ?>
    <div class="calendar-month">
        <h2 class="month-title"><?php echo $month; ?></h2>
        <hr>
        <div class="row">
            <?php
            foreach ($posts as $post) :

                //get post data
                $post = get_post($post);
                $day = date("d", get_post_meta($post->ID, "event_date", true));
                $post_type = strtoupper(get_post_type($post->ID));
                $location = get_post_meta($post->ID, "event_location", true);
                $url = get_permalink($post->ID);

                //get speaker data
                $speakers = explode(", ", get_post_meta($post->ID, "presenters", true));
                ?>
                <div class="calendar-post col-xs-12 col-md-4">
                    <div class="calendar-post-date">
                        <span><?php echo $day; ?></span>
                    </div>
                    <div class="calender-post-info">
                        <p class="info-post-type"><?php echo $post_type; ?></p>
                        <p class="info-post-location"><?php echo $location; ?></p>
                        <div class="post-speakers">
                            <?php
                            foreach ($speakers as $speaker) :
                                $speaker = get_post($speaker);
                                $speaker_name = get_the_title($speaker->ID);
                                $speaker_title = get_post_meta($speaker->ID, "title", true);
                                ?>
                                <p class="calendar-speaker-name"><?php echo $speaker_name; ?></p>
                                <p class="calendar-speaker-title"><?php echo $speaker_title; ?></p>
                            <?php endforeach; ?>
                        </div>
                        <a href="<?php echo $url; ?>" class="btn btn-speeches">Learn More</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>

<?php get_footer(); ?>