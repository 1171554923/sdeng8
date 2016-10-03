
<!DOCTYPE html>
<html>
<head>
  <title>Video.js | HTML5 Video Player</title>

  <!-- Chang URLs to wherever Video.js files will be hosted -->
  <link href="../css/video-js.css" rel="stylesheet" type="text/css">
  <!-- video.js must be in the <head> for older IEs to work. -->
  <script src="../js/video.js"></script>

  <!-- Unless using the CDN hosted version, update the URL to the Flash SWF -->
  <script>
    	videojs.options.flash.swf = "../video-js.swf";
  </script>
</head>
<body>
	
  <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="1000" height="464"  data-setup="{}">
    <source src="<?=constant('ASSETS_URL').$model->url?>" type='<?=$model['url_type']?>' />	
    <track kind="captions" src="../demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
    <track kind="subtitles" src="../demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
  </video>

</body>
</html>
