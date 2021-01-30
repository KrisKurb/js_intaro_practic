<template>
  <b-container>
    <div class="d-flex justify-content-around">
      <h3 class="converter_text">Резюме</h3>
    </div>
    <div class="d-flex">
      <b-col cols="6">
        <b-form @submit="on_submit" v-if="show">
          <div v-if="errors.length">
            <b>У вас есть ошибки, исправьте и попробуйте снова:</b>
            <ul>
              <li v-for="(er, index) in errors" :key="index">{{ er }}</li>
            </ul>
          </div>
          <!--Профессия-->
          <b-form-group id="input-group-profession" :label="res.profession.res_name+':'" label-for="input-profession">
            <b-form-input class="col-3" id="input-profession" v-model="res.profession.res_ind" type="text" placeholder="Программист" required></b-form-input>
          </b-form-group>
          <!--Город-->
          <b-form-group id="input-group-city" :label="res.city.res_name+':'" label-for="input-city">
            <b-form-input class="col-5" id="input-city" v-model="city" type="text" placeholder="Липецк" required></b-form-input>
            <b-list-group v-if="cities.length">
              <b-list-group-item v-for="(city,index) in cities" :key="index" button @click="clickCity(index)">
                {{ city.title }}
              </b-list-group-item>
            </b-list-group>
          </b-form-group>
          <!--Фото-->
          <b-form-group id="input-group-photo" :label="res.photo.res_name+':'" label-for="input-photo">
            <b-form-input class="col-10" id="input-photo" v-model="res.photo.res_ind" type="text" placeholder="https://i.pinimg.com/originals/8a/eb/d8/8aebd875fbddd22bf3971c3a7159bdc7.png" required></b-form-input>
          </b-form-group>
          <!--ФИО-->
          <b-form-group id="input-group-name" :label="res.name.res_name+':'" label-for="input-name">
            <b-form-input class="col-7" id="input-name" v-model="res.name.res_ind" placeholder="Романов Роман Романович" required></b-form-input>
          </b-form-group>
          <!--Телефон-->
          <b-form-group id="input-group-number" :label="res.number.res_name+':'" label-for="input-number">
            <b-form-input class="col-3" id="input-number" v-model="res.number.res_ind" type="tel" placeholder="89456587515"></b-form-input>
          </b-form-group>
          <!--Почта-->
          <b-form-group id="input-group-email" :label="res.email.res_name+':'" label-for="input-email">
            <b-form-input class="col-4" id="input-email" v-model="res.email.res_ind" type="email" placeholder="exemp@mail.ru" required></b-form-input>
          </b-form-group>
          <!--Дата рождения-->
          <b-form-group id="input-group-birthday" :label="res.birthday.res_name+':'" label-for="input-birthday">
            <b-form-datepicker id="input-group-birthday" v-model="res.birthday.res_ind" placeholder="Выбрать" class="col-7"></b-form-datepicker>
          </b-form-group>
          <!--Образование-->
          <Education
              v-for="(education,index) in res.education"
             :education="education"
             :education_length="res.education.length"
             :levels="levels"
             :index="index"
             :city="res.city.res_ind"
             @add-education="addEducation"
             @remove-education="removeEducation"
             :key="index">
          </Education>
          <!--Желаемая зарплата-->
          <b-form-group id="input-group-salary" :label="res.salary.res_name+':'" label-for="input-salary">
            <b-form-input class="col-4" id="input-salary" v-model="res.salary.res_ind" placeholder="80000"></b-form-input>
          </b-form-group>
          <!--Навыки-->
          <b-form-group id="input-group-skills" :label="res.skills.res_name+':'" label-for="input-salary">
            <b-form-textarea id="input-skills" v-model="res.skills.res_ind" placeholder="Vue, html, css" rows="3" max-rows="5"></b-form-textarea>
          </b-form-group>
          <!--О себе-->
          <b-form-group id="input-group-about_me" :label="res.about_me.res_name+':'" label-for="input-about_me">
            <b-form-textarea id="input-about_me" v-model="res.about_me.res_ind" placeholder="Информация о себе" max-rows="6"></b-form-textarea>
          </b-form-group>
          <!--Статус-->
            <b-form-group id="input-group-status" :label="res.status.res_name+':'" label-for="input-status">
              <b-form-select id="input-status" v-model="res.status.res_ind" :options="status" required></b-form-select>
            </b-form-group>
          <div class="d-flex justify-content-around">
            <b-button type="submit" variant="primary">Заполнить</b-button>
          </div>
        </b-form>
      </b-col>
      <b-col cols="6">
        <div class="">
          <div class="d-flex justify-content-center">
            <img v-if="withdraw" :src="res.photo.res_ind" alt="" class="photo_">
          </div>
          <p class="mb-2" v-for="(r,index) in res" :key="index">
            <template v-if="r.res_name !== res.photo.res_name">
              <template v-if="r !== res['education']">
                {{r.res_name}}:
              </template>
              <template v-if="withdraw & r !== res['education']">
                {{r.res_ind}}
              </template>
            </template>
          </p>
          <div v-for="(education,index) in res.education" :key="index">
            <template v-if="education.level.res_ind === levels[0]">
              <p>{{education.level.res_name}}: {{education.level.res_ind}}</p>
            </template>
            <template v-else-if="education.level.res_ind === null">
              <p>{{education.level.res_name}}:Отсутствует</p>
            </template>
            <template v-else>
              <p v-for="(ed,ind) in education" :key="ind">
                {{ed.res_name}}:
                <template v-if="withdraw">
                  {{ed.res_ind}}
                </template>
              </p>
            </template>
          </div>
        </div>
      </b-col>
    </div>
  </b-container>
