jQuery(document).ready(function() {
    if (document.getElementById('event_date').value == '')
        jQuery('#event_date').mask('DD/MM/YYYY');
    if (document.getElementById('event_start_time').value == '')
        jQuery('#event_start_time').mask('--:-- ZM', {translation: {'Z': {pattern: /(A|P)/, optional: false}}});
    if (document.getElementById('event_end_time').value == '')
        jQuery('#event_end_time').mask('--:-- ZM', {translation: {'Z': {pattern: /(A|P)/, optional: false}}});
    
    if (jQuery('#live_stream_yes:checked').val())
        jQuery('#live_stream').show();
    
    jQuery('#live_stream_no').click(function() {
        jQuery('#live_stream').hide();
    });
    jQuery('#live_stream_yes').click(function() {
        jQuery('#live_stream').show();
    });
});