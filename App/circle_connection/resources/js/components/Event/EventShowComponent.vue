<template>
  <div>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{ event.title }}</h5>
        <p class="card-text">{{ event.content }}</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">{{ event.meeting_place }}</li>
        <li class="list-group-item">{{ event.start_time }}</li>
        <li class="list-group-item">{{ event.end_time}}</li>
        <li class="list-group-item">{{ event.number_of_persons }}</li>
        <li class="list-group-item">{{ event.fee}}</li>
      </ul>
    </div>
    <button class="btn btn-primary" type="button" @click="participate">イベントに参加する</button>

    <ul class="list-group">
      <li v-for="profile_user in event.users" class="list-group-item">
        <user-profile-overview-component :profile_user="profile_user"></user-profile-overview-component>
      </li>
    </ul>

  </div>
</template>

<script>
import UserProfileOverviewComponent from '../Profile/UserProfileOverviewComponent';

export default {
  props: ['event_id'],
  data() {
    return {
      user: {},
      event: {}
    }
  },
  created() {
    axios.get('/api/me')
      .then((res) => {
        this.user = res.data;
        /** イベントを取得する */
        axios.get('/api/events/' + this.event_id)
          .then((res) => {
            this.event = res.data;
          })
          .catch((error) => {
            console.log(error);
          });
      })
      .catch((error) => {
        console.log(error);
      });
  },
  methods: {
    /** ログインユーザーをイベントに追加する */
    participate() {
      axios.post('/api/event_participant', {
        user_id: this.user.id,
        event_id: this.event.event_id
      })
        .then((res) => {
          this.$store.commit('alert/setAlert', {'message': res.data.message});
          this.$router.push({name: 'events'});
        })
        .catch((error) => {
          /**
           * エラーハンドリング
           * TODO: これが書くとこ多そうだからまとめれそうならまとめたい
           */
          var error_message = Object.values(error.response.data.errors).join("\n");
          this.$store.commit('alert/setAlert', {'message': error_message, 'type': 'danger'});
        });
    }
  },
  components: {
    UserProfileOverviewComponent,
  }
}
</script>
