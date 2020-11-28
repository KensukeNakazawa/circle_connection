/**
 * フロントエンドのルーティングを記述
 */

import Vue from 'vue';
import VueRouter from 'vue-router';

// vuex
import store from './store/index';

// component のインポート
// ホーム
import HomeComponent from './components/Home/HomeComponent';

// 認証系
import LoginComponent from './components/Auth/LoginComponent';
import RegisterComponent from './components/Auth/RegisterComponent';

// イベント系
import EventIndexComponent from './components/Event/IndexComponent';
import EventCreateComponent from './components/Event/EventCreateComponent';
import EventShowComponent from "./components/Event/EventShowComponent";

/** プロフィール系 */
import ProfileIndexComponent from './components/Profile/IndexComponent';
import ProfileShowComponent from "./components/Profile/ProfileShowComponent";

// マイページ系
import UserComponent from './components/MyPage/UserComponent';
import UserSettingComponent from './components/MyPage/UserSettingComponent';
// import SetProfilePictureComponent from "./components/MyPage/SetProfilePictureComponent";
import ProfilePictureComponent from "./components/MyPage/ProfilePictureComponent";
import SetSnsComponent from "./components/MyPage/SetSnsComponent";
import CircleSettingComponent from './components/MyPage/CircleSettingComponent';


Vue.use(VueRouter);

// フロントエンドルーティング
const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/login',
      name: 'auth.login',
      component: LoginComponent
    },
    {
      path: '/register',
      name: 'auth.register',
      component: RegisterComponent
    },
    /** ホーム関連 */
    {
      path: '/',
      component: HomeComponent,
      name: 'home',
      meta: { requiresAuth: true }
    },
    /** イベント関連 */
    {
      /** イベント一覧ページ */
      path: '/events',
      name: 'events',
      component: EventIndexComponent,
      meta: { requiresAuth: true }
    },
    {
      path: '/events/:event_id',
      name: 'events.show',
      component: EventShowComponent,
      props: true,
      meta: { requiresAuth: true }
    },
    { /** イベント作成 */
      path: '/events/create',
      name: 'events.create',
      component: EventCreateComponent,
      meta: { requiresAuth: true }
    },
    /** プロフィール系 */
    {
      path: '/profiles',
      name: 'profiles',
      component: ProfileIndexComponent,
      meta: { requiresAuth: true }
    },
    {
      path: 'profiles/:profile_user_id',
      name: 'profiles.show',
      component: ProfileShowComponent,
      props: true,
      meta: { requiresAuth: true}
    },
    /** マイページ関連 */
    {
      path: '/user',
      name: 'user',
      component: UserComponent,
      meta: { requiresAuth: true }
    },
    {
      path: '/user/profile_picture',
      name: 'profile_picture',
      component: ProfilePictureComponent,
      meta: { requiresAuth: true }
    },
    {
      path: '/user/setting',
      name: 'user.setting',
      component: UserSettingComponent,
      meta: { requiresAuth: true }
    },
    {
      path: '/circle/setting',
      name: 'circle.setting',
      component: CircleSettingComponent,
      meta: { requiresAuth: true }
    },
    {
      path: '/user/sns_setting',
      name: 'set_sns_setting',
      component: SetSnsComponent,
      meta: { requiresAuth: true }
    },
  ]
});


/**
 * 認証済みのユーザーかをチェックし、済みでなければ、ログインページに飛ばす
 */
router.beforeEach((to, from, next) => {
  store.commit('alert/setAlert', {'message': ''});
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // ログインしていなかったらログインページにリダイレクト
    var sessionStorageData = JSON.parse(sessionStorage.getItem('connection'));
    if (!sessionStorageData.auth.token) {
      next({
        path: '/login',
        query: { redirect: to.fullPath}
      })
    } else {
      next();
    }
  } else {
    next();
  }
});


export default router;