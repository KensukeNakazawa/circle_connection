<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md">
        <div class="card">
          <div class="card-header">ログイン</div>
          <div class="card-body">
            <!-- <p v-show="isError">認証に失敗しました。</p> -->
            <form @submit.prevent="login">

              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>

                <div class="col-md-6">
                  <input id="email" type="email" class="form-control "
                         required autocomplete="email" autofocus
                         v-model="email">
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control"
                           required autocomplete="current-password"
                           v-model="password">
                </div>
              </div>


              <div class="form-group">
                <button type="submit" class="btn btn-primary w-100">
                    ログイン
                </button>
              </div>

            </form>

            <div class="text-center mt-3 mb-3">または</div>

            <router-link v-bind:to="{name: 'auth.register'}">
              <div class="text-center">
                <button class="btn btn-primary w-100">新規登録</button>
              </div>
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapActions } from 'vuex';

  export default {
    data () {
      return {
        email: '',
        password: '',
      }
    },
    methods: {
      login() {
        this.$store.dispatch('login', {
          email: this.email,
          password: this.password
        });
      }
    }
  }
</script>
