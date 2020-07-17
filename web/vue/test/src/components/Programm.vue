<template>
    <div class="form-group center">
        <h5 class="white">Групи ризику застрахованих</h5>


        <!-- DIRTY Responsive pricing table HTML -->

        <article>
            <div :id = "'scrollplan' + i">
                <ul>
                   <!-- <li class="bg-blue">
                        <label class="btn  ">
                            <input type="radio" name="optionsSS" id="optionSS" autocomplete="off"
                                   v-model="programm" :value="{val: 0.7, name: 'S'}" disabled>S
                        </label>
                    </li> -->
                    <li class="bg-purple">
                        <label class="btn  ">
                            <input type="radio" :name="'optionsA' + i" id="optionCC" autocomplete="off"
                                   v-model="programm" :value="{val: 1, name: 'A'}" >A
                        </label>
                    </li>
                    <li class="bg-blue">
                        <label class="btn  ">
                            <input type="radio" :name="'optionsB' + i" id="optionGG" autocomplete="off"
                                   v-model="programm" :value="{val: 2.5, name: 'B'}">B
                        </label>
                    </li>
                    <li class="bg-blue ">
                        <label class="btn  ">
                            <input type="radio" :name="'optionsC' + i" id="optionPP" autocomplete="off"
                                   v-model="programm" :value="{val: 100, name: 'C'}" disabled >C
                        </label>
                    </li>

                </ul>
            </div>

            <table>
                <thead>
                <tr>
             <!--        <th class="hide"></th>  -->
                    <!-- <th class="bg-blue"><label class="btn ">
                        <input type="radio" name="options" id="optionS" autocomplete="off"
                               v-model="programm" :value="{val: 0.7, name: 'S'}" disabled>"S"
                    </label></th> -->
                    <th style = "display: none !important;"></th>

                    <th class="bg-purple"><label class="btn ">
                        <input type="radio" :name="'options' + i" id="optionC" autocomplete="off"
                               v-model="programm" :value="{val: 1, name: 'A'}" >A
                    </label></th>
                    <th class="bg-blue default"><label class="btn ">
                        <input type="radio" :name="'options' + i" id="optionG" autocomplete="off"
                               v-model="programm" :value="{val: 2.5, name: 'B'}">B
                    </label></th>
                    <th class="bg-blue"><label class="btn ">
                        <input type="radio" :name="'options' + i" id="optionP" autocomplete="off"
                               v-model="programm" :value="{val: 100, name: 'C'}" disabled>C
                    </label></th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <!-- <td >Невідкладна стоматологічна допомога</td> -->
                    <!-- <td></td> -->
                    <td style = "display: none !important;"></td>
                    <td class="default">
                        Travels (trekking trips) - with quiet landscape, chess, checkers and other sports
                    </td>
                    <td>
                        Badminton, biathlon, volleyball, gymnastics artistic, dance, , sailing, skiing, swimming, radiosport, tennis, weightlifting, athletics, acrobatics, trampoline, baseball, cycling (track, road), water polo , wrestling, water skiing, weight sports, rowing, fire-applied sports, diving, gliding, shooting (all kinds), fencing, figure skating, gymnastics sport.
                    </td>
                    <td>
                        Bobsleigh, boxing, equestrian, karate, skiing (except mountaineering, climbing insurance is not accepted), hang gliding, parachuting, speed skating, ski jumping from the springboard, underwater sports, polo, rugby, handball, traveling ( hiking on foot) from the mountain landscape, modern pentathlon, luge, speedway, hockey (all kinds), freestyle, football, basketball, track shorts., motor sport, all-around, comprehensive sports events.
                    </td>
                </tr>

                </tbody>
            </table>

        </article>


    </div>
