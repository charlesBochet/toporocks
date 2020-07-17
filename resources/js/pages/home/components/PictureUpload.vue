<template>
  <div>
    <img v-if="previewImage" :src="previewImage" class="uploaded-image">
    <input type="file" accept="image/png, image/jpeg" @change="uploadImage" class="image-input">
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
      reader.readAsDataURL(image)
      reader.onload = e => {
        this.previewImage = e.target.result
        this.$emit('pictureUploaded', this.previewImage)
      }
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
