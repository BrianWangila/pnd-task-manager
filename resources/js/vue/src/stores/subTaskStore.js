import { defineStore } from "pinia";
import axiosClient from "../axios";
import { useToast } from 'vue-toastification'


const toast = useToast()



export const useSubTaskStore = defineStore("subTaskStore", {

  state: () => {
    return {
        subTasks: [],
        taskItem: ""
    }
  },

  getters: {

  },

  actions: {

    // Read all subTasks
    async getTasks(){

        try {
            await axiosClient.get("/subTasks")
            .then((res) => {
              this.subTasks = res.data
            })

        } catch (error) {
            console.log(error)
        }
    },

    // add new subTask
    async addSubTask(data){

        try {
            await axiosClient.post("/subTasks", data, {headers: {"Content-Type": "application/json"}})
            .then((res) => {
              console.log(res)
              toast.success(res.data.message, {timeout: 2000})
            })

          

        } catch (error) {
            console.log(error)
            toast.error(error.response.data.message, {timeout: 3000})
        }
    },

    // Delete A subtask
    async deleteSubTask(id){
        try {
            await axiosClient.delete("/subTasks/"+id)
            
            this.subTasks = this.subTasks.filter((item) => {
              return item.id !== id
            })

        } catch (error) {
            console.log(error)
        }
    },
  }
})