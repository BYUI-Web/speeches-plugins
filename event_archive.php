<?php 
$future_posts = array(); 
$current_posts = array();
$past_posts = array();
if (have_posts()) { 
	while (have_posts()) {
		the_post();

		// Test each of the posts against "NOW" and see if its past present or future!
		date_default_timezone_set('America/Denver');
		$now = strtotime('now');
		$post_start_time = strtotime(get_post_meta(get_the_ID(), 'event_date')[0] . ' ' . get_post_meta(get_the_ID(), 'event_start_time')[0]);
		$post_end_time = strtotime(get_post_meta(get_the_ID(), 'event_date')[0] . ' ' . get_post_meta(get_the_ID(), 'event_end_time')[0]);

		// Add posts to respective group (past, present, future)
		if ($now > $post_end_time)
			array_push($past_posts, get_the_ID());
		elseif ($now < $post_start_time)
			array_push($future_posts, get_the_ID());
		else {
			array_push($current_posts, get_the_ID());
		}
	}
}
?>
<?php get_header(); ?>
<div class="row">
	<div class="col-xs-12">
		<h2>Future Posts</h2>
		<ul>
		<?php foreach ($future_posts as $post): ?>
			<li><a href="<?php echo get_permalink($post); ?>"><?php echo get_the_title($post); ?></a></li>
		<?php endforeach; ?>
		</ul>
		<h2>Current Posts</h2>
		<ul>
		<?php foreach ($current_posts as $post): ?>
			<li><a href="<?php echo get_permalink($post); ?>"><?php echo get_the_title($post); ?></a></li>
		<?php endforeach; ?>
		</ul>
		<h2>Past Posts</h2>
		<ul>
		<?php foreach ($past_posts as $post): ?>
			<li><a href="<?php echo get_permalink($post); ?>"><?php echo get_the_title($post); ?></a></li>
		<?php endforeach; ?>
		</ul>
	</div>
</div>

<?php get_footer(); ?>