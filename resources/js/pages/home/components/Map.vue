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
    <v-marker-cluster>
      <l-marker
        v-for="route in routes"
        :key="route.id"
        :lat-lng="route.location.coordinates"
        :icon="icon"
      >
        <l-tooltip v-if="route.ascents.length > 0" :options="{
          permanent: true,
          direction: 'top',
          className: 'route-tooltip'
        }"
        >
          {{ route.ascents[0].grade }}
        </l-tooltip>
      </l-marker>
    </v-marker-cluster>
  </l-map>
</template>

<script>
import { latLng, icon } from 'leaflet'
import { LMap, LTileLayer, LCircleMarker, LMarker, LTooltip } from 'vue2-leaflet'
import VMarkerCluster from 'vue2-leaflet-markercluster'

export default {
  name: 'TopoMap',
  components: {
    LMap,
    LTileLayer,
    LCircleMarker,
    LMarker,
    LTooltip,
    VMarkerCluster
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
        iconSize: [1, 1],
        iconAnchor: [1, 1]
      })
    }
  },
  mounted () {
    this.getCurrentPosition(() => { this.center.lat = this.currentPosition.lat; this.center.lng = this.currentPosition.lng; this.zoom = 17 })
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

<style>
  .route-tooltip {
    background: red;
    color: white;
    border-radius: 3px;
  }
</style>
