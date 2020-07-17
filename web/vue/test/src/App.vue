<template>
  <div class="booking-form">

 <!-- <app-vuelidatecomponent></app-vuelidatecomponent> -->


    <!-- <form @submit=""
          action=""
          method="post"
    > -->


      <app-dates></app-dates>
      <div class="row">
        <app-territory></app-territory>
        <app-franshiza></app-franshiza>
        <app-med-spend></app-med-spend>
        <app-accident></app-accident>

      </div>

      <app-tourists></app-tourists>

      <app-calculate></app-calculate>

 <!--   </form> -->



  </div>



</template>

<script>



  export default {
    name: 'App',
    data(){
      return {

      }
    },

    methods:{




 },
    components: {

    }
  }
</script>



<style>
  .booking-form {
    width: -webkit-fill-available;
  }

  hr {
    border-top: 1px solid #fff;
  }

</style>