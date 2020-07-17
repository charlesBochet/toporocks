<template>
  <l-map
    :zoom="zoom"
    :center="center"
    :options="mapOptions"
    class="min-vh-100"
  >
    <l-tile-layer
      :url="url"
    />
    <l-circle-marker
      v-if="currentPosition"
      :lat-lng="currentPosition"
      :options="{ color: '#2890ff', fillColor: '#2890ff', fillOpacity: 0.8, weight: 1 }"
    />
  </l-map>
</template>

<script>
import { latLng } from 'leaflet'
import { LMap, LTileLayer, LCircleMarker } from 'vue2-leaflet'

export default {
  name: 'TopoMap',
  components: {
    LMap,
    LTileLayer,
    LCircleMarker
  },
  data () {
    return {
      zoom: 5,
      center: latLng(48.4, 2.7),
      url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      currentPosition: null,
      mapOptions: {
        zoomAnimation: true
      }
    }
  },
  mounted () {
    this.getCurrentPosition(() => { this.center.lat = this.currentPosition.lat; this.center.lng  = this.currentPosition.lng; this.zoom = 13 })
    setInterval(this.getCurrentPosition, 3000)
  },
  methods: {
    getCurrentPosition (callback = () => {}) {
      if (!navigator.geolocation) {
        return
      }
      navigator.geolocation.getCurrentPosition(
        pos => {
          this.currentPosition = latLng(pos.coords.latitude, pos.coords.longitude)
          callback()
        }
      )
    }
  }
}
</script>

<style scoped>
</style>
