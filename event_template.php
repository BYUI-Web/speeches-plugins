<?php get_header(); ?>
<div class="row">
	<div class="col-xs-12 col-sm-8">
		<?php $current_post; ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php $meta = get_post_meta( get_the_ID() ); ?>
			<?php
			$current_post = get_the_ID();

			$presenters = explode(', ', $meta['presenters'][0]);
			$speaker_title = get_post_meta($presenters[0], 'title');
			?>
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

				<h2><?php the_title(); ?></h2>

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
						<img class="feat_icon" src="<?php bloginfo('template_url'); ?>/images/tv.png" >
							<div>
								<a href="javascript:void(0)" onclick="document.getElementById('video-player').style.display='block';document.getElementById('audio-player').style.display='none'"><h3>Watch</h3></a>
								<a href="<?php echo $meta['video_download'][0]; ?>" download>Download Video</a>
								<a href="#">Share (embed link)</a>
							</div>
						</div>
						<div class="custom-box">
						<img class="feat_icon" src="<?php bloginfo('template_url'); ?>/images/read.png" >
							<div>
								<a href="#"><h3>Read</h3></a>
								<a href="#">Download Transcript</a>
								<a href="#">Share (embed link)</a>
							</div>
						</div>
						<div class="custom-box">
						<img class="feat_icon" src="<?php bloginfo('template_url'); ?>/images/headphones.png" >
							<div>
								<a href="javascript:void(0)" onclick="document.getElementById('audio-player').style.display='block';document.getElementById('video-player').style.display='none'"><h3>Listen</h3></a>
								<a href="<?php echo $meta['audio_download'][0]; ?>" download>Download MP3</a>
							</div>
						</div>
					</div>
				</div>
				<div class="entry">
					<div class="group">
						<div class="speaker-info">
							<h3><?php echo get_the_title($presenters[0]); ?></h3>
							<h4><?php echo $speaker_title[0]; ?></h4>
						</div>
						<div class="event-meta">
							<p><?php echo $meta['event_date'][0]; ?></p>
						</div>
					</div>
					<p><?php echo wpautop($meta['transcript'][0]); ?></p>

					<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
					<hr>
					<?php the_tags( 'TAGS: ', ', ', ''); ?>

				</div>
			</div>
			<!-- <?php comments_template(); ?> -->
		<?php endwhile; endif; ?>
	</div>

	<aside class="hidden-xs hidden-sm col-sm-4">
		<div class="sidebar-inner">
			<h2>Next Devotional</h2>
			<h3>Russell T. Osguthorpe</h3>
			<p>Sunday School General President</p>
			<p>Tuesday at 2:10 p.m.</p>
			<p>Prepare by reading:</p>
			<p>Your Scriptures</p>
		</div>
		<div class="sidebar-inner">
			<?php foreach ($presenters as $person) : ?>
				<h2>Speaker Bio</h2>
				<div><?php echo get_the_post_thumbnail($person, array(200,'auto')); ?></div>
				<p class="sidebar-speaker-meta"><?php echo get_post_meta($person, 'speaker_bio')[0]; ?></p>
			<?php endforeach; ?>
		</div>
		<div class="sidebar-inner discussion">
			<h2>Discuss<img src="<?php bloginfo('template_url'); ?>/images/chatbubble.png"?></h2>
			<p>This Week's Question:</p>
			<blockquote>How do you prepare for devotional?</blockquote>
			<p>Tweet your answer with #byuidevo</p>
		</div>
		<div class="sidebar-inner social-sharing">
			<h2>Share This Page</h2>
			<a href="#"><img src="<?php bloginfo('template_url')?>/images/facebook.png ?>" alt=""></a>

			<a href="#"><img src="<?php bloginfo('template_url')?>/images/pinterest.png ?>" alt=""></a>	

			<a href="#"><img src="<?php bloginfo('template_url')?>/images/twitter.png ?>" alt=""></a>
		</div>
		<div class="sidebar-inner sidebar-featured-speeches">
			<h2>Other Speeches</h2>
			<?php
			$loop = new WP_Query( array( 'post_type' => 'devotional') );
			while ( $loop->have_posts() ) : $loop->the_post(); 
			$meta = get_post_meta(get_the_ID());
			if (get_the_ID() == $current_post)
				continue;
			?>

			<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
			<p><?php echo get_the_title($meta['presenters'][0]); ?></p>
			<p class="meta"><?php
				$speaker_title = get_post_meta($meta['presenters'][0], 'title'); 
				echo $speaker_title[0];
				?></p>


				<?php
				endwhile;
				?>
			</div>
		</aside>
	</div>

	<?php get_footer(); ?>