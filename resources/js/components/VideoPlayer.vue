<template>
  <vue-video-player
    class="vjs-custom-skin"
    ref="videoPlayer"
    :options="playerOptions"
    :playsinline="true"
  />
</template>

<script>
import "video.js/dist/video-js.css";
import VueVideoPlayer from "vue-video-player/src/player";

export default {
  name: "VideoPlayer",
  components: {
    VueVideoPlayer
  },
  data() {
    return {
      // videojs options
      playerOptions: {
        height: "360",
        autoplay: true,
        muted: true,
        language: "en",
        playbackRates: [0.7, 1.0, 1.5, 2.0],
        sources: [
          {
            type: "video/mp4",
            src: "api/movies/1/watch"
          }
        ]
      }
    };
  },
  mounted() {
    axios.get("api/movies/4/watch").then(resp => console.log(resp));
  }
};
</script>
