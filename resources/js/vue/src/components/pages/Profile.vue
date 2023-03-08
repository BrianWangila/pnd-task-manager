<template>
  <section class="section profile">
    <div class="heading">
      <div>
        <h2 v-if="time > 1 && time < 12" style="font-size: 30px; font-weight: 600;"><span style="font-size: 25px; font-weight: 500;">Good morning,</span> ADMIN</h2>
        <h2 v-else-if="time > 12 && time < 16" style="font-size: 30px; font-weight: 600;"><span style="font-size: 25px; font-weight: 500;">Good afternoon,</span> ADMIN</h2>
        <h2 v-else style="font-size: 30px; font-weight: 600;"><span style="font-size: 25px; font-weight: 500;">Good Evening,</span> ADMIN</h2>


        <P style="font-weight: 500;">Home / <span style="font-weight: 400;">Profile</span></P>
      </div>
      <!-- <div>
        <div className="btn-group">
          <button type="button" className="btn btn-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-calendar"></i> Today
          </button>
          <ul className="dropdown-menu" >
            <li><DatePicker v-model="date" /></li>
          </ul>
        </div>

        <div className="btn-group" style="margin-left: 20px;">
          <button type="button" className="btn btn-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-funnel"></i> Filter
          </button>
          <ul className="dropdown-menu" >
            <li><a class="dropdown-item" href="#">Upcoming</a></li>
            <li><a class="dropdown-item" href="#">Overdue</a></li>
            <li><a class="dropdown-item" href="#">Ongoing</a></li>
          </ul>
        </div>
      </div> -->
    </div>

    <div class="row content">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="./images/profile-img.jpg" alt="Profile" class="rounded-circle">
            <h2>Brian Wangila</h2>
            <h3>Software Dev</h3>
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

              <li class="nav-item">
                <button style="color: #2F5508;" class="nav-link" id="active2" data-bs-toggle="tab" data-bs-target="#profile-change-password">Account Settings</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">About</h5>
                <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8">Brian Wangila</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Company</div>
                  <div class="col-lg-9 col-md-8">Peak and Dale Solutions</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Job</div>
                  <div class="col-lg-9 col-md-8">Fullstack Software Developer</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Country</div>
                  <div class="col-lg-9 col-md-8">Kenya</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Address</div>
                  <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">admin@example.com</div>
                </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form>
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <img src="./images/profile-img.jpg" alt="Profile">
                      <div class="pt-2">
                        <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                        <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="fullName" type="text" class="form-control" id="fullName" value="Brian Wangila">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="about" class="form-control" id="about" rows="5" >Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="company" type="text" class="form-control" id="company" value="Peak and Dale Solutions">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="job" type="text" class="form-control" id="Job" value="Fullstack Software Developer">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="country" type="text" class="form-control" id="Country" value="Kenya">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="address" type="text" class="form-control" id="Address" value="A108 Adam Street, New York, NY 535022">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control" id="Phone" value="(436) 486-3538 x29071">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="Email" value="admin@example.com">
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


              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form>

                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="currentPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="newpassword" type="password" class="form-control" id="newPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirm Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-color btn-primary">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->

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
  import Footer from '../Footer.vue'

  export default {
    components: {
      Footer,
    },
    data(){
      
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

 
  .active2 {
    color: yellow;
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

 


</style>