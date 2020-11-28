import router from '../../router';

const state = {
  token: ''
}

const mutations = {
  login(state, payload) {
    state.token = payload;
  },
  logout(state) {
    state.token = null;
  }
};

const getters = {
  isLogin(state) {
    return state.token ? true : false;
  }
};

const actions = {
  /**
   * ログインを行い、永続化する
   * @param commit
   * @param payload
   */
  login({ commit }, payload) {
    axios.post('api/login', {
      email: payload.email,
      password: payload.password
    }).then(res => {
      const token = res.data.access_token;
      axios.defaults.headers.common['Authorization'] = 'Bearer' + token;

      commit('login', token);
      router.push({name: 'events'});
      commit('alert/setAlert', {'message': 'ログインしました'}, {root: true});
    }).catch(error => {
      commit('alert/setAlert', {'message': 'ログインに失敗しました' + error, 'type': 'danger'}, {root: true});
    });
  },
  /**
   * ユーザー登録して、ログイン後、永続化する
   * @param commit
   * @param payload
   */
  register({ commit }, payload) {
    axios.post('/api/register', {
      name: payload.name,
      email: payload.email,
      password: payload.password,
      password_confirmation: payload.password_confirmation,
      user_type: payload.user_type
    }).then((res) => {
      const token = res.data.access_token;
      axios.defaults.headers.common['Authorization'] = 'Bearer' + token;
      commit('login', token);
      router.push({name: 'events'});
      commit('alert/setAlert', {'message': 'ユーザー登録しました'}, {root: true});
    }).catch(function (error) {
        console.log(error);
      });
  },
  /**
   * ログアウトする
   * @param commit
   */
  logout ({ commit }) {
    axios.post('api/logout').then(res => {
      axios.defaults.headers.common['Authorization'] = '';
      commit('logout');
      router.push({path: '/login'});
      commit('alert/setAlert', {'message': 'ログアウトしました'}, {root: true});
    }).catch(error => {
      commit('alert/setAlert', {'message': 'ログアウトに失敗しました'}, {root: true});
    });
  }
};

export default {
  namespaces: true,
  state,
  mutations,
  getters,
  actions
};