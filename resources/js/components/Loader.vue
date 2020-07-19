<template>
  <div class="loader-container">
    <div class="lds-ripple"><div></div><div></div></div>
  </div>
</template>

<script>

export default {
  name: 'Loader'
}
</script>

<style lang="scss" scoped>
  .loader-container {
    text-align: center;
  }
  .lds-ripple {
    display: inline-block;
    position: relative;
    width: 200px;
    height: 200px;
    margin: auto;
  }
  .lds-ripple div {
    position: absolute;
    border: 4px solid #1c077b;
    opacity: 1;
    border-radius: 50%;
    animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
  }
  .lds-ripple div:nth-child(2) {
    animation-delay: -0.5s;
  }
  @keyframes lds-ripple {
    0% {
      top: 90px;
      left: 90px;
      width: 0;
      height: 0;
      opacity: 1;
    }
    100% {
      top: 0px;
      left: 0px;
      width: 180px;
      height: 180px;
      opacity: 0;
    }
  }

</style>
