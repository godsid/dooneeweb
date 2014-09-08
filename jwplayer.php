<?php
$file = isset($_GET['file'])?$_GET['file']:"movies/NCIS-LA-MASTER-TEST.mp4";
?>
<script src="http://jwpsrv.com/library/Oc_FXgzlEeSUiyIACtqXBA.js"></script>
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

</script>

<!--
wowzacaptionfile=movies/hawaii-five-o-s4-ep1_480.ttml&wowzacaptionlanguages=tha

 -->
