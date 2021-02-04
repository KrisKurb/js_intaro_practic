<template>
  <div class="res">
    <div class="d-flex justify-content-center">
      <b-col class="form_col form-input">
        <div>
            <template v-if="withdraw">
              <b-alert show>
                <p v-for="(text,ind) in alert_text" :key="ind">{{text}}</p>
              </b-alert>
            </template>
            <b-form @submit="onSubmit" v-if="show">
              <b-form-group
                  id="input-group-prof"
                  :label="res.profession.res_name+':'"
                  label-for="input-prof"
              >
                <b-form-input
                    id="input-prof"
                    v-model="res.profession.res_ind"
                    type="text"
                    placeholder="Программист"
                    required
                ></b-form-input>
              </b-form-group>
              <!--Город-->
              <b-form-group
                  id="input-group-city"
                  :label="res.city.res_name+':'"
                  label-for="input-city"
              >
                <b-form-input
                    id="input-city"
                    v-model="city"
                    type="text"
                    placeholder="Липецк"
                    required
                ></b-form-input>
                <b-list-group v-if="cities">
                  <b-list-group-item v-for="(city,index) in cities" :key="index" button @click="clickCity(index)">
                    {{ city.title }}
                  </b-list-group-item>
                </b-list-group>
              </b-form-group>
              <!--Фото-->
              <b-form-group
                  id="input-group-photo"
                  :label="res.photo.res_name+':'"
                  label-for="input-photo"
              >
                <b-form-input
                    id="input-photo"
                    v-model="res.photo.res_ind"
                    type="text"
                    required
                ></b-form-input>
              </b-form-group>
              <!--Телефон-->
              <b-form-group
                  id="input-group-c_c_number"
                  :label="res.c_c_number.res_name+':'"
                  label-for="input-c_c_number"
              >
                <b-form-input
                    id="input-c_c_number"
                    v-model="res.c_c_number.res_ind"
                    type="c_c_number"
                    placeholder="8457589658"
                    required
                ></b-form-input>
              </b-form-group>
              <!--ФИО-->
              <b-form-group id="input-group-fullName" :label="res.c_name.res_name+':'" label-for="input-fullName">
                <b-form-input
                    id="input-fullName"
                    v-model="res.c_name.res_ind"
                    placeholder="Романов Роман Романович"
                    required
                ></b-form-input>
              </b-form-group>
              <!--Почта-->
              <b-form-group
                  id="input-group-email"
                  :label="res.email.res_name+':'"
                  label-for="input-email"
              >
                <b-form-input
                    id="input-email"
                    v-model="res.email.res_ind"
                    type="email"
                    placeholder="Email"
                    required
                ></b-form-input>
              </b-form-group>
              <!--Дата рождения-->
              <b-form-group id="input-group-date_c_dr" :label="res.c_dr.res_name+':'" label-for="input-date_c_dr">
                <b-form-datepicker id="input-group-date_c_dr" v-model="res.c_dr.res_ind" placeholder="Не выбрана" class="mb-2"></b-form-datepicker>
              </b-form-group>
              <!--Образование-->
              <template v-if="this.res.education.length">
                <Education
                    v-for="(education,index) in res.education"
                    :education="education"
                    :education_length="res.education.length"
                    :degrees="degrees"
                    :index="index"
                    :city="res.city.res_ind"
                    @add-education="addEducation"
                    @remove-education="removeEducation"
                    :key="index">
                </Education>
              </template>
              <template v-else>
                <b-button variant="outline-primary" @click="addEducation">Добавить образование</b-button>
              </template>
              <!--Зарплата-->
              <b-form-group
                  id="input-group-salary"
                  :label="res.salary.res_name+':'"
                  label-for="input-salary"
              >
                <b-form-input
                    id="input-salary"
                    v-model="res.salary.res_ind"
                    placeholder="80000"
                    required
                ></b-form-input>
              </b-form-group>
              <!--Навыки-->
              <b-form-group
                  id="input-group-skills"
                  :label="res.skills.res_name+':'"
                  label-for="input-salary"
              >
                <b-form-textarea
                    id="input-skills"
                    v-model="res.skills.res_ind"
                    placeholder="Vue, js, html"
                    rows="3"
                    max-rows="6"
                ></b-form-textarea>
              </b-form-group>
              <!--О себе-->
              <b-form-group
                  id="input-group-meMe"
                  :label="res.me.res_name+':'"
                  label-for="input-meMe"
              >
                <b-form-textarea
                    id="input-meMe"
                    v-model="res.me.res_ind"
                    placeholder="Занимаюсь разными вещами"
                    rows="3"
                    max-rows="6"
                ></b-form-textarea>
              </b-form-group>
              <!--Селект статуса-->
              <b-form-group id="input-group-status" :label="res.status.res_name+':'" label-for="input-status">
                <b-form-select
                    id="input-status"
                    v-model="res.status.res_ind"
                    :options="status"
                    required
                ></b-form-select>
              </b-form-group>
              <!--Error оповещение-->
              <b-alert v-if="errors.length" show variant="danger">
                <b>Пожалуйста исправьте указанные ошибки:</b>
                <ul>
                  <li v-for="(error, ind) in errors" :key="ind">{{ error }}</li>
                </ul>
              </b-alert>

              <div class="d-flex justify-content-around">
                <b-button type="submit" variant="primary">Готово</b-button>
              </div>
            </b-form>
        </div>
      </b-col>

      <!--      Блок с выводом резюме -->
      <b-col cols="6" class="res_col res-output">
        <!--   Блок с выводом резюме     -->
        <h2 v-if="$route.name === 'edit'" class="text-center">Резюме</h2>
        <h2 v-else-if="$route.name === 'add'"  class="text-center">Шаблон резюме</h2>
        <Resume :withdraw="withdraw" :res="res" :degrees="degrees"></Resume>

      </b-col>
    </div>
  </div>
