<template>
    <div class="col-md-3">

        <div class="form-group">
            <div class="form-checkbox inline"><span class="form-label">Медичні итрати</span>
        </div>

            <select id="idselect" class="form-control" v-model="summ" @change="onSendCurrency" >
                <option v-for='summa in summas' :value="summa">
                    {{ summa.val }}
                </option>
            </select>
            <div class="form-checkbox inline">
            <span class="select-arrow"></span>

            <span class="form-label">
            <label for="EUR">
                <input type="radio" id="EUR" name="EUR"
                       v-model='currency'
                       @change="onSendCurrency"
                       value="EUR">
                <span></span>EUR
            </label>
            <label for="USD">
                <input type="radio" id="USD" name="USD"
                       v-model='currency'
                       @change="onSendCurrency"
                       value="USD" :disabled="zone"
                >
                <span :class="disabledclass"></span>USD
            </label>

            </span>
                <div class="white" >
                <i class="far fa-question-circle"
                   v-tooltip.right-end="{
                  content: 'Для Шенгену лише EUR',
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


</template>

<script>
    import {eventBus} from '../main'
    export default {
        data(){
            return{
                disabledclass:'',
                medterritoryzone: '',
                currency: 'EUR',
                 summ: {val: "30000", koef: 1},


                summas: [
            //    {val: "5000", koef:  0.84},
            //    {val: "10000", koef: 0.88},
            //    {val: "15000", koef: 0.92},
            //    {val: "20000", koef: 0.96},
                {val: "30000", koef: 1},
                {val: "50000", koef: 2.7}
                ]
            }
        },
        created(){
            eventBus.$on('territory', data =>{

             this.medterritoryzone = data.territoryzone
            console.log ('data.territory', data);
                this.summas = []

             if (this.medterritoryzone  == 'WORLD'){
                 this.summas = [
                     // {val: "30000", koef: 1},
                     {val: "50000", koef: 2.7}
                 ]

                 this.summ = {val: "50000", koef: 2.7}
             }
             else {
                 this.summas = [
                     {val: "30000", koef: 1},
                     {val: "50000", koef: 2.7}
                 ]
             }

            });
        },
        watch:{
          currency(){
              console.log('wach currency ', this.currency)
              this.onSendCurrency()
          }
        },
        mounted(){
            this.onSendCurrency();
        },
        methods: {
            onSendCurrency(){
                eventBus.$emit('medspend', {
                    currency: this.currency,
                    sumkoef: this.summ.koef,
                    sumval: this.summ.val
                });
            }
        },
        computed: {
            zone(){
                if (this.medterritoryzone == 'Schengen') {
                    this.currency = 'EUR'
                    this.disabledclass = 'classdisabled'
                    //this.onSendCurrency() -- переехало в watch т.к. после return скрипт умирает
                    return true;
                }
                else if(this.medterritoryzone == 'WORLD'){
                    this.currency = 'USD'
                    this.disabledclass = ''
                    return false;
                }
                else {
                    this.disabledclass = ''
                    return false;
                }

            }
        }
    }

</script>

<style scoped>
    span.classdisabled {
        background-color: #eee !important;
    }

    .form-checkbox.inline {
        display: flex;
        align-items: center;
   /*     justify-content: space-between; */
    }

</style>


// WEBPACK FOOTER //
// src/components/MedSpend.vue