import { defineStore } from "pinia";
import axiosClient from "../axios";



export const useAuthStore = defineStore("auth", {
  state: () => {
    return {
      authUser: null,
      message: null,
      errorMsg: null,
      userToken: JSON.parse(localStorage.getItem('TOKEN'))
   
    }
  },

  getters: {
    user: (state) => state.authUser,
    error: (state) => state.errorMsg,
    token: (state) => state.userToken
  },

  actions: {
    async signIn(data){
      
      try {
        await axiosClient.post("/login", data,  {headers: {"Content-Type": "application/json"}})
        .then((res) => {
           if(res.data.status == 201){
             this.authUser = res.data.user
             localStorage.setItem("TOKEN", JSON.stringify(res.data.token))
             localStorage.setItem("user", JSON.stringify(res.data.user))

             this.router.push({name: "Dashboard"})
                    
           } 
            
        })
      } catch (error) {
        this.errorMsg = error.response.data.error
        console.log(error.response)
      }
    },

    async signOut(){
      const config = {
            headers: {
              Authorization: `Bearer ${this.token}`,
              Accept: "application/json",
              "Content-Type": "application/json",
            },
          };
      try {
        console.log(this.token)
         await axiosClient.post("/logout", {}, config)
         .then((res) => {
            // if(res.data.status == 200){
              localStorage.removeItem("TOKEN")
              localStorage.removeItem("user")
              console.log("success")
              this.authUser = null
  
              this.router.push({name: "Login"})
            // }
         })
      } catch (error) {
        console.log(error)
      }
    }
  }
});

