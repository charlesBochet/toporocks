<template>
  <side-bar :title="$t('add_ascent')" @closed="$emit('closed')">
    AddAscentSideBar
  </side-bar>
</template>

<script>
import SideBar from './SideBar';

export default {
  name: 'AddAscentSideBar',
  components: {
    SideBar
  }
}
</script>

<style scoped>
</style>
