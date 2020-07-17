<template>
<div class="form-group center">
<h3 class="white"> Подорожуючі </h3>
    <hr>
    

    
    <div v-for="(tourist, i) in tourists">

<div class="row">
        <div class="col-md-5">
            <div class="kossflex">
                <div class="form-group ">
                    <span class="form-label">№</span>
                    <div class="form-control disabled">
                    <div class="pclass" >{{ i+1 }}</div>
                    </div>
                </div>
       <!-- </div>

        <div class="col-md-2"> -->
                <div class="form-group">
                    <span class="form-label">Спорт</span>
                    <select id="idaim1" class="form-control" v-model="tourist.aim" @change="" >
                        <option v-for='aim in aims' :value="aim">
                            {{ aim.val }} {{ aim.name }}
                        </option>
                    </select>
                    <span class="select-arrow kkarrow"></span>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <span class="form-label">Дата народження</span>
                <date-picker :id="'tourist' +i" v-model="tourist.birthday" :config="optionsBirthday"
                             @dp-change="onSendTourists">

                </date-picker>
            </div>
         </div>




         <div class="col-md-3">
            <div class="form-btn">
                <button :class="onClass(i)"
                        :id="'iiiddd-' +i "
                        v-on:click.stop.prevent="addTourist(i)"
                        v-scroll-to="'#elementzz'"
                        >{{ onToggle(i) }}</button>
            </div>
        </div>

 <!--       <div class="col-md-4">
        <div class="kossflex">
            <div class="form-group">
                <span class="form-label"></span>
                <label class="container-kk">
                    <input type="checkbox"  @change="addProfsport(i)"
                    :disabled = "tourist.progname != 'B'"
                    :checked = "tourist.profsport"
                    >
                    <span class="checkmark" :class = "tourist.progname != 'B' ? 'disabled' : '' "></span>
                </label>
            </div>

            <div class="form-group">
                <span class="form-label"></span>
                <div :class="proffsportclass" >
                    <div class="pclass">Професійний спорт </div>
                </div>
            </div>
        </div>
    </div>    -->
