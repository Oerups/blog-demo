<template>
  <div>
    <div v-if="state == 'success'" class="alert alert-success">
      <strong>Success!</strong> The article has been created.
    </div>

    <div v-else-if="state == 'error'" class="alert alert-warning">
      <strong>Failed!</strong> An error occured...
    </div>

    <form @submit.prevent="handleSubmit" class="w-50">
      <h1 class="text-center">New article</h1>
      <div class="form-group">
        <label for="exampleFormControlInput1">Title</label>
        <input type="input" class="form-control" id="exampleFormControlInput1" placeholder="Title" v-model="values.title">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Content</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" v-model="values.content"/>
      </div>
<!--      <div class="form-group">-->
<!--        <label for="exampleFormControlSelect1">Category</label>-->
<!--        <select class="form-control" id="exampleFormControlSelect1" v-model="values.category">-->
<!--          <option>Sport</option>-->
<!--          <option>Nature</option>-->
<!--          <option>Musique</option>-->
<!--          <option></option>-->
<!--        </select>-->
<!--      </div>-->
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
import { conf } from '../conf.js';

  export default {
    data: () => ({
      values: {
        title: "",
        content: "",
        categories: ["Musique"]
      },
      state: ""
    }),
    methods: {
      handleSubmit: function () {

        fetch(conf.articlesUrl, {
          headers: {
            "Accept": "application/json",
            "Content-Type": "application/json",
            'Authorization': `Bearer ${JSON.parse(localStorage.getItem('user'))['stsTokenManager']['accessToken']}`
          },
          method: "POST",
          body: JSON.stringify(this.values)
        }).then((resp) => {
          if (resp.status == 200) {
            this.state = "success";
            return resp.json();
          } else {
            this.state = "error";
          }
        }).then((data) => {
          this.$router.push(`article/${data.id}`);
        });
      },
    }
  };
</script>
    


