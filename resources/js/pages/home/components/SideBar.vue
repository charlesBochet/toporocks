<template>
  <div class="side-bar">
    <div class="header">
      <span class="header-title"><a class="action" @click="actionCallback">✓ {{ title }}</a></span>
      <span class="header-close" @click="$emit('closed')">✕</span>
    </div>
    <slot></slot>
  </div>
</template>

<script>

export default {
  name: 'SideBar',
  props: ['title', 'actionCallback']
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
      padding: 0px 20px;
      color: #999;

      .header-close {
        line-height: 56px;
        float: right;
        cursor: pointer;
      }

      .action {
        display: inline-block;
        padding: 5px 10px;
        border: 1px solid #fafafa;
        cursor: pointer;
        background-color: #529e00;
        color: white;
        border-radius: 5px;
        margin-top: 10px;
        font-size: 0.9em;
      }
    }
  }
</style>
