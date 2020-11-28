<template>
  <div>
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
