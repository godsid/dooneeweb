<?php
//$file = isset($_GET['file'])?$_GET['file']:"movies/NCIS-LA-MASTER-TEST.mp4";

/*
<!--<script src="http://jwpsrv.com/library/Oc_FXgzlEeSUiyIACtqXBA.js"></script>
<div id='playerfiQrAeklYZgB'></div>
<script type='text/javascript'>
    jwplayer('playerfiQrAeklYZgB').setup({
        sources:[
        {
            file: 'rtmp://122.155.197.142:1935/vods/_definst_/mp4:<?=$file?>'
        },
        {
            file: 'http://122.155.197.142:1935/vods/_definst_/mp4:<?=$file?>/playlist.m3u8'
        },
        {
            file: 'rtsp://122.155.197.142:1935/vods/_definst_/movies/<?=$file?>'
        }],
        primary: 'flash',
        //image: '//122.155.197.142/hawaii-five-o.jpg',
        width: '100%',
        aspectratio: '16:9',
        autostart: 'false',
        rtmp: {
                securetoken: "2efb932b99725e31"
        },
    });

</script>-->
*/
var_dump($movie);
echo $moviePath;
//http://122.155.197.142:1935/vod/mp4:series/e63b0e7202th480.mp4/playlist.m3u8

//rtsp://122.155.197.142:1935/vod/_definst_/series/e63b0e7202th480.mp4
?>
<script src="http://jwpsrv.com/library/Oc_FXgzlEeSUiyIACtqXBA.js"></script>
<div id='playerfiQrAeklYZgB'></div>
<script type='text/javascript'>
    jwplayer('playerfiQrAeklYZgB').setup({
        sources:[
        {
            file: 'rtmp://122.155.197.142:1935/vod/_definst_/mp4:series/e63b0e7202th480.mp4'
        },
        {
            file: 'http://122.155.197.142:1935/vod/_definst_/mp4:series/e63b0e7202th480.mp4/playlist.m3u8'
        },
        {
            file: 'rtsp://122.155.197.142:1935/vod/_definst_/series/e63b0e7202th480.mp4'
        }
        ],
        primary: 'html5',
        //image: '//122.155.197.142/hawaii-five-o.jpg',
        width: '100%',
        aspectratio: '16:9',
        autostart: 'false',
        rtmp: {
                securetoken: "2efb932b99725e31"
        },
    });

</script>

<?php exit;?>
<script src="<?=static_url('/js/jwplayer/jwplayer.js')?>"></script>
<div id="container">Loading the player ...</div>
<script type="text/javascript">

//http://www.longtailvideo.com/support/jw5
jwplayer("container").setup({
    flashplayer: "<?=static_url("/js/jwplayer/player.swf")?>",
    width: "100%",
    height: "100%" ,
    primary: 'html5',
    aspectratio: '16:9',
    autostart: 'false',
    //file: "series/e63b0e7202th480.mp4",
    <?php /*levels: [
        { bitrate: 600, file: "series/0fe066fc2cth480.mp4", width: 480 },
        { bitrate: 900, file: "series/0fe066fc2cth720.mp4", width: 720 },
        { bitrate: 790, file: "series/0fe066fc2cth480.mp4", width: 480 },
        { bitrate: 1320, file: "series/0fe066fc2cth480.mp4", width: 720 },
    ],*/ ?>
    sources:[{file: 'http://122.155.197.142:1935/vods/_definst_/mp4:/series/e63b0e7202th480.mp4/playlist.m3u8'}],
    //provider: "rtsp",
    //streamer: "rtsp://122.155.197.142:1935/vod/",
    /*rtmp: {
            securetoken: "2efb932b99725e31"
        },
    */
     //   token:"2efb932b99725e31",
        //securetoken:"2efb932b99725e31",
    plugins: {
        "gapro-2": {
            "idstring": "||<?=$movie['movie_id']?>||-||<?=$movie['title']?>||",
            "trackstarts": true,
            "trackpercentage": true,
            "trackseconds": true
        },
        //gapro: { accountid: "UA-37461640-3" },
        //"qualitymonitor-2": {},
        //"hd-2": { file: "<?=$moviePath?>th720.mp4", fullscreen: true,state :false },
        sharing: { link: "<?=base_url('/movie/'.$movie['movie_id'])?>" },
        <?php /*"captions-2": {
           files: "/assets/tha.srt,/assets/eng.srt",
           labels: "Thai,English"},*/?>
   },
    skin:"<?=static_url('/js/jwplayer/newtubedark.zip')?>",
    /*logo: {
        hide:false,
        position:"top-left",
        margin:8,
        file: "<?=static_url('/img/logo-player.png')?>",
        link: "<?=home_url()?>"
    },*/
    abouttext:"DooneeTV 2014",
    aboutlink:"<?=base_url('/privacy')?>",
    <?php /*playlist: [
                { duration: 32, file: "series/0fe066fc2cth480.mp4", image:"http://www.doonee.tv/assets/files/2014/335a3.jpg" },
                { duration: 124, file: "series/0fe066fc2cth720.mp4", image: "http://www.doonee.tv/assets/files/2014/335a3.jpg" },
                { duration: 542, file: "series/0fe066fc2cen480.mp4", image:"http://www.doonee.tv/assets/files/2014/335a3.jpg" },
                { duration: 542, file: "series/0fe066fc2cen720.mp4", image:"http://www.doonee.tv/assets/files/2014/335a3.jpg" },
        ],
        "playlist.position": "right",
        "playlist.size": 360,*/ ?>
    events: {
        onReady:function(){
            console.log('ready');
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
<script type="text/javascript">
  var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
  document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
  try{
    var pageTracker = _gat._getTracker("UA-37461640-3");
    pageTracker._trackPageview();
  } catch(err) {}
</script>

<?php /*<!--
wowzacaptionfile=movies/hawaii-five-o-s4-ep1_480.ttml&wowzacaptionlanguages=tha
 -->
 */ ?>
