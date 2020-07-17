<template>
  <div class="main-layout">
    <navbar />

    <div class="container-fluid p-0 main-container">
      <child />
    </div>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'

export default {
  name: 'MainLayout',

  components: {
    Navbar
  }
}
</script>

<style scoped>
  .main-container {
    overflow: hidden;
    height: calc(100vh - 56px)
  }
</style>
