<template>
<div class="row">

   

    <div class="col-md-3">
        <div class="form-btn inline"
             v-tooltip.right-end="{
                  content: (!valid) ? 'Прийміть умови та заповніть дані подорожуючих' : '',
                    trigger: 'click hover',
                  classes: ['info'],
                  targetClasses: ['it-has-a-tooltip'],
                  offset: 1,
                  delay: {
                    show: 400,
                    hide: 300,
                  },


                }">

            <div class="fixed">


                <button type="button" id="kmyBtn" class="submit-btn" @click.stop.prevent="onBuy" :disabled="!valid"
                >Купити за <b><span> {{ calculate_manual }}</span></b> грн.
                <br/>
                <span class="small"> в т.ч. комісія ПС 2.75% </span>
                </button>
                <i class="far fa-question-circle white ktooltip"
                   v-if="!valid"></i>


            </div>

        </div>

    </div>



</div>
</template>
<script>
    import axios from 'axios'

    import {eventBus} from '../main'
    import $ from 'jquery'

    var sha1 = require('sha1');

    var URL = "https://direct.arsenal-ic.com/calculate";
    var merID = '1';
    var password = 'd222bba5e9c1b8637ba757c0016b15c7'
    var IP = '91.197.169.148';
    var code = '1234567890'

    var telfop = '+380503843096'
    var author = 'koss@darnitsa.org'
    var point = 'genuine_insurance'
    var sumapi


    export default{
    data() {
        return {


            valid: false,
            agree: '',
            dataAPI: '',
            eur: 28,
            usd: 32,
            currency: '',
            medsumkoef: '',
            medsumval: '',

            dateStart: '',
            dateStop: '',
            days: '',
            k1period: '',
            multi: '',
            period_multi: '',
            today: '',

            territory: '', //тут коэффициент для расчета
            territoryzone: '', //а тут зона
            programmval: '',
            programmname: '',
            franshizakoef: '',
            franshizaval: '',

            touristcount: '',
            vendorCount: '',

            tourists: [],
            strahuvalnik: '',
            strahneedet: '',
            telstrah: '',
            email: '',
            luggage: '',
            delay: '',
            accidentsum: ''

        }
    },


        mounted(){


            let api = 'http://arsenal.genuine.community/get-rate';
            let arreurusd;
            axios.get(api).then((response) => {

            arreurusd  =  response.data.split(";");
         //    console.log(arreurusd);
            this.eur = arreurusd[0];
            this.usd = arreurusd[1];
        })
        .catch((error) => {
                console.log(error);
        });


        },

    created () {
        eventBus.$on('datez', data => {
            // если параметр пустой, то берет данные из первой инициализации
            this.dateStart = (data.dateStart == '') ? this.dateStart : data.dateStart,
            this.dateStop = (data.dateStop == '') ? this.dateStop : data.dateStop,
            this.days = data.days,
            this.k1period = data.k1period
            this.multi = data.multi,
            this.period_multi = data.kod,
            this.today = data.today
           console.log('datez',  data);

         });

        eventBus.$on('territory', data =>{
            this.territory = data.territorykoef,
            this.territoryzone = data.territoryzone
           // console.log ('data.territorykoef', data);
        });



        eventBus.$on('medspend', data =>{
            this.currency = data.currency,
            this.medsumkoef = data.sumkoef,
            this.medsumval = data.sumval
        //    console.log (data);
        });

        eventBus.$on('programm', data =>{
            this.programmval = data.programmval
            this.programmname = data.programmname
           // console.log (data);
         })

        eventBus.$on('franshiza', data =>{
            this.franshizakoef = data.franshizakoef,
            this.franshizaval = data.franshizaval
         //   console.log ('franshiza calc ', data);
        })

        eventBus.$on('tourists', data =>{
            this.tourists = data
        })

        eventBus.$on('formshow', data =>{
        //    console.log('data formshow ',data, ' ', data.formshow)
            this.agree = !data
        })

        eventBus.$on('strah', data =>{
           // console.log ('strah ', data)
            this.strahuvalnik = data.strahdata
            this.strahneedet = data.strahneedet
            this.valid = data.valid
        })

        eventBus.$on('email', data =>{
            this.email = data
        })

        eventBus.$on('tel', data =>{
            this.telstrah = data
        })

        eventBus.$on('accident', data =>{
            this.accidentsum = data.accident
        })

        eventBus.$on('luggagedelay', data =>{
            this.luggage = data.luggage,
            this.delay = data.delay
            this.valid = data.valid
        //    console.log('dataLUGGAGEDELAY  ', data)
        })

        },

        methods: {
            hex2bin(hex) {
                return (parseInt(hex, 16).toString(2)).padStart(8, '0');
            },
            onBuy(){
            //==console.log('nazhata knopka');

                $("#kmyBtn").addClass("animated hinge");

                let apidata  = {
                    kind: 'travel',
                    method: 'calculate',
                    code: '1234567890',
                    mode: 'json',
                    programm: '7',
                    'date-to':this.dateStop,
                    'period-days':this.days,
                    multi:this.multi,
                    'period-multi': this.period_multi,
                    franshise: this.franshizaval,
                    pocket: this.programmname,
                    // 'territory[0]':'2',
                    // vendorCount:'1',
                    commission:'0',
                    discount:'0',
                    cover1: this.medsumval,
                    //cover1: '30000',
                    currency1:this.currency,
                    cover2:'0',
                    currency2:'UAH',
                    cover3: '0',
                    currency3: 'UAH',
                    cover4: '0',
                    currency4: 'UAH',
                    //ip: '91.197.169.148',
                    //signature: signature,
                   // luggage: (this.luggage)? 1 : 0,
                    //delayed: (this.delay)? 1 : 0
                    
                    territoryzone: this.territoryzone
                }
                //    saveDocAPI['luggage'] = (this.luggage)? 1 : 0
                //    saveDocAPI['delayed'] = (this.delay)? 1 : 0


                let touristcount = this.tourists.length // Количество туристов
                apidata.vendorCount = touristcount // присваем и передаем
                
                //Задаем куда едут
                //apidata['territoryzone'] = this.territoryzone
                
                for (let i=0; i < touristcount; i++){

                    
                    apidata['vendors['+i+'][bd]'] = this.tourists[i].birthday
                    apidata['vendors['+i+'][goal]'] = this.tourists[i].aim.val
                }


                //    console.log('apidata ', apidata)
                this.dataAPI = apidata



                //let passwordmerIDcodeIP = password + merID + code + IP
                let id = 'newID'
                let amount = 0

                let cover = ''
                let currency = 'UAH'
                let datePeriod = '+' + this.days + 'd'


                    //   let  saveDocSignature = password + merID + id + amount + author + cover + currency + this.dateStart + datePeriod + point + code
                //let  saveDocSignature = 'd222bba5e9c1b8637ba757c0016b15c71newID0koss@darnitsa.org20000UAH06.02.2019+12mgenuine_insurance1234567890'
               // console.log('saveDocSignature TYPEOF ',typeof(saveDocSignature), ' ', saveDocSignature)

            //    let SHA1 = sha1(saveDocSignature)
                // console.log('SHA1 ', SHA1)
            //    let HEXBIN_SHA1 = this.hex2bin(SHA1)
                // console.log('HEXBIN_SHA1', HEXBIN_SHA1)
            //    let BASE64_ENCODE_HEXBIN_SHA1 = this.base64_encode(HEXBIN_SHA1)
                // console.log('BASE64_ENCODE_HEXBIN_SHA1 ', BASE64_ENCODE_HEXBIN_SHA1)

            //    let signature = BASE64_ENCODE_HEXBIN_SHA1

                // console.log('signature', signature)

                let saveDocAPI = this.dataAPI
            //    saveDocAPI.method = 'saveDoc'
            //    saveDocAPI.amount = 0
                saveDocAPI['doc_date'] = this.today
                saveDocAPI['doc_number'] = null
                saveDocAPI.draft = 1
                saveDocAPI['date_from'] = this.dateStart
                saveDocAPI['date_to'] = this.dateStop
                saveDocAPI['date_period'] = datePeriod
                saveDocAPI['period_days'] = this.days
                saveDocAPI['addSchengen'] = (this.territoryzone == 2) ?    1   :  0

                //общие данные для страхователя
                saveDocAPI['vendor_goal'] = this.tourists[0].aim.val
                saveDocAPI['vendor_phone'] = telfop
                saveDocAPI['vendor_passport-date'] = null
                saveDocAPI['vendor_passport-issuer'] = null
                saveDocAPI['vendor_address-city'] = null
                saveDocAPI['vendor_address_index'] = null
                saveDocAPI['telstrah'] = this.telstrah
                saveDocAPI['emailstrah'] = this.email
            //    saveDocAPI['luggage'] = (this.luggage)? 1 : 0
            //    saveDocAPI['delayed'] = (this.delay)? 1 : 0


                    if (this.strahneedet){
                        saveDocAPI['vendor_inn'] = this.strahuvalnik.inn
                        saveDocAPI['vendor_name1'] = this.strahuvalnik.name
                        saveDocAPI['vendor_name2'] = this.strahuvalnik.sirname
                        saveDocAPI['vendor_name3'] = null
                        saveDocAPI['vendor_birthday'] = this.strahuvalnik.birthday
                        saveDocAPI['vendor_title_translit'] = saveDocAPI['vendor_name1'] + ' ' + saveDocAPI['vendor_name2'] + ' ' + saveDocAPI['vendor_name3']
                        saveDocAPI['vendor_passport_series'] = (this.strahuvalnik.passport.length == 10) ?  this.strahuvalnik.passport.substr(0 ,2 ) : ''
                        saveDocAPI['vendor_passport_number'] = (this.strahuvalnik.passport.length == 10) ? this.strahuvalnik.passport.substr(2 ,this.strahuvalnik.passport.length ) : ''

                    //    saveDocAPI['vendor_intpass_series'] = (this.strahuvalnik.passport.length == 8) ? this.strahuvalnik.passport.substr(0 ,2 ) : ''
                        saveDocAPI['vendor_intpass_series'] = this.strahuvalnik.passport.substr(0 ,2 )
                        saveDocAPI['vendor_passport_series'] = saveDocAPI['vendor_intpass_series']
                    //    saveDocAPI['vendor_intpass_number'] = (this.strahuvalnik.passport.length == 8) ? this.strahuvalnik.passport.substr(2 ,this.strahuvalnik.passport.length ) : ''
                        saveDocAPI['vendor_intpass_number'] = this.strahuvalnik.passport.substr(2 ,this.strahuvalnik.passport.length ) 
                        saveDocAPI['vendor_passport_number'] = saveDocAPI['vendor_intpass_number']

                        saveDocAPI['vendor_address-address'] = this.strahuvalnik.address
                        saveDocAPI['vendor_address-translit'] = this.strahuvalnik.address
                        saveDocAPI['vendor_only-policyholder'] = 1 // это если Страхувальник не едет

                    }
                    else {
                        saveDocAPI['vendor_inn'] = this.tourists[0].inn
                        saveDocAPI['vendor_name1'] = this.tourists[0].name
                        saveDocAPI['vendor_name2'] = this.tourists[0].sirname
                        saveDocAPI['vendor_name3'] = null
                        saveDocAPI['vendor_birthday'] = this.tourists[0].birthday
                        saveDocAPI['vendor_title-translit'] = saveDocAPI['vendor_name1'] + ' ' + saveDocAPI['vendor_name2'] + ' ' + saveDocAPI['vendor_name3']
                        saveDocAPI['vendor_passport_series'] = this.tourists[0].passport.substr(0 ,2 )
                        saveDocAPI['vendor-passport_number'] = this.tourists[0].passport.substr(2 ,this.tourists[0].passport.length )

                        saveDocAPI['vendor_intpass_series'] = this.tourists[0].passport.substr(0 ,2 )
                        saveDocAPI['vendor_passport_series'] = saveDocAPI['vendor_intpass_series']
                        saveDocAPI['vendor_intpass_number'] = this.tourists[0].passport.substr(2 ,this.tourists[0].passport.length )
                        saveDocAPI['vendor_passport_number'] = saveDocAPI['vendor_intpass_number']


                        saveDocAPI['vendor_address_address'] = null
                        saveDocAPI['vendor_address-translit'] = null
                    }


                for (let j =0, i= 0 ; i < saveDocAPI.vendorCount; i++, j++){

                    saveDocAPI['tables[other_vendors]['+j+'][tpl_goal]'] = this.tourists[i].aim.val
                    saveDocAPI['tables[other_vendors]['+j+'][tpl_inn]'] = this.tourists[i].inn
                    saveDocAPI['tables[other_vendors]['+j+'][tpl_name1]'] = this.tourists[i].name
                    saveDocAPI['tables[other_vendors]['+j+'][tpl_name2]'] = this.tourists[i].sirname
                    saveDocAPI['tables[other_vendors]['+j+'][tpl_name3]'] = null
                    saveDocAPI['tables[other_vendors]['+j+'][tpl_title_translit]'] = saveDocAPI['tables[other_vendors]['+j+'][tpl_name1]'] + ' ' + saveDocAPI['tables[other_vendors]['+j+'][tpl_name2]'] + ' ' + saveDocAPI['tables[other_vendors]['+j+'][tpl_name3]']
                    saveDocAPI['tables[other_vendors]['+j+'][tpl_birthday]'] = this.tourists[i].birthday
                    saveDocAPI['tables[other_vendors]['+j+'][tpl_intpass_series]'] = this.tourists[i].passport.substr(0 ,2 )
                    saveDocAPI['tables[other_vendors]['+j+'][tpl_intpass_number]'] = this.tourists[i].passport.substr(2 ,this.tourists[i].passport.length )
                    saveDocAPI['tables[other_vendors]['+j+'][tpl_address_index]'] = null
                    saveDocAPI['tables[other_vendors]['+j+'][tpl_address_city]'] = null
                    saveDocAPI['tables[other_vendors]['+j+'][tpl_address_address]'] = null
                    saveDocAPI['tables[other_vendors]['+j+'][tpl_address_translit]'] = null

                }

                saveDocAPI['sumapi'] = this.calculate_manual // присваиваем сумму
                saveDocAPI['doc_number'] = 234234 //эту парашу надо убрать

               // console.log('saveDocAPI ', saveDocAPI, ' saveDocAPI.vendorCount ', saveDocAPI.vendorCount)

                function post(path, params, method) {
                    method = method || "post"; // Set method to post by default if not specified.

                    // The rest of this code assumes you are not using a library.
                    // It can be made less wordy if you use one.
                    var form = document.createElement("form");
                    form.setAttribute("method", method);
                    form.setAttribute("action", path);

                    for(var key in params) {
                        if(params.hasOwnProperty(key)) {
                            var hiddenField = document.createElement("input");
                            hiddenField.setAttribute("type", "hidden");
                            hiddenField.setAttribute("value", params[key]);
                            key = key.replace(/\-/g, '_')

                            //console.log('key ', key)
                            hiddenField.setAttribute("name", key);

                            form.appendChild(hiddenField);
                        }
                    }
                    var arrcsrf; //
                    $.ajax({ //эта фигня запрашивает csrf и отправляет форму
                        url: '/',
                        type: "GET",
                     //   data: {},
                        success: function (data) {
                         //    console.log('data csrf url /', data)
                            arrcsrf  =  data.split(";");
                            // console.log('arrcsrf ',arrcsrf)

                            //console.log('arrcsrf[0] ', arrcsrf[0], ' arrcsrf[0] ', arrcsrf[1])

                            var hiddenToken = document.createElement("input");
                            hiddenToken.setAttribute("name", arrcsrf[0]);
                            hiddenToken.setAttribute("value",arrcsrf[1]);
                            form.appendChild(hiddenToken);

                            document.body.appendChild(form);
                            form.submit();


                            }
                        })
                }

                 /*     $.ajax({
                   // url: URL,
                    url: 'https://direct.arsenal-ic.com/calculate',
                    type: 'POST',
                    data: saveDocAPI,
                    dataType: "json",
                          crossDomain: true,
                    async: false,
                    success: function(respText) {
                    //    console.log(' respTextajax ', respText)
                        // saveDocAPI['number'] = '123123123'; добавить когда Арсенал раздуплится
                    //    console.log ('saveDocAPIrespTextajax ', saveDocAPI)
                        // post('http://localhost/polis/insert', saveDocAPI);

                         post('/polis/insert', saveDocAPI);

                    },
                    error: function(respText){
                        //theResponse = 'error'
                    //    console.log('error', respText)
                    },
                    complete: function(){
                        //console.log('DONEDONEDONEDONEDONE')
                    }

                });  */
                    
            //  console.log('saveDocAPI',saveDocAPI);
            
            console.log('saveDocAPI', saveDocAPI);
            // UNCOMMENT STRING BELLOW:
                post('/polis/insert', saveDocAPI);
            },
        //    base64_encode(data) { // Encodes data with MIME base64
                //
                // +   original by: Tyler Akins (http://rumkin.com)
                // +   improved by: Bayron Guevara
        //
        //        var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
        //        var o1, o2, o3, h1, h2, h3, h4, bits, i = 0, enc = '';
        //
        /*        do { // pack three octets into four hexets
                    o1 = data.charCodeAt(i++);
                    o2 = data.charCodeAt(i++);
                    o3 = data.charCodeAt(i++);

                    bits = o1 << 16 | o2 << 8 | o3;

                    h1 = bits >> 18 & 0x3f;
                    h2 = bits >> 12 & 0x3f;
                    h3 = bits >> 6 & 0x3f;
                    h4 = bits & 0x3f;

                    // use hexets to index into b64, and append result to encoded string
                    enc += b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
                } while (i < data.length); */
        //
        /*        switch (data.length % 3) {
                    case 1:
                        enc = enc.slice(0, -2) + '==';
                        break;
                    case 2:
                        enc = enc.slice(0, -1) + '=';
                        break;
                } */
        //
        //        return enc;
        //    },
        },

        computed:{

            calculate_manual(){
            // Формула ручного расчёта
                let touristcount = this.tourists.length // Количество туристов
                let K5;

                if (touristcount >= 1 && touristcount < 3){
                    K5 = 1
                }

                if (touristcount >= 3 && touristcount < 11){
                    K5 = 0.95
                }

                if (touristcount >= 11 && touristcount < 21){
                    K5 = 0.85
                }

                if (touristcount >= 51){
                    K5 = 0.8
                }

                let summ1 = 0

                let Cgeneral = 0;
                let Kа = 1 // коэффициент андеррайтера

                // console.log ('K5 ', K5, 'touristcount', touristcount)



                   for (let i=0; i < touristcount; i++){

                        let K1 = this.tourists[i].work
                        let K2 = this.tourists[i].aim.koef
                       // let K3 = (this.tourists[i].profsport != true) ? 1 : 3.5
                        let K3 = this.tourists[i].risk
                        let K4 = this.tourists[i].agekoef

                       Cgeneral  += K1 *  K2  * K3 * K4 * K5  * Kа

                     //  console.log ('Cgeneral ', Cgeneral, K1, K2, K3, K4, K5, Kа)

                    }

                        let IPm = (this.multi == 1) ? this.period_multi : this.k1period
                        let Cfr = this.franshizakoef
                        let Сtr = this.territory
                        let kurs = (this.currency == 'EUR')? this.eur : this.usd; //Cex
                        let Cterm = (this.multi == 0) ? this.days : 1


                        let IP1= IPm * Cfr  * Сtr * Cgeneral  * kurs * Cterm

                        //let IPpa = this.accidentsum
                        let IP2=  this.accidentsum  * Cgeneral *  Cterm

                        let SP1 =  IP1+  IP2

                        let SP = SP1 * touristcount
                        SP = SP / 0.9725

                // console.log ('SP', SP)



               // arsenal console.log ('kurs ' + kurs + ' ' + this.eur  + '' + this.usd )
               //  let medpay = summ1 * 80/(100 - 25) * kurs;
               // console.log ('medpay ' + medpay);
                return SP.toFixed(2) ;
            }
        },

       /* asyncComputed: {

            calc_arsenal: {
                //Формула расчёта по API Арсенала
                get () {
                    let passwordmerIDcodeIP = password + merID + code + IP

                    let SHA1 = sha1(passwordmerIDcodeIP)
                    let HEXBIN_SHA1 = this.hex2bin(SHA1)
                    let BASE64_ENCODE_HEXBIN_SHA1 = this.base64_encode(HEXBIN_SHA1)

                    let signature = BASE64_ENCODE_HEXBIN_SHA1
                    //console.log('BASE64_ENCODE_HEXBIN_SHA1 ', BASE64_ENCODE_HEXBIN_SHA1)



                    return new Promise(

                             function(resolve, reject) {

                                 $.extend({
                                     xResponse: function(url, data) {
                                         // local var
                                 //        console.log ('ajax data ', data)
                                         var theResponse = null;
                                         // jQuery ajax
                                         $.ajax({
                                             url: url,
                                             type: 'POST',
                                             data: data,
                                             dataType: "json",
                                             async: false,
                                             before: function(){
                                               return 'рахуємо';
                                             },
                                             success: function(respText) {
                                         //        console.log(' respText ', respText)
                                                 theResponse = respText.data.Arsenal.amount;
                                                 sumapi = theResponse
                                                 //console.info ('calculate_manual ', calculate_manual)
                                             },
                                             error: function(){
                                                 theResponse = 'error'
                                             }
                                         });

                                         // Return the response text
                                         return theResponse;
                                     }
                                 });

                                 var xData = $.xResponse(URL, apidata);
                                 //var xData = $.xResponse(URL, example);


                                     resolve(
                                             xData
                                    );

                             }
                    )
                },
                default: '...'
            }
        } */

    }
</script>

<style scoped>
    button[type=button]:disabled,  button[type=button]:disabled:focus, button[type=button]:disabled:hover {
        background: #f58787;
        opacity: 1;
    }



    .white {
        color: white;
        cursor: pointer;
    }

    .form-btn.inline {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }



  @media screen and (max-width: 600px) {
        .fixed {
            position: fixed;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 0.24rem;
            background-color: #efefef;
            text-align: center;

        }
    .fixed .ktooltip {
            display: none;
        }
    }

    @media screen and (min-width: 600px) {
        .fixed {

            display: contents;
        }
    }




</style>

