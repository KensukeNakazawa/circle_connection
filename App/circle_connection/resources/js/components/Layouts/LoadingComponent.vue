<template>
  <!--
    Loading の実装 vuex
    https://www.hypertextcandy.com/loading-with-vuex
    https://zukucode.com/2017/04/vuex-action-loading.html
  -->
  <div v-if="this.$store.state.loading">
    <vue-loading
      type="spiningDubbles"
      color="#4169e1"
      :size="{ width: '100px', height: '100px' }"
    >
    </vue-loading>
  </div>
</template>

<script>
import { VueLoading } from 'vue-loading-template'
import {mapState} from 'vuex';

export default {
  // computed: {
  //   ...mapState({
  //   loading: 'loading'
  // })
  // },
  components: {
    VueLoading
  }
}

</script>

<style scoped>

</style>
