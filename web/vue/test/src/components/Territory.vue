<template>
    <div class="col-md-3">
        <div class="form-group">
            <span class="form-label">Територія дії</span>
            <select id="terselect" class="form-control" v-model="territory" @change="onSendTerritory" >
                <option v-for='territory in territories' :value="territory">
                    {{ territory.val }}
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
                territory: {
                    zone: 'EUROPE', val: "Countries of  Europe, Turkey, Egypt, Tunisia, Israel", koef: 1.2
                },
                territories: [
                    {zone: 'WORLD', val: "The Whole World", koef: 2},
                    {zone: 'EUROPE', val: "Countries of  Europe, Turkey, Egypt, Tunisia, Israel", koef: 1.2},
                    {zone: 'Schengen', val: "Countries of Schenhen agreement, and also the Great Britain, Ireland, Denmark", koef: 1.0},
                    {zone: 'CIS', val: "CIS countries", koef: 1.0},
                    //{zone: 3, val: "Таиланд, Тунис, Турция, Египет", koef: 1.5},
                    //{zone: 4, val: "США", koef: 10},
                    //{zone: 5, val: "Весь Мир", koef: 10},
                    //{zone: 6, val: "Другие страны", koef: 1.5}
                    //{zone: "Зона 7", val: "Весь Мир, кроме США", koef: 5}
                ]
            }
        },
        mounted(){
            this.onSendTerritory();
        },
        methods: {
            onSendTerritory(){
                // console.log('onSendTerritory ' + this.territory);
                eventBus.$emit('territory', {
                    territorykoef: this.territory.koef,
                    territoryzone: this.territory.zone
                });
            }
        }
    }
</script>


// WEBPACK FOOTER //
// src/components/Territory.vue