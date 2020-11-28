<template>
  <div>
    <p v-show="isError">情報の取得に失敗しました</p>
    <div class="text-center mb-2">
      <img :src="'/storage/profile_picture/' + user.picture_url" class="profile">
    </div>
    <span @click="show">画像を変更する</span>
    <profile-picture-component></profile-picture-component>
    <ul class="list-group">
      <span v-if="user.user_type_id === 1">

        <router-link v-bind:to="{name: 'user.setting'}">
          <li class="list-group-item">基本設定</li>
        </router-link>

      </span>

      <span v-else-if="user.user_type_id === 2">
        <router-link v-bind:to="{name: 'circle.setting'}">
          <li class="list-group-item">基本設定</li>
        </router-link>
      </span>

      <router-link v-bind:to="{name: 'set_sns_setting'}">
        <li class="list-group-item">SNS設定</li>
      </router-link>

      <span>
        <a><li class="list-group-item" @click="logout">ログアウト</li></a>
      </span>

    </ul>
  </div>
</template>

<script>
import ProfilePictureComponent from "./ProfilePictureComponent";
export default {
  data() {
    return {
      isError: false,
      user: {}
    }
  },
  mounted() {
    axios.get('/api/me')
      .then((res) => {
        this.user = res.data;
      })
      .catch((error) => {
        this.isError = true;
      });
  },
  methods: {
    logout() {
      this.$store.dispatch('logout');
    },
    show() {
      this.$modal.show('profile-picture-modal');
    }
  },
  components: {
    ProfilePictureComponent
  }
}
</script>
