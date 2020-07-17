<template>
  <div>
    <topo-map @centerUpdated="mapCenter = $event"/>
    <div class="add-button" @click="addRoute">
      + {{ $t('add_route') }}
    </div>
    <add-route-side-bar v-if="mode === 'add-route'" @closed="closeSideBar" :map-center="mapCenter">
    </add-route-side-bar>
    <view-route-side-bar v-if="mode === 'view-route'" @closed="closeSideBar">
    </view-route-side-bar>
    <add-ascent-side-bar v-if="mode === 'add-ascent'" @closed="closeSideBar">
    </add-ascent-side-bar>
    <view-ascent-side-bar v-if="mode === 'view-ascent'" @closed="closeSideBar">
    </view-ascent-side-bar>
  </div>
</template>

<script>
import { latLng } from 'leaflet'
import TopoMap from './components/Map.vue'
import AddRouteSideBar from './components/AddRouteSideBar'
import AddAscentSideBar from './components/AddAscentSideBar';
import ViewAscentSideBar from './components/ViewAscentSideBar'
import ViewRouteSideBar from './components/ViewRouteSideBar'

export default {
  components: { AddAscentSideBar, AddRouteSideBar, ViewRouteSideBar, ViewAscentSideBar, TopoMap },
  props: [
    'mode' // ['default', 'view-route', 'add-ascent', 'view-ascent', 'add-route']
  ],
  data () {
    return {
      selectedRoute: null,
      mapCenter: latLng(48.4, 2.7)
    }
  },
  methods: {
    addRoute () {
      this.$router.push('/add-route')
    },
    closeSideBar () {
      this.$router.push('/')
    }
  }
}
</script>

<style scoped>
  .add-button {
    font-weight: bold;
    position: absolute;
    bottom: 10px;
    right: 10px;
    background: #1c077b;
    border-radius: 30px;
    height: 60px;
    line-height: 60px;
    color: white;
    border: none;
    padding: 0px 30px;
    font-size: 1em;
    z-index: 1000;
    text-align: center;
    cursor: pointer;
  }
</style>
