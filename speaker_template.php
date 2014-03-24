<?php get_header(); ?>

<?php

function getPostsBySpeaker($id) {
	$speakerPosts = array();
	$counter = 0;

	$loop = new WP_Query( array( 'post_type' => array('devotional', 'forum')) );
    while ($loop->have_posts()) {
        $loop->the_post();
        $post_id = get_the_ID();
        $loop_presenters = get_post_meta(get_the_ID(),'presenters')[0];
        if ($loop_presenters) {
            $loop_presenters = explode(', ', $loop_presenters);
            
            if (in_array($id, $loop_presenters)) {
                array_push($speakerPosts, $post_id);
            }

        }
    }
    return $speakerPosts;
}

/*
 * Variables for this post
 */

$id = get_the_ID();
$speakerName = get_the_title();
$image = wp_get_attachment_image_src(get_post_thumbnail_id())[0];
$bio = wpautop(get_post_meta($id, "speaker_bio")[0]);

$speaker_posts = getPostsBySpeaker($id);

?>

<div class="row speaker-wrapper">
    <div class="col-xs-12 col-md-3 speaker-image">
        <img src="<?php echo $image; ?>" alt="<?php echo $speakerName; ?>'s Image"/>
    </div>
    <div class="col-xs-12 col-md-9 speaker-bio-wrapper">
        <div class="speaker-name">
            <h2>
                <?php echo $speakerName; ?>
            </h2>
        </div>
        <div class="speaker-bio">
            <?php echo $bio; ?>
        </div>
    </div>
    <section class="col-xs-12 col-md-9 speaker-speeches">
        <div class="speeches-inner">
            <h2 class="speaker-speeches-header">From This Speaker</h2>
            <ul class="speaker-speeches-list">
                <?php foreach ($speaker_posts as $post): ?>
                    <?php
                    $post_title = get_the_title($post);
                    $post_date = date("F jS, Y", get_post_meta($post, "event_date")[0]);
                    $url = get_permalink($post);
                    ?>
                    <li>
                        <a href="<?php echo $url; ?>" class="speaker-post-title"><?php echo $post_title; ?></a>
                        <p class="speaker-post-date"><?php echo $post_date; ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
</div>

<?php get_footer();