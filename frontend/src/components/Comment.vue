<template>
  <div>
    <div class="mt-5 mb-5">
      Post a comment

      <form class="mb-3" @submit.prevent="postComment">
        <div class="form-group">
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="values.content"/>
          <button type="submit" class="btn btn-primary mt-1">Post</button>
        </div>
      </form>

      <div class="card mt-1" v-for="(comment, key) in comments.slice().reverse()" :key="key">
        <div class="card-header">
          Anonymous
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <p>{{ comment.content }}</p>
          </blockquote>
          <footer class="blockquote-footer">{{ comment.created_at }}</footer>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import {conf} from "../conf";

  export default {
    name: "Comment",

    props: {
      articleId: String
    },
    data() {
      return {
        comments: [],
        values: {
          content: null,
          article_id: this.articleId
        }
      }
    },
    methods: {
      postComment : function() {
        fetch(`${conf.commentairesUrl}`, {
          headers: {
            "Accept": "application/json",
            "Content-Type": "application/json",
            'Authorization': `Bearer ${JSON.parse(localStorage.getItem('user'))['stsTokenManager']['accessToken']}`,
          },
          method: "POST",
          body: JSON.stringify(this.values)
        }).then((resp) => {
          return resp.json();
        }).then(data => {
          this.comments.push(data)
          this.values.content = null;
        });
      }
    },
    beforeMount () {
      fetch(`${conf.commentairesUrl}/article/${this.articleId}`, {
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
        this.comments = data;
      });
    }
  };
</script>