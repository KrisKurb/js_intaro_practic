<template>
<b-navbar type="dark" class="head_nav_color">
    <b-navbar-nav class="d-flex align-items-center">
      <b-nav-item class="d-flex ">
        <span class="nav_logo">WorkHunt</span>
      </b-nav-item>
      <b-nav-item>
        <span class="nav_click">Конвертер</span>
      </b-nav-item>
      <b-nav-item>
        <span class="nav_click">Резюме</span>
      </b-nav-item>
    </b-navbar-nav>
</b-navbar>
</template>

<script>
export default {
name: "Header"

}
</script>

<style scoped>
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