// // @see https://www.webopixel.net/javascript/1447.html
import Vue from 'vue';
import Vuex from 'vuex';

// stateの永続化
import createPersistedState from 'vuex-persistedstate';

import auth from './modules/auth';
import alert from './modules/alert';
import loading from './modules/loading';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    auth, alert, loading
  },
  /**
   * @see https://www.webopixel.net/javascript/1463.html
   */
  strict: true,
  plugins: [createPersistedState({
    /**　sessionStorageのキー */
    key: 'connection',
    /** 保存するstate */
    paths: ['auth.token'],
    /** ストレージの種類 */
    storage: window.sessionStorage
  })]
});
