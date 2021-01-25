<template>
  <div id="app">
    <Header></Header>
    <Converter></Converter>
    <Resume></Resume>
  </div>
</template>
<script>
import Header from "@/components/Header";
import Converter from "@/components/Converter";
import Resume from "@/components/Resume";
export default {
  name: 'App',
  components:{
    Resume,
    Header,
    Converter
  }
}
</script>

<style>

</style>
