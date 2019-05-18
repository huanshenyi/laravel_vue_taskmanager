<template>
    <div class="row justify-content-center">
        <div class="col-4 mr-3">
         <step-list
                 :steps="inProcess"
                 :route="route"
         >
             <template v-slot:header>
                     <div class="card-header">
                         進行中({{ todos.length }})
                         <button class="btn btn-sm btn-success float-right" @click="componentAll">全て完成</button>
                     </div>
             </template>
         </step-list>

         <step-input
                 :route="route"
                 @add="sync"
         ></step-input>
        </div>
        <div class="col-4">
            <step-list
                    :steps="processed"
                    @componentAll='componentAll'
                    :route="route"
            >
                <template v-slot:header>
                            <div class="card" v-show="processed.length">
                                <div class="card-header">
                                    完成({{dones.length}})
                                    <button class="btn btn-sm btn-danger float-right" @click="clearCompleted">内容クリア</button>
                                </div>
                            </div>
                </template>
            </step-list>
        </div>
    </div>
</template>

<script>
    import StepInput from './Step-input'
    import StepList from './Step-list'
    import {Hub} from '../event-bus'
    export default {
        name:'steps',
        props:{
          route : String,
          initialSteps: Array,
          todos: Array,
          dones: Array
        },
        components:{
            StepInput,
            StepList
        },
        data:function(){
            return{
                steps:this.initialSteps
            }
        },
        created:function(){
            Hub.$on('remove',this.remove)
        },
        computed:{
            inProcess(){
                return this.steps.filter(function (step) {
                    return ! step.completion
                })
            },
            processed(){
                return this.steps.filter( (step)=>{
                    return step.completion
                })
            }
        },
        methods:{
            // fetchSteps:function(){
            //     let self = this
            //     axios.get(this.route).then(function (response) {
            //         self.steps = response.data.steps
            //     }).catch((err)=>{
            //        alert(`みつかりません\n ${err.response.data.message} \nエラーcode: ${err.response.status}`)
            //         //console.log(err.response)
            //     })
            // },
            sync(step){
                this.steps.push(step)
            },
            remove(step){
                    let i = this.steps.indexOf(step)
                    this.steps.splice(i,1)
            },
            componentAll:function () {
                axios.post(`${this.route}/complete`).then((response)=>{
                    this.inProcess.forEach(function (step) {
                        step.completion=true
                    })
                })

            },
            clearCompleted:function () {
                axios.delete(`${this.route}/clear`).then((response)=>{
                    this.steps = this.inProcess
                })
            }
        }
    }
</script>

<style scoped>

</style>

