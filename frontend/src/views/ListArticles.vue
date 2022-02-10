<template>
  <div>
    <div class="card text-center mb-4 w-75" v-for="(article, key) in articles.slice().reverse()" :key="key">
      <div class="card-header">
        <strong>{{ article.title }}</strong>
      </div>
      <div class="card-body">
        <p class="card-text">{{ extract(article.content) }}</p>
        <router-link class="btn btn-primary" :to="`article/${article.id}`">Lire la suite</router-link>
      </div>
      <div class="card-footer text-muted">
        By Anonymous
      </div>
    </div>
  </div>
</template>

<script>
import {conf} from '../conf.js';
export default {
  data() {
    return {
      articles: []
    }
  },
  beforeMount() {
    fetch(conf.articlesUrl, {
      headers: {
        "Accept": "application/json",
        "Content-Type": "application/json",
        'Authorization': `Bearer ${JSON.parse(localStorage.getItem('user'))['stsTokenManager']['accessToken']}`
      },
      method: "GET",
    }) .then((resp) => {
      return resp.json();
    }) .then(data => {
      this.articles = data;
    })
    ;
  },
  methods: {
    extract : function(text) {
      return `${text.substring(0,400)} ...`;
    }
  }
};

</script>