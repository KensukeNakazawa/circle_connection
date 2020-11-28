<template>
  <div>

    <form @submit.prevent="submit">

      <div class="form-group">
        <label for="twitter">Twitter</label>
        <input type="text" class="form-control" id="twitter"
               v-model="user.twitter_id">
      </div>

      <div class="form-group">
        <label for="instagram">Instagram</label>
        <input type="text" class="form-control" id="instagram"
               v-model="user.instagram_id">
      </div>

      <button type="submit" class="btn btn-primary">変更する</button>

    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isError: false,
      user: {}
    }
  },
  created() {
    axios.get('/api/me')
      .then((res) => {
        this.user = res.data;
      })
      .catch((error) => {
        this.isError = true;
      });
  },
  methods: {
    submit() {
      axios.post('/api/user/update_sns_setting/' + this.user.id, {
        twitter_id: this.user.twitter_id,
        instagram_id: this.user.instagram_id
      }).then((res) => {
        console.log(res);
      }).catch((error) => {
        console.log(error);
      })
    }
  }
}
</script>
