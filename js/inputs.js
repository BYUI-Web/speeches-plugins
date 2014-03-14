jQuery(document).ready(function(){
	if (document.getElementById('event_date').value == '')
		jQuery('#event_date').mask('DD/MM/YYYY');
	if (document.getElementById('event_start_time').value == '')
		jQuery('#event_start_time').mask('--:-- ZM', {translation:  {'Z': {pattern: /(A|P)/, optional: false}}});
	if (document.getElementById('event_end_time').value == '')
		jQuery('#event_end_time').mask('--:-- ZM', {translation:  {'Z': {pattern: /(A|P)/, optional: false}}});
	jQuery('#live_stream_yes').change(function() {
		jQuery('#live_stream').toggle();
	});
	jQuery('#live_stream_no').change(function() {
		jQuery('#live_stream').toggle();
	});
});