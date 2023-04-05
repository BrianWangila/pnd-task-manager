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
    async getSubTasks(){

        try {
            await axiosClient.get("/subtasks")
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
            await axiosClient.post("/subtasks", data, {headers: {"Content-Type": "application/json"}})
            .then((res) => {
              console.log(res)
              toast.success(res.data.message, {timeout: 2000})
            })

          

        } catch (error) {
            console.log(error)
            toast.error(error.response.data.message, {timeout: 3000})
        }
    },

     // edit subTask
     async editSubTask(id, data){

      try {
          await axiosClient.patch("/subtasks/"+id, data, {headers: {"Content-Type": "application/json"}})
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
            await axiosClient.delete("/subtasks/"+id)
            
            this.subTasks = this.subTasks.filter((item) => {
                return item.id !== id

            })

            toast.success('item deleted', {timeout: 2000})


        } catch (error) {
            console.log(error)
        }
    },


    // toggle status
    async toggleStatus(id){

        const subtask = this.subTasks.find((item) => {
            return item.id === id;
        })

        subtask.status = 'complete';
  
        try {
            const data = {
                status: subtask.status
            };
          
            await axiosClient.patch("/subtasks/"+id, data);
          
            toast.success("Milestone status set to 'Complete'", {timeout: 3000});
          
        } catch (error) {
            console.log(error);
            toast.error(error.response.data.message, {timeout: 3000})
        }
      },


      
  }
})