</template>

<script>
import Education from "@/components/Education";
import Resume from '@/components/Resume';
import jsonp from 'jsonp';
export default {
  name: "Add",
  components:{
    Education,
    Resume
  },
  data() {
    return {
      redacted: false,
      alert_text: [],
      cities: [],
      city: '',
      errors: [],
      res: {
        c_name: {res_name:'ФИО', res_ind: ''},
        photo: {res_name:'Ссылка на фото', res_ind: ''},
        profession: {res_name:'Профессия', res_ind: ''},
        city: {res_name:'Город', res_ind: ''},
        c_c_number: {res_name:'Номер телефона', res_ind: ''},
        email: {res_name:'Почта', res_ind: ''},
        c_dr: {res_name:'Дата рождения', res_ind: ''},
        education: [],
        salary: {res_name:'Ожидаемая заработная плата', res_ind: ''},
        skills: {res_name:'Навыки', res_ind: ''},
        me: {res_name:'О себе', res_ind: ''},
        status: {res_name:'Статус', res_ind:'Новый'},
      },
      degrees: ['Среднее', 'Среднее специальное', 'Неоконченное высшее', 'Высшее'],
      status: ['Новый', 'Назначено собеседование', 'Принят', 'Отказ'],
      show: true,
      withdraw: false
    }
  },
  mounted() {
    if(this.$route.name === 'edit'){
      // запрос к апи на вывод данных по кандидату
      this.axios.get('http://api/'+ this.$route.params.id +'/get-candidate').then(response => {
        this.res.c_name.res_ind = response.data[0].c_name;
        this.res.photo.res_ind = response.data[0].photo;
        this.res.profession.res_ind = response.data[0].profession;
        this.res.city.res_ind = response.data[0].city;
        this.city = response.data[0].city;
        this.res.c_c_number.res_ind = response.data[0].c_c_number;
        this.res.email.res_ind = response.data[0].email;
        this.res.c_dr.res_ind = response.data[0].c_dr;
        this.res.salary.res_ind = response.data[0].salary;
        this.res.skills.res_ind = response.data[0].skills;
        this.res.me.res_ind = response.data[0].me;
        this.res.status.res_ind = response.data[0].status;
      }).catch(err => {
        // console.log(err);
        this.alert_text.push(err);
        this.withdraw = true;
      });
      // запрос к апи на вывод информации об образовании по заданному кандидату
      this.axios.get('http://api/'+ this.$route.params.id +'/get-education').then(response => {
        for(let i = 0; i < response.data.length; i++){
          this.addEducationAxios(response.data[i]);
        }
        // console.log(response.data);
      }).catch(err => {
        console.log(err);
        this.alert_text.push(err);
        this.withdraw = true;
      });
    }
  },
  watch: {
    city:  function () {
      this.cities = 'Ожидаю, когда вы закончите печатать...';
      this.debouncedGetAnswer();
    }
  },
  created: function () {
    this.debouncedGetAnswer = this.lodash.debounce(this.getCity, 500);
  },
  methods: {
    getCity: function () {
      this.cities  = 'Думаю...';
      jsonp('https://api.vk.com/method/database.getCities?country_id=1&need_all=1&count=10&v=5.126&access_token=' +
          process.env.VUE_APP_TOKEN_VK + '&lang=ru&q=' + this.city +'', null, (err, data) => {
        if (err) {
          this.cities = err.message;
        } else {
          this.cities = data.response.items;
        }
      });
    },
    clickCity(index) {
      this.city = this.cities[index].title;
      this.res.city.res_ind = this.city;
      this.cities = [];
    },
    addEducation() {
      this.res.education.push(
          {
            id: {res_name: 'id', res_ind: ''},
            level: {res_name: 'Уровень образования', res_ind: 'Среднее'},
            university: {res_name: 'Учебное заведение', res_ind: ''},
            faculty: {res_name: 'Факультет', res_ind: ''},
            specialization: {res_name: 'Специализация', res_ind: ''},
            ed_year: {res_name: 'Год окончания', res_ind: ''},
          }
      );
      if(this.$route.name === 'edit'){
        this.axios({
          method: 'POST',
          url: 'http://api/' + this.$route.params.id + '/add-education',
          data: {
            education: this.res.education[this.res.education.length-1]
          },
          headers: {
            "Content-type": "application/json; charset=UTF-8"
          }
        }).then(response => {
          console.log('response='+response.data);
          this.res.education[this.res.education.length-1].id.res_ind = response.data.ed_id;
          console.log('id='+this.res.education[this.res.education.length-1].id.res_ind);
        }).catch(error => {
          console.log('error='+error);
          this.error.push(error);
          this.withdraw = false;
        });
      }
    },
    addEducationAxios(dat) {
      this.res.education.push(
          {
            id: {res_name: 'id', res_ind: dat.ed_id},
            level: {res_name: 'Уровень образования', res_ind: dat.level},
            university: {res_name: 'Учебное заведение', res_ind: dat.university},
            faculty: {res_name: 'Факультет', res_ind: dat.faculty},
            specialization: {res_name: 'Специализация', res_ind: dat.specialization},
            ed_year: {res_name: 'Год окончания', res_ind: dat.ed_year},
          }
      );
    },
    removeEducation(index) {
      // если мы редактируем кандидата, то удаляем из базы сразу образование при клике удаления оразования
      if(this.$route.name === 'edit') {
        this.axios.get('http://api/' + this.res.education[index].id.res_ind +'/delete-education').then(
            response => {
              console.log(response.data)
            }).catch(err => {
          console.log(err);
        });
      }
      this.res.education.splice(index,1);
    },
    onSubmit(event) {
      event.preventDefault();
      this.errors = [];
      let phone_control = new RegExp('\\d{'+this.res.c_number.res_ind.length +'}', 'gim');

      if(this.res.c_number.res_ind.length < 6 || this.res.c_number.res_ind.length >10 || !phone_control.test(this.res.c_number.res_ind)) {
        this.errors.push('Номер телефона не корректный');
      }

      if (this.res.city.res_ind === '')
        this.res.city.res_ind = this.city;

      if (this.errors.length) {
        this.withdraw = false;
      } else {
        let countAverangelevel = 0;
        for (let i = 0; i < this.res.education.length; i++) {
          if (this.res.education[i].level.res_ind === 'Среднее') {
            countAverangelevel++;
          }
          if (countAverangelevel > 1) {
            this.removeEducation(i);
          }
        }
        if (this.$route.name === 'add') {
          this.axios({
            method: 'POST',
            url: 'http://api/add',
            data: {
              candidate: this.res
            },
            headers: {
              "Content-type": "application/json; charset=UTF-8"
            }
          }).then(response => {
            this.alert_text.push(response.data);
            this.withdraw = true;
          }).catch(error => {
            this.errors.push(error);
            this.withdraw = false;
          });
        }
      }
      if (this.$route.name === 'edit') {
        this.axios({
          method: 'POST',
          url: 'http://api/' + this.$route.params.id + '/edit',
          data: {
            candidate: this.res
          },
          headers: {
            "Content-type": "application/json; charset=UTF-8"
          }
        }).then(response => {
          this.alert_text.push(response.data);
          this.withdraw = true;
        }).catch(error => {
          this.errors.push(error);
          this.withdraw = false;
        });
      }
      if(!this.errors.length)
        this.resActive();
    },
    resActive() {
      this.redacted = !this.redacted;
    }
  }
}
</script>

<style scoped>
.res_col {
  padding: 20px 80px 20px 80px;
}
</style>