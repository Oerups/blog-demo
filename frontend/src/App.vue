<template>
  <div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto d-flex justify-content-between w-100">
          <div class="d-flex">
            <li><router-link class="nav-link" to="/">Home</router-link></li>
            <li v-if="this.user"><router-link class="nav-link" to="/new">New</router-link></li>
            <li v-if="this.user"><router-link class="nav-link" to="/article">Articles</router-link></li>
          </div>
          <div class="d-flex">
            <li v-if="!this.user"><router-link class="nav-link" to="/register">Sign Up</router-link></li>
            <li v-if="!this.user"><router-link class="nav-link" to="/login">Login</router-link></li>
            <li v-if="this.user"><button type="submit" class="nav-link" @click="logOut()">Logout</button></li>
          </div>
        </ul>
      </div>
    </nav>
    
    <router-view class="d-flex justify-content-center align-items-center flex-column w-100 mt-5"></router-view>
  </div>
</template>

<script>
import { getAuth, signOut } from "firebase/auth";
import { conf } from "./conf.js";

export default {
  methods: {
    logOut() {
      const auth = getAuth();
        signOut(auth).then(() => {
          localStorage.removeItem('user');
          this.user = null;
          this.$router.push('/login');
        });
      }
    },
  name: "App",
  provide() {
    const provider = {
      setAuth: (user) => {
        this.user = user
        localStorage.setItem('user', JSON.stringify(user))
        window.location.href="/";
      },
      apiUrls: this.apiUrls
    }
    Object.defineProperty(provider, 'user', {
      enumerable: true,
      get: () => this.user,
    })
    return provider
  },
  data() {
    return {
      user: null,
      apiUrls: {
        articlesUrl: conf.articlesUrl,
        commentairesUrl: conf.commentairesUrl,
      }
    };
  },
  // created() {
  //   const auth = getAuth();
  //   auth.onAuthStateChanged((user) => {
  //     if (user) {
  //       user.getIdToken().then(function(idToken) {
  //         localStorage.setItem('id-token', idToken);
  //       });
  //     } else {
  //       this.user = null;
  //       localStorage.removeItem('id-token');
  //       if (this.$route.path !== '/home') this.$router.push('/home');
  //     }
  //   });
  // },
  beforeMount() {
    this.user = JSON.parse(localStorage.getItem('user'))
  },
};
</script>

<style>
</style>
