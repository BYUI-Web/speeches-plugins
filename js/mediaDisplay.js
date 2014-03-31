function dispVideo(element) {
    //make sure the video hasn't been disabled
    document.getElementById('video-player').style.display='block';
    document.getElementById('audio-player').style.display='none';
    document.getElementById('watch').style.display='block';
    document.getElementById('listen').style.display='none';
    document.getElementById('read').style.display='none';
}

function dispRead(element) {
	document.getElementById('transcript').style.display='block';
	document.getElementById('watch').style.display='none';
	document.getElementById('listen').style.display='none';
	document.getElementById('read').style.display='block';
	document.getElementById('discussion').style.display='none';
}

function dispListen(element) {
	document.getElementById('audio-player').style.display='block';
	document.getElementById('video-player').style.display='none';
	document.getElementById('watch').style.display='none';
	document.getElementById('listen').style.display='block';
	document.getElementById('read').style.display='none';
}

function dispDiscuss() {
	document.getElementById('transcript').style.display='none';
	document.getElementById('watch').style.display='none';
	document.getElementById('listen').style.display='none';
	document.getElementById('read').style.display='none';
	document.getElementById('discussion').style.display='block';
}

function dispDate() {
	document.getElementById('dispDate').className = 'active';
	document.getElementById('dispSpeaker').className = '';
	document.getElementById('dispTopic').className = '';
	document.getElementById('date-filter').style.display = 'block';
	document.getElementById('speaker-filter').style.display = 'none';
	document.getElementById('topic-filter').style.display = 'none';
}


function dispSpeaker() {
	document.getElementById('dispDate').className = '';
	document.getElementById('dispSpeaker').className = 'active';
	document.getElementById('dispTopic').className = '';
	document.getElementById('date-filter').style.display = 'none';
	document.getElementById('speaker-filter').style.display = 'block';
	document.getElementById('topic-filter').style.display = 'none';
}


function dispTopic() {
	document.getElementById('dispDate').className = ' ';
	document.getElementById('dispSpeaker').className = '';
	document.getElementById('dispTopic').className = 'active';
	document.getElementById('date-filter').style.display = 'none';
	document.getElementById('speaker-filter').style.display = 'none';
	document.getElementById('topic-filter').style.display = 'block';
}