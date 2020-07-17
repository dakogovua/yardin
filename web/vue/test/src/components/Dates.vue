<template>
    <div class="row">

        <div class="col-md-2">
            <div class="form-group">
                <span class="form-label">Подорож</span>
<div class="maintravel" id="manytimes">
                <toggle-button @change="onShow"
                               id="changed-font2"
                               :speed = "1000"
                               :value="true"
                               :height="44"
                               :width = "150"
                               :color ="{checked: '#2196f3', unchecked: '#e54bd9', disabled: '#CCCCCC'}"
                               :labels="{checked: 'Багаторазова',
                                unchecked: 'Одноразова'}"

                />
                <div class="white" >
                <i class="far fa-question-circle"
                   v-tooltip.right-end="{
                  content: msg,
                    trigger: 'click hover',
                  classes: ['info'],
                  targetClasses: ['it-has-a-tooltip'],
                  offset: 2,
                  delay: {
                    show: 400,
                    hide: 300,
                  },
                }"></i>
                </div>
            </div>

            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group" >
                <span class="form-label" v-if="show">Період/днів, багаторазова</span>
                <span class="form-label" v-if="!show">одноразова подорож</span>
                <select class="form-control" v-model = "multikoef" @change="onMultiSelect" :disabled="!show">
                    <option v-for='period in multivisaperiods' :value="period" >
                        {{ period.data }}
                    </option>
                </select>
                <span class="select-arrow"></span>
                
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <span class="form-label">Початкова дата</span>
                <date-picker  :id="'dateStartID'" v-model="dateStart" :config="optionsStart"
                             @dp-change="onChangeStart"></date-picker>
            </div>
        </div>
        <div class="col-md-3">
            <transition name="fade">
            <div class="form-group" >
                <span class="form-label">Кінцева дата</span>

                    <date-picker :id="'dateStopID'" v-model="dateStop" :config="optionsStop"
                             @dp-change="onChangeStop"
                                ></date-picker>

            </div>
            </transition>
        </div>


    </div>
</template>

