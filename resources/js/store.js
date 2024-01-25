import { createStore } from 'vuex';
import axios from 'axios';

const store = createStore({
  state: {
    user: null,
    // other session-related data
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
    },
    // other mutations for managing session data
  },
  actions: {
    async login({ commit }, userData) {
      try {
        const response = await axios.post(window.url + 'api/loginAgent', userData);

        // Log the entire response
        console.log('API Response:', response);

        if (response.data.user) {
          // Log the user data before committing the mutation
          console.log('User data in response:', response.data.user);

          // Commit the setUser mutation after a successful login
          commit('setUser', response.data.user);

          // Redirect to the dashboard or perform other actions
          // router.push('/dashboard');
          window.location.href = '/dashboard';
        } else if (response.data.error) {
          console.log(response.data);
          // Handle error scenarios
        } else {
          console.log(response.data);
          // Handle other scenarios
        }
      } catch (error) {
        console.error('API Error:', error);
        // Handle errors
      }
    },
    // other actions for managing session data
  },
  getters: {
    getUser: (state) => state.user,
    // other getters for session data
  },
});

export default store;
