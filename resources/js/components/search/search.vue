<template>
    <div class="instant-search">
        <form class="form-inline">
            <div class="input-group">
                <input type="text" v-model="searchStr" @focus="fetch" @blur="leave" class="form-control" placeholder="タスク検索" aria-label="search" aria-describedby="basic-addon1">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                </div>
            </div>
        </form>
        <ul class="list-group search-list" v-if="show">
            <li class="list-group-item"
                    v-for="task in filtered"
                    :key="task.id">
                <a :href="url(task.id)">{{task.name}}</a>
            </li>
        </ul>
    </div>
</template>

<script>
    import { Loading } from 'element-ui';
    import 'element-ui/lib/theme-chalk/index.css';
    export default {
        name: "search",
        data:function(){
          return{
              tasks: [],
              show: false,
              loaded: false,
              searchStr:''
          }
        },
        computed:{
           filtered(){
               let str = this.searchStr.trim().toLowerCase();
               return this.tasks.filter((task)=>{
                  if(task.name.toLowerCase().indexOf(str) != -1){
                      return true
                  }
               })
           }
        },
        methods:{
            fetch:function () {
                if(!this.loaded){
                    let loadingInstance = Loading.service({target:'.instant-search',spinner:"el-icon-loading"})
                    axios.get('/tasks/search').then((response)=>{
                        this.tasks = response.data.tasks
                        this.show = true
                        this.loaded = true
                        loadingInstance.close();

                    }).catch((err)=>{

                    })
                }else{
                    this.show = true
                }
            },
            leave:function () {
                setTimeout(()=>{
                    this.show = false
                },500)
            },
            url:function (id) {
                return `/tasks/${id}+/steps`
            }
        }
    }
</script>

<style scoped lang="scss">
   .instant-search{
       height: 3rem;
       z-index:1000;
       .search-list{
           max-height: 20em;
           overflow: auto;
       }
   }
</style>