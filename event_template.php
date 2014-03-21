<?php get_header(); ?>
<?php

function getPostsBySpeaker($current_post_id) {
    $speakerPosts = array();
    $counter = 0;
    $current_post_presenters = get_post_meta($current_post_id, 'presenters')[0];

    if ($current_post_presenters)
        $current_post_presenters = explode(', ', $current_post_presenters);

    $loop = new WP_Query(array('post_type' => 'devotional'));
    if ($loop->have_posts()) {
        while ($loop->have_posts()) {
            $loop->the_post();
            $post_id = get_the_ID();
            $loop_presenters = get_post_meta(get_the_ID(), 'presenters')[0];
            if ($loop_presenters)
                $loop_presenters = explode(', ', $loop_presenters);
            foreach ($loop_presenters as $test) {
                foreach ($current_post_presenters as $comp) {
                    if ($test == $comp) {
                        if ($post_id != $current_post_id) {
                            $add = true;
                            foreach ($speakerPosts as $toAdd) {
                                if ($toAdd == $post_id)
                                    $add = false;
                            }
                            if ($add)
                                array_push($speakerPosts, $post_id);
                        }
                    }
                }
            }
            if (count($speakerPosts) == 2)
                break;
        }
    }
    if (($speakerPosts))
        return $speakerPosts;
    else
        return "No Posts Found";
}

$current_post = get_the_ID();
$post_types = array('devotional' => 'BYU-Idaho Devtional');

//initialize all meta variables
$meta = get_post_meta(get_the_ID());
//loop through meta and create variables with the name of the key
foreach($meta as $key => $value) { ${$key} = $value[0]; }
//make two variables for the event's date and start time since in the meta they
//are stored as one string
$event_date_only = date("Y-m-d", $event_date);
$event_start_time = date("h:i A", $event_date);
$current_post_type = get_post_type();


?>
<div class="row">
    <div class="col-xs-12 col-sm-8">
        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            <?php include_once('partials/event_media.php'); ?>
            <?php include_once('partials/transcript_discuss.php'); ?>
        </div>
        <!-- <?php comments_template(); ?> -->
    </div>
    <aside class="col-xs-12 col-sm-4">
        <div class="aside-holder">
            <div class="sidebar-inner event-details">
                <h2>Event Details</h2>
                <ul>
                    <li><span>Event Type: </span><?php echo $post_types[$current_post_type]; ?></li>
                    <li><span>Speaker: </span><?php echo get_the_title($presenters[0]); ?></li>
                    <li><span>When: </span><?php echo date('l, F jS, Y \a\t g:i A', $post_time); ?></li>
                    <li><span>Where: </span> <?php echo $meta['event_location'][0]; ?></li>
                    <li>
                        <span>Prepare: </span>The following scriptures have been recommended by the speaker, in preparation for the event.
                        <ul>
                            <?php foreach ($prep_material as $prep): ?>
                                <li><?php echo $prep; ?></li>
<?php endforeach; ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="sidebar-inner speaker-bio">
<?php foreach ($presenters as $person) : ?>

                    <h2>Speaker Bio</h2>
                    <div class="group">
                        <div class="sidebar-speaker-image"><?php echo get_the_post_thumbnail($person); ?></div>
                        <div class="sidebar-speaker-info">
                            <h3><?php echo get_the_title($person); ?></h3>
                            <?php
                            $string = get_post_meta($person, 'speaker_bio')[0];
                            $string = substr($string, 0, strpos(wordwrap($string, 150), "\n"));
                            ?>
                            <p class="sidebar-speaker-meta"><?php echo $string; ?> </p>
                            <a class="read-more" href="<?php echo get_permalink($person) ?>">More</a>
                        </div>
                    </div>
<?php endforeach; ?>
            </div>
            <div class="sidebar-inner sidebar-featured-speeches">
                <h2>Related Speeches</h2>
                <div>
                    <h3>By this Speaker</h3>
                    <?php
                    $posts = getPostsBySpeaker($current_post);
                    if (is_array($posts)) :
                        foreach ($posts as $post) :
                            ?>
                            <div>
                                <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                                <p><?php echo get_the_title($meta['presenters'][0]); ?></p>
                                <p class="meta"><?php echo get_post_meta($meta['presenters'][0], 'title')[0]; ?></p>
                            </div>
    <?php endforeach;
else: echo $posts;
endif; ?>
                </div>
                <hr>
                <div>
                    <h3>On this Topic</h3>
                    <?php
                    $sameTopicPosts = array();
                    $counter = 0;
                    $loop = new WP_Query(array('post_type' => $current_post_type));
                    if ($loop->have_posts()) {
                        while ($loop->have_posts()) {
                            $loop->the_post();
                            $tags = get_the_tags();

                            foreach ($tags as $tag) {
                                foreach ($current_post_tags as $tagTest) {
                                    if ($tag->name == $tagTest->name) {
                                        $counter++;
                                        if (!(get_the_ID() == $current_post)) {
                                            $toAdd = get_the_ID();
                                            $exists = false;
                                            foreach ($sameTopicPosts as $id) {
                                                if ($id == $toAdd)
                                                    $exists = true;
                                            }
                                            if (!$exists) :
                                                if (count($sameTopicPosts) < 2)
                                                    array_push($sameTopicPosts, $toAdd);
                                            endif;
                                        }
                                        continue;
                                    }
                                }
                            }
                        }
                    }

                    foreach ($sameTopicPosts as $post) :
                        ?>
                        <div>
                            <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                            <p>
                        <?php
                        $presenter_id = get_post_meta($post, 'presenters')[0];
                        echo get_the_title($presenter_id);
                        ?>
                            </p>
                            <p class="meta"><?php echo get_post_meta($presenter_id, 'title')[0]; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <hr>
                <div>
                    <h3>Other <?php echo $current_post_type; ?>s</h3>
                    <?php
                    $loop = new WP_Query(array('post_type' => $current_post_type));
                    while ($loop->have_posts()) : $loop->the_post();
                        $meta = get_post_meta(get_the_ID());
                        if (get_the_ID() == $current_post)
                            continue;
                        ?>
                        <div>
                            <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                            <p><?php echo get_the_title($meta['presenters'][0]); ?></p>
                            <p class="meta"><?php echo get_post_meta($meta['presenters'][0], 'title')[0]; ?></p>
                        </div>
<?php endwhile; ?>
                </div>
                <div class="center"><a class="speeches-button" href="/<?php echo $current_post_type; ?>s">View All <?php echo $current_post_type; ?>s</a></div>
            </div>
        </div>
    </aside>
</div>

<?php get_footer(); ?>