<script>
    import {eventBus} from '../main'
    import $ from 'jquery'

    var moment = require('moment');
   // moment().format();


    export default {

    data () {

            return {
                msg: 'Як плануєте подорожувати? Однорозова чи багаторазова',
                
                show: false, //от этой штуки зависит выводить опции мультивизы или нет
                dateStart: moment().startOf('day').add(2, 'days').format('DD.MM.YYYY'),
                //dateStart: this.convtodatepicker(this.createDate(3,0,0)),
                dateStop: moment().startOf('day').add(5, 'days').format('DD.MM.YYYY'),

                optionsStart: {
                    format: 'DD.MM.YYYY',
                    useCurrent: false,
                    locale: 'uk',
                    minDate: moment().startOf('day').add(1, 'days'),
                    maxDate: moment().startOf('day').add(2, 'years')

                },
                optionsStop: {
                    format: 'DD.MM.YYYY',
                    useCurrent: false,
                    locale: 'uk',

                    minDate: moment().startOf('day').add(1, 'days'),
                    maxDate: moment().startOf('day').add(365, 'days'),
                },

                k1: '', // k1 коэфф поездки
                multikoef: '',
                diff: this.diffdays, // разность дней
                multivisaperiods:[],
                // m -вспомогательная хрень для установки конечной даты договора в мультивиз
                m: '',
                // Это для расчета коэффициента исходя из суммы
                medsumval: ''
            }
        },
        
        created () {
            eventBus.$on('medspend', data =>{
            //this.currency = data.currency,
            //this.medsumkoef = data.sumkoef,
            this.medsumval = data.sumval
            
            this.multivisaperiods = []
            
            if (this.medsumval == '30000'){
                    this.multivisaperiods.push(
                        {data: "15/90", koef :0.0167, kod: 5 },
                        {data: "30/90",  koef:0.0367, kod: 11 },
                        {data: "30/365",  koef:0.0367, kod: 11 },
                        {data: "60/180", koef:0.0517 , kod: 15.5},
                        {data: "90/180", koef:0.0800 , kod: 24 },
                        {data: "60/365", koef:0.0667 , kod: 20},
                        {data: "90/365", koef:0.0900 , kod: 27},
                        {data: "180/365", koef:0.1333 , kod: 40},
                       // {data: "365/182", koef:0.8 , kod: "365_182"},
                        )
                        if (this.show){
                            this.multikoef = { //устанавливаем по умолчанию коэф и дату
                                "data": "30/90", "koef": 0.0367, "kod" : 11
                            }
                        }
                }
                if (this.medsumval == '50000'){
                    this.multivisaperiods.push(
                        {data: "15/90", koef :0.0160, kod: 8 },
                        {data: "30/90",  koef:0.0260, kod: 13 },
                        {data: "30/365",  koef:0.0260, kod: 13 },
                        {data: "60/180", koef:0.0410 , kod: 20.5},
                        {data: "90/180", koef:0.0600 , kod: 30 },
                        {data: "60/365", koef:0.0480 , kod: 24},
                        {data: "90/365", koef:0.0670 , kod: 33.5},
                        {data: "180/365", koef:0.1000 , kod: 50},
                       // {data: "365/182", koef:0.8 , kod: "365_182"},
                    )
                    if (this.show){
                            this.multikoef = { //устанавливаем по умолчанию коэф и дату
                                "data": "30/90",  "koef":0.0260, "kod": 13
                            }
                        }
                }
        //    console.log (data);
            });
            

        },
        mounted() {
            this.onShow();
        //   this.sendDates();
        },
        watch:{

            multikoef() {
                //handler: function () {
                    console.log('multikoef watch ')
                    this.sendDates();
                //},
                // deep: false
            },
            medsumval(){
                    console.log('watch medsumval');
                    this.diffdays;
                }
            
        },
        methods:{
            daysend(){
            //возрвращает количество дней из выбранного в мультивизе значения
                let daysend = this.multikoef.data
                // daysend.substr(daysend.indexOf("/")+1, daysend.length
                //console.log ('daysend ', daysend, ' ', daysend.length, ' ', daysend.substr(daysend.indexOf("/")+1, daysend.length))
                if (daysend.indexOf("/") != -1)
                {
                    daysend = daysend.substr(0 ,daysend.indexOf("/") )

                }

                //daysend -= 1 // -1 чтобы не включало последний ден
                daysend --
                return daysend
            },
            setmaxstop(){
                //функция устанавливает стопдейт
                let s = this.momentfromstart().startOf('day').add(365, 'days')
                this.optionsStop.maxDate = s
            },
            onMultiSelect(){
                //сработка при выборе при выборе периода мультивизы
                this.setmaxstop()
                let m = this.momentfromstart() //это дата выбранного старта
                //устанавливаем дату макса + 365 дней


                m = m.startOf('day').add(this.daysend(), 'days')
                this.m = m.format('DD.MM.YYYY')
                console.log ('this.m  ', this.m )
                // console.log ('m ' + m.format('DD.MM.YYYY') + ' s ' + s.format('DD.MM.YYYY')+ ' ' + this.optionsStop.maxDate.format('DD.MM.YYYY'))

//                setTimeout(this.dateStopRavnom, 200);
                setTimeout(()=>{this.dateStop = this.m},200)

            },
            dateStopRavnom(){
            //    функция заглушка, устанавливает после сеттаймаута, победил стрелочной функцией
             //   this.dateStop = this.m

            },
            onShow(){
                this.multikoef = { //устанавливаем по умолчанию коэф и дату
                    "data": "30/90", "koef": 0.0367, "kod" : 11
                }
                // отработка чекбокса мультвизы
                this.show = !this.show;
                this.setmaxstop()
                //устанавливаем данные дейтстопа после клика на чекбокс
                let m = this.momentfromstart() //это дата выбранного старта
                m = m.startOf('day').add(this.daysend(), 'days')
                // console.log('m --->>>>' + m.format('DD.MM.YYYY') + ' ' + this.daysend())
                let letstopdate = m.format('DD.MM.YYYY')
                //console.log('letstopdate  ', letstopdate )
                this.dateStop = letstopdate// если не сработает, придется через сеттаймаут

                if (this.show)
                {
                    $('#dateStopID').data("DateTimePicker").disable();
                }
                else {

                    $('#dateStopID').data("DateTimePicker").enable();
                    this.optionsStop.minDate = this.dateStart;
                    this.dateStop = this.dateStart

                    this.multikoef =''
                }
            },

            onChangeStart(){
                //функция на изменения дата начала
                let m = this.momentfromstart()
                m = m.startOf('day').add(364, 'days');
               // console.log ('onChangeStart m ' + m.format('DD.MM.YYYY'))
                this.optionsStop.maxDate = m

               if (this.diffdays <= 0 || this.diffdays > 365) {
                   setTimeout(this.stopravnostart, 100)
               }
                this.optionsStop.minDate = this.dateStart;

                if (this.show){
                    console.log('this.show ' + this.show)
                    this.onMultiSelect()
                }
                else {
                    setTimeout(function(){
                        $('#dateStopID').data("DateTimePicker").show();
                    }, 100)

                }
                this.sendDates();

            },
            stopravnostart(){
               // console.log('stopravnostart this.dateStart' + this.dateStart)

                this.dateStop = this.dateStart
              //  console.log('stopravnostart this.dateStart' + this.dateStop)
                this.sendDates();
            },
            onChangeStop(){
                if (this.diffdays <= 0 || this.diffdays > 365) {
                    setTimeout(this.stopravnostart, 100)
                }
                this.sendDates();
            },
            convtodatepicker(date){
                //функция преобразует в дейтпикеровский формат данные преред отправкой в евентбас
                //необходима для первоначальной отправки когда отправляется дата
                let dd = date.getDate();
                dd = (dd<10)? '0' + dd : dd;

                let mm = date.getMonth() + 1;
                mm = (mm<10)? '0' + mm : mm;

                return dd +'.' + mm + '.' + date.getFullYear();
            },
            sendDates(){
                //функция отправляет данные в евентБас чтобы их извлек калькулятор
                // console.log('sendDates ')
                eventBus.$emit('datez', {
                    dateStart: this.dateStart,
                    dateStop: this.dateStop,
                    days: this.diffdays,
                    k1period: this.k1,
                    multi: this.multi,
                    kod: this.multikoef.kod,
                    today: moment().startOf('day').format('DD.MM.YYYY'),
                    data: this.multikoef.data
                });
            },
            convertfromdatepicker(datetomysqlformat){
                //функция делаем mysql формат гггг-мм-дд из формата дд.мм.гггг
                var dd = datetomysqlformat.substr(0,2);
                var mm = datetomysqlformat.substr(3,2);
                var yy = datetomysqlformat.substr(6,4);

                var  yyyymmdd = yy.concat('-',mm,'-',dd);
                //      console.log ("yyyymmddyyyymmddyyyymmdd "+ yyyymmdd);
                return yyyymmdd;
            },

            momentfromstart(){
            //функция генерит новую дату на основе выбранной даты дейтСтарт
            //    console.log ('moment datestart ' + moment(new Date(this.convertfromdatepicker(this.dateStart))).format('DD.MM.YYYY'))
                return moment(new Date(this.convertfromdatepicker(this.dateStart)))
            },


        },
        computed:{
            multi(){
              // функция возращает 1 или 0 если стоит show true
                return (this.show) ? 1 : 0
            },
            diffdays(){

                if (this.show){
                    this.k1 = this.multikoef.koef
                    let daysend = this.multikoef.data
                    return daysend.substr(daysend.indexOf("/")+1, daysend.length); // это выдирает из 90/30 лишь 30
                }

                let date1 = this.convertfromdatepicker(this.dateStart);
                let date2 = this.convertfromdatepicker(this.dateStop);

                // console.log('date1 '+ date1+ 'date2' + date2)
                function daysdiff(date1,date2){

                    var diff = new Date(date2) - new Date(date1);
                    //  console.log ("diffdiff" + diff);

                    var diffdays = diff/1000/60/60/24;
                    // console.log ("diffdaysdays " + diffdays);

                    diffdays++; //это чтобы включительно с последним днем.

                    return diffdays;
                }

                let diff = daysdiff(date1 ,date2);
                
                console.log('dates this.medsumval', this.medsumval, ' typeof ', typeof(this.medsumval));
                
                switch(this.medsumval) {
                  case '10000':
                        if (diff <=7) this.k1 = 0.33;
                        else if (diff <=15) this.k1 = 0.3;
                        else if (diff <=30) this.k1 = 0.27;
                        else if (diff <=90) this.k1 = 0.24;
                        else if (diff <=180) this.k1 = 0.21;
                        else  this.k1 = 0.19;
                        //else if (diff <=365) this.k1 = 0.9;
                        // else this.k1 = 10;
                        
                        console.log ('10000', this.k1);
                    break;
                  case '20000':
                        if (diff <=7) this.k1 = 0.35;
                        else if (diff <=15) this.k1 = 0.33;
                        else if (diff <=30) this.k1 = 0.28;
                        else if (diff <=90) this.k1 = 0.25;
                        else if (diff <=180) this.k1 = 0.23;
                        else  this.k1 = 0.2;
                        console.log ('20000', this.k1);
                    break;
                    case '30000':
                        if (diff <=7) this.k1 = 0.47;
                        else if (diff <=15) this.k1 = 0.43;
                        else if (diff <=30) this.k1 = 0.39;
                        else if (diff <=90) this.k1 = 0.33;
                        else if (diff <=180) this.k1 = 0.3;
                        else  this.k1 = 0.25;
                    break;
                    
                    case '50000':
                        if (diff <=7) this.k1 = 0.6;
                        else if (diff <=15) this.k1 = 0.54;
                        else if (diff <=30) this.k1 = 0.47;
                        else if (diff <=90) this.k1 = 0.4;
                        else if (diff <=180) this.k1 = 0.38;
                        else  this.k1 = 0.33;
                    break;
                    
                  default:
                    this.k1 = 10;
                }
                
                
                
                // console.log('k1perod method ' + diff + ' '  + this.k1);

                    return diff;


            }
        },
        components: {

        }
    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
        opacity: 0;
    }

   /* .vue-js-switch#changed-font2 {
        font-size: 14px;
        margin-right: 2px;
    } */
    .maintravel {
        display:flex;
        align-items:center;
        justify-content: space-between;
        width: 170px;
    }






</style>


// WEBPACK FOOTER //
// src/components/Dates.vue