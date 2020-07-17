
// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import AppDates from './components/Dates.vue'
import AppCalculate from './components/Calculate.vue'
import AppTerritory from './components/Territory.vue'
import AppMedSpend from './components/MedSpend.vue'
import AppProgramm from './components/Programm.vue'
import AppFranshiza from './components/Franshiza.vue'
import AppVuelidate from './components/Vuelidate.vue'
//import AppAim from './components/Aim.vue'
import AppTourists from './components/Tourists.vue'
import AppAccident from './components/Accident.vue'

import datePicker from 'vue-bootstrap-datetimepicker';
//import 'bootstrap/dist/css/bootstrap.css';
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
Vue.use(datePicker);
Vue.use(require('vue-moment'));

import ToggleButton from 'vue-js-toggle-button'
Vue.use(ToggleButton)

import VTooltip from 'v-tooltip'
Vue.use(VTooltip)

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

var VueScrollTo = require('vue-scrollto'); 
Vue.use(VueScrollTo)

//Vue.config.productionTip = false
Vue.component('AppDates', AppDates)
Vue.component('AppCalculate', AppCalculate)
Vue.component('AppTerritory', AppTerritory)
Vue.component('AppMedSpend', AppMedSpend)
Vue.component('AppProgramm', AppProgramm)
Vue.component('AppFranshiza', AppFranshiza)
//Vue.component('AppAim', AppAim)
Vue.component('AppTourists', AppTourists)
Vue.component('AppAccident', AppAccident)
Vue.component('AppVuelidatecomponent', AppVuelidate)

import AsyncComputed from 'vue-async-computed'

Vue.use(AsyncComputed)

export const eventBus = new Vue()


/* eslint-disable no-new */
new Vue({
  el: '#app',
  components: { App },
  template: '<App  />'
})
