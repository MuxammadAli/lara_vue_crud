<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create new Contact</div>

                    <div class="card-body">
                        <form>
                            <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" v-model="name" placeholder="Name">
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" v-model="email" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" id="adress" v-model="adress" placeholder="adress">
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" class="form-control" id="phone" v-model="phone" placeholder="Enter Phone">
  </div>
  
  <button type="submit" @click.prevent="saveForm" class="btn btn-primary">Submit</button>
</form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Address</th>
      <th scope="col">Phone</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(form,index) in form.data" :key="form.id">
      <th scope="row">{{ index + 1 }}</th>
      <td>{{form.name}}</td>
      <td>{{form.email}}</td>
      <td>{{form.adress}}</td>
      <td>{{form.phone}}</td>
      <td>
          <button type="button" @click="editForm(form.id)" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              Edit
          </button>
          <button type="button" @click="deleteForm(form.id)" class="btn btn-danger">
              Delete
          </button>
      </td>
    </tr>
  </tbody>
</table>
  <pagination :data="form" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            </div>
        </div>
         <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form>
                            <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" v-model="editname" placeholder="Name">
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" v-model="editemail" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" id="adress" v-model="editadress" placeholder="adress">
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" class="form-control" id="phone" v-model="editphone" placeholder="Enter Phone">
  </div>
  
  <button type="submit" @click.prevent="updateForm" data-dismiss="modal" class="btn btn-success">Update</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    </div>
</template>

<script>
    export default {
        data() {
            return{
                form: {},
                id:'',
                name:'',
                email:'',
                adress:'',
                phone:'',
                editname: '',
                editemail: '',
                editadress: '',
                editphone: '',
            }
        },
        mounted() {
            this.getResults();
        },
        methods:{
            saveForm(){
                axios.post('save_form', {
                    name: this.name,
                    email: this.email,
                    adress: this.adress,
                    phone: this.phone
                })
                .then(response => {
                    this.name = '',
                    this.email = '',
                    this.adress = '',
                    this.phone = '',
                    this.getResults();
                });
            },
            getResults(page = 1) {
                axios.get('all_form?page=' + page)
                  .then(response => {
                      console.log(response.data)
                      this.form = response.data
                  }); 
            },
            editForm(id) {
                axios.get('edit_form/'+ id)
                .then(response => {
                    this.id = response.data.id;
                    this.editname = response.data.name;
                    this.editemail = response.data.email;
                    this.editadress = response.data.adress;
                    this.editphone = response.data.phone;
                });
            },
            updateForm() {
                axios.put('update_form', {
                    id: this.id,
                    name: this.editname,
                    email: this.editemail,
                    adress: this.editadress,
                    phone: this.editphone,
                })
                .then(response => {
                    this.getResults();
                });
            },
            deleteForm(id) {
                axios.delete('delete_form/' + id)
                .then(response => {
                    this.getResults();
                });
            }
        }
    }
</script>
