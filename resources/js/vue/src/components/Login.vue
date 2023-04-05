<template>
  <main>
    <div class="logo-v">
      <img src="../assets/images/pnd-logo.png" alt="logo" />
    </div>
    <div class="login-page">
      <!-- {{toast.success("My toast content", {
        timeout: 3000
      })}} -->
      <div class="login">
        <h4>PROJECT MANAGER</h4>
        <div>
          <div class="details">
            <h4>Login to your account</h4>
            <p>Manage your tasks and stay ahead of time</p>
          </div>
          <form @submit.prevent="user_store.signIn(user_input)">
            <!-- Email input -->
            <div class="form-group mb-4 ">
              <label class="form-label" for="loginEmail">Email address</label>
              <input type="email" id="loginEmail" class="form-control" v-model="user_input.email" placeholder="Enter email address" autofocus/>
            </div>

            <!-- Password input -->
            <div class="form-group mb-4 ">
              <label class="form-label" for="loginPassword">Password</label>
              <input type="password" id="loginPassword" class="form-control" v-model="user_input.password" placeholder="Enter password"/>
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
              <div class="col d-flex justify-content-center">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="formCheckbox" v-model="user_input.remember" />
                  <label class="form-check-label" for="formCheckbox"> Remember me </label>
                </div>
              </div>

              <div class="col">
                <router-link style="color: grey; font-size: 15px;" to="/dashboard">Forgot password?</router-link>
              </div>
            </div>
<!-- 
            <div v-if="user_store.error" style="color: red; font-size: 15px;">
              {{ user_store.error }}
            </div> -->
            <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
          </form>
        </div>
      </div>
      <div class="image">
        <img src="../assets/images/login-illu.png" alt="login-illustration" />
      </div>
    </div>
    <div class="copy">
      &COPY; 2023
    </div>
  </main>
</template>


<script>
  import { useAuthStore } from '../stores/authStore.js';
  import { useToast } from "vue-toastification";



  export default {
    name: "Login",
    data() {
      return {
        user_store: useAuthStore(),
        toast: useToast(),
        user_input: {
          email: "",
          password: "",
          remember: false
        },
        
      }
    },

    // mounted: {},
    // methods: {},
  }

</script>



<style scoped>

  main {
    padding: 10px 80px;
  }

  .login > h4 {
    margin-top: 20px; 
    margin-bottom: 50px; 
    text-align: center;
    font-weight: 600;
  }

  .login-page {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 83vh;

  }

  .login {
    border: 1px solid #00000044;
    padding: 50px 70px;
    border-radius: 15px;
    margin-right: 10vw;
  }

 .copy {
  position: relative;
  bottom: 0;
 }

 .details {
  margin-bottom: 30px;
 }

 .btn {
  background-color: #000;
  margin-top: 50px;
  height: 45px;
  font-size: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
 }

 .image img {
  width: 50rem;
  margin-right: -7vw;
 }

 .side {
    display: none;
  }

  

</style>