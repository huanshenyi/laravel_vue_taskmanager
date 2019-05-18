<template>
    <div class="card mb-4" v-if="steps.length">
        <slot name="header"></slot>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item" v-for="(step, index) in steps" :key="step.id">
                    <span @dblclick="edit(step, index)" ref="stepName">{{step.name}}</span>
                    <input type="text" v-model="editedStep"
                           @keyup.enter="update(step, index)"
                           ref="stepInput" style="display: none" class="form-control">
                    <div class="float-right">
                        <i class="fa fa-check" @click="toggle(step)"></i>
                        <i class="fas fa-window-close" @click="remove(step)"></i>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import {Hub} from '../event-bus'
    export default {
        name: "Step-list",
        props:{
            steps: Array,
            route: String
        },
        data(){
      return {
          editedStep:''
        }
    },
        methods:{
            toggle(step){
                axios.patch(`${this.route}/${step.id}/toggle`,{completion: ! step.completion}).
                then((response)=>{
                    step.completion = ! step.completion
                })
            },
            remove(step){
                axios.delete(`${this.route}/${step.id}`).then((response)=>{
                    Hub.$emit('remove',step)
                }).catch((err)=>{

                })
            },
            edit:function(step, index){
                // this.remove(step)
                // Hub.$emit('edit',step)
                this.$refs.stepName[index].style.display = 'none';
                this.$refs.stepInput[index].style.display = 'block';
                this.editedStep = step.name;
            },
            update(step, index){
                axios.patch(`${this.route}/${step.id}`,{name:this.editedStep}).
                then((response)=>{
                    window.location.reload()
                })
            }
        }
    }
</script>

<style scoped>

</style>