import { defineStore } from "pinia";
import axiosClient from "../axios";



export const useEmployeeStore = defineStore("employeeStore", {

  state: () => {
    return {
      employees: [],
      dptEmployees: "",
      loading: false
    }
  },

  getters: {
    getDptEmployees: (state) => {
      return state.dptEmployees
    }
  },

  actions: {

    // get all employees
    async getEmployees(){
      // this.loading = true
      try {

        await axiosClient.get("/employees")
        .then((res) => {
          this.employees = res.data
          console.log(this.employees)
        })

      } catch (error) {
        console.log(error)
      }

      // this.loading = false
    },
    async getEmployeesByDpt(id){

      try {
        await axiosClient.get("/employees/department/"+id)
        .then((res) => {
          this.dptEmployees = res.data
          console.log(this.dptEmployees)
        })

      } catch (error) {
        console.log(error)
      }
    },


    // // add new project
    // async addProject(data){

    //   try {
    //     await axiosClient.post("/projects", data, {headers: {"Content-Type": "application/json"}})
    //     .then((res) => {
    //       console.log(res)
    //     })
    //   } catch (error) {
    //     console.log(error)
    //   }
    // },

    // // get one project
    // async singleProject(id){
    //   try {
    //     await axiosClient.get("/projects/"+id)
    //     .then((res) => {
    //       this.projectItem = res.data

    //     })
    //   } catch (error) {
    //     console.log(error)
    //   }
    // },

    // // Delete A project
    // async deleteProject(id){
      
    //   try {
    //     await axiosClient.delete("/projects/"+id)
        
    //     this.projects = this.projects.filter((item) => {
    //       return item.id !== id
    //     })
    //     console.log(this.projects)

    //   } catch (error) {
    //     console.log(error)
    //   }
    // },
  }
})