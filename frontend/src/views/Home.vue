<template>
  <div>
    <h1>Home sweet home</h1>
    <div v-if="user != null">
      <p>{{user.displayName}}</p>
      <p>{{user.email}}</p>
    </div>
  </div>
</template>

<script>

export default {
  inject: ['user']
};
</script>