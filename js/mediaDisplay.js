function dispVideo(element) {
    //make sure the video hasn't been disabled
    if (element.parentElement.className.indexOf("disabled") === -1) {
	document.getElementById('video-player').style.display='block';
	document.getElementById('audio-player').style.display='none';
	document.getElementById('watch').style.display='block';
	document.getElementById('transcript').style.display='block';
	document.getElementById('listen').style.display='none';
	document.getElementById('read').style.display='none';
	document.getElementById('discussion').style.display='none';
    }
}

function dispRead(element) {
    if (element.parentElement.className.indexOf("disabled") === -1) {
	document.getElementById('transcript').style.display='block';
	document.getElementById('watch').style.display='none';
	document.getElementById('listen').style.display='none';
	document.getElementById('read').style.display='block';
	document.getElementById('discussion').style.display='none';
    }
}

function dispListen(element) {
    if (element.parentElement.className.indexOf("disabled") === -1) {
	document.getElementById('audio-player').style.display='block';
	document.getElementById('video-player').style.display='none';
	document.getElementById('transcript').style.display='block';
	document.getElementById('watch').style.display='none';
	document.getElementById('listen').style.display='block';
	document.getElementById('read').style.display='none';
	document.getElementById('discussion').style.display='none';
    }
}

function dispDiscuss() {
	document.getElementById('transcript').style.display='none';
	document.getElementById('watch').style.display='none';
	document.getElementById('listen').style.display='none';
	document.getElementById('read').style.display='none';
	document.getElementById('discussion').style.display='block';
}