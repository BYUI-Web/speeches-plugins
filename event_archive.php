<?php 

// Include Model
require_once 'event_model.php';
$archive = array();
$now = strtotime('now');
$args = array(
	'post_type' => 'devotional',
	'meta_key' => 'event_date',
	'orderby' => 'meta_value_num',
	'order' => 'ASC'
	); 
$loop = new WP_Query( $args );
if ($loop->have_posts()) {
	while ($loop->have_posts()) { 
		$loop->the_post();
		array_push($archive, get_the_ID());
	}
}
get_header();
?>
<script type="text/javascript">
	posts = [];
	<?php
	foreach ($archive as $id)
		echo 'posts.push({ "id":'.$id.', "postType":"'. get_post_type( $id ) .'", "month":"'. date( 'F', get_post_meta($id, 'event_date', true)) .'", "year":"'.date( 'Y', get_post_meta($id, 'event_date', true)).'"});';
	?>
	function updateList() {
		var toShow = jQuery.grep(posts, function( a ) {
			if (document.getElementById('post_type').value == 'all')
				return true;
			else
				return ( document.getElementById('post_type').value == a.postType );
		});
		for (i in posts) {
			document.getElementById('post-' + posts[i].id).style.display="none";
		}
		for (i in toShow) {
			document.getElementById('post-' + toShow[i].id).style.display="block";
		}
	}
</script>
<div class="row">
	<div class="col-xs-12">
		<div>
			<select id="post_type" onchange="updateList()">
				<option value="all">-</option>
				<option value="devotional">Devotionals</option>
				<option value="forum">Forum</option>
			</select>
		</div>
		<hr>
		<?php foreach ($archive as $post) : ?>
			<div id="post-<?php echo $post; ?>" class="post-archive group" style="display:none;">
				<span><?php echo date( 'd', get_post_meta($post, 'event_date', true)) ?></span>
				<div>
					<a href="<?php echo get_permalink($post); ?>"><h2><span><?php echo get_post_type($post) ?> - </span><?php echo get_the_title($post); ?></h2></a>
					<p><?php echo getSpeaker($post); ?></p>
					<p class="meta"><?php echo getSpeakerTitle($post); ?></p>
				</div>
			</div>
		<?php endforeach; ?>

	</div>
</div>
<script type="text/javascript">
	window.onload = updateList();
</script>
<?php get_footer(); ?>