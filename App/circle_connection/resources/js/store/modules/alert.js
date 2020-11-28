// メッセージ用

const state = {
  message: '',
  type: 'success'
};

const mutations = {
   setAlert (state, {message, type}) {
    state.message = message
    state.type = type || 'success'
    const timeout = 3000;
    setTimeout(() => (state.message = ''), timeout);
  }
};

export default {
  namespaced: true,
  state,
  mutations
};