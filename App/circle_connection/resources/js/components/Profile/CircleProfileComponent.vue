<template>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">
        {{ profile_user.name }}
      </h5>
      <i class="fab fa-twitter"></i>
      <p class="card-text">{{ profile_user.circle_category }}</p>
      <p class="card-text">{{ profile_user.scale }}</p>
      <p class="card-text">{{ profile_user.introduce }}</p>
      <p class="card-text">{{ profile_user.content}}</p>
      <p class="card-text">{{ profile_user.place }}</p>
    </div>
    {{ profile_user }}
  </div>
</template>

<script>
export default {
  props: ['profile_user_id'],
  data() {
    return {
      profile_user: {}
    }
  },
  created() {
    axios.get('/api/profiles/' + this.profile_user_id)
      .then((res) => {
        console.log(res);
        this.profile_user = res.data;
      })
      .catch((error) => {
        console.log(error);
      })
  }
}
</script>
