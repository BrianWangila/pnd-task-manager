<template>
  <main>
    <div class="logo-v">
      <img src="../assets/images/pnd-logo.png" alt="logo" />
    </div>
    <div class="login-page">
      <div class="login">
        <h4>TASK MANAGER</h4>
        <div>
          <div class="details">
            <h4>Login to your account</h4>
            <p>Manage your tasks and stay ahead of time</p>
          </div>
          <form @submit.prevent="onLogin">
            <!-- Email input -->
            <div class="form-outline mb-4 ">
              <input type="email" id="form2Example1" class="form-control " />
              <label class="form-label" for="form2Example1">Email address</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4 ">
              <input type="password" id="form2Example2" class="form-control" />
              <label class="form-label" for="form2Example2">Password</label>
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
              <div class="col d-flex justify-content-center">
                <!-- Checkbox -->
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                  <label class="form-check-label" for="form2Example31"> Remember me </label>
                </div>
              </div>

              <div class="col">
                <!-- Simple link -->
                <router-link style="color: grey; font-size: 15px;" to="/dashboard">Forgot password?</router-link>
              </div>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

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

  export default {
    name: "Login",
    data() {
      return {

      }
    },
    created(){
      this.router = this.$router;
    },

    methods: {
      onLogin(){
        this.router.push('/dashboard')
      }
    },
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