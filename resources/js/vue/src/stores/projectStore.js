import { defineStore } from "pinia";
import axiosClient from "../axios";



export const useProjectStore = defineStore("projectStore", {

  state: () => {
    return {
      projects: [],
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
          console.log(this.projects)
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
          console.log(res)
        })
      } catch (error) {
        console.log(error)
      }
    },

    // get one project
    async singleProject(id){
      try {
        await axiosClient.get("/projects/"+id)
        .then((res) => {
          this.projects = res.data
          console.log(this.projects)

          this.router.push({name: "ProjectDetails"})

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
        console.log(this.projects)

      } catch (error) {
        console.log(error)
      }
    },
  }
})