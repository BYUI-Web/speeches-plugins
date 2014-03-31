<aside class="col-xs-12 col-sm-4">
	<div class="aside-holder">
		<div class="sidebar-inner group event-details">
			<h2>Event Details</h2>
			<ul>
				<li><span>Event Type: </span>BYU-Idaho <?php echo $current_post_type; ?></li>
				<li><span>Speaker: </span><?php echo getSpeaker($current_post); ?></li>
				<li><span>When: </span><?php echo getPostTime($current_post); ?></li>
				<li><span>Where: </span> <?php echo getEventLocation($current_post); ?></li>
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
		<div class="sidebar-inner group speaker-bio">
			<?php foreach ($presenters as $person) : ?>

				<h2>Speaker Bio</h2>
				<div class="group">
					<div class="sidebar-speaker-image"><?php echo get_the_post_thumbnail($person); ?></div>
					<div class="sidebar-speaker-info">
						<h3><?php echo get_the_title($person); ?></h3>
						<?php 
						$string = get_post_meta($person, 'speaker_bio');
						$string = substr($string[0], 0, strpos(wordwrap($string[0], 150),"\n"));
						?>
						<p class="sidebar-speaker-meta"><?php echo $string; ?> </p>
						<a class="read-more" href="<?php echo get_permalink($person) ?>">More</a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="sidebar-inner group sidebar-featured-speeches">
			<h2>Related Speeches</h2>
			<div>
				<h3>By this Speaker</h3>
				<?php 
				$posts = getPostsBySpeaker($current_post); 
				if (is_array($posts)) :
					foreach ($posts as $post) : ?>
				<div>
					<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
					<p><?php echo getSpeaker($post); ?></p>
					<p class="meta"><?php echo getSpeakerTitle($post); ?>
					</p>
				</div>
			<?php endforeach; else: echo $posts; endif;?>
		</div>
		<hr>
		<div>
			<h3>On this Topic</h3>
			<?php
			$sameTopicPosts = getPostsByTopic($current_post);
				foreach ($sameTopicPosts as $post) : ?>
				<div>
					<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
					<p>
						<?php
						$presenter_id = get_post_meta($post, 'presenters', true);
						echo get_the_title($presenter_id); 
						?>
					</p>
					<p class="meta"><?php echo get_post_meta($presenter_id, 'title', true); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
		<hr>
		<div>
			<h3>Other <?php echo $current_post_type; ?>s</h3>
			<?php
			$loop = new WP_Query( array( 'post_type' => $current_post_type, "orderby" => "views") );
			while ( $loop->have_posts() ) : $loop->the_post(); 
			$meta = get_post_meta(get_the_ID());
			if (get_the_ID() == $current_post)
				continue;
			?>
			<div>
				<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
				<p><?php echo getSpeaker(get_the_ID()); ?></p>
				<p class="meta"><?php echo getSpeakerTitle(get_the_ID()); ?></p>
			</div>
		<?php endwhile; ?>
	</div>
	<div class="center"><a class="speeches-button" href="/<?php echo $current_post_type; ?>s">View All <?php echo $current_post_type; ?>s</a></div>
</div>
</div>
</aside>