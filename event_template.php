<?php
// Include Model
require_once 'event_model.php';

// Set Variables For Out of Loop Usage
$current_post; 
$meta;
$post_time;
$prep_material;
$current_post_type;
get_header();
?>
<div class="row">
	<div class="col-xs-12 col-sm-8">


		<?php 
		if (have_posts()) : 
			while (have_posts()) : 
				the_post();
			$meta = get_post_meta( get_the_ID() ); 
			$current_post = get_the_ID();
			$current_post_type = get_post_type( $current_post );
			
			$presenters = explode(', ', $meta['presenters'][0]);
			$prep_material = explode(', ', $meta['prep_material'][0]);

			$speaker_title = get_post_meta($presenters[0], 'title');

            // Test each of the posts against "NOW" and see if its past present or future!
			date_default_timezone_set('America/Denver');
			$now = strtotime('now');
			$post_end_time = strtotime($meta['event_date'][0] . ' ' . $meta['event_end_date'][0]);		
            //determine which video player to use
			if (!postTimeStatus(get_the_ID()) == 'future') {
				if (postTimeStatus(get_the_ID()) == 'current' && $meta['live_stream'][0] == "yes") {
					$video_embed = $meta['live_stream_embed'][0];
				}
			} else {
				$video_embed = $meta['video_embed'][0];
			}
			?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<div class="event-featured">
					<div>
						<div id="video-player">
							<?php echo $video_embed; ?>
						</div>
						<div id="audio-player">
							<?php echo $meta['audio_embed'][0]; ?>
						</div>
					</div>
					<div class="additional-featured group">
						<div class="custom-box">
							<a href="javascript:void(0)" onclick="dispVideo()">
								<img class="feat_icon" src="<?php bloginfo('template_url'); ?>/images/tv.png" >
								<div class="right">
									<h3>Watch</h3>
								</div>
							</a>
						</div>
						<div class="custom-box">
							<a href="javascript:void(0)" onclick="dispRead()">
								<img class="feat_icon" src="<?php bloginfo('template_url'); ?>/images/read.png" >
								<div class="right">
									<h3>Read</h3>
								</div>
							</a>
						</div>
						<div class="custom-box">
							<a href="javascript:void(0)" onclick="dispListen()">
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
								<li><a href="<?php echo $meta['video_download'][0]; ?>" download>Download Video</a></li>
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
								<li><a href="<?php echo $meta['audio_download'][0]; ?>" download>Download MP3</a></li>
								<li><a href="#">Share (embed link)</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="entry">
					<?php

                    // Add posts to respective group (past, present, future)
					if (postTimeStatus(get_the_ID()) == 'future') : ?>
					<div  id="transcript">
						<p>This event is currently not available. Attend the event <?php if (get_post_meta(get_the_ID(), 'live_stream')[0] == "yes") {echo "or watch the live stream";} ?> on <?php echo date('l, F jS, Y \a\t g:i A', $post_time)?></p>
					</div>
				<?php else: ?>
					<div class="group">
						<div class="event-description">
							<h2><?php the_title(); ?></h2>
							<h3><?php echo get_the_title($presenters[0]); ?></h3>
							<h4><?php echo $speaker_title[0]; ?></h4>
						</div>
					</div>
					<div id="transcript">
						<p><?php echo wpautop($meta['transcript'][0]); ?></p>
					</div>
					<div id="discussion">

					</div>
					<a href="#top" class="speeches-button">Back to Top</a>
				<?php endif; ?>
			</div>
		</div>
		<!-- <?php comments_template(); ?> -->
	<?php endwhile; endif; ?>
</div>
<?php require_once 'partials/event_template_sidebar.php'; ?>
</div>

<?php get_footer(); ?>