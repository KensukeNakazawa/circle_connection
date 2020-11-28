<template>
  <div>

    <form @submit.prevent="submit">

      <div class="form-group">
        <label for="name">名前</label>
        <input type="text" class="form-control" id="name"
               v-model="user.name">
      </div>

      <input type="hidden" v-model="user_setting.id">

      <div class="form-group">
        <label for="grade">学年</label>
        <input type="text" class="form-control" id="grade"
               v-model="user_setting.grade">
      </div>

      <div class="form-group">
        <label for="faculty">学部</label>
        <input type="text" class="form-control" id="faculty"
               v-model="user_setting.faculty">
      </div>

      <div class="form-group">
        <label for="hometown">出身地</label>
        <input type="text" class="form-control" id="hometown"
               v-model="user_setting.hometown">
      </div>

      <div class="form-group">
        <label for="gender_id">性別</label>
        <select id="gender_id" v-model="user_setting.gender_id">
          <option v-for="gender in user_setting.genders" v-bind:value="gender.id">
            {{ gender.name }}
          </option>
        </select>
      </div>

      <div class="form-group">
        <label for="introduce">自己紹介</label>
        <textarea type="text" class="form-control" id="introduce" v-model="user_setting.introduce"></textarea>
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
        user_setting: {}
      }
    },
    created () {
      axios.get('/api/me')
        .then((res) => {
          this.user = res.data;
          axios.get(`/api/user_setting/${this.user.id}/edit`)
            .then((res) => {
              this.user_setting = res.data;
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
        var user_setting = this.user_setting
        axios.post('/api/user_setting', {
          name: this.user.name,
          id: user_setting.id,
          grade: user_setting.grade,
          faculty: user_setting.faculty,
          hometown: user_setting.hometown,
          gender_id: user_setting.gender_id,
          introduce: user_setting.introduce
        }).then((res) => {
          console.log(res.data);
            var message = '変更しました'
          })
          .catch(function (error) {
            var message = '変更に失敗しました'
          });
      }
    }


  }
</script>>
