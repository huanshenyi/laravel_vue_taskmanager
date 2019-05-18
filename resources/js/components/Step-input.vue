<template>
    <div class="card">
        <div class="card-header">
            <div class="form-group">
                <label v-show="!newStep">完成までのステップ入力:</label>
                <input type="text" v-model="newStep" ref="newStep" class="form-control" @keyup.enter="addStep">
            </div>
        </div>
        <button type="submit" class="btn btn-primary" @click="addStep" v-if="newStep">ステップ挿入</button>
    </div>
</template>

<script>
    import {Message} from 'element-ui'
    import 'element-ui/lib/theme-chalk/index.css';
    //import { Hub } from '../event-bus'
    export default {
        name: "Step-input",
        props:{
            route: String
        },
        data:function () {
            return{
                newStep:''
            }
        },
        // created(){
        //  Hub.$on('edit',this.edit)
        // },
        methods:{
            addStep:function () {
                axios.post(this.route,{name:this.newStep}).then((response)=>{
                    this.$emit('add',response.data.step)
                    this.newStep=''
                }).catch((err)=>{
                    if(err.response.status === 422){
                        Message.error(err.response.data.errors.name[0])
                    }
                })
            },
            // edit(step){
            //         this.newStep = step.name;
            //         this.$refs.newStep.focus()
            // }
        }
    }
</script>

<style scoped>

</style>