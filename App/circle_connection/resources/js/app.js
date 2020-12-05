/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/** third party */
require('./bootstrap');
import axios from 'axios';
import VueCropper from 'vue-cropperjs';
import 'cropperjs/dist/cropper.css';
/** @see https://www.kabanoki.net/3144/ */
import VModal from 'vue-js-modal';


/** my components */
import store from './store/index';
import router from './router';

// layout 関連のcomponent

import HeaderComponent from './components/Layouts/HeaderComponent';
import BottomComponent from './components/Layouts/BottomComponent';
import LoadingComponent from './components/Layouts/LoadingComponent';

/** constants */
import constants from './constants/constants';


window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

/** global components */
/** third party */
Vue.use(VModal);
Vue.component('vue-cropper', VueCropper);
/** my component */
Vue.component('header-component', HeaderComponent);
Vue.component('bottom-component', BottomComponent);
Vue.component('loading-component', LoadingComponent);



/**
 * ログインを永続化したものがあるかどうかを確認する
 * ページリロードしても、ログイン状態が保持されているようにする
 * vuex persisted state
 * router とかより先に書かないとリロードした時にログイン出来てないような挙動になってしまうため、
 * 位置は気をつける
 * @see https://www.webopixel.net/javascript/1463.html
 */
if (sessionStorage.getItem('connection')) {
  const storageData = JSON.parse(sessionStorage.getItem('connection'));
  if (storageData.auth.token) {
    axios.defaults.headers.common['Authorization'] = 'Bearer' + storageData.auth.token;
  }
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',
  store,
  router,
  constants
});
