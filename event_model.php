<?php
/* * ******************************************* */
/* * ********* Test to see if Post already occured ********** */
/* * ********* Takes Post ID as a parameter ********** */
/* * ********* Returns True || False; ********** */
/* * ******************************************* */
function postTimeStatus($post_id) {
	date_default_timezone_set('America/Denver');
	$now = strtotime('now');
	$post_start_time = get_post_meta($post_id, 'event_date');
	$post_end_time = get_post_meta($post_id, 'event_end_time');
	if ($now > $post_end_time[0]) {
		return 'past';
	} elseif ($now > $post_start_time) {
		return 'current';
	} else {
		return 'future';
	}
}

/* * *********************************************************** */
/* * ********* Gets posts by speaker of a post********** */
/* * ********* Takes Post ID as a parameter ********** */
/* * ********* Returns Array of 2 posts || "No Posts Found"; ********** */
/* * ********************************************************* */
function getPostsBySpeaker($current_post_id) {
	$speakerPosts = array();
	$counter = 0;
	$current_post_presenters = get_post_meta($current_post_id, 'presenters');

	if ($current_post_presenters[0])
		$current_post_presenters = explode(', ', $current_post_presenters[0]);

	$loop = new WP_Query( array( 'post_type' => array('devotional', 'forum')) );
	if ($loop->have_posts()) { 
		while ($loop->have_posts()) {
			$loop->the_post();
			$post_id = get_the_ID();
			$loop_presenters = get_post_meta(get_the_ID(),'presenters');
			if ($loop_presenters[0])
				$loop_presenters = explode(', ', $loop_presenters[0]);
			foreach ($loop_presenters as $test) {
				foreach ($current_post_presenters as $comp) {
					if ($test == $comp) {
						if ($post_id != $current_post_id) {
							$add = true;
							foreach ($speakerPosts as $toAdd) {
								if ($toAdd == $post_id)
									$add = false;
							}
							if ($add)
								array_push($speakerPosts, $post_id);
						}
					}
				}
			}
			if (count($speakerPosts) == 2)
				break;
		}
	}
	if (($speakerPosts))
		return $speakerPosts;
	else
		return "No Posts Found";
}

/* * *********************************************************** */
/* * ********* Gets posts by topics of a post********** */
/* * ********* Takes Post ID as a parameter ********** */
/* * ********* Returns Array of 2 posts || "No Posts Found"; ********** */
/* * ********************************************************* */
function getPostsByTopic($post_id) {
	$current_post_tags = get_the_tags($post_id);
	$sameTopicPosts = array();
	$counter = 0;
	$loop = new WP_Query( array( 'post_type' => array('devotional', 'forum')) );
	if ($loop->have_posts()) {
		while ($loop->have_posts()) { 
			$loop->the_post();
			$tags = get_the_tags();

			foreach ($tags as $tag) {
				foreach ($current_post_tags as $tagTest) {
					if ($tag->name == $tagTest->name) {
						$counter++;
						if (!(get_the_ID() == $current_post)) {
							$toAdd = get_the_ID();
							$exists = false;
							foreach ($sameTopicPosts as $id) {
								if ($id == $toAdd)
									$exists = true;
							}
							if (!$exists) {
								if (count($sameTopicPosts) < 2)
									array_push($sameTopicPosts, $toAdd);
							}
						}
						continue;
					}
				}
			} 
		}
	}
	return $sameTopicPosts;
}

/* * ******************************************* */
/* * ********* Gets Post Speaker/Speakers ********** */
/* * ********* If second param true returns *********** */
/* * ********* Array of speakers otherwise  ********** */
/* * ********* just first speaker ********** */
/* * ******************************************* */
function getSpeaker($post_id, $returnAll = false) {
	$speakers;
	$speaker_id = get_post_meta($post_id, 'presenters');
	if ($speaker_id) {
		$speakers = explode(', ', $speaker_id);
	}
	if ($returnAll && $speakers) {
		$speaker_names = array();
		foreach ($speakers as $indv_speaker) {
			array_push($speaker_names, get_the_title($indv_speaker));
		}
		return $speaker_names;
	}
	return get_the_title($speaker_id[0]);
}

/* * ******************************************* */
/* * ********* Gets Post Speaker/Speakers ********** */
/* * ********* If second param true returns *********** */
/* * ********* Array of speakers otherwise  ********** */
/* * ********* just first speaker ********** */
/* * ******************************************* */
function getSpeakerTitle($post_id, $returnAll = false) {
	$speakers;
	$speaker_id = get_post_meta($post_id, 'presenters');
	if ($speaker_id) {
		$speakers = explode(', ', $speaker_id);
	}
	if ($returnAll && $speakers) {
		$speaker_names = array();
		foreach ($speakers as $indv_speaker) {
			array_push($speaker_names, get_the_title($indv_speaker));
		}
		return $speaker_names;
	}
	$speaker_title = get_post_meta($speaker_id[0], 'title');
	return $speaker_title[0];
}

/* * ******************************************* */
/* * ********* Gets Post Speaker/Speakers ********** */
/* * ********* If second param true returns *********** */
/* * ********* Array of speakers otherwise  ********** */
/* * ********* just first speaker ********** */
/* * ******************************************* */
function getSpeakerBio($post_id) {
	$speaker_id = get_post_meta($post_id, 'speaker_bio');
	if ($speaker_id) {
		$speakers = explode(', ', $speaker_id);
	}
	if ($returnAll && $speakers) {
		$speaker_names = array();
		foreach ($speakers as $indv_speaker) {
			array_push($speaker_names, get_the_title($indv_speaker));
		}
		return $speaker_names;
	}
	$speaker_title = get_post_meta($speaker_id[0], 'title');
	return $speaker_title[0];
}

/* * ******************************************* */
/* * ********* Gets The Post Time ********** */
/* * ********* Formatted for output ********** */
/* * ******************************************* */
function getPostTime($post_id) {
	$post_date = get_post_meta($post_id, 'event_date');
	return date('l, F jS, Y \a\t g:i A', $post_time[0]);
}

/* * ******************************************* */
/* * ********* Gets The Post Location ********** */
/* * ********* return for output ********** */
/* * ******************************************* */
function getEventLocation($post_id) {
	$location = get_post_meta($post_id, 'event_location');
	return $location[0];
}
?>