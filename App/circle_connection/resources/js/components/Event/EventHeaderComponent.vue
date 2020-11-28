<template>
  <div v-if="user_type_id === 1">
    <ul class="mx-auto text-center list-group list-group-horizontal">
        <li class="list-group-item" :class="{ active: index_or_my === 'index' }" @click="getIndex">
          イベント一覧
        </li>
        <li class="list-group-item" :class="{ active: index_or_my === 'my' }" @click="getParticipate">
          参加イベント
        </li>
    </ul>
  </div>
  <div v-else-if="user_type_id === 2">
    <ul class="mx-auto list-group list-group-horizontal">
      <li class="list-group-item" :class="{ active: index_or_my === 'index' }" @click="getIndex">
        イベント一覧
      </li>

      <li class="list-group-item" :class="{ active: index_or_my === 'my' }" @click="getMyEvent">
        予定イベント
      </li>
    </ul>
  </div>

</template>

<script>
export default {
  props: ['user_type_id'],
  data() {
    return {
      index_or_my: 'index'
    }
  },
  methods: {
    getIndex() {
      axios.get('/api/events')
        .then((res) => {
          this.$parent.events = res.data;
          this.index_or_my = 'index';
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getParticipate() {
      axios.get('/api/events/participate_events/' + this.$parent.user.id)
        .then((res) => {
          this.$parent.events = res.data;
          this.index_or_my = 'my';
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getMyEvent() {
      axios.get('/api/events/my_events/' + this.$parent.user.id)
        .then((res) => {
          this.$parent.events = res.data;
          this.index_or_my = 'my';
        })
        .catch((error) => {
          console.log(error);
        });
    }
  }
}

</script>
