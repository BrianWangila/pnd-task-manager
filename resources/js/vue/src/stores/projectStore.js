import { defineStore } from "pinia";
import axiosClient from "../axios";
import { useToast } from 'vue-toastification'


const toast = useToast()



export const useProjectStore = defineStore("projectStore", {

  state: () => {
    return {
      projects: [],
      projectItem: ""
    }
  },

  getters: {

  },

  actions: {

    // Read all projects
    async getProjects(){

      try {

        await axiosClient.get("/projects")
        .then((res) => {
          this.projects = res.data
        })

      } catch (error) {
        console.log(error)
      }
    },

    // add new project
    async addProject(data){

      try {
        await axiosClient.post("/projects", data, {headers: {"Content-Type": "application/json"}})
        .then((res) => {
          
          toast.success(res.data.message, {timeout: 2000})
        })

      } catch (error) {
        console.log(error)
        toast.error(error.response.data.error, {timeout: 5000})
      }
    },

    // get one project
    async singleProject(id){
      try {
        await axiosClient.get("/projects/"+id)
        .then((res) => {
          this.projectItem = res.data

        })
      } catch (error) {
        console.log(error)
      }
    },

    // Delete A project
    async deleteProject(id){
      
      try {
        await axiosClient.delete("/projects/"+id)
        this.projects = this.projects.filter((item) => {
          return item.id !== id
        })

        toast.success("Project deleted", 3000)

      } catch (error) {
        // toast.error(error.data.message, 3000)
      }
    },
  }
})