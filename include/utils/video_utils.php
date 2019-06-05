<?php


if ( ! function_exists( 'get_youtube_videos' ) ) :
    function get_youtube_videos($text){


        $match = array();
        $videos=array();


        $ret=preg_match_all('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $text, $match);
        //print_r($match);
        //echo $ret;
        //echo "youtube videos:".$ret."\n";
        if($ret>0){
            //print_r($match);
            $urls=$match[0];
            $ids=$match[1];
            //print_r($ids);
            $usedids=array();
            foreach($urls as $i=>$url)
            {
                $video=array();
                $video["url"]=$url;
                $video["embedurl"]="http://www.youtube.com/embed/".$ids[$i]."?origin=".get_site_url()."&autohide=1&controls=0&enablejsapi=1&version=3";
                $video["server"]="youtube";
                $video["id"]=$ids[$i];
                //echo $video["id"]."-".((in_array($video["id"], $ids))?"SI":"NO")." | ";
                if(!in_array($video["id"], $usedids)){
                    $videos[]=$video;
                    $usedids[]=$video["id"];
                }
            }
            //print_r($videos);

            return $videos;
        }else{
            return false;
        }
    }
endif;

if ( ! function_exists( 'get_vimeo_videos' ) ) :
    function get_vimeo_videos($text){
        $match = array();
        $videos=array();

        $ret=preg_match_all('|^https?://vimeo.com/([a-zA-Z0-9]+)|', $text, $match);
        //echo "vimeo videos:".$ret."\n";
        if($ret>0){
            //print_r($match);
            $urls=$match[0];
            $ids=$match[1];
            $usedids=array();
            foreach($urls as $i=>$url)
            {
                $video=array();
                $video["url"]=$url;
                $video["embedurl"]="http://player.vimeo.com/video/".$ids[$i]."?api=1&player_id=video-vimeo-".$ids[$i];
                $video["server"]="vimeo";
                $video["id"]=$ids[$i];

                if(!in_array($video["id"], $usedids)){
                    $videos[]=$video;
                    $usedids[]=$video["id"];
                }
            }
            //print_r($videos);
            return $videos;
        }else{
            return false;
        }
    }
endif;


if ( ! function_exists( 'get_video_thumbnail' ) ) :
    function get_video_thumbnail($id,$server){
        $ret="";
        $url= get_video_thumbnail_url($id,$server);
        $ret="<img src='".$url."'/>";
        return $ret;
    }
endif;


if ( ! function_exists( 'get_video_thumbnail_url' ) ) :
    function get_video_thumbnail_url($id,$server){
        $ret="";
        //_dump($id);
        $ret=get_template_directory_uri()."/assets/images/video-thumbnail.png";
        
        if(!$id) return $ret;

        if($server=="youtube"){
            $ret="http://img.youtube.com/vi/".$id."/hqdefault.jpg";
        }else if($server=="vimeo"){
            //_dump($id);
            $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$id.php"));
            $ret=$hash[0]['thumbnail_large'];
        }
        return $ret;
    }
endif;


if ( ! function_exists( 'get_video_thumbnail_from_url' ) ) :
function get_video_thumbnail_from_url($videourl){
    //$ret=preg_match_all('|https?://www.youtube.com/watch\?v=([a-zA-Z0-9]+)|', $videourl, $match);
    $ret=preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $videourl, $match);
    if($ret>0){
        $url=$match[0];
        $id=$match[1];
        return get_video_thumbnail_url($id,"youtube");
    }
    $ret=preg_match('|^https?://vimeo.com/([a-zA-Z0-9]+)|', $videourl, $match);
    //$ret= preg_match("/https?:\/\/(?:www\.)?vimeo\.com\/\d{8}/", $videourl, $match);
    if($ret>0){
        //_dump($match);
        $url=$match[0];
        $id=$match[1];
        return get_video_thumbnail_url($id,"vimeo");
    }

}
endif;



function get_post_videos($post){

    $videos=array();
    $tmp=get_youtube_videos(__($post->post_content));
    if($tmp){
        $videos=array_merge($videos,$tmp);
    }

    $tmp=get_vimeo_videos(__($post->post_content));
    if($tmp){
        $videos=array_merge($videos,$tmp);
    }
    return $videos;

}

function get_post_first_video($post){
    $videos=get_post_videos($post);
    if(is_array($videos)){
        if(count($videos)>0){
            return $videos[0];
        }
    }
    return false;
}



function youtube_api_script(){
?>
<script id="youtube-api-helpers">
      // 2. This code loads the IFrame Player API code asynchronously.
      if($('#youtube-api').size()==0) {
		  var tag = document.createElement('script');
    	  tag.id="youtube-api";
		  tag.src = "https://www.youtube.com/iframe_api";
		  var firstScriptTag = document.getElementsByTagName('script')[0];
		  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	  }
	  
	  
      var youtubePlayers = []; //{id:'player',height:'390',width:'640',videoId:'M7lc1UVf-VE'}
	
      function onYouTubeIframeAPIReady() {
        if(typeof youtubePlayers === 'undefined')
           return; 
		if(youtubePlayers.length>0){
			for(var i = 0; i < youtubePlayers.length;i++) {
			  var curplayer = createPlayer(youtubePlayers[i]);
			  youtubePlayers[i].obj=curplayer;
			}   
		}
      }
	  
	  function getPlayer(playerId){
		if(typeof youtubePlayers === 'undefined')
           return false; 
		if(youtubePlayers.length>0){
			for(var i = 0; i < youtubePlayers.length;i++) {
				if(youtubePlayers[i].id==playerId) return youtubePlayers[i].obj;
			}
		}
		return false;
	  }
      function createPlayer(playerInfo) {
          //console.log("CREATING YOUTUBE PLAYER");
		  //console.log(playerInfo);
		  
		  return new YT.Player(playerInfo.id, {
             videoId: playerInfo.videoId,
			 controls: 0,
			 autohide: 1,
			 playerVars: { 'autohide': 1, 'autoplay': 0, 'controls': 1 },
			events: {
				  'onStateChange': onPlayerStateChange,
				  
			}
			 
          });
      }
      	  
	  function onPlayerStateChange(event) {
        //console.log(event);
		if (event.data == YT.PlayerState.PAUSED){
			//console.log("PAUSED");
			//console.log(event.target.d);
			$(event.target.d).parent().removeClass('playing');
        }
      }

    </script>
<?php
}