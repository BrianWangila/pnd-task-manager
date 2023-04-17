import { defineStore } from "pinia";
import axiosClient from "../axios";
import { useToast } from 'vue-toastification';
import router from "../router/index";


const toast = useToast();



export const useAuthStore = defineStore("auth", {
    state: () => ({
        
        authUser: JSON.parse(localStorage.getItem('user')),
        message: null,
        errorMsg: null,
        userToken: JSON.parse(localStorage.getItem('TOKEN')),
        returnUrl: null,
      
    }),

    getters: {
        // user: (state) => state.authUser,
        isLoggedIn: state => !!state.token,
        error: (state) => state.errorMsg,
        token: (state) => state.userToken
    },

    actions: {
        loadUser() {

            // if(!this.authUser || !this.userToken) {

            //     if(router.currentRoute.name != "Login") {

            //         return router.go('/');
            //         // return router.push({ name: 'Login' });
            //     }
            // }
        },


        async signIn(data){
            // console.log(this.userToken)
            try {
                await axiosClient.post("/login", data,  {headers: {"Content-Type": "application/json"}})
                .then((res) => {
                    console.log(res.data)
                    if(res.data.status == 201){

                        localStorage.setItem("TOKEN", JSON.stringify(res.data.token));
                        localStorage.setItem("user", JSON.stringify(res.data.user));
                        
                        this.router.push({path: "/dashboard"});
                    }   
                })

              toast.success(`You're logged in, welcome back`, {timeout: 3000})

            } catch (error) {
                this.errorMsg = error.response.data.error
                toast.error(this.errorMsg, {timeout: 5000})
            }
      },

        async signOut(){
            try {
              await axiosClient.post("/logout")
              .then((res) => {
                  // if(res.data.status == 200){
                    localStorage.removeItem("TOKEN")
                    localStorage.removeItem("user")
                    this.authUser = null
        
                    this.router.push({name: "Login"})
                  // }
                })

                toast.success("You're logged out", {timeout: 2000})

          } catch (error) {
              console.log(error)
          }
        },

        // add new team member
        async register(data){

            try {
            await axiosClient.post("/register", data, {headers: {"Content-Type": "application/json"}})
            .then((res) => {
                console.log(res)
                toast.success(res.data.message, {timeout: 2000})
            })

            } catch (error) {
                console.log(error)
            }
        },
    }
});