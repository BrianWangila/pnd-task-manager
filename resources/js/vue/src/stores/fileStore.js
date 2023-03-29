import { defineStore } from "pinia";
import axiosClient from "../axios";
import { useToast } from 'vue-toastification'




const toast = useToast();


export const useFileStore = defineStore("fileStore", {

    state: () => {
        return {
            files: [],
        };
    },

    getters: {

    },

    actions: {

        // Read all files
        async getFiles(){

            try {
                await axiosClient.get("/files")
                .then((res) => {
                    this.files = res.data;
                    console.log(this.files);
                })

            } catch (error) {
                console.log(error);
            }
        },

        
        // add new file
        async addFile(data){

            try {
                await axiosClient.post("/files", data, {headers: {"Content-Type" : "multipart/form-data"}})
                .then((res) => {
                  
                    toast.success(res.data.message, {timeout: 2000});

                })

            } catch (error) {
                console.log(error);
                toast.error(error.response.data.message, {timeout: 5000});
            }
        },
    }
})