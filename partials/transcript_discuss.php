<?php
    $title = the_title();
    
    //we need to build the speaker string
    $presenters = explode(", ", $presenters);
    
    //get the presenters name
    $speakerNames = get_the_title($presenters[0]);
    
    $counter = 0;
    $numPresenters = count($presenters);
    for ($i = 1; $i < $numPresenters; $i++) {
        
    }
?>

<div class="entry">
    <div class="group">
        <div class="event-description">
            <h2><?php the_title(); ?></h2>
            <h3><?php echo get_the_title($presenters[0]); ?></h3>
            <h4><?php echo $speaker_title[0]; ?></h4>
        </div>
    </div>
    <div id="transcript">
        <p><?php echo wpautop($meta['transcript'][0]); ?></p>
    </div>
    <div id="discussion">

    </div>
    <a href="#top" class="speeches-button">Back to Top</a>
</div>