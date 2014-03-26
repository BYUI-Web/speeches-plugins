<?php 

// Include Model
require_once 'event_model.php';
$next_post = getUpcoming('devotional',1);
get_header();

?>
<div class="row">
	<div class="col-xs-12 col-sm-8">
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
		<div class="archive-feature">
		<img src="<?php bloginfo('template_url'); ?>/images/devo.png">
			<div class="info-banner">
			<p>Attend this event or watch the live stream on <?php echo getPostTime($next_post[0]); ?> MST</p>
			</div>
		</div>
			<h1>The Importance of Devotional</h1>
			<p>
				Devotionals are special worship services and an important setting for studying the doctrines and principles of the restored gospel. Each week, speakers and many other individuals strive to provide a meaningful experience where the Spirit can teach and enlighten us. Because of its special nature, it is important that each of us come to Devotional prepared and ready to learn. In doing so, you will help create an environment in which the Holy Ghost can minister and lift not only you, but also all who are gathered to be taught.
			</p>
			<p>
				To help with your preparation, the scriptures to be cited in each address, as well as other helpful materials, are available online at www.byui.edu/devotionals for you to study in advance. Bringing scriptures to Devotional further confirms your preparedness and willingness to be taught. Each week you will have the opportunity to indicate the availability of your scriptures.
			</p>
			<p>
				In addition, we strongly desire and encourage you to come dressed in your Sunday best. Wearing appropriate attire is another important signal to the Lord that you recognize the importance of being taught by the Spirit. Your effort to come in the best clothing you have influences the ministry of the Holy Ghost, the speaker, and the learn- ing. A few of you work or have other circumstances and cannot dress up for Devotional. All are welcome, yet hope you will dress up when you have the opportunity and make Tuesday a day to dress for Devotional.
			</p>
			<p>
				Attending Devotional each week is an important part of a BYU-Idaho education. Both students and employees are encouraged to attend. The university’s departments and offices operate with a minimal staff to facilitate participa- tion by as many individuals as possible. As you make Devotional a part of your regular study and worship—your life will be enriched.
			</p>
		</div>
	</div>
	<?php require_once 'partials/event_archive_sidebar.php'; ?>
</div>

<?php get_footer(); ?>