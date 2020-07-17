<template>
  <div>
    <img v-if="previewImage" :src="previewImage" class="uploaded-image">
    <input type="file" accept="image/png, image/jpeg" class="image-input" @change="uploadImage">
  </div>
</template>

<script>
export default {
  name: 'PictureUpload',
  data () {
    return {
      previewImage: null
    }
  },
  methods: {
    uploadImage (e) {
      const image = e.target.files[0]
      const reader = new FileReader()

      let data = new FormData()
      data.append('file', image)

      console.log(e.target)
      let config = {
        header: {
          'Content-Type': e.target.mime
        }
      }
      this.$http.post('api/pictures/upload', data, config).then((response) => {
        reader.readAsDataURL(image)
        reader.onload = e => {
          this.previewImage = e.target.result
        }
        this.$emit('pictureUploaded', response.data.path)
      }).catch((error) => {
        alert('Error while uploading')
        console.log(error)
      })
    }
  }
}
</script>

<style>
  .uploaded-image {
    width: calc(100%);
  }

  .image-input {
    margin-top: 5px;
    font-size: 0.8em;
  }
</style>
