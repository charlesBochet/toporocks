<template>
  <div ref="picture-container">
    <input type="file" accept="image/png, image/jpeg" class="image-input" @change="loadPicture">
    <editor v-if="displayEditor" ref="editor" :canvas-height="canvasHeight" :canvas-width="canvasWidth" />
  </div>
</template>

<script>
import Editor from 'vue-image-markup'

export default {
  name: 'PictureUpload',
  components: { Editor },
  data () {
    return {
      canvasHeight: 150,
      canvasWidth: 300,
      displayEditor: false,
      uploadConfig: {},
      picturePath: null,
      tracedPicturePath: null
    }
  },
  methods: {
    loadPicture (e) {
      this.displayEditor = false
      const image = e.target.files[0]

      let data = new FormData()
      data.append('file', image)

      this.uploadConfig = {
        header: {
          'Content-Type': e.target.mime
        }
      }
      this.$http.post('api/pictures/upload', data, this.uploadConfig).then((response) => {
        this.canvasWidth = this.$refs['picture-container'].clientWidth
        let image = new Image()
        image.src = response.data.url
        image.onload = () => {
          this.canvasHeight = this.canvasWidth / image.width * image.height
          this.displayEditor = true
          this.$nextTick(() => {
            this.$refs.editor.set('freeDrawing', { stroke: 'red' })
            this.$refs.editor.setBackgroundImage(response.data.url)
          })
        }

        this.picturePath = response.data.path
      }).catch((error) => {
        alert('Error while uploading')
        console.log(error)
      })
    },
    savePictures () {
      let base64Image = this.$refs.editor.saveImage()
      fetch(base64Image).then(res => {
        res.blob().then(image => {
          let data = new FormData()
          data.append('file', image)
          return this.$http.post('api/pictures/upload', data, this.uploadConfig).then((response) => {
            this.tracedPicturePath = response.data.path
            this.$emit('picturesUploaded', { picturePath: this.picturePath, tracedPicturePath: this.tracedPicturePath })
          })
        })
      })
    }
  }
}
</script>

<style>
  .image-input {
    margin-top: 5px;
    font-size: 0.8em;
  }
</style>
