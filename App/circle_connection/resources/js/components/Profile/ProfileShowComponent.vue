<template>
  <div>
    <div class="text-center mb-2">
      <img :src="'/storage/profile_picture/' + profile_user.picture_url" class="profile">
    </div>
    <span v-if="profile_user.user_type_id === 1">
      <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{ profile_user.name }}</h5>
        <p class="card-body">{{ profile_user.grade }}</p>
        <p class="card-body">{{ profile_user.faculty }}</p>
        <p class="card-body">{{ profile_user.hometown }}</p>
        <p class="card-body">{{ profile_user.introduce }}</p>
        <p class="card-body">{{ profile_user.gender }}</p>
        <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a>
      </div>
      </div>
    </span>
    <span v-else-if="profile_user.user_type_id === 2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">
            {{ profile_user.name }}
          </h5>
          <i class="fab fa-twitter fa-2x">
<!--            <router-link to="https://twitter.com/{{ profile_user.twitter_id }}"></router-link>-->
<!--            <a href=""></a>-->
          </i>
          <i class="fab fa-instagram fa-2x">

          </i>
          <p class="card-text">サークル紹介：　{{ profile_user.introduce }}</p>
          <p class="card-text">活動内容：　{{ profile_user.content}}</p>
          <p class="card-text">活動場所：　{{ profile_user.place }}</p>
          <p class="card-text">サークルカテゴリー：　{{ profile_user.circle_category }}</p>
          <p class="card-text">人数：　{{ profile_user.scale }}</p>
        </div>
      </div>
    </span>
  </div>
</template>

<script>
import CircleProfileComponent from "./CircleProfileComponent";
import UserProfileComponent from "./UserProfileComponent";

export default {
  // props: ['profile_user_id'],
  data() {
    return {
      profile_user_id: this.$route.params.profile_user_id,
      profile_user: {}
    }
  },
  created() {
    console.log(this.profile_user_id);
    axios.get('/api/profiles/' + this.profile_user_id)
      .then((res) => {
        this.profile_user = res.data;
      })
      .catch((error) => {
        console.log(error);
      })
  },
  components: {
    CircleProfileComponent,
    UserProfileComponent
  }
}
</script>
