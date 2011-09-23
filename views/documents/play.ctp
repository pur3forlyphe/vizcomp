
<h1><?php echo $video['description']; ?></h1>
  <!-- Begin VideoJS -->
  <div class="video-js-box">
    <!-- Using the Video for Everybody Embed Code http://camendesign.com/code/video_for_everybody -->
	
    <video class="video-js" width="640" height="264" controls preload poster="http://video-js.zencoder.com/oceans-clip.png">
		
      <source src="<?php echo $video['original'];?>" type='video/mp4;' />
	  
      <!-- Flash Fallback. Use any flash video player here. Make sure to keep the vjs-flash-fallback class. -->
	  
      <object class="vjs-flash-fallback" width="640" height="264" type="application/x-shockwave-flash" data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf">
		  
        <param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" />
		
        <param name="allowfullscreen" value="true" />
		
        <param name="flashvars" value='config={"playlist":["http://video-js.zencoder.com/oceans-clip.png", {"url": "http://vizcomp/<?php echo $video['original'] . '.' . $video['extension']; ?>","autoPlay":false,"autoBuffering":true}]}' />
        <!-- Image Fallback. Typically the same as the poster image. -->
        <img src="http://video-js.zencoder.com/oceans-clip.png" width="640" height="264" alt="Poster Image" title="No video playback capabilities." />
		
      </object>
	  
    </video>
	
    <!-- Download links provided for devices that can't play video in the browser. -->
	
  </div>
  <!-- End VideoJS -->