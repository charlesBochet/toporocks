<template>
  <div>
    <span v-for="grade in grades" class="grade" :class="{ selected: grade === selectedGrade }" :key="grade" @click="selectGrade(grade)">{{ grade }}</span>
  </div>
</template>

<script>
import Config from '../../../config'

export default {
  name: 'GradePicker',
  data () {
    return {
      grades: null,
      selectedGrade: null
    }
  },
  mounted () {
    this.grades = Config.grades
  },
  methods: {
    selectGrade (grade) {
      this.selectedGrade = grade
      this.$emit('selected', grade)
    }
  }
}
</script>

<style lang="scss" scoped>
  .grade {
    display: inline-block;
    padding: 5px;
    border: 1px solid #eee;
    border-radius: 5px;
    margin: 3px;
    cursor: pointer;
    &:hover {
      background-color: #eee;
    }
    &.selected {
      background-color: #eee;
    }
  }
</style>
