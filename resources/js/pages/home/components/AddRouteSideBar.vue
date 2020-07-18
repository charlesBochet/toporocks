<template>
  <side-bar :title="$t('add_route')" :action-callback="savePictures" @closed="$emit('closed')">
    <div class="side-bar-section">
      <div class="section-label">
        Location
      </div>
      <div class="section-content">
        <mini-map :center="mapCenter" @positionUpdated="routePosition = $event" :routes="routes" />
      </div>
    </div>
    <div class="side-bar-section">
      <div class="section-label">
        Topo
      </div>
      <div class="section-content">
        <picture-upload ref="pictureUpload" @picturesUploaded="addRoute" />
      </div>
    </div>
    <div class="side-bar-section">
      <div class="section-label">
        Grade
      </div>
      <div class="section-content">
        <grade-picker @selected="selectedGrade = $event" />
      </div>
    </div>
  </side-bar>
</template>

<script>
import SideBar from './SideBar'
import GradePicker from './GradePicker'
import PictureUpload from './PictureUpload'
import MiniMap from './MiniMap'

export default {
  name: 'AddRouteSideBar',
  components: {
    MiniMap,
    PictureUpload,
    GradePicker,
    SideBar
  },
  props: ['mapCenter', 'routes'],
  data () {
    return {
      routePosition: this.mapCenter,
      selectedGrade: null,
      picturePath: null,
      tracedPicturePath: null
    }
  },
  mounted () {
  },
  methods: {
    savePictures () {
      this.$refs.pictureUpload.savePictures()
    },
    addRoute ($event) {
      this.picturePath = $event.picturePath
      this.tracedPicturePath = $event.tracedPicturePath
      const data = {
        position: this.routePosition,
        grade: this.selectedGrade,
        picturePath: this.picturePath,
        tracedPicturePath: this.tracedPicturePath
      }
      this.$http.post('api/routes/create', data).then((response) => {
        this.$emit('closed')
      }).catch((error) => {
        alert('Error while uploading')
        console.log(error)
      })
      console.log(this.$data)
    }
  }
}
</script>

<style lang="scss" scoped>
  .side-bar-section {
    padding: 10px 20px;

    .section-label {
      font-weight: bold;
      color: #666;
    }
  }

  .grade {
    display: inline-block;
    padding: 5px;
    border: 1px solid #eee;
    border-radius: 5px;
    margin: 3px;
    cursor: pointer;
    &:hover {
      background-color: #eee;
    }
  }
</style>