</div>


        <app-programm @k3="onK3" :i="i" :key = i></app-programm>


        <div class="accordionklass">
        
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <div class="white">
                        <toggle-button @change="onRabota(i)"/> Їде працювати
                    </div>
                </div>

            </div>
         </div>
        

        <transition name="fade">
        <div v-if="tourists[i].rabota">
            <div class="accordion--content">
                <!-- <div> -->
                    <input :id="'accordion--content__one' + i" class="accordion--content--toggle"
                       type="radio" :name="'accordion' + i" checked
                       v-model="tourist.work"
                       value="1"
                        >
                    <label :for="'accordion--content__one' + i" class="accordion--content--toggle--text">Work-1</label>
                <!-- </div> -->
                <div class="accordion--content--body">
                    <p>&bull; Employees of financial institutions (except collectors), other office staff;<br /> &bull; Workers household and municipal services (other than those listed in group 2);<br /> &bull; Teaching staff after-school childcare facilities; teachers and students of institutes, colleges, special schools;<br /> &bull; cloakroom attendants, janitors, housewives;<br /> &bull; Employees;<br /> &bull; Workers and trade structures catering, except for the cook;<br /> &bull; Engineering and technical personnel, not related to the manufacturing process;<br /> &bull; Workers mail, telegraph, telephone.</p>
                </div>
            </div>
            <div class="accordion--content">
                <input :id="'accordion--content__two' + i" class="accordion--content--toggle"
                       type="radio" :name="'accordion' + i"
                       v-model="tourist.work"
                       value="2.5"
                >
                <label :for="'accordion--content__two' + i" class="accordion--content--toggle--text">Work-2</label>
                <div class="accordion--content--body">
                    <p>&bull; collectors and drivers of special transport;<br /> &bull; Persons teaching road driving means.<br /> &bull; Members of airfield maintenance, cashiers;<br /> &bull; Drivers loaders, disinfectors;<br /> &bull; Workers manufacturing (paper - cellulose, wood);<br /> &bull; Workers household and municipal services (cleaning, laundry, projectionist, craftsmen);<br /> &bull; Working light industry, debugger, hunters and fishermen;<br /> &bull; Workers food processing, printing companies;<br /> &bull; Workers transport (except aircraft);<br /> &bull; Workers stations, expeditions;<br /> &bull; Cooks;<br /> Workers on manufacturing products without machining;<br /> Artists (except the circus).</p>
                </div>
            </div>
            <div class="accordion--content">
                <input id="'accordion--content__three' + i" class="accordion--content--toggle"
                       type="radio" :name="'accordion' + i" disabled>
                <label :for="'accordion--content__three' + i" class="accordion--content--toggle--text">Work- 3
                    Not accepted for insurance
                </label>
                <div class="accordion--content--body">
                    <p>&bull; Flight - lifting structure of civil aviation;<br /> &bull; Workers employed on test work;<br /> &bull; Individuals involved in the production, storage, test explosives and chemical laboratory workers;<br /> &bull; Police explosives, security guards, divers;<br /> &bull; Workers rescue stations;<br /> &bull; Teams courts sea and river fleets;<br /> &bull; Workers heavy industry;<br /> &bull; Builders (Jack, coffered, roofing and prefabricated work, etc.);<br /> &bull; Workers air transport;<br /> &bull; Сircus performers;<br /> &bull; Working gas storage;<br /> &bull; Production of chemicals (except toxic and explosive) chemical laboratory workers;<br /> &bull; Workers veterinaries,<br /> &bull; Fire, Protection<br /> &bull; Workers of construction, engineering, glass industry, agriculture workers.</p>
                </div>
            </div>
        </div>
        </transition>
        
        </div>


        <hr>
    </div>
    
    
    <div id="elementzz">
        
    </div>


    
    <div class="row" id="accept">
        <div class="col-md-12">
            <span>
        <toggle-button @change="onAgree"
                        id="changed-font"
                       :speed = "1000"
                       :value="false"
                       :height="44"
                       :width = "180"
                       :color ="{checked: '#29a20b', unchecked: '#999292', disabled: '#CCCCCC'}"
                       :labels="{checked: 'Я приймаю умови',
                       unchecked: 'Прийміть умови'}"
                        name="agree"
                        required />
                    </span>
            <span class="white" v-show="formshow"> та надаю згоду на обробку персональних даних</span>
            </div>
    </div>
    <transition name="fade">
