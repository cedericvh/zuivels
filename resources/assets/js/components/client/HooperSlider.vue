<template>
  <hooper :itemsToShow="1" :centerMode="true" :infiniteScroll="true" :autoPlay="true" :playSpeed="4000" :wheelControl="false">
    <slide>
      <img src="/images/history/geschiedenis_01.jpg" alt="Geschiedenis">
    </slide>
    <slide>
      <img src="/images/history/geschiedenis_02.jpg" alt="Geschiedenis">
    </slide>
    <slide>
      <img src="/images/history/geschiedenis_03.jpg" alt="Geschiedenis">
    </slide>
    <slide>
      <img src="/images/history/geschiedenis_04.jpg" alt="Geschiedenis">
    </slide>
    <slide>
      <img src="/images/history/geschiedenis_05.jpg" alt="Geschiedenis">
    </slide>
    <slide>
      <img src="/images/history/geschiedenis_06.jpg" alt="Geschiedenis">
    </slide> 
    <hooper-navigation slot="hooper-addons"></hooper-navigation>
  </hooper>
</template>

<script>
  
  import { Hooper, Slide, Navigation as HooperNavigation } from 'hooper';
  export default {
    name: "HooperSlider",
    components: {
      Hooper,
      Slide,
      HooperNavigation
    }
  }
</script>
<style>
.hooper {
  position: relative;
  overflow: hidden;
  box-sizing: border-box;
  width: 100%;
}
.hooper * {
  box-sizing: border-box;
}
.hooper-track {
  display: flex;
  box-sizing: border-box;
  width: 100%;
  padding: 0;
  margin: 0;
}
.hooper-slide {
  flex-shrink: 0;
  
}


.hooper.is-vertical .hooper-track {
  flex-direction: column;
  height: 200px;
}
.hooper.is-rtl {
  direction: rtl;
}
.hooper-hidden {
  display: none;
}
</style>