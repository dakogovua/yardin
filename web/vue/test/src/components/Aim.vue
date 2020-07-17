<template>
    <div class="">
        <!-- <label for="idaim">Мета подорожі</label> -->
        <div class=" form-inline">

            <select id="idaim" class="form-control" v-model="aimobject" @change="onSendAim" >
                <option v-for='aim in aims' :value="aim">
                    {{ aim.val }}
                </option>
            </select>

        </div>

    </div>
</template>
<script>
    import {eventBus} from '../main'
    export default {
        data(){
            return {
                aimobject: {
                    "val": "T", "koef": 1
                },

                aims: [
                    {val: "T", koef: 1},
                    {val: "W", koef: 1},
                    {val: "PW", koef: 2},
                    {val: "AR", koef: 3},
                    {val: "PS", koef: 5},
                ]
            }
        },
        mounted(){
            this.onSendAim();
        },
        methods: {
            onSendAim(){
                // console.log('onSendTerritory ' + this.territory);
                /*eventBus.$emit('aim', {
                    aimkoef: this.aimobject.koef,
                });*/

                this.$emit('aimemit',{
                    aimname: this.aimobject.val,
                    aimkoef: this.aimobject.koef
                })
            }
        }
    }
</script>