<div v-if="formshow">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group" >
                <span class="form-label">e-mail
                    <span class="error"
                          v-if="$v.email.$error && !$v.email.email"> Щось не схоже!
                    </span>
                </span>
                <input class="form-control" v-model.trim="$v.email.$model" @input="delayTouch($v.email)"  placeholder="your@email"/>
            </div>


        </div>
        <div class="col-md-3">

            <div class="form-group" :class="{ 'form-group--error': $v.tel.$error }">
                <!-- <label class="form__label">Телефон</label> -->
                <span class="form-label">Моб. телефон <span v-if="plus">без "+"</span>
                    <span class="error"
                        v-if="!$v.tel.kossnums">лише цифри!
                    </span>
                     <!-- <span class="error"
                        v-if="!$v.tel.kossplus">БЕЗ "+"!
                    </span> -->
                    <span class="error"
                          v-else-if="!$v.tel.maxLength">Здається, перебір!
                    </span>

                    <span class="error"
                          v-else-if="$v.tel.$error && !$v.tel.minLength">Мінімум 11 цифр
                    </span>

                </span>
                <input class="form-control" v-model.trim="$v.tel.$model" @input="delayTouch($v.tel)" @keyup="onlyTel" placeholder="38 (0XX) XXX XX-XX"/>
            </div>
            <!-- <div class="error" v-if="!$v.tel.required">Field is required</div> -->


            <!-- <div class="form-group">
                <span class="form-label">Телефон</span>
                <input class="form-control" type="text" placeholder="38(0XX)XXX-XXXX" v-model="tel" required>
            </div> -->
        </div>
        <div class="col-md-5">
            <div class="kossflex">
                <div class="form-group">
                    <span class="form-label"></span>
                    <label class="container-kk">
                        <input type="checkbox"  @change="addStrahuvalnik" checked>
                        <span class="checkmark"></span>
                    </label>
               </div>
        <!--    </div>

            <div class="col-md-4"> -->
                <div class="form-group">
                    <span class="form-label"></span>
                    <div :class="strahuvalnikclass" >
                        <div class="pclass mobile">{{ strahuvalnikmessage }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <transition name="menu-popover">
         <div v-if="strahshow">
             <div class="row">
                 <div class="col-md-3">
                     <h5 class="white">Страхувальник: </h5>
                 </div>
             </div>
             <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <span class="form-label">Адреса реєстрації</span>
                <input class="form-control" type="text" placeholder="м.Київ, Хрещатик 1" v-model="strahuvalnik.address">
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <span class="form-label">Дата народження</span>
                <date-picker  v-model="strahuvalnik.birthday" :config="optionsBirthdayStrah"
                >
                </date-picker>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <span class="form-label">Ім'я</span>
                <input class="form-control" type="text" placeholder="Ім'я" v-model="strahuvalnik.name">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <span class="form-label">Прізвище</span>
                <input class="form-control" type="text" placeholder="Прізвище" v-model="strahuvalnik.sirname">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <span class="form-label">Паспорт</span>
                <input class="form-control" type="text" placeholder="СО123456" v-model="strahuvalnik.passport">
            </div>
        </div>
     <!--   <div class="col-md-2">
            <div class="form-group">
                <span class="form-label">Податковий номер</span>
                <input class="form-control" type="text" placeholder="1234567890" v-model="strahuvalnik.inn">
            </div>
        </div> -->

             <div class="col-md-2">
                 <div class="form-group">
                     <span class="form-label" v-if="strahinnkeyup">Податковий номер</span>
                     <!-- <span class="form-label" v-else-if="!innkeyup">ІНН</span> -->
                     <span class="form-label error" v-else-if="!$v.strahuvalnik.inn.numeric">Лише цифри</span>
                     <span class="form-label" v-else-if="!$v.strahuvalnik.inn.minLength"> Номер <10 цифр</span>

                     <span class="form-label error" v-else-if="!$v.strahuvalnik.inn.maxLength">Більше за 10 цифр</span>
                     <span class="form-label" v-else-if="!$v.strahuvalnik.inn.required">Введіть номер</span>
                     <span class="form-label" v-else-if="!strahinnkeyup">номер правильний</span>

                     <input class="form-control"  v-model.trim="$v.strahuvalnik.inn.$model" placeholder="1234567890"
                            @keyup="onStrahInnKeyUp"   type="text">
                 </div>
             </div>
             </div>

    </div>

    </transition>

         <div v-for="(tourist, i) in tourists">
             <div  class="row">
                 <div class="col-md-3">
                    <h5 class="white">Подорожуючий {{ i+1 }} </h5>
                 </div>
             </div>
             <div  class="row">
        <div class="col-md-4">
            <div class="kossflex">
                <div class="form-group">
                    <span class="form-label">Резидент</span>
                    <label class="container-kk">
                        <input type="checkbox"  
                        @change="tourist.rezident=!tourist.rezident
                                tourist.passport=''" 
                        
                        checked>
                        <span class="checkmark"></span>
                    </label>
                </div>
        <!--    </div>

            <div class="col-md-1"> -->
                <div class="form-group">
                    <span class="form-label">Спорт</span>
                    <select id="idaim1" class="form-control" v-model="tourist.aim" @change="" >
                        <option v-for='aim in aims' :value="aim">
                            {{ aim.val }}
                        </option>
                    </select>
                    <span class="select-arrow"></span>
                </div>

                <div class="form-group">
                    <span class="form-label">Дата народження</span>
                    <date-picker :id="'tourist' +i" v-model="tourist.birthday" :config="optionsBirthday"
                                 @dp-change="onSendTourists">

                    </date-picker>
                </div>
            </div>
        </div>
     <!--   <div class="col-md-2"> -->

   <!-- </div> -->
        <div class="col-md-2">
            <div class="form-group">
                <span class="form-label">Ім'я
                    <span v-if="!$v.tourists.$each[i].name.maxLength" class="error">перебір</span>
                    <span v-if="!$v.tourists.$each[i].name.kossname" class="error">Латиницею</span>
                </span>
                <input class="form-control" type="text" placeholder="NAME"
                       @keyup="onNameKeyUp(i)" :name="'name' + i" v-model="tourist.name">
            </div>
        </div>
        <div class="col-md-2">

            <div class="form-group">
                <span class="form-label">Прізвище
                    <span v-if="!$v.tourists.$each[i].sirname.maxLength" class="error">перебір</span>
                    <span v-else-if="!$v.tourists.$each[i].sirname.kossname" class="error">Латиницею</span>
                </span>
                <input class="form-control" type="text" placeholder="SIRNAME"
                       :name="'sirname' + i" v-model="tourist.sirname" @keyup="onSirnameKeyUp(i)">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <span class="form-label">Passport
                    <span v-if="!$v.tourists.$each[i].passport.maxLength" class="error">перебір</span>
                <!--    <span v-else-if="!$v.tourists.$each[i].passport.kosspassseriesnonrezident" class="error">Any</span>
                    <span v-else-if="!$v.tourists.$each[i].passport.kosspassseries" class="error">Латиницею</span> -->
                </span>
                <input class="form-control" type="text" placeholder="AB12345678" :name="'passport' + i"
                       @keyup="onPassportKeyUp(i)" v-model="tourist.passport">
            </div>

        </div>
        <div class="col-md-2">
            <div class="form-group">
                <span class="form-label" v-if="innkeyup">Податковий номер</span>
                <!-- <span class="form-label" v-else-if="!innkeyup">ІНН</span> -->
                <span class="form-label error" v-else-if="!$v.tourists.$each[i].inn.numeric">Лише цифри</span>
                  <span class="form-label" v-else-if="!$v.tourists.$each[i].inn.minLength"> Номер <10 цифр</span>

                    <span class="form-label error" v-else-if="!$v.tourists.$each[i].inn.maxLength">Більше за 10 цифр</span>
                    <span class="form-label" v-else-if="!$v.tourists.$each[i].inn.required">Введіть номер</span>
                  <span class="form-label" v-else-if="!innkeyup">номер правильний</span>

                <input class="form-control" :name="'inn' + i" v-model="tourist.inn" placeholder="1234567890"
                       @keyup="onInnKeyUp(i)"  :disabled="!tourist.rezident" type="text">
            </div>

        </div>
    </div>
        <hr>        
</div>

    <!-- <div class="kossrow">

            <div class="col-md-3">
                <div class="form-group">
                    <div class="white">
                        <toggle-button @change="luggage = !luggage"/> Страхування багажу
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <div class="white">
                            <toggle-button @change="delay = !delay"/> Затримка рейсу
                    </div>
                </div>
            </div>

     </div>  -->

</div>
     </transition>

</div>
</template>
<script>

//     import $ from 'jquery'


    import { required, requiredIf,requiredUnless, minLength, maxLength, helpers, numeric, email } from 'vuelidate/lib/validators'

    const kossnums= helpers.regex('kossnums', /^[0-9\(\) -]*$/) //регулярное выражение для номера телефон

    const kosspassseries= helpers.regex('kosspassseries', /^[A-Za-z]{1,2}/) //регулярное выражение для номера паспорта
    const kosspassseriesnonrezident= helpers.regex('kosspassseriesnonrezident', /^[A-Za-z0-9]{1,2}/) //регулярное выражение для номера паспорта
    const kossname= helpers.regex('kossname', /^[A-Za-z]*$/) //регулярное выражение для номера паспорта


    const touchMap = new WeakMap()

    import {eventBus} from '../main'
    //import AppAim from './Aim.vue'

    var moment = require('moment');

    export default {
        data(){
            return {
                valid: false,
                plus: true,
                innkeyup: true,
                strahinnkeyup: true,
                strahuvalnikclass: 'form-control disabled',
                proffsportclass: 'form-control disabled',
                strahuvalnikmessage: 'Страхувальник є подорожуючий №1',

                strahshow: false,
                formshow: false,

                aims: [
                    {val: "NO", name:"The purpose of a trip is not connected with sports and/or active leisure", koef: 1},
                    {val: "NS", name:"Зайняття непрофесійним спортом", koef: 2},
                    {val: "AV", name:"Звичайне зайняття активним відпочинком", koef: 1.5},
                    //{val: "AR", name:"Активний спортивний відпочинок", koef: 3},
                    // {val: "PS", name:"", koef: 5},
                ],

                optionsBirthday:{
                    format: 'DD.MM.YYYY',
                    useCurrent: false,
                    locale: 'uk',
                    minDate: moment().startOf('day').subtract(85, 'years'),
                    maxDate: moment().startOf('day').subtract(0, 'years'),
                    viewMode: 'years'
                },
                optionsBirthdayStrah:{
                    format: 'DD.MM.YYYY',
                    useCurrent: false,
                    locale: 'uk',
                    //minDate: moment().startOf('day').subtract(85, 'years'),
                    maxDate: moment().startOf('day').subtract(0, 'years'),
                    viewMode: 'years'
                },
                email : '',
                tel: '',
                luggage: '',
                delay: '',

                tourists: [
                    {
                     name: '',
                     sirname: '',
                     birthday: moment().startOf('day').subtract(33, 'years').format('DD.MM.YYYY'),
                     passport: '',
                     inn: '',
                     //aim: { "val": "T", name:"Навчання, пляжний відпочинок, туризм", "koef": 1 },
                     aim: { val: "NO", name:"The purpose of a trip is not connected with sports and/or active leisure", koef: 1},
                     agekoef: '',
                     rezident: true,
                     work: 1,
                     risk: '',
                     progname: '',
                     profsport: false,
                     rabota: false,
                    }
                ],
                strahuvalnik: {},
                workshow: false,

            }
        },


        mounted(){
           // console.log (' moment().startOf ', moment().startOf('day').subtract(33, 'years').format('DD.MM.YYYY'))
            this.onSendTourists()

        },
        watch:{
            luggage(){
                this.onSendTourists()
            },
            delay(){
                this.onSendTourists()
            },
            email(){
                this.onSendTourists()
            },
            tel(){
                this.onSendTourists()
            },
            formshow(){
                this.onSendTourists()
            },

            tourists: {
                handler: function (after, before) {
                    // Return the object that changed
                   /* let changed = after.filter( function( p, idx ) {
                        return Object.keys(p).some( function( prop ) {
                            return p[prop] !== before[idx][prop];
                        })
                    }) */
                    // Log it
                    this.setkAge()
                    this.onSendTourists()
                },
                deep: true
            },
            strahuvalnik:{
                handler: function () {
                    this.onSendStrah()
                },
                deep: true
            },

        },
        methods: {

            onK3(data){
               console.log('K3 data ', data)
                this.tourists[data.i].risk = data.k3val,
                this.tourists[data.i].progname = data.name
              //  console.log(this.tourists[data.i])
                   /* if (data.name !== 'B' && this.tourists[data.i].profsport){
                        this.tourists[data.i].profsport = false
                   } */

                   this.onSendTourists()

            },

            onToggle(i){
                let dlina = this.tourists.length;

                // console.log('dlina', dlina, ' i ', i)

                if (i +1 == 4){
                    return 'Видалити подорожуючого';
                }
                else if (i + 1 == dlina){
                    return 'Додати подорожуючого';
                }
                else {
                    return 'Видалити подорожуючого';
                }
            },
            onClass(i){
                let dlina = this.tourists.length;

               // console.log('dlina', dlina, ' i ', i)

                if (i +1 == 4){
                    return 'submit-btn';
                }
                else if (i + 1 == dlina){
                    return 'add-btn';
                }
                else {
                    return 'submit-btn';
                }
            },
            addTourist(i){
                // console.log('this.onToggle(i) ', this.onToggle(i))
                if (this.onToggle(i) == 'Видалити подорожуючого')
                {
                   // console.log ('onToggle(i) !!! ---- ', i)
                    this.tourists.splice(i,1)
                    //this.removeTourist(i)
                }
                else {
                    if (this.tourists.length < 4){
                        this.tourists.push({
                            name: '',
                            sirname: '',
                            birthday: moment().startOf('day').subtract(33, 'years').format('DD.MM.YYYY'),
                            passport: '',
                            inn: '',
                            //aim: { "val": "T", "koef": 1 },
                            //aim: { "val": "T", name:"Навчання, пляжний відпочинок, туризм", "koef": 1 },
                            aim: { val: "NO", name:"The purpose of a trip is not connected with sports and/or active leisure", koef: 1},
                            agekoef: '',
                            rezident: true,
                            work: 1,
                            risk: '',
                            progname: '',
                            profsport: false,
                            rabota: false
                        })
                    }
                }
            },

            addStrahuvalnik(){
                this.strahshow = !this.strahshow
              if (this.strahshow ){
                  this.strahuvalnikclass = 'form-control'
                  this.strahuvalnikmessage = 'Страхувальник  НЕ подорожуючий №1'
                this.strahuvalnik = {
                  name: '',
                  sirname: '',
                  birthday: moment().startOf('day').subtract(33, 'years').format('DD.MM.YYYY'),
                  passport: '',
                  inn: '',
                  address: '',
                }

              }
                else {
                  this.strahuvalnikclass = 'form-control disabled'
                  this.strahuvalnikmessage = 'Страхувальник є  подорожуючий №1'
                  this.strahuvalnik = {}
              }
                this.onSendStrah()
            },

            addProfsport(index){
               this.tourists[index].profsport = !this.tourists[index].profsport

                console.log('this.tourists[index].profsport ', this.tourists[index].profsport)

                if(this.tourists[index].profsport){
                    this.proffsportclass = 'form-control'
                }
                else {
                    this.proffsportclass = 'form-control disabled'
                }

            },

            setkAge(){
                //Устанавливаем возврастной коэф каждому туристу
                this.tourists.forEach(function (element) {
                    let today = moment().year()
                    let year = element.birthday
                    year = year.substr(year.lastIndexOf(".") + 1)

                    let age = today - year

                    let kAge;

                    if (age >= 0 && age < 1) {
                        kAge = 4
                    }
                    else if (age >= 1 && age < 4) {
                        kAge = 1.5
                    }
                    else if (age >= 4 && age < 60) {
                        kAge = 1
                    }
                    else if (age >= 60 && age < 66) {
                        kAge = 1.5
                    }
                    else if (age >= 66 && age < 76) {
                        kAge = 2
                    }
                    else if (age >= 76 && age < 81) {
                        kAge = 3
                    }
                    else if (age >= 81 && age <= 85) {
                        kAge = 4
                    }
                    else {
                        return ;
                    }
                    element.agekoef = kAge
                })
            },

            onSendTourists(){
                this.setkAge()
                this.validate()

                eventBus.$emit('tourists', this.tourists);
                eventBus.$emit('formshow', this.formshow);
                eventBus.$emit('email', this.email);
                eventBus.$emit('tel', this.tel);
                eventBus.$emit('luggagedelay', {
                        luggage: this.luggage,
                        delay: this.delay,
                        valid: this.valid
                    });

            },

            onSendStrah(){
                this.validate()
                eventBus.$emit('strah', {
                    strahdata :this.strahuvalnik,
                    strahneedet : this.strahshow,
                    valid: this.valid
                })
            },
            onlyTel(){
                // let x = this.tel
                let x = this.tel.replace(/\D/g, '').match(/(\d{0,2})(\d{0,3})(\d{0,3})(\d{0,4})/)
                let value = !x[2] ? x[1] : x[1] + "("  + x[2] + ") " + x[3] + (x[4] ? "-" + x[4] : "");
                this.tel = value;
                this.plus = false;
            },
            delayTouch ($v) {
                $v.$reset()
                if (touchMap.has($v)) {
                    clearTimeout(touchMap.get($v))
                    // console.log('delayTouch ')
                }
                touchMap.set($v, setTimeout($v.$touch, 1000))
            },
            onInnKeyUp(i){
             //   console.log('innkeyup ', this.tourists[i].inn)
                let x = this.tourists[i].inn.replace(/\D/g, '').match(/(\d{0,2})(\d{0,3})(\d{0,3})(\d{0,2})/)
               // console.log('x[1] ', x[1],'x[2] ',x[2],'x[3] ', x[3],'x[4] ',x[4])
                let value =  x[1]   + x[2]  + x[3] + x[4] ;
                this.tourists[i].inn = value
                this.innkeyup = false;
            },
            onStrahInnKeyUp(){
                //   console.log('innkeyup ', this.tourists[i].inn)
                let x = this.strahuvalnik.inn.replace(/\D/g, '').match(/(\d{0,2})(\d{0,3})(\d{0,3})(\d{0,2})/)
                // console.log('x[1] ', x[1],'x[2] ',x[2],'x[3] ', x[3],'x[4] ',x[4])
                let value =  x[1]   + x[2]  + x[3] + x[4] ;
                this.strahuvalnik.inn = value
                this.strahinnkeyup = false;
            },
            onPassportKeyUp(i){
            
                
                    let x = this.tourists[i].passport.replace(/[A-Za-z]{2}\D{8}/g, '').match(/([A-Za-z]{0,2})(\d{0,6})/)
                
                if (!this.tourists[i].rezident){
                    x = this.tourists[i].passport.replace(/[A-Za-z0-9]{2}\D{8}/g, '').match(/([A-Za-z0-9]{0,2})(\d{0,6})/)
                }
               //  console.log('x[1] ', x[1],'x[2] ',x[2])
                let value;
                    if(!x[1]) {
                        value = "";
                    }
                    else if (x[1].length < 2){
                        x[2] = ""
                        value =  x[1]
                    }
                    else {
                        value = x[1] + x[2]
                    }

                this.tourists[i].passport = value.toUpperCase();
            },
            onSirnameKeyUp(i){
                let x = this.tourists[i].sirname.replace(/\W+/g, '').match(/([A-Za-z]{0,20})/)
               // console.log('x[1] ', x[1])
                let value =  !x[1] ? "":  x[1] ;
                this.tourists[i].sirname = value.toUpperCase();
            },
            onNameKeyUp(i){
                let x = this.tourists[i].name.replace(/\W+/g, '').match(/([A-Za-z]{0,19})/)
               // console.log('x[1] ', x[1])
                let value =  !x[1] ? "":  x[1] ;
                this.tourists[i].name = value.toUpperCase();
            },
            validate() {
               // console.log('validate!')
                this.$v.$touch()
                if (this.$v.$invalid) {
                  //  console.log('ERROR')
                    this.valid = false;
                } else {
                    // do your submit logic here
                 //   console.log('OK')
                    this.valid = true;
                }
            },

            onAgree(){
                // window.scrollTo(0, 500);
                this.formshow =!this.formshow
            },
            
            onRabota(i){
                //console.log('i',i)
                this.tourists[i].rabota = !this.tourists[i].rabota 
                if (!this.tourists[i].rabota){
                    this.tourists[i].work = 1 
                }
            
            }

        },
        computed: {


        },
        components: {
        

        },
        validations: {
       /*     if (this.strahshow){
                return{ */
                    tel: {
                        required,
                        minLength: minLength(15),
                        maxLength: maxLength(16),
                        kossnums,
                        //kossplus
                    },
                    email: {

                        required,
                        email
                    },
                    tourists: {
                        required,
                        minLength: minLength(1),
                        $each: {
                            name: {
                                required,
                                minLength: minLength(1),
                                maxLength: maxLength(19),
                                kossname
                            },
                            sirname:{
                                required,
                                minLength: minLength(1),
                                maxLength: maxLength(20),
                                kossname
                            },
                            passport: {
                                required,
                                maxLength: maxLength(8),
                                minLength: minLength(8),
                            //    kosspassseries: requiredIf(function(i){
                            //      //console.log('i', i);
                            //      return i.rezident
                            //  }),
                            //  kosspassseriesnonrezident: requiredIf(function(i){
                            //      //console.log('i', i);
                            //      return !i.rezident
                            //  }),
                            },
                            inn: {
                                //required,
                                required: requiredIf(function(i){
                                    //console.log('i', i);
                                    return i.rezident
                                }),
                                numeric,
                                maxLength: maxLength(10),
                                minLength: minLength(10)

                            }
                        }
                    },
                    strahuvalnik: {
                            inn: {
                                required: requiredIf(function(){return this.strahshow;}),
                                numeric,
                                maxLength: maxLength(10),
                                minLength: minLength(10)
                            }

                    }
                }

    }
</script>

<style scoped>

   table a {
        cursor: pointer;
    }
    th {
        min-width: 100px;
    }

 .pclass {
 padding-top: 12px;
 }

   .vue-js-switch#changed-font {
       font-size: 16px;
   }

   .disabled {
       background-color: #e9ecef;
       opacity: 1;
   }

   .menu-popover-enter,
   .menu-popover-leave-to {
       opacity: 0;
       transform: rotateY(50deg);
   }
   .menu-popover-enter-to,
   .menu-popover-leave {
       opacity: 1;
       transform: rotateY(0deg);
   }
   .menu-popover-enter-active,
   .menu-popover-leave-active {
       transition: opacity, transform 200ms ease-out;
   }


   .fade-enter-active, .fade-leave-active {
       transition: opacity .5s;
   }
   .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
       opacity: 0;
   }

   .row-centered {
       text-align:center;
   }

   .kossrow {
       margin: 0 auto;
       display: flex;
       /* text-align: center; */
       justify-content: center;
   }

    .accordionklass {
       width: 100%;
   }

   .accordion--content {
       /* each tab */
       display: block;
   }

   .accordion--content--body {
       /* content body and checkbox */
       display: none;
   }
   .accordion--content--toggle:checked ~ .accordion--content--toggle--text {
       /* active tab title */
       color: #000;
       background-color: #ccc;
       border: none;
   }
   .accordion--content--toggle:checked ~ .accordion--content--body {
       /* active tab body */
       display: block;
       background-color: #ccc;
   }
   .accordion--content--toggle--text {
       /* tab title */
       display: block;
       background-color: #2196f3;
       color: #fff;
       cursor: pointer;
       font-size: 25px;
       border-bottom: 1px solid #f5f5f5;
       user-select: none;
   }

    .accordionklass input {
        float: left;
        margin: 10px;
    }
   @media screen and (max-width: 600px) {
       .pclass.mobile {
           padding: 2px;
       }
   }

</style>


// WEBPACK FOOTER //
// src/components/Tourists.vue