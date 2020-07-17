<template>
  <div class="side-bar">
    <div class="header">
      <span class="header-title">{{ title }}</span>
      <span class="header-close" @click="$emit('closed')">✕</span>
    </div>
    <slot></slot>
  </div>
</template>

<script>

export default {
  name: 'SideBar',
  props: ['title']
}
</script>

<style lang="scss" scoped>
  .side-bar {
    overflow-y: scroll;
    height: 100vh;
    background-color: white;
    width: 100vw;
    @media (min-width: 500px) {
      width: 500px;
    }
    position: absolute;
    right: 0;
    top: 0;
    z-index: 1001;

    .header {
      border-bottom: 1px solid #fafafa;
      height: 56px;
      line-height: 56px;
      padding: 0px 20px;
      color: #999;

      .header-close {
        float: right;
        cursor: pointer;
      }
    }
  }
</style>
