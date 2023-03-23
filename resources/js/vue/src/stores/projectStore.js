import { defineStore } from "pinia";
import axiosClient from "../axios";
import { useToast } from 'vue-toastification'


const toast = useToast()



export const useProjectStore = defineStore("projectStore", {

  state: () => {
    return {
      projects: [],
      projectItem: "",
      loading: false,
    }
  },

  getters: {
    inProgress: (state) => {
      return state.projects.filter((project) => {
        return project.status == "In progress";
      });

    },
    overdue: (state) => {
      return state.projects.filter((project) => {
        return project.status == "Overdue";
      });

    },
    finished: (state) => {
      return state.projects.filter((project) => {
        return project.status == "Completed";
      });

    },
  },

  actions: {

    // Read all projects
    async getProjects(){

      try {

        this.loading = true;

        await axiosClient.get("/projects")
        .then((res) => {
          this.projects = res.data
        })
        .catch((error) => {
          console.log(error)
        })
        .finally(() => {
          this.loading = false;
        })

      } catch (error) {
        console.log(error)
      }
    },

    // add new project
    async addProject(data){

      try {
        await axiosClient.post("/projects", data, {headers: {"Content-Type": "multipart/form-data"}})
        .then((res) => {
          
          toast.success(res.data.message, {timeout: 2000})
        })

      } catch (error) {
        console.log(error)
        toast.error(error.response.data.error, {timeout: 5000})
      }
    },

    // update project
    // async updateProject(data, id){

    //   try {
    //     await axiosClient.put("/projects/"+id, data, {headers: {"Content-Type": "multipart/form-data"}})
    //     .then((res) => {

    //       console.log("updated")
          
    //       toast.success(res.data.message, {timeout: 2000})
    //     })

    //   } catch (error) {
    //     console.log(error)
    //     // toast.error(error.response.data.error, {timeout: 5000})
    //   }
    // },

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

        toast.success("Project deleted", 2000)

      } catch (error) {
        toast.error(error.response.data.message, 3000)
      }
    },
  }
})