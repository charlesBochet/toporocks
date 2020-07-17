<template>
  <l-map
    v-if="routes"
    :zoom="zoom"
    :center="center"
    :options="mapOptions"
    class="min-vh-100"
    @update:center="centerUpdate"
  >
    <l-tile-layer
      :url="url"
    />
    <l-circle-marker
      v-if="currentPosition"
      :lat-lng="currentPosition"
      :options="{ color: '#2890ff', fillColor: '#2890ff', fillOpacity: 0.8, weight: 1 }"
    />
    <l-marker
      v-for="route in routes"
      :key="route.id"
      :lat-lng="route.location.coordinates"
      :icon="icon" />
  </l-map>
</template>

<script>
import { latLng, icon } from 'leaflet'
import { LMap, LTileLayer, LCircleMarker, LMarker } from 'vue2-leaflet'

export default {
  name: 'TopoMap',
  components: {
    LMap,
    LTileLayer,
    LCircleMarker,
    LMarker
  },
  props: ['routes'],
  data () {
    return {
      zoom: 5,
      center: latLng(48.4, 2.7),
      url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      currentPosition: null,
      mapOptions: {
        zoomAnimation: true
      },
      icon: icon({
        iconUrl: '/icons/marker.png',
        iconSize: [37, 37],
        iconAnchor: [18, 37]
      })
    }
  },
  mounted () {
    this.getCurrentPosition(() => { this.center.lat = this.currentPosition.lat; this.center.lng = this.currentPosition.lng; this.zoom = 13 })
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
    },
    centerUpdate (center) {
      this.$emit('centerUpdated', center)
    }
  }
}
</script>

<style scoped>
</style>
