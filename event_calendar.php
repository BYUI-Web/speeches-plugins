<?php
// Include Model
require_once 'event_model.php';
get_header();
$calendar = getCalendar(strtotime('now'));
?>
<div class="row">
    <div class="col-xs-12">
    <p><?php var_dump($calendar); ?></p>
    </div>
</div>

<?php get_footer(); ?>