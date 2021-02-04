<template>
  <b-alert show class="ml-5">
    <div class="d-flex justify-content-end">
      <a href="" class="text-decoration-none" @click.prevent="handleClick" @click="clickRemoveEducation(index)">X</a>
    </div>
    <b-form-group id="input-group-level" :label="education.level.res_name+':'" label-for="input-level">
      <b-form-select
          id="input-level"
          v-model="education.level.res_ind"
          :options="degrees"
          required
      ></b-form-select>
    </b-form-group>
    <template v-if="education.level.res_ind !== degrees[0] && education.level.res_ind !== ''">
      <b-form-group id="input-group-university" :label="education.university.res_name+':'" label-for="input-university">
        <b-form-input
            id="input-education"
            v-model="educ"
            type="text"
            placeholder="Липецк государственный технический университет"
            required
        ></b-form-input>
        <b-list-group v-if="educs">
          <b-list-group-item v-for="(ed,index) in educs" :key="index" button @click="clickEduc(index)">
            {{ ed.title }}
          </b-list-group-item>
        </b-list-group>
      </b-form-group>
      <b-form-group id="input-group-faculty" :label="education.faculty.res_name+':'" label-for="input-faculty">
        <b-form-input
            id="input-faculty"
            v-model="education.faculty.res_ind"
            placeholder="Автоматизациии и информатики"
            required
        ></b-form-input>
      </b-form-group>
      <b-form-group id="input-group-specialization" :label="education.specialization.res_name+':'" label-for="input-specialization">
        <b-form-input
            id="input-specialization"
            v-model="education.specialization.res_ind"
            placeholder="Математическое обеспечение и администрирование информационных систем"
            required
        ></b-form-input>
      </b-form-group>
      <b-form-group
          id="input-group-yearEnd"
          :label="education.ed_year.res_name+':'"
          label-for="input-yearEnd"
          description="Если учитесь в настоящее время — укажите год предполагаемого окончания"
      >
        <b-form-input
            id="input-yearEnd"
            v-model="education.ed_year.res_ind"
            placeholder="2021"
            required
        ></b-form-input>
      </b-form-group>
    </template>
    <a v-if="education_length === index+1"
       href="" class="text-decoration-none"
       @click.prevent="handleClick"
       @click="clickAddEducation">Добавить ещё одно место обучения</a>
  </b-alert>
</template>

<script>
import jsonp from "jsonp";

export default {
  name: "Education",
  props: ['education', 'index', 'education_length', 'degrees', 'city'],
  data(){
    return {
      educ:'',
      educs: [],
    }
  },
  watch: {
    // эта функция запускается при любом изменении вопроса
    educ:  function () {
      this.educs = 'Ожидаю';
      this.debouncedGetAnswer();
    }
  },
  created: function () {
    this.debouncedGetAnswer = this.lodash.debounce(this.getEduc, 500);
    if(this.education.university.res_ind !== '')
      this.educ = this.education.university.res_ind;
  },
  methods: {
    getEduc: function () {
      this.educs  = 'Думаю';
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
      this.education.university.res_ind = this.educ;
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