</template>

<script>
import jsonp from 'jsonp';
import Education from "@/components/Education";
export default {
  name: "Resume",
  components:{
    Education
  },
  data() {
    return {
      cities: [],
      city: '',
      res: {
        profession: {
          res_name: 'Профессия',
          res_ind: ''
        },
        city: {
          res_name: 'Город',
          res_ind: ''
        },
        photo: {
          res_name: 'Ссылка на фото',
          res_ind: 'https://i.pinimg.com/originals/8a/eb/d8/8aebd875fbddd22bf3971c3a7159bdc7.png'
        },
        name: {
          res_name: 'ФИО',
          res_ind: ''
        },
        number: {
          res_name: 'Телефон',
          res_ind: ''
        },
        email: {
          res_name: 'Email',
          res_ind: ''
        },
        birthday: {
          res_name: 'Дата рождения',
          res_ind: ''
        },
        education: [
          {
            level: {
              res_name: 'Уровень образования',
              res_ind: null
            },
            educations: {
              res_name: 'Учебное заведение',
              res_ind: ''
            },
            faculty: {
              res_name: 'Факультет',
              res_ind: ''
            },
            specialization: {
              res_name: 'Специализация',
              res_ind: ''
            },
            year_of_ending: {
              res_name: 'Год окончания',
              res_ind: ''
            },
          }
        ],

        salary: {
          res_name: 'Желаемая зарплата',
          res_ind: ''
        },
        skills: {
          res_name: 'Навыки',
          res_ind: ''
        },
        about_me: {
          res_name: 'О себе',
          res_ind: ''
        },
        status: {
          res_name:'Статус',
          res_ind:'Новый'},
      },
      levels: ['Среднее', 'Среднее специальное', 'Неоконченное высшее', 'Высшее',],
      status: ['Новый', 'Назначено собеседование', 'Принят', 'Отказ'],
      show: true,
      errors: [],
      withdraw: false,
    }
  },
  watch: {
    city:  function () {
      this.cities = 'Жду, пока вы напишете хоть что-то';
      this.debouncedGetAnswer();
    }
  },
  created: function () {
    this.debouncedGetAnswer = this.lodash.debounce(this.getCity, 500);
  },
  methods: {
    getCity: function () {
      console.log(process.env.VUE_APP_TOKEN_VK)
      this.cities  = 'Выполняю поиск';
      jsonp('https://api.vk.com/method/database.getCities?country_id=1&need_all=1&count=10&v=5.126&access_token=' + process.env.VUE_APP_TOKEN_VK+ '&lang=ru&q=' + this.city +'', null, (err, data) => {
        if (err) {
          this.cities = err.message;
        } else {
          this.cities = data.response.items;
        }
      });
    },
    clickCity(index){
      this.city = this.cities[index].title;
      this.res.city.res_ind = this.city;
      this.cities = [];
    },
    addEducation() {
      this.res.education.push(
          {
            level: {
              res_name: 'Уровень образования',
              res_ind: null
            },
            educations: {
              res_name: 'Учебное заведение',
              res_ind: ''
            },
            faculty: {
              res_name: 'Факультет',
              res_ind: ''
            },
            specialization: {
              res_name: 'Специализация',
              res_ind: ''
            },
            year_of_ending: {
              res_name: 'Год окончания',
              res_ind: ''
            },
          }
      );
    },
    removeEducation(index) {
      this.res.education.splice(index,1);
    },
    on_submit(e){
      this.errors =[];
      let phone_control = new RegExp('\\d{'+this.res.number.res_ind.length +'}', 'gim');

      if(this.res.number.res_ind.length < 6 || this.res.number.res_ind.length >10 || !phone_control.test(this.res.number.res_ind)) {
        this.errors.push('Номер телефона не корректный');
      }

      if(!this.errors.length)
        this.withdraw = true;
      else
        this.withdraw = false;
      e.preventDefault();
    }
  },
}
</script>
<style scoped>
.photo_{
  max-width: 450px;
  max-height: 450px;
}
</style>