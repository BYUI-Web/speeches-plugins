jQuery(document).ready(function() {
//    if (document.getElementById('event_date').value == '')
//        jQuery('#event_date').mask('DD/MM/YYYY');
//    if (document.getElementById('event_start_time').value == '')
//        jQuery('#event_start_time').mask('--:-- ZM', {translation: {'Z': {pattern: /(A|P)/, optional: false}}});
//    if (document.getElementById('event_end_time').value == '')
//        jQuery('#event_end_time').mask('--:-- ZM', {translation: {'Z': {pattern: /(A|P)/, optional: false}}});
//    
    if (jQuery('#live_stream_yes:checked').val())
        jQuery('#live_stream').show();
    
    if (jQuery('#video_status_yes:checked').val())
        jQuery('#video_media').show();
    
    if (jQuery('#audio_status_yes:checked').val())
        jQuery('#audio_media').show();
    
    if (jQuery('#transcript_status_yes:checked').val())
        jQuery('#transcript').show();
    
    jQuery('#video_status_not_yet, #video_status_never').click(function() {
       jQuery('#video_media').hide(); 
    });
    
    jQuery('#video_status_yes').click(function() {
       jQuery('#video_media').show(); 
    });
    
    jQuery('#audio_status_not_yet, #audio_status_never').click(function() {
       jQuery('#audio_media').hide(); 
    });
    
    jQuery('#audio_status_yes').click(function() {
       jQuery('#audio_media').show(); 
    });
    
    jQuery('#transcript_status_not_yet, #transcript_status_never').click(function() {
       jQuery('#transcript').hide(); 
    });
    
    jQuery('#transcript_status_yes').click(function() {
       jQuery('#transcript').show(); 
    });
    
    jQuery('#live_stream_no').click(function() {
        jQuery('#live_stream').hide();
    });
    jQuery('#live_stream_yes').click(function() {
        jQuery('#live_stream').show();
    });
    
});