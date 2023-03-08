import { defineStore } from "pinia";
import axiosClient from "../axios";



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

    // add new project
    async addTask(data){

      try {
        await axiosClient.post("/task", data, {headers: {"Content-Type": "application/json"}})
        .then((res) => {
          console.log(res)
        })
      } catch (error) {
        console.log(error)
      }
    },

    // get one project
    async singleTask(id){
      try {
        await axiosClient.get("/tasks/"+id)
        .then((res) => {
          this.taskItem = res.data

        })
      } catch (error) {
        console.log(error)
      }
    },

    // Delete A project
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