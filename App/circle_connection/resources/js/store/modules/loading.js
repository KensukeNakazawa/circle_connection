// ローディング用

const state = {
  loading: false
}

const mutations = {
  setLoading(state, payload) {
    state.loading = payload
  }
}

export default {
  namespaced: true,
  state,
  mutations
}