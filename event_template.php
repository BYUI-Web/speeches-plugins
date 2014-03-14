<?php get_header(); ?>
<?php 
$current_post; 
$meta;
$post_types = array( 'devotional' => 'BYU-Idaho Devtional');
$post_time;
$prep_material;
$current_post_type;
$current_post_tags;
?>
<div class="row">
	<div class="col-xs-12 col-sm-8">
		

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php $meta = get_post_meta( get_the_ID() ); ?>
			<?php
			$post_time = strtotime(get_post_meta(get_the_ID(), 'event_date')[0] . ' ' . get_post_meta(get_the_ID(), 'event_start_time')[0]);
			$current_post = get_the_ID();
			$current_post_type = get_post_type( $current_post );
			$current_post_tags = get_the_tags();
			$presenters = explode(', ', $meta['presenters'][0]);
			$prep_material = explode(', ', $meta['prep_material'][0]);

			$speaker_title = get_post_meta($presenters[0], 'title');
			?>
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

				<div class="event-featured">
					<div>
						<div id="video-player">
							<?php echo $meta['video_embed'][0]; ?>
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
				</div>
			</div>
			<!-- <?php comments_template(); ?> -->
		<?php endwhile; endif; ?>
	</div>

	<aside class="hidden-xs hidden-sm col-sm-4">
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
						<p class="sidebar-speaker-meta"><?php echo $string; ?> <a class="read-more" href="#">More</a></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="sidebar-inner sidebar-featured-speeches">
			<h2>Related Speeches</h2>
			<h3>By this Speaker</h3>
			<hr>
			<h3>On this Topic</h3>
			
			<hr>
			<h3>Other <?php echo $current_post_type; ?>s</h3>
			<?php
			$loop = new WP_Query( array( 'post_type' => $current_post_type) );
			while ( $loop->have_posts() ) : $loop->the_post(); 
			$meta = get_post_meta(get_the_ID());
			if (get_the_ID() == $current_post)
				continue;
			?>

			<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
			<p><?php echo get_the_title($meta['presenters'][0]); ?></p>
			<p class="meta"><?php echo get_post_meta($meta['presenters'][0], 'title')[0]; ?></p>

		<?php endwhile; ?>
	</div>
</aside>
</div>

<?php get_footer(); ?>