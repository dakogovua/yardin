<template>
    <div>
        <app-input v-for="(inf, index) in info"
                   :name="inf.name"
                    :val = "inf.value"
                    :pattern = "inf.pattern"
                    :key = "index">

        </app-input>


    </div>

</template>

<script>
    export default {
        data(){
            return {
                info: [
                    {
                        name: 'Name',
                        value: 'имя',
                        pattern: /^[a-zA-Z ]{2,30}$/
                    },
                    {
                        name: 'Phone',
                        value: '',
                        pattern: /^[0-9]{7,14}$/
                    },
                    {
                        name: 'Email',
                        value: 'ыыы',
                        pattern: /.+/
                    },
                    {
                        name: 'Some Field 1',
                        value: 'ыыыввв',
                        pattern: /.+/
                    },
                    {
                        name: 'Some Field 2',
                        value: 'ввв',
                        pattern: /.+/
                    }
                ],
                controls: [],
                done: 0,
                formSubmited: false
            }
        },
        components: {
            appInput:{
                data(){
                    return {
                        activated: this.val != ''
                    }
                },
                props:['name','val', 'pattern'],
                template: `
                    <div class="form-group" >
                    {{ validClass }}
	                    <label> {{ name }} </label>
	                    <i  class="fa" :class="validClass"v-if="!activated" >!!!</i>
	                    <input type="text" :value="val" @input="onInput" />
	                    {{ name }} {{ val }} {{ pattern }}
	                </div>
                `
                ,
                methods:{
                    onInput(e){
                        if (e.target.value == '') {
                            this.activated = false
                        }
                        else {
                            this.activated = true
                        }
                        console.log(e.target.value)
                    }
                },
                computed:{
                    validClass(){
                        console.log(this.pattern.test(this.val))
                        return this.pattern.test(this.val) ? 'asdas' : 'aaaaa';
                    }
                }
            }
        }
    }
</script>