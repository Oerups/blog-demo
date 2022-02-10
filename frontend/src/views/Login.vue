<template>
  <div>
    <form @submit.prevent="userLogin" class="w-50">
      <h3>Sign In</h3>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="login" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="user.email">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" v-model="user.password">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
import { getAuth, signInWithEmailAndPassword } from "firebase/auth";
export default {
  inject: ['setAuth'],
  name: "Form",
  data: () => ({
    user: { email: '', password: '' }
  }),
  methods: {
    userLogin() {
      const auth = getAuth();
          signInWithEmailAndPassword(auth, this.user.email, this.user.password)
          .then((userCredential) => {
            this.setAuth(userCredential.user);
          })
          .catch((error) => {
            alert(error.message);
          });
    }
  },
};
</script>
