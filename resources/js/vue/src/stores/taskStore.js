import { defineStore } from "pinia";
import axiosClient from "../axios";
import { useToast } from 'vue-toastification'


const toast = useToast()



export const useTaskStore = defineStore("taskStore", {

  state: () => {
    return {
      tasks: [],
      taskItem: ""
    }
  },

  getters: {

  },

  actions: {

    // Read all projects
    async getTasks(){

      try {

        await axiosClient.get("/tasks")
        .then((res) => {
          this.tasks = res.data
        })

      } catch (error) {
        console.log(error)
      }
    },

    // add new task
    async addTask(data){

      try {
        await axiosClient.post("/tasks", data, {headers: {"Content-Type": "application/json"}})
        .then((res) => {
          console.log(res)
        })

        toast.success("New Task Added the Project", {timeout: 2000})

      } catch (error) {
        console.log(error)
      }
    },

    // get one task
    async singleTask(id){
      try {
        await axiosClient.get("/tasks/"+id)
        .then((res) => {
          this.taskItem = res.data
          console.log(this.taskItem)

        })
      } catch (error) {
        console.log(error)
      }
    },

    // Delete A task
    async deleteTask(id){
      try {
        await axiosClient.delete("/tasks/"+id)
        
        this.tasks = this.tasks.filter((item) => {
          return item.id !== id
        })

      } catch (error) {
        console.log(error)
      }
    },
  }
})