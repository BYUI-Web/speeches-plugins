<?php
$title = get_the_title();

    //we need to build the speaker string
$presenters = explode(", ", $presenters);

    //get the presenters name
$speaker = array();

$numSpeakers = count($presenters);
for ($i = 0; $i < $numSpeakers; $i++) {
    $speaker[$i]['name'] = get_the_title($presenters[$i]);
    $speaker[$i]['title'] = get_post_meta($presenters[$i], 'title', true);
}

//check to see if there is a transcript
if ($transcript_status == "yes") {
    $transcript = wpautop($transcript);
} else if ($transcript_status == "not_yet") {
    $transcript = "<h3>The transcript is not yet available. Please check back later.</h3>";
} else if ($transcript_status == "never") {
    $transcript = "<h3>There will not be a transcript provided for this event.</h3>";
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
    <div id="transcript" <?php echo ($transcript_status != "yes") ? "style='display: none;'" : ""; ?> >
        <p><?php echo wpautop($transcript); ?></p>
    </div>
    <div id="discussion" <?php echo ($transcript_status != "yes") ? "style='display: block;'" : ""; ?>>
        <div id="disqus_thread"></div>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'byuidahospeeches'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a>
    </noscript>
        
</div>
<a href="#top" class="speeches-button">Back to Top</a>
</div>