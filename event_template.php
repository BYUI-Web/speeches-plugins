<?php
// Include Model
require_once 'event_model.php';

// Set Variables For Out of Loop Usage
$current_post; 
$meta;
$post_time;
$prep_material;
$current_post_type;
get_header();

$current_post = get_the_ID();
$post_types = array('devotional' => 'BYU-Idaho Devtional');

//initialize all meta variables
$meta = get_post_meta(get_the_ID());
//loop through meta and create variables with the name of the key
foreach($meta as $key => $value) { ${$key} = $value[0]; }
$current_post_type = get_post_type();

?>
<div class="row">
    <div class="col-xs-12 col-sm-8">
        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            <?php include_once('partials/event_media.php'); ?>
            <?php include_once('partials/transcript_discuss.php'); ?>
        </div>
    </div>
<?php require_once 'partials/event_template_sidebar.php'; ?>
</div>

<?php get_footer(); ?>