</template>
<script>
    import $ from 'jquery'

    // DIRTY Responsive pricing table JS
    $( document ).ready(function() {
        // console.log( "ready!" , $('#scrollplan > ul').scrollLeft(), '   ', $('#scrollplan > ul').position());

        let scrollwidth = $('#scrollplan > ul').width()
        $('#scrollplan > ul').scrollLeft(scrollwidth  / 3 - 20) // делаем на глаз скролл
// console.log('  left offset ', scrollwidth / 3 - 20 , '  scrollleft ', $('#scrollplan > ul').scrollLeft(), ' width ', $('#scrollplan > ul').width())


    $( "ul" ).on( "click", "li", function() {

        var pos = $(this).index()+2;
        $("tr").find('td:not(:eq(0))').hide();
        $('td:nth-child('+pos+')').css('display','table-cell');
        $("tr").find('th:not(:eq(0))').hide();
     //   $('li').removeClass('active');
     //   $(this).addClass('active');
    });

    // Initialize the media query
    var mediaQuery = window.matchMedia('(min-width: 640px)');

    // Add a listen event
    mediaQuery.addListener(doSomething);

    // Function to do something with the media query
    function doSomething(mediaQuery) {

        if (mediaQuery.matches) {
            $('.sep').attr('colspan',4);
        } else {
            $('.sep').attr('colspan',2);
        }
    }

    // On load
    doSomething(mediaQuery);
    });

    import {eventBus} from '../main'
    export default{
        data(){
            return{
                currency:'',
                programm: {
                    val: 1,
                    name: 'A'
                },
                programms: [
                    {val: 1, name: 'A'},
                    {val: 3.5, name: 'B'},
                    {val: 0, name: 'C'},
                    //{val: 2.7, name: 'P'}
                ]

            }
        },
        props:[
            'i'
        ],
        created(){
            eventBus.$on('medspend', data =>{
                this.currency = data.currency
                //    this.medsumkoef = data.sumkoef,
                //    this.medsumval = data.sumval
                //    console.log (data);
            });
        },
        mounted(){
            this.onSendProgramm();
        },
        watch:{
            programm(){
                 console.log ('programm')
                this.onSendProgramm()
            }
        },
        methods: {
            onSendProgramm(){
            //    eventBus.$emit('programm', {
            //        programmval: this.programm.val,
            //        programmname: this.programm.name
            //    });

                console.log ('programm')

                this.$emit('k3', {
                    k3val:this.programm.val,
                    i: this.i,
                    name: this.programm.name
                })
                eventBus.$emit('programm', {

                });

            }
        }
    }
</script>
<style scoped>
    .center{
        text-align: center;
    }


    .center article {
        width:100%;
        /*max-width:1000px;*/
        margin:0 auto;
        /* height:1000px; */
        position:relative;
    }
    .center ul {
        display:flex;
        top:0px;
        z-index:10;
        padding-bottom:14px;
        overflow-x: auto;
        padding: 0;
    }
/*    .center li {
        list-style:none;
        flex:1;
    }
*/
    .center li {
        list-style: none;
        flex: 1;
        width: 100%;
        border: 1px solid #DDD;
        border-right: 0;
        border-top: 0;
        padding: 10px;
        background: #FFF;
        font-size: 14px;
        font-weight: bold;
        height: 60px;
        color: #999;
    }

    .center li:last-child {
        border-right:1px solid #DDD;
    }
    .center button {
        width:100%;
        border: 1px solid #DDD;
        border-right:0;
        border-top:0;
        padding: 10px;
        background:#FFF;
        font-size:14px;
        font-weight:bold;
        height:60px;
        color:#999
    }
    .center li.active button {
        background:#F5F5F5;
        color:#000;
    }
    .center table { border-collapse:collapse; table-layout:fixed; width:100%; }
    .center th { background:#F5F5F5; display:none; }
    .center td, .center th {
        height:53px
    }
    .center td, .center th { border:1px solid #DDD; padding:10px; empty-cells:show; }
    .center td, .center th {
        text-align:left;
    }
    .center td+td, .center th+th {
        text-align:center;
        display:none;
    }
    .center td.default {
        display:table-cell;
    }
    .center .bg-purple {
        border-top:3px solid #A32362;
    }
    .center .bg-blue {
        border-top:3px solid #0097CF;
    }
    .center .sep {
        background:#F5F5F5;
        font-weight:bold;
    }
    .center .txt-l { font-size:28px; font-weight:bold; }
    .center .txt-top { position:relative; top:-9px; left:-2px; }
    .center .tick { font-size:18px; color:#2CA01C; }
    .center .hide {
        border:0;
        background:none;
    }

    @media (min-width: 640px) {
        .center ul {
            display:none;
        }
        .center td, .center th {
            display:table-cell !important;
        }
        .center td, .center th {
            width: 330px;

        }
        .center td+td, .center th+th {
            width: auto;
        }
    }

    .center tbody {
        background-color: #eee;
        opacity: 0.65;
    }
    .white {
        color: white;
    }

    .center td {
        text-align: left !important;
        vertical-align: top;
    }

</style>


// WEBPACK FOOTER //
// src/components/Programm.vue