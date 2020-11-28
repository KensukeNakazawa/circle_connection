<template>

  <div class="">
    <modal name="search_modal" :adaptive=true  width="90%">
      <div @click="close" class="text-right"><i class="fas fa-times fa-2x"></i></div>
      <form @submit.prevent="search">
        <div class="form-group row　text-center">
          <div v-if="user.user_type_id === 1">
            <div class="col-md-6">
              <label for="name" class="col-md-4 col-form-label">
                  サークル名
              </label>
              <input type="text" class="form-control" v-model="name">
            </div>

            <div class="col-md-6">
              <label for="circle_category_id">サークルカテゴリー</label>
              <select id="circle_category_id" v-model="circle_category_id">
                <option v-for="circle_category in circle_categories" v-bind:value="circle_category.id">
                  {{ circle_category.name}}
                </option>
              </select>
            </div>

            <div class="col-md-6">
              <label for="scale_id">サークルの規模</label>
              <select id="scale_id" v-model="scale_id">
                <option v-for="scale in scales" v-bind:value="scale.id">
                  {{ scale.name }}
                </option>
              </select>
            </div>

          </div>

          <div v-else-if="user.user_type_id === 2">
            <label for="name" class="col-md-4 col-form-label text-md-right">
                ユーザー名
            </label>
            <div class="col-md-6">
              <input id="name" type="text" class="form-control " v-model="name">
            </div>
          </div>

        </div>

        <div class="form-group text-center">
          <button type="submit" class="btn btn-primary w-50">
            検索する
          </button>
        </div>

      </form>
    </modal>
  </div>

</template>

<script>

export default {
  props: ['user'],
  data() {
    return {
      name: '',
      circle_category_id: '',
      scale_id: '',
      circle_categories: {},
      scales: {}
    }
  },
  created() {
    axios.get('/api/search/get_search_items')
      .then((res) => {
        this.circle_categories = res.data.circle_categories;
        this.scales = res.data.scales;
      });
  },
  methods: {
    close() {
      this.$modal.hide('search_modal');
      this.$parent.hide();
    },
    search() {
      this.$parent.profile_users = null;
      this.$parent.search_loading = true;
      this.$parent.hide();
      axios.get('/api/search/profiles', {
        params: {
          user_type_id: this.user.user_type_id,
          name: this.name,
          circle_category_id: this.circle_category_id,
          scale_id: this.scale_id
        }
      }).then((res) => {
        this.$parent.profile_users = res.data;
        this.$parent.search_loading = false;
      }).catch((error) => {
        this.$parent.search_loading = false;
      }).then(function () {
        // always executed
      });
    }
  }
}
</script>

<style scoped>

</style>
