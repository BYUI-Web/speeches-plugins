<?php

require_once 'event_model.php';
/**
 * RSS2 Feed Template for displaying RSS2 Posts feed.
 *
 * @package WordPress
 */

header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);
$more = 1;

echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'; ?>

<rss version="2.0"
xmlns:content="http://purl.org/rss/1.0/modules/content/"
xmlns:wfw="http://wellformedweb.org/CommentAPI/"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:atom="http://www.w3.org/2005/Atom"
xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
xmlns:media="http://search.yahoo.com/mrss"
<?php
	/**
	 * Fires at the end of the RSS root to add namespaces.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss2_ns' );
	?>
	>

	<channel>
		<title><?php bloginfo_rss('name'); wp_title_rss(); ?></title>
		<atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
		<link><?php bloginfo_rss('url') ?></link>
		<description><?php bloginfo_rss("description") ?></description>
		<lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
		<language><?php bloginfo_rss( 'language' ); ?></language>
		<?php
		$duration = 'hourly';
	/**
	 * Filter how often to update the RSS feed.
	 *
	 * @since 2.1.0
	 *
	 * @param string $duration The update period.
	 *                         Default 'hourly'. Accepts 'hourly', 'daily', 'weekly', 'monthly', 'yearly'.
	 */
	?>
	<sy:updatePeriod><?php echo apply_filters( 'rss_update_period', $duration ); ?></sy:updatePeriod>
	<?php
	$frequency = '1';
	/**
	 * Filter the RSS update frequency.
	 *
	 * @since 2.1.0
	 *
	 * @param string $frequency An integer passed as a string representing the frequency
	 *                          of RSS updates within the update period. Default '1'.
	 */
	?>
	<sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', $frequency ); ?></sy:updateFrequency>
	<?php
	/**
	 * Fires at the end of the RSS2 Feed Header.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss2_head');

	$loop = new WP_Query( array( 'post_type' => array('devotional', 'forum') ) );
	while( $loop->have_posts()) : $loop->the_post();
	$post_end_time = get_post_meta(get_the_ID(), 'event_end_time');
	$now = strtotime('now');
	if ($now > $post_end_time[0]) :
		$meta = get_post_meta(get_the_ID());
	?>
	<item>
		<title><?php the_title_rss() ?></title>
		<link><?php the_permalink_rss() ?></link>
		<comments><?php comments_link_feed(); ?></comments>
		<pubDate><?php echo getPostTime( get_the_ID() ); ?></pubDate>
		<dc:creator><![CDATA[<?php echo getSpeaker( get_the_ID() ); ?>]]></dc:creator>
		<?php the_category_rss('rss2') ?>

		<guid isPermaLink="false"><?php the_guid(); ?></guid>
		<description><![CDATA[<?php echo 'A ' . get_post_type( get_the_ID() ) . ' from BYU-Idaho'; ?>]]></description>
		<?php $content = get_the_content_feed('rss2'); ?>
		<?php if ( $meta['transcript'][0] ) : ?>
			<content:encoded><![CDATA[<?php echo $meta['transcript'][0]; ?>]]></content:encoded>
		<?php else : ?>
			<content:encoded><![CDATA[<?php the_excerpt_rss(); ?>]]></content:encoded>
		<?php endif; ?>
		<?php if ($meta['video_download'][0]) : ?>
			<media:content url="<?php echo $meta['video_download'][0]?>" type="video"/>
		<?php endif; ?>
		<?php if ($meta['audio_download'][0]) : ?>
			<media:content url="<?php echo $meta['audio_download'][0]?>" type="audio"/>
		<?php endif; ?>
		<?php rss_enclosure(); ?>
		<?php
	/**
	 * Fires at the end of each RSS2 feed item.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss2_item' );
	?>
</item>
<?php endif; endwhile; ?>
</channel>
</rss>
