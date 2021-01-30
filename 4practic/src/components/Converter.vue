<template>
<b-container>
  <div class="d-flex justify-content-around">
        <h3 class="converter_text">Конвертер</h3>
  </div>
  <div class="d-flex">
    <b-col cols="6">
      <b-form-group  label = "Выберите нужную конвертацию:"  v-slot = "{ariaDescribedby}" >
        <b-form-radio v-for="(item, index) in conv" :aria-descriptionby  = "ariaDescribedby" :key="index" name = "some-radios" v-model="elem" :value  = "index" > {{item.name_conv}} </b-form-radio>
      </b-form-group >
    </b-col>
    <b-col class="d-flex align-items-center">
      <input type="text" class="form-control col-2" required v-model="transfer">
      <label  class="col-5 text-center">=  {{conv[elem].output_value}}</label>
    </b-col>
  </div>
  </b-container>
</template>

<script>
export default {
name: "Converter",
  data(){
    return{
      elem: 0,
      conv:[
        {
          name_conv: 'футы в метры',
          input_value: 0,
          output_value: 0
        },
        {
          name_conv: 'морские милли в километры',
          input_value: 0,
          output_value: 0
        },
        {
          name_conv: 'градусы в радианы',
          input_value: 0,
          output_value: 0
        },
        {
          name_conv: 'температура по Цельсию в температуру по Фаренгейту',
          input_value: 0,
          output_value: 0
        },
      ]
    }
  },
  methods:{
  },
  computed:{
    transfer: {
      get: function () {
        return this.conv[this.elem].input_value;
      },
      set: function (inp){
        this.conv[this.elem].input_value = inp;
        switch (this.elem) {
          case 0:
            this.conv[this.elem].output_value = inp * 0.3048;
            break;
          case 1:
            this.conv[this.elem].output_value = inp * 1.85;
            break;
          case 2:
            this.conv[this.elem].output_value = inp * 0.017;
            break;
          case 3:
            this.conv[this.elem].output_value = inp * 274.15;
            break;
        }
      }
    }
  }
}
</script>

<style>
.converter_text{
  color: darkslategray;
}
</style>