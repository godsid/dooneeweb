<!DOCTYPE html>
<html>
<body>
<!--
<video width="320" height="240" controls>
  <source src="http://122.155.197.142:1935/vod/mp4:1.mp4/playlist.m3u8" type="video/mp4">
  <source src="rtsp://122.155.197.142:1935/vod/1.mp4" type="video/mp4">
  Your browser does not support the video tag.
</video>-->
<video width="320" height="240" controls="controls">
  <source controls src="http://122.155.197.142:1935/vod/_definst_/mp4:series/eee340664eth480.mp4/playlist.m3u8"/> 
  <source controls src="rtsp://122.155.197.142:1935/vod/_definst_/mp4:series/eee340664eth480.mp4"/> 
  Your browser does not support the video tag.
</video>
</body>
</html>
<?php
exit; 
?>


<script src="<?=static_url('/js/jwplayer/jwplayer.js')?>"></script>
<div id="container">Loading the player ...</div>
<script type="text/javascript">
    jwplayer("container").setup({
        flashplayer: "<?=static_url("/js/jwplayer/player.swf")?>",
        width: "640",
        height: "480" ,
        primary: 'html5',
        aspectratio: '16:9',
        autostart: 'true',
        //file: "http://122.155.197.142:1935/vod/_definst_/mp4:series/3405377f8fth480.mp4/playlist.m3u8",

        file:"rtsp://122.155.197.142:1935/vod/_definst_/mp4:series/3405377f8fth480.mp4",
        //levels: [
           // { file: "rtmp://122.155.197.142:1935/vod/mp4:1.mp4" }, // H.264 version
            
            //{ file: "http://122.155.197.142:1935/vod/mp4:1.mp4/playlist.m3u8" }, // Ogg Theroa version
          //  { file: "rtsp://122.155.197.142:1935/vod/1.mp4" }, // WebM version
          //  ],
         
        skin:"<?=static_url('/js/jwplayer/newtubedark.zip')?>",
        events: {
            onReady:function(){
                //console.log('ready');
                jwplayer().getPlugin("dock").setButton("quality",qualityHD,'<?=static_url('/img/qualityHD.png')?>','<?=static_url('/img/qualityHD.png')?>');
                jwplayer().getPlugin("dock").setButton("sound",soundTha,'<?=static_url('/img/soundEng.png')?>','<?=static_url('/img/soundEng.png')?>');
            },
        },
    });
    function qualityHD(){
        jwplayer().getPlugin("dock").setButton("quality",qualitySD,'<?=static_url('/img/qualityHD.png')?>','<?=static_url('/img/qualityHD.png')?>');
        var position = jwplayer().getPosition();
        var playlist = jwplayer().getPlaylist()[0];
        playlist.file = playlist.file.replace('480','720');
        jwplayer().load(playlist).seek(position);
        console.log(jwplayer().getPlaylist());
    }
    function qualitySD(){
        jwplayer().getPlugin("dock").setButton("quality",qualityHD,'<?=static_url('/img/qualitySD.png')?>','<?=static_url('/img/qualitySD.png')?>');
        var position = jwplayer().getPosition();
        var playlist = jwplayer().getPlaylist()[0];
        playlist.file = playlist.file.replace('720','480');
        jwplayer().load(playlist).seek(position);
        console.log(jwplayer().getPlaylist());
    }

    function soundTha(){
        jwplayer().getPlugin("dock").setButton("sound",soundEng,'<?=static_url('/img/soundTha.png')?>','<?=static_url('/img/soundTha.png')?>');
        var position = jwplayer().getPosition();
        var playlist = jwplayer().getPlaylist()[0];
        playlist.file = playlist.file.replace('th','en');
        jwplayer().load(playlist).seek(position);
        console.log(jwplayer().getPlaylist());
    }
    function soundEng(){
        jwplayer().getPlugin("dock").setButton("sound",soundTha,'<?=static_url('/img/soundEng.png')?>','<?=static_url('/img/soundEng.png')?>');
        var position = jwplayer().getPosition();
        var playlist = jwplayer().getPlaylist()[0];
        playlist.file = playlist.file.replace('en','th');
        jwplayer().load(playlist).seek(position);
        console.log(jwplayer().getPlaylist());
    }
</script>
</body>
</html>