<!DOCTYPE html>
<html>
<body>
	<video width="100%" height="100%" style="min-height:150px;" controls id="video">
	  <source src="http://122.155.197.142:1935/vod/_definst_/mp4:<?=$moviePath?>th480.mp4/playlist.m3u8"/> 
	  <source src="rtsp://122.155.197.142:1935/vod/_definst_/mp4:<?=$moviePath?>th480.mp4"/> 
	  Your browser does not support the video.
	</video>

	<script type="text/javascript">
		if (
		    document.fullscreenEnabled || 
		    document.webkitFullscreenEnabled || 
		    document.mozFullScreenEnabled ||
		    document.msFullscreenEnabled
		){	
			v = document.getElementsByTagName('video');
			// go full-screen
			if (v.requestFullscreen) {
			    v.requestFullscreen();
			} else if (v.webkitRequestFullscreen) {
			    v.webkitRequestFullscreen();
			} else if (v.mozRequestFullScreen) {
			    v.mozRequestFullScreen();
			} else if (v.msRequestFullscreen) {
			    v.msRequestFullscreen();
			}
		}

	</script>
</body>