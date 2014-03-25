<?php
$current_post_type = get_post_type($next_post[0]);
$recent_events = getRecent(3,'devotional');
?>

<aside class="col-xs-12 col-sm-4">
	<div class="aside-holder">
		<div class="sidebar-inner group event-details">
			<h2>Next Event</h2>
			<ul>
				<li><span>Event Type: </span>BYU-Idaho <?php echo $current_post_type; ?></li>
				<li><span>Speaker: </span><?php echo getSpeaker($next_post[0]); ?></li>
				<li><span>When: </span><?php echo getPostTime($next_post[0]); ?></li>
				<li><span>Where: </span> <?php echo getEventLocation($next_post[0]); ?></li>
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
		<div class="sidebar-inner group recent">
			<h2>Recent Events</h2>
			<?php foreach ($recent_events as $event) : ?>
				<div>
					<span class="sidebar-header-date"><?php echo getShortDate($event); ?></span>
					<a href="<?php echo get_permalink($event); ?>"><h3><?php echo get_the_title($event); ?></h3></a>
					<p><?php echo getSpeaker($event); ?></p>
					<p class="meta"><?php echo getSpeakerTitle($event); ?></p>
				</div>
			<?php endforeach; ?>
			<div class="right">
				<a class="speeches-button" href="#">View Archive</a>
			</div>
		</div>
		<div class="sidebar-inner group etiquette">
			<h2>Event Etiquette</h2>
			<ul>
				<li>Dress appropriately</li>
				<li>Hats should be removed</li>
				<li>Arrive early</li>
				<li>Do not bring or use laser pointers</li>
				<li>Save only one extra seat and only until 10 minutes before the hour</li>
				<li>Refrain from talking</li>
				<li>Turn off cell phones and pagers</li>
				<li>Help promote a spiritual environment</li>
				<li>No food or drink</li>
				<li>Refrain from applause</li>
				<li>Refrain from disturbing the concentration of others or detracting from the spirit of the meeting</li> 
				<li>Remain seated until after the closing prayer</li>
			</ul>
		</div>
		<div class="sidebar-inner group">
			<h2>Ushers Needed</h2>
			<p>Devotional ushers are valued volunteers. This is a great opportunity to not only serve but to also make lasting friendships as you learn to work with one another. Click below to apply.</p>
			<div class="right">
				<a class="speeches-button" href="#">Learn More</a>
			</div>
		</div>
	</div>
</aside>