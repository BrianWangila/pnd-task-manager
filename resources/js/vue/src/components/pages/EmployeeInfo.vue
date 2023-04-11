<template>
  <section class="section profile">
    <div class="heading">
      <div>
        <h2 style="font-size: 30px; font-weight: 600;">Team Member </h2>

        <P style="font-weight: 500;">Home / <span style="font-weight: 400;">Profile / {{ user.name }}</span></P>
      </div>
    </div>


    <div class="row content">


      <div class="back">
        <router-link to="/teams"><button>Back</button></router-link>
      </div>
      <div class="col-xl-4">
        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <img v-if="!singleEmployee.image_url" src="./images/profile-img.jpg" alt="Profile" class="rounded-image" >
            <img v-else :src="singleEmployee.image_url" alt="Profile" class="rounded-image" >
            <h2>{{ user.name }}</h2>
            <h3 class="mt-2">{{ singleEmployee.job_title }}</h3>
            <div class="social-links mt-2">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-8">
        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button style="color: #2F5508;" class="nav-link active2 active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button style="color: #2F5508;" class="nav-link" id="active2" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">About</h5>
                <div style="width: 30vw;">
                  <p class="small ">{{ singleEmployee.about }}</p>
                </div>

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8"> {{ user.name }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">{{ user.email }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Job</div>
                  <div class="col-lg-9 col-md-8">{{ singleEmployee.job_title }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8">{{ singleEmployee.phone }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Department</div>
                  <div class="col-lg-9 col-md-8">{{ department.department_name }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Company</div>
                  <div class="col-lg-9 col-md-8">{{ singleEmployee.organization }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Address</div>
                  <div class="col-lg-9 col-md-8">{{ singleEmployee.address }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Country</div>
                  <div class="col-lg-9 col-md-8">{{ singleEmployee.country }}</div>
                </div>
              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form @submit.prevent="updateEmployee(singleEmployee.id, singleEmployee.user_id)" enctype="multipart/form-data">

                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9 profile-sq">
                      <img ref="profileImg" :src="singleEmployee.image_url" alt="Profile">
                      <div class="pt-2">
                        <!-- <p @click="uploadImage" class="btn btn-color btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></p> -->
                        <p @click="removeImage" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></p>
                      </div>
                      <!-- <input type="file" ref="imageInput" @change="onSelectFile" style="display: none"> -->
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="fullName" type="text" class="form-control" id="fullName" v-model="inputData.name">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="about" class="form-control" id="about" rows="5" v-model="inputData.about" >{{ singleEmployee.about }}</textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Department</label>
                    <div class="col-md-8 col-lg-9">
                        <select class="form-select" v-model="inputData.department_id">
                            <option v-for="dpt in departmentStore.departments" :key="dpt.id" :value="dpt.id">{{ dpt.department_name }}</option>
                        </select>
                        <!-- <input name="company" type="text" class="form-control" id="company" :value="department.department_name"> -->
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="company" type="text" class="form-control" id="company" :value="singleEmployee.organization">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="job" type="text" class="form-control" id="Job" v-model="inputData.job_title">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="country" type="text" class="form-control" id="Country" :value="singleEmployee.country">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="address" type="text" class="form-control" id="Address" v-model="inputData.address" >
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control" id="Phone"  v-model="inputData.phone" >
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="Email" v-model="inputData.email">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="twitter" type="text" class="form-control" id="Twitter" value="https://twitter.com/#">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="facebook" type="text" class="form-control" id="Facebook" value="https://facebook.com/#">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="instagram" type="text" class="form-control" id="Instagram" value="https://instagram.com/#">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="linkedin" type="text" class="form-control" id="Linkedin" value="https://linkedin.com/#">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>
      </div>
      <hr class="footer-divider">

      <footer>
        <p> &copy; Copyright <span style="color:#2F5508; font-weight: 600;">Peak&Dale</span>. All Rights Reserved <br/>
            Designed by <span style="color: #81BE41">Peak&Dale</span></p>
      </footer>
      <!-- <Footer class="footer1"/> -->
    </div>
  </section>
</template>


<script>
    import Footer from '../Footer.vue';
    import axiosClient from '../../axios';
    import { useAuthStore } from '../../stores/authStore';
    import { useToast } from 'vue-toastification'
    import { useEmployeeStore } from '../../stores/employeeStore';
    import { useDepartmentStore } from '../../stores/departmentStore';



    export default {
        components: {
            Footer,
        },
        data(){
            var userData = JSON.parse(localStorage.getItem('user'))
            return {
                user: userData,
                authStore: useAuthStore(),
                departmentStore: useDepartmentStore(),
                employeeStore: useEmployeeStore(),
                toast: useToast(),
                singleEmployee: "",
                inputData: {
                    name: "",
                    email: "",
                    department_id: "",
                    job_title: "",

                },
                user: "",
                department: ""
            
            }
        },
        mounted(){
            var id = this.$route.params.id;

            const today = new Date()
            this.time = today.getHours()
            this.employeeStore.getEmployees()
            this.employees = this.employeeStore.employees
            this.departmentStore.getDepartments()
            this.employeeStore.getEmployeesByDpt(this.user.department_id)
            this.showEmployeeDets(id)
            this.greeting();

        }, 
        methods: {


            async showEmployeeDets(id){
                await axiosClient.get('/employees/'+id)
                .then((res) => {
                    this.singleEmployee = res.data;
                    this.user = res.data.user;
                    this.department = res.data.department;
                    this.inputData = this.singleEmployee;
                    this.inputData.name = this.singleEmployee.user.name
                    this.inputData.email = this.singleEmployee.user.email

                    console.log(this.singleEmployee);
                });
            },


            greeting(){

                const today = new Date()
                let time = today.getHours()

                if(time > 1 && time < 12) {

                this.time_title = "Good morning,";  

                } else if (time >= 12 && time < 16) {
                
                this.time_title = "Good afternoon,";

                } else {

                this.time_title = "Good evening,";
                }
            },

        
            async updateEmployee(id, user){

                try {
                    await axiosClient.patch("/employees/"+id, this.inputData, {headers: {"Content-Type": "application/json"}})  //update

                    .then((res) => {
                        this.toast.success(res.data.message, {timeout: 2000})
                    })
                    
                    await axiosClient.patch("/users/"+user, this.inputData, {headers: {"Content-Type": "application/json"}})  //update

                    
                    window.location.reload()
                
                } catch (error) {

                    console.log(error)
                    this.toast.error(error.response.data.message, {timeout: 5000})
                }
            },



            uploadImage() {
                this.$refs.imageInput.click();
            },



            onSelectFile(event){
                const file = event.target.files[0];
                const reader = new FileReader();

                reader.onload = () => {
                    this.$refs.profileImg.src = reader.result;
                    this.imageUrl = reader.result;
                };
                reader.readAsDataURL(file);

                // update image file
                this.inputData.image_file = file;
                
            },



            removeImage() {
                this.$refs.profileImg.src = "./images/profile-img.jpg";
                this.user.profileImage = null;
                this.imageUrl = "./images/profile-img.jpg";
            },


        


        },
    }

</script>


<style scoped>

  section {
    position: absolute;
    top: 10.9vh;
    left: 13.6vw;
    width: 68.4vw;
  }

  .back {
    display: flex;
    justify-content: flex-end;
    position: relative;
    right: 25px;
  }

  .back a {
    border: 1px solid #2F5508;
    background-color: #2F5508;
    color: white;
    font-weight: 600;
    padding: 3px 15px;
    margin: -10px 0 10px;
    border-radius: 5px;

  }

  .back a:hover {
    border: 1px solid #2e5508bb;
    background-color: #2e5508a4;
    color: white;

  }

  .heading {
    padding-left: 2vw;
    padding-right: 3vw;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .btn-white {
    border: 1px solid #b0adad9d;
  }

  .btn-white:hover {
    background-color: rgba(221, 240, 210, 0.875);
    border: 1px solid rgb(183, 181, 181);
  }

 


  .btn-white i {
    margin-right: 10px;
  }

  .content {
    background-color: #d9d9d966;
    padding: 2vh 1.5vw;
    margin-left: 0;
    margin-right: 0;
    overflow-y: auto;
    height: 80.3vh;

  }

  .text-center button {
    background-color: #ffff;
    color: green;
    border: 1px solid ;
    text-shadow: none;

  }

  .footer-divider {
    position: relative;
    width: 100vw;
    margin-top: 5vh;
  
  }

  footer p {
    text-align: center;
    color: #2F5508;
  }

  .card-body .nav-item .active {
    border-bottom: 2px solid #2F5508;
  }

 
  .btn-color {
    background-color: #2e5508e9;
    color: white;
  }

  .rounded-image {
    height: 120px;
    width: 150px;
    border-radius: 50%;
  }

  .profile-sq img {
    
    height: 120px;
    width: 150px;
  }

</style>