<?php
    $title = get_the_title();
    
    //we need to build the speaker string
    $presenters = explode(", ", $presenters);
    
    //get the presenters name
    $speaker = array();
    
    $numSpeakers = count($presenters);
    for ($i = 0; $i < $numSpeakers; $i++) {
        $speaker[$i]['name'] = get_the_title($presenters[$i]);
        $speaker[$i]['title'] = get_post_meta($presenters[$i], 'title')[0];
    }
    
?>

<div class="entry">
    <div class="group">
        <div class="event-description">
            <h2><?php echo $title; ?></h2>
            <?php foreach($speaker as $speak) : ?>
                <h3><?php echo $speak['name']; ?></h3>
                <?php if (!empty($speak['title'])) : ?>
                    <h4><?php echo $speak['title']; ?></h4>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div id="transcript">
        <p><?php echo wpautop($transcript); ?></p>
    </div>
    <div id="discussion">
        <!-- <?php comments_template('', true); ?> -->
    </div>
    <a href="#top" class="speeches-button">Back to Top</a>
</div>