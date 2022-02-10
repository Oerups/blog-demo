<template>
  <div>
    <form @submit.prevent="userRegister" class="w-50">
      <h3>Sign Up</h3>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="user.email">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" v-model="user.password">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword2" class="form-label">Repeat password</label>
        <input type="password" class="form-control" id="exampleInputPassword2" v-model="user.repeatPassword">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
import { getAuth, createUserWithEmailAndPassword } from "firebase/auth";

export default {
  inject: ['setAuth'],
  name: "Register",
  data: () => ({
    user: { email: '', password: '', repeatPassword: '' }
  }),
  methods: {
    userRegister() {

      const auth = getAuth();
      createUserWithEmailAndPassword(auth, this.user.email, this.user.password)
          .then(() => {
            this.$router.push('/login');
          })
          .catch((error) => {
            console.log(error);
          });
    }
  },
};
</script>
