<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">新規登録</div>

          <div class="card-body">
            <form @submit.prevent="submit">

              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">名前またはサークル名</label>

                <div class="col-md-6">
                  <input id="name" type="text" class="form-control"
                          required autocomplete="name" autofocus
                          v-model="name">
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>

                <div class="col-md-6">
                  <input id="email" type="email" class="form-control"
                          required autocomplete="email"
                          v-model="email">
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>

                <div class="col-md-6">
                  <input id="password" type="password" class="form-control"
                          required autocomplete="new-password"
                          v-model="password">
                </div>
              </div>

              <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">確認用パスワード</label>

                <div class="col-md-6 w-100">
                  <input id="password-confirm" type="password" class="form-control"
                         required autocomplete="new-password" @change="password_check"
                         v-model="password_confirmation">
                </div>
                {{ password_check_message }}
              </div>

              <div class="form-group">
                <legend class="text-md col-form-label">ユーザータイプ</legend>

                <div class="btn-group btn-group-toggle w-100">

                  <label class="btn btn-primary " :class="{ active: user_type === '1' }">
                    <input type="radio" id="user" value="1" v-model="user_type" checked >
                    ユーザー
                  </label>

                  <label class="btn btn-primary" for="circle" :class="{ active: user_type === '2' }" >
                    <input type="radio" id="circle" value="2" v-model="user_type">
                    サークル
                  </label>

                </div>
              </div>

              <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary w-100">
                    新規登録する
                </button>
              </div>

              <div class="text-center mt-3 mb-3">または</div>

              <router-link v-bind:to="{name: 'auth.login'}">
                <div class="text-center">
                  <button class="btn btn-primary w-100">ログイン</button>
                </div>
              </router-link>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data: function () {
      return {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        user_type: '1',
        password_check_message: ''
      };
    },
    methods: {
      submit() {
        this.$store.dispatch('register', {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
          user_type: this.user_type
        });
      },
      password_check() {
        console.log(this.password === this.password_confirmation);
        if (this.password !== this.password_confirmation) {
          this.password_check_message = '入力したパスワードが誤っています';
        } else {
          this.password_check_message = '';
        }

      }
    }
  }
</script>
