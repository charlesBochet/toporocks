<template>
  <div>
    <topo-map :routes="routes" @centerUpdated="mapCenter = $event" />
    <div v-if="user" class="add-button" @click="addRoute">
      + {{ $t('add_route') }}
    </div>
    <add-route-side-bar v-if="mode === 'add-route'" :map-center="mapCenter" @closed="closeSideBar" :routes="routes" />
    <view-route-side-bar v-if="mode === 'view-route'" @closed="closeSideBar" />
    <add-ascent-side-bar v-if="mode === 'add-ascent'" @closed="closeSideBar" />
    <view-ascent-side-bar v-if="mode === 'view-ascent'" @closed="closeSideBar" />
  </div>
</template>

<script>
import { latLng } from 'leaflet'
import TopoMap from './components/Map.vue'
import AddRouteSideBar from './components/AddRouteSideBar'
import AddAscentSideBar from './components/AddAscentSideBar'
import ViewAscentSideBar from './components/ViewAscentSideBar'
import ViewRouteSideBar from './components/ViewRouteSideBar'
import { mapGetters } from 'vuex'

export default {
  components: { AddAscentSideBar, AddRouteSideBar, ViewRouteSideBar, ViewAscentSideBar, TopoMap },
  props: [
    'mode' // ['default', 'view-route', 'add-ascent', 'view-ascent', 'add-route']
  ],
  data () {
    return {
      routes: [],
      selectedRoute: null,
      mapCenter: latLng(48.4, 2.7)
    }
  },
  mounted () {
    this.$http.get('api/routes').then((response) => {
      this.routes = response.data
    })
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
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
