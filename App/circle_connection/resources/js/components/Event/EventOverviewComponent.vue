<template>
  <div class="card">
    <div class="card-body">
<!--      <p class="card-img"><img :src="'/storage/profile_picture/' + user.picture_url" class="profile"></p>-->
      <p class="card-text">場所: {{ event.place }}</p>
      <p class="card-text">予定日時: {{ event.start_time }} ~ {{ event.end_time }}</p>
      <p class="card-text">予定時間: 2時間</p>
      <p class="card-text">内容: {{ event.content }}</p>
      <router-link v-bind:to="{name: 'events.show', params: {event_id: event.id}}">
        <i class="card-link">詳しく見る</i>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  props: ['event'],

}
</script>>
