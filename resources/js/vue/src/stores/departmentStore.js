import { defineStore } from "pinia";
import axiosClient from "../axios";


var userData = JSON.parse(localStorage.getItem('user'))

export const useDepartmentStore = defineStore("departmentStore", {

  state: () => {
    return {
      departments: [],
    }
  },

  getters: {
      dptByEmployee: (state) => {
          return state.departments.filter((dpt) => {
              return dpt.id == userData.department_id;
          });

      },
  },

  actions: {

    // get all departments
    async getDepartments(){

        try {

            await axiosClient.get("/departments")
            .then((res) => {
                this.departments = res.data
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