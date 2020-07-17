<template>
  <side-bar :title="$t('view_ascent')" @closed="$emit('closed')">
    ViewAscentSideBar
  </side-bar>
</template>

<script>
import SideBar from './SideBar';

export default {
  name: 'ViewAscentSideBar',
  components: {
    SideBar
  }
}
</script>

<style scoped>
</style>
