<template>
    <div class="col-md-3">
        <div class="form-group">
            <span class="form-label">Нещасний випадок, UAH</span>
            <select id="idfranshiza" class="form-control" v-model="accident" @change="onSendAccident" >
                <option v-for='accident in accidents' :value="accident">
                    {{ accident.val }}
                </option>
            </select>
            <span class="select-arrow"></span>
        </div>


    </div>

</template>
<script>
    import {eventBus} from '../main'
    export default {
        data(){
            return {
                // currency: '',
                accident: '',
                accidents: []
            }
        },
        watch: {
            accident() {

                this.onSendAccident();
            }
        },
        created(){


            eventBus.$on('datez', data => {
                // если параметр пустой, то берет данные из первой инициализации
                //this.multi = data.multi,
                 console.log(data, 'data.multi',  data.multi, typeof(data.multi));
                // Muti trip
                this.accidents=[]

                //Single trip
                 if (data.multi == 0){

                     let tariff
                     let sum

                    if (data.days >= 1 && data.days <= 7){

                        tariff = 0.0200
                        sum = 2

                         this.accidents.push(
                            {val: "5000", koef: 0.0200, sum: 1},
                            {val: "10 000", koef: 0.0200, sum: 2},
                            {val: "50 000", koef: 0.0200, sum: 10},
                        );
                    }

                     if (data.days >= 8 && data.days <= 15){

                         tariff = 0.0180
                         sum = 1.8

                         this.accidents.push(
                             {val: "5000", koef: 0.0180, sum: 0.9},
                             {val: "10 000", koef: 0.0180, sum: 1.8},
                             {val: "50 000", koef: 0.0180, sum: 9},
                         );
                     }

                     if (data.days >= 16 && data.days <= 30){

                         tariff = 0.0150
                         sum = 1.5

                         this.accidents.push(
                             {val: "5000", koef: 0.0150, sum: 0.75},
                             {val: "10 000", koef: 0.0150, sum: 1.5},
                             {val: "50 000", koef: 0.0150, sum: 7.5},
                         );
                     }

                     if (data.days >= 31 && data.days <= 90){

                         tariff = 0.0120
                         sum = 1.2

                        this.accidents.push(
                             {val: "5000", koef: tariff, sum: 0.6},
                             {val: "10 000", koef: tariff, sum: 1.2},
                             {val: "50 000", koef: tariff, sum: 6},
                         );
                     }

                     if (data.days >= 91 && data.days <= 180){

                         tariff = 0.0090
                         sum = 0.9

                         this.accidents.push(
                             {val: "5000", koef: tariff, sum: 0.45},
                             {val: "10 000", koef: tariff, sum: 0.9},
                             {val: "50 000", koef: tariff, sum: 4.5},
                         );
                     }

                     if (data.days >= 181 && data.days <= 365){
                         tariff = 0.0070
                         sum = 0.7

                         this.accidents.push(
                             {val: "5000", koef: tariff, sum: 0.35},
                             {val: "10 000", koef: tariff, sum: 0.7},
                             {val: "50 000", koef: tariff, sum: 3.5},
                         );
                     }

                     this.accident = {"val": "10 000", "koef": tariff, "sum": sum}



                 }
                // Multi trip
                if (data.multi == 1){


                    let koef
                    let sum
                    switch(data.data) {
                        case '15/90':
                                koef = 0.2600
                                sum = 26
                            this.accidents.push(
                                {val: "5000", koef: koef, sum: 13},
                                {val: "10000", koef: koef, sum: 26},
                            );
                            break;
                        case '30/90':

                            koef = 0.4300
                            sum = 43

                            this.accidents.push(
                                {val: "5000", koef: koef, sum: 21.5},
                                {val: "10000", koef: koef, sum: 43},
                            );
                            break;
                        case '30/365':

                            koef = 0.4300
                            sum = 43

                            this.accidents.push(
                                {val: "5000", koef: koef, sum: 21.5},
                                {val: "10000", koef: koef, sum: 43},
                            );
                            break;
                        case '60/180':
                            koef = 0.5600
                            sum = 56

                            this.accidents.push(
                                {val: "5000", koef: 0.5600, sum: 28},
                                {val: "10000", koef: 0.5600, sum: 56},
                            );
                            break;

                        case '90/180':

                            koef = 0.8700
                            sum = 87

                            this.accidents.push(
                                {val: "5000", koef: 0.8700, sum: 43.5},
                                {val: "10000", koef: 0.8700, sum: 87},
                            );
                            break;

                        case '60/365':

                            koef = 0.7400
                            sum = 74

                            this.accidents.push(
                                {val: "5000", koef: 0.7400, sum: 37},
                                {val: "10000", koef: 0.7400, sum: 74},
                            );
                            break;

                        case '90/365':

                            koef = 1
                            sum = 100

                            this.accidents.push(
                                {val: "5000", koef: 1, sum: 50},
                                {val: "10000", koef: 1, sum: 100},
                            );
                            break;

                        case '180/365':

                            koef = 1.2600
                            sum = 126

                            this.accidents.push(
                                {val: "5000", koef: 1.2600, sum: 63},
                                {val: "10000", koef: 1.2600, sum: 126},
                            );
                            break;

                        default:

                            koef = 10.5600
                            sum = 5600

                            this.accidents.push(
                                {val: "500000", koef: 10.5600, sum: 2800},
                                {val: "1000000", koef: 10.5600, sum: 5600},
                            );

                    }

                    this.accident = { "val": "10000", "koef": koef, "sum": sum }

                }

            });
        },
        mounted(){
            this.onSendAccident();
        },

        methods: {
            onSendAccident(){
                console.log ('accident' , this.accident.sum);
                eventBus.$emit('accident', {
                    accident: this.accident.sum
                });
            },

        }
    }
</script>

