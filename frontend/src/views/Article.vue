<template>
  <div>
    <div v-if="article" className="container" class="w-50">
      <div className="card text-center">
      <div className="card-header">
          <h1 class="mb-5">{{article.title}}</h1>
      </div>
      <div className="card-body">
          <p className="card-text">{{article.content}}</p>
      </div>
      <div className="card-footer text-muted" class="text-secondary">
          {{article.author ? "By" + article.author : ""}}
      </div>
      </div>

      <Comment v-if="isMounted" :articleId="article.id"/>
    </div>

    <div v-else><h1>404</h1></div>
  </div>
</template>

<script>
import Comment from "../components/Comment.vue"
import { conf } from '../conf.js';

export default {
  components: {
    Comment
  },
  data() {
    return {
      article: {},
      isMounted: false
    }
  },
  beforeMount() {
    fetch(`${conf.articlesUrl}/${this.$route.params.id}`, {
      headers: {
        "Accept": "application/json",
        "Content-Type": "application/json",
        'Authorization': `Bearer ${JSON.parse(localStorage.getItem('user'))['stsTokenManager']['accessToken']}`
      },
      method: "GET",
      // body: JSON.stringify(this.values)
    }).then((resp) => {
      return resp.json();
    }).then(data => {
      this.isMounted = true;
      this.article = data;
    });
  }
};
</script>
    


