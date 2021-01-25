<template>
  <b-container>
    <div class="d-flex justify-content-around">
      <h3 class="converter_text">Резюме</h3>
    </div>
    <div class="d-flex">
      <b-col cols="6">
        <b-form>
          <!--Профессия-->
          <b-form-group id="input-group-profession" :label="res.profession.res_name+':'" label-for="input-profession">
            <b-form-input class="col-3" id="input-profession" v-model="res.profession.res_ind" type="text" placeholder="Программист" required></b-form-input>
          </b-form-group>
          <!--Город-->
          <b-form-group id="input-group-city" :label="res.city.res_name+':'" label-for="input-city">
            <b-form-input class="col-5" id="input-city" v-model="res.city.res_ind" type="text" placeholder="Липецк" required></b-form-input>
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
          <!--Уровень образования-->
          <b-form-group id="input-group-level" :label="res.level.res_name+':'" label-for="input-level">
            <b-form-select class="col-8" id="input-level" v-model="res.level.res_ind" :options="levels" placeholder="Выбрать" required></b-form-select>
          </b-form-group>
          <!--Учебное заведение-->
          <b-form-group id="input-group-education" :label="res.education.res_name+':'" label-for="input-education">
            <b-form-input class="col-11" id="input-education" v-model="res.education.res_ind" placeholder="Липецкий государственный технический университет" required></b-form-input>
          </b-form-group>
          <!--Факультет-->
          <b-form-group id="input-group-faculty" :label="res.faculty.res_name+':'" label-for="input-faculty">
            <b-form-input class="col-10" id="input-faculty" v-model="res.faculty.res_ind" placeholder="Факультет автоматизациии и информатики" required></b-form-input>
          </b-form-group>
          <!--Специализация-->
          <b-form-group id="input-group-specialization" :label="res.specialization.res_name+':'" label-for="input-specialization">
            <b-form-input class="col-10" id="input-specialization" v-model="res.specialization.res_name" placeholder="Математическое обеспечение и администрирование информационных систем" required
            ></b-form-input>
          </b-form-group>
          <!--Год окончания-->
          <b-form-group id="input-group-year_of_ending" :label="res.year_of_ending.res_name+':'" label-for="input-year_of_ending">
            <b-form-input class="col-4" id="input-year_of_ending" v-model="res.year_of_ending.res_ind" placeholder="2020" required></b-form-input>
          </b-form-group>
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
        </b-form>
      </b-col>
      <b-col cols="6">
        <div>
          <div class="d-flex mb-3 justify-content-center"><img :src="res.photo.res_ind" alt="" class="photo_"></div>
          <p class="mb-2" v-for="(r,index) in res" :key="index">
            <template v-if="r.res_name !== 'Ссылка на фото'">{{r.res_name}}: {{r.res_ind}}</template>
          </p>
        </div>
      </b-col>
    </div>
  </b-container>
</template>

<script>
export default {
  name: "Resume",
  data() {
    return {
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
        level: {
          res_name: 'Уровень образования',
          res_ind: ''
        },
        education: {
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
      },
      levels: ['Среднее', 'Среднее специальное', 'Неоконченное высшее', 'Высшее',],
    }
  }
}
</script>
<style scoped>
.photo_{
  max-width: 450px;
  max-height: 450px;
}
</style>