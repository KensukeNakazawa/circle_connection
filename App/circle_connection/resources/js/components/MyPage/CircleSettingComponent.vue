<template>
  <div>

    <form @submit.prevent="submit">

      <div class="form-group">
        <label for="name">サークル名</label>
        <input type="text" class="form-control" id="name"
               v-model="user.name">
      </div>

      <input type="hidden" v-model="circle_setting.id">

      <div class="form-group">

        <label for="circle_category_id">サークルカテゴリー</label>
        <select id="circle_category_id" v-model="circle_setting.circle_category_id">
          <option v-for="circle_category in circle_setting.circle_categories" v-bind:value="circle_category.id">
            {{ circle_category.name}}
          </option>
        </select>
      </div>

      <div class="form-group">
        <label for="scale_id">サークルの規模</label>
        <select id="scale_id" v-model="circle_setting.scale_id">
          <option v-for="scale in circle_setting.scales" v-bind:value="scale.id">
            {{ scale.name }}
          </option>
        </select>

      </div>

      <div class="form-group">
        <label for="hometown">サークル紹介</label>
        <input type="text" class="form-control" id="hometown"
               v-model="circle_setting.introduce">
      </div>

      <div class="form-group">
        <label for="content">活動内容</label>
        <input type="text" class="form-control" id="content"
               v-model="circle_setting.content">
      </div>

      <div class="form-group">
        <label for="place">主な活動場所</label>
        <textarea type="text" class="form-control" id="place" v-model="circle_setting.place"></textarea>
      </div>

      <button type="submit" class="btn btn-primary">変更する</button>

    </form>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        user: {},
        circle_setting: {}
      }
    },
    created () {
      axios.get('/api/me')
        .then((res) => {
          this.user = res.data;
          axios.get(`/api/circle_setting/${this.user.id}/edit`)
            .then((res) => {
              this.circle_setting = res.data;
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
      /**
       * ユーザー設定変更を行う
       *
       */
      submit() {
        var circle_setting = this.circle_setting
        axios.post('/api/circle_setting', {
          name: this.user.name,
          id: circle_setting.id,
          circle_category_id: circle_setting.circle_category_id,
          scale_id: circle_setting.scale_id,
          introduce: circle_setting.introduce,
          content: circle_setting.content,
          place: circle_setting.place
        }).then((res) => {
            var message = '変更しました'
          })
          .catch(function (error) {
            var message = '変更に失敗しました'
          });
      }
    }


  }
</script>>
