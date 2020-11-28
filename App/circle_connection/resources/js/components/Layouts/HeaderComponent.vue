<template>
  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light ">
    <router-link v-bind:to="{name: 'home'}">
      <span class="navbar-brand" href="#">Connection</span>
    </router-link>
    {{ /** エラーメッセージがあれば表示する */ }}
    <div v-bind:class="'alert-' + alertType" v-if="alertMessage">{{ alertMessage }}</div>

  </nav>
</template>

<script>
import {mapState} from 'vuex';

export default {
  data() {
    return {
      show: false
    }
  },
  updated() {
    /** 3秒後にfalseにする */
    setTimeout(() => {this.alertMessage = null},3000)
  },
  computed: mapState('alert', {
    'alertMessage': 'message',
    'alertType': 'type'
  }),
}
</script>
