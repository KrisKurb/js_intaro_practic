<template>
  <div id="app">
    <b-navbar type="dark" class="head_nav_color">
      <b-navbar-nav class="d-flex align-items-center">
        <b-nav-item class="d-flex" :to="{name: 'home'}">
          <span class="nav_logo">WorkHunt</span>
        </b-nav-item>
        <b-nav-item :to="{name: 'add'}">
          <span class="nav_click">Добавить резюме</span>
        </b-nav-item>
      </b-navbar-nav>
    </b-navbar>

    <router-view></router-view>
  </div>
</template>
<script>
export default {
  name: 'App',
}
</script>

<style>
.head_nav_color {
  background: cadetblue;
  height: 65px;
}
.nav_logo {
  font-size: 45px;
  font-style: italic;
  color: beige;
}
.nav_click {
  font-size: 18px;
}
</style>
