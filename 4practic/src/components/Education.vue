<template>
  <b-alert show variant="warning">
    <div v-if="index !== 0" class="d-flex justify-content-end">
      <a href="" class="text-decoration-none" @click.prevent="handleClick" @click="clickRemoveEducation">X</a>
    </div>
    <b-form-group id="input-group-level" :label="education.level.res_name+':'" label-for="input-level">
      <b-form-select id="input-level" v-model="education.level.res_ind" :options="levels" required></b-form-select>
    </b-form-group>
    <template v-if="education.level.res_ind !== levels[0] && education.level.res_ind !== null">
      <b-form-group id="input-group-educations" :label="education.educations.res_name+':'" label-for="input-educations">
        <b-form-input id="input-education" v-model="educ" type="text" placeholder="Липецк государственный технический университет" required></b-form-input>
        <b-list-group v-if="educs">
          <b-list-group-item v-for="(ed,index) in educs" :key="index" button @click="clickEduc(index)">{{ ed.title }}</b-list-group-item>
        </b-list-group>
      </b-form-group>
      <b-form-group id="input-group-faculty" :label="education.faculty.res_name+':'" label-for="input-faculty">
        <b-form-input id="input-faculty" v-model="education.faculty.res_ind" placeholder="Автоматизациии и информатики" required></b-form-input>
      </b-form-group>
      <b-form-group id="input-group-specialization" :label="education.specialization.res_name+':'" label-for="input-specialization">
        <b-form-input id="input-specialization" v-model="education.specialization.res_ind" placeholder="Математическое обеспечение и администрирование информационных систем" required></b-form-input>
      </b-form-group>
      <b-form-group id="input-group-year_of_ending" :label="education.year_of_ending.res_name+':'" label-for="input-year_of_ending">
        <b-form-input id="input-year_of_ending" v-model="education.year_of_ending.res_ind" placeholder="2020" required></b-form-input>
      </b-form-group>
    </template>
    <a v-if="education_length === index+1" href="" class="text-decoration-none link-education_color" @click.prevent="handleClick" @click="clickAddEducation">Добавить ещё одно место обучения</a>
  </b-alert>
</template>

<script>
import jsonp from "jsonp";
export default {
name: "Education",
  props: ['education', 'index', 'education_length', 'levels', 'city'],
  data(){
    return {
      educ:'',
      educs: [],
    }
  },
  watch: {
    educ:  function () {
      this.educs = 'Ожидаю';
      this.debouncedGetAnswer();
    }
  },
  created: function () {
    this.debouncedGetAnswer = this.lodash.debounce(this.getEduc, 500);
  },
  methods: {
    getEduc: function () {
      this.educs  = 'Ожидайте';
      jsonp('https://api.vk.com/method/database.getCities?country_id=1&need_all=1&count=10&v=5.126&access_token=' + process.env.VUE_APP_TOKEN_VK + '&lang=ru&q=' + this.city + '', null, (err, data) => {
        if (err) {
          console.error(err.message);
        } else {
          let currentCityId = data.response.items[0].id;
          jsonp('https://api.vk.com/method/database.getUniversities?city_id=' + currentCityId + '&country_id=1&count=10&v=5.126&access_token=' + process.env.VUE_APP_TOKEN_VK + '&q=' + this.educ + '', null, (err, data) => {
            if (err) {
              console.error(err.message);
            } else {
              this.educs = data.response.items;
            }
          });
        }
      });
    },
    clickEduc(index){
      this.educ = this.educs[index].title;
      this.education.educations.res_ind = this.educ;
      this.educs = [];
    },
    handleClick(e){
      e.preventDefault();
    },
    clickAddEducation(){
      this.$emit('add-education');
    },
    clickRemoveEducation(index) {
      this.$emit('remove-education', index);
    }
  }
}
</script>
<style scoped>
</style>