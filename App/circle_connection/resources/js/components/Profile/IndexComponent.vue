<template>
  <div>

    <!-- TODO: プロフィール一覧の見た目を整える -->
    <div v-if="user.user_type_id === 1">
      <ul class="list-group">
        <li v-for="profile_user in profile_users" class="list-group-item">
          <circle-profile-overview-component :profile_user="profile_user"></circle-profile-overview-component>
        </li>
      </ul>
    </div>
    <div v-else-if="user.user_type_id === 2">
      <ul class="list-group">
        <li v-for="profile_user in profile_users" class="list-group-item">
          <user-profile-overview-component :profile_user="profile_user"></user-profile-overview-component>
        </li>
      </ul>
    </div>

    <div>
      <button class="search-btn" @click="show">
        <i class="fas fa-circle-notch fa-2x"></i>
      </button>
      <search-component :user="user"></search-component>

    </div>
  </div>

</template>

<script>

import UserProfileOverviewComponent from './UserProfileOverviewComponent';
import CircleProfileOverviewComponent from './CircleProfileOverviewComponent';
import SearchComponent from "./SearchComponent";

export default {
  data() {
    return {
      profile_users: {},
      user: {},
      search_loading: false,
    }
  },
  created() {
    axios.get('/api/me')
      .then((res) => {
        this.user = res.data;
        axios.get('api/profiles')
          .then((res) => {
            this.profile_users = res.data;
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
    show() {
      this.$modal.show('search_modal');
    },
    hide() {
      this.$modal.hide('search_modal');
    }
  },
  components: {
    UserProfileOverviewComponent,
    CircleProfileOverviewComponent,
    SearchComponent
  }
}
</script>
