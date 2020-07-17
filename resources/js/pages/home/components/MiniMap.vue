<template>
  <l-map
    :zoom="zoom"
    :center="center"
    :options="mapOptions"
    class="mini-map"
  >
    <l-tile-layer
      :url="url"
    />
    <l-marker :lat-lng="center" :draggable="true" :icon="icon" @update:latLng="updateMarkerPosition($event)"/>
  </l-map>
</template>

<script>
import { icon } from 'leaflet'
import { LMap, LTileLayer, LMarker } from 'vue2-leaflet'

export default {
  name: 'MiniMap',
  components: {
    LMap,
    LTileLayer,
    LMarker
  },
  props: [ 'center' ],
  data () {
    return {
      zoom: 18,
      url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      markerPositon: this.center,
      mapOptions: {
        zoomControl: false
      },
      icon: icon({
        iconUrl: '/icons/marker.png',
        iconSize: [37, 37],
        iconAnchor: [18, 37]
      })
    }
  },
  methods: {
    updateMarkerPosition (position) {
      this.markerPositon = position
      this.$emit('positionUpdated', position)
    }
  }
}
</script>

<style scoped>
  .mini-map {
    width: 100%;
    height: 300px;
  }
</style>
