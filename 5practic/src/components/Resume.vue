<template>
  <div class="">
    <div class="d-flex justify-content-center">
      <img :src="res.photo.res_ind" alt="" class="img_size">
    </div>
    <p class="mb-2" v-for="(r,index) in res" :key="index">
      <template v-if="r.res_name !== res.photo.res_name">
        <template v-if="r !== res['education']">
          {{r.res_name}}:
        </template>
        <template v-if="r !== res['education']">
          {{r.res_ind}}
        </template>
      </template>
    </p>
    <b-alert show v-for="(education,index) in res.education" :key="index">
      <template v-if="education.level.res_ind === degrees[0]">
        <p>{{education.level.res_name}}: {{education.level.res_ind}}</p>
      </template>
      <template v-else-if="education.level.res_ind === ''">
        <p>{{education.level.res_name}}:Отсутствует</p>
      </template>
      <template v-else>
        <p v-for="(ed,ind) in education" :key="ind">
          <template v-if="ed.res_name !== 'id'">
            {{ed.res_name}}:
            <template>
              {{ed.res_ind}}
            </template>
          </template>
        </p>
      </template>
    </b-alert>
  </div>
</template>

<script>
export default {
  name: "Resume",
  props: ['withdraw', 'res', 'degrees']
}
</script>

<style scoped>
.img_size {
  max-width: 450px;
  max-height: 450px;
}
</style>