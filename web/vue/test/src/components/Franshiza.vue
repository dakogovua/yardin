<template>
    <div class="col-md-2">
        <div class="form-group">
            <span class="form-label">Франшиза, {{ currency }}</span>
            <select id="idfranshiza" class="form-control" v-model="franshiza" @change="onSendFranshiza" >
                <option v-for='franshiza in franshizas' :value="franshiza">
                    {{ franshiza.val }}
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
                currency: '',
                franshiza: {val: "0", koef: 1},
                franshizas: [
                    {val: "0", koef: 1},
                    {val: "50", koef: 0.95},
                    {val: "100", koef: 0.90},
                    {val: "150", koef: 0.85},
                    {val: "200", koef: 0.80},
                    {val: "250", koef: 0.75},
                    {val: "300", koef: 0.70},
                ]
            }
        },
        watch: {
            franshiza() {

                this.onSendFranshiza();
            }
        },
        created(){
            eventBus.$on('medspend', data =>{
                this.currency = data.currency
            //this.medsumkoef = data.sumkoef,
            //this.medsumval = data.sumval
            //    console.log (data);
            })
        },
        mounted(){
            this.onSendFranshiza();
        },

        methods: {
            onSendFranshiza(){
               //  console.log('this.franshiza.val ' + this.franshiza.val);
                eventBus.$emit('franshiza', {
                    franshizakoef: this.franshiza.koef,
                    franshizaval: this.franshiza.val
                });
            },

        }
    }
</script>


// WEBPACK FOOTER //
// src/components/Franshiza.vue