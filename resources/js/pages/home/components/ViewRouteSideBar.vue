<template>
  <side-bar :title="$t('view_route')" @closed="$emit('closed')">
    Coucou
  </side-bar>
</template>

<script>
import SideBar from './SideBar';

export default {
  name: 'ViewRouteSideBar',
  components: {
    SideBar
  }
}
</script>

<style scoped>
</style>
