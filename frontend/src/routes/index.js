import VueRouter from "vue-router";

var routes = [
  { path: "/", component: () => import("../views/Home.vue") },
  { path: "/article", component: () => import("../views/ListArticles.vue") },
  { path: "/article/:id", component: () => import("../views/Article.vue") },
  { path: "/new", component: () => import("../views/NewArticle.vue") },
  // { path: '/signup', component: Signup },
  { path: "/login", component: () => import("../views/Login.vue") },
  { path: "/register", component: () => import("../views/Register.vue") },
];

export default new VueRouter({
  mode: "history",
  routes,
});
