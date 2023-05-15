import { defineStore } from "pinia";
import axiosClient from "../axios";
import { useToast } from 'vue-toastification'


const toast = useToast()

var userData = JSON.parse(localStorage.getItem('user'))


export const useTaskStore = defineStore("taskStore", {

    state: () => {
        return {
            tasks: [],
            taskItem: ""
        }
    },

    getters: {
        tasksByEmployeeId: (state) => {
            return state.tasks.filter((task) => {
              return task.employee_id == userData.id;
            });
  
        },
    },

    actions: {

        // Fetch all tasks
        async getTasks(){

            try {

                await axiosClient.get("/tasks")
                .then((res) => {
                this.tasks = res.data
                console.log(this.tasks)
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
                toast.success(res.data.message, {timeout: 2000})
                })

                

            } catch (error) {
                console.log(error)
                toast.error(error.response.data.message, {timeout: 3000})
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
                await axiosClient.delete("/tasks/"+id);
                
                this.tasks = this.tasks.filter((item) => {
                return item.id !== id;
                
                });

                window.location.reload();



            } catch (error) {
                console.log(error);
            };
        },
    }
})