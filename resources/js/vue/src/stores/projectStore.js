import { defineStore } from "pinia";
import axiosClient from "../axios";



export const useProjectStore = defineStore("projects", {

  state(){
    return {
      projects: [],
    }
  },

  getters: {

  },

  action: {
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
    }
  }
})