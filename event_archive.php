<?php 

// Include Model
require_once 'event_model.php';
$speechesarchive = array();
$speakersarchive = array();
$now = strtotime('now');
$speeches_args = array(
	'post_type' => 'devotional',
	'meta_key' => 'event_date',
	'orderby' => 'meta_value_num',
	'order' => 'ASC'
	); 
$speakers_args = array(
	'post_type' => 'speaker',
	'meta_key' => 'last_name',
	'orderby' => 'meta_value',
	'order' => 'ASC'
	); 
$loop = new WP_Query( $speeches_args );
if ($loop->have_posts()) {
	while ($loop->have_posts()) { 
		$loop->the_post();
		array_push($speechesarchive, get_the_ID());
	}
}

u$loop = new WP_Query( $speakers_args );
if ($loop->have_posts()) {
	while ($loop->have_posts()) { 
		$loop->the_post();
		array_push($speakersarchive, get_the_ID());
	}
}
get_header();
?>
<div class="archive-header group">
	<div class="archive-header-banner">
		<h1>Speeches Archive</h1>
	</div>
	<div class="filters">
		<label for="">Browse by: </label>
		<a href="javascript:void(0)" onclick="dispDate()" id="dispDate">Date</a>
		<a href="javascript:void(0)" onclick="dispSpeaker()" id="dispSpeaker">Speaker</a>
		<a href="javascript:void(0)" onclick="dispTopic()" id="dispTopic">Topic</a>
	</div>
</div>
<script type="text/javascript">
	posts = [];
	<?php
	foreach ($speechesarchive as $id)
		echo 'posts.push({ "id":'.$id.', "postType":"'. get_post_type( $id ) .'", "month":"'. date( 'F', get_post_meta($id, 'event_date', true)) .'", "year":"'.date( 'Y', get_post_meta($id, 'event_date', true)).'"});';
	?>
	function updateDateList() {
		var toShow = jQuery.grep(posts, function( a ) {
			var postType = (document.getElementById('post_type').value == 'all') ? true : false;
			return ( (document.getElementById('post_type').value == a.postType || postType) );
		});
		for (i in posts) {
			document.getElementById('post-' + posts[i].id).style.display="none";
		}
		for (i in toShow) {
			document.getElementById('post-' + toShow[i].id).style.display="block";
		}
	}
	function speechesFilter() {
		var toShow = jQuery.grep(posts, function( a ) {
			var postType = (document.getElementById('post_type').value == 'all') ? true : false;
			return ( (document.getElementById('post_type').value == a.postType || postType) );
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
		<div id="date-filter">
			<div>
				<select id="post_type" onchange="updateDateList()">
					<option value="all">-</option>
					<option value="devotional">Devotionals</option>
					<option value="forum">Forum</option>
				</select>
			</div>
			<hr>
			<?php foreach ($speechesarchive as $post) : ?>
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
		<div id="speaker-filter">
			<div>
				<a href="javascript:void(0)" onclick="speechesFilter()">A</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">B</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">C</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">D</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">E</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">F</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">G</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">H</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">I</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">J</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">K</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">L</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">M</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">N</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">O</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">P</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">Q</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">R</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">S</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">T</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">U</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">V</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">W</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">X</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">Y</a>
				<a href="javascript:void(0)" onclick="speechesFilter()">Z</a>
			</div>
			<hr>
			<?php var_dump($speakersarchive); ?>
			<?php foreach ($speakersarchive as $post) : ?>
				<?php  ?>
			<?php endforeach; ?>
		</div>
		<div id="topic-filter">
			<div>
				<select id="post_type" onchange="updateDateList()">
					<option value="all">-</option>
					<option value="devotional">Devotionals</option>
					<option value="forum">Forum</option>
				</select>
			</div>
			<hr>
			<?php foreach ($speechesarchive as $post) : ?>
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
</div>
<script type="text/javascript">
	window.onload = dispDate();
	window.onload = updateDateList();
</script>
<?php get_footer(); ?>