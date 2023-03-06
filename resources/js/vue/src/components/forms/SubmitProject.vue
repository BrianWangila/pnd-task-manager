<template>
  <main>
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-dark" id="ModalLabel">Add New Project</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form @submit.prevent="addProject">
              <div class="mb-3">
                  <label for="projectTitle" class="form-label">Project/Brief Title</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="data_input.project_title"/>
                  <div id="emailHelp" class="form-text">Write a short title of the project.</div>
              </div>
              <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Deadline</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" v-model="data_input.deadline"/>
              </div>
              <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Description</label>
                  <textarea type="text" rows="5" class="form-control" id="exampleInputPassword1" v-model="data_input.description"></textarea>
              </div>
              <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
            </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
      </div>
  </main>
</template>