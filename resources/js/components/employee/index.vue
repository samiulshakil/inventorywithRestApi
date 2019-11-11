<template>
  <div>

    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="text-center bg-success">
            <h3 class="text-white">All Employee</h3>
          </div>
        </div>
        <div class="col-sm-6 text-center">
          <h3 class="bg-success"><router-link to="/store-employee" class="text-center text-white">Add New Employee</router-link></h3>
        </div>
      </div>
  </div>


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <label for="">Search</label>
                <input type="text" class="form-control" v-model="searchTerm">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Photo</th>
                      <th>Email</th>
                      <th>Salary</th>
                      <th>Start date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="employee in filterSearch" :key="employee.id">
                      <td>{{employee.name}}</td>
                      <td><img :src="employee.photo" alt="" id="im_photo"></td>
                      <td>{{employee.email}}</td>
                      <td>{{employee.salary}}</td>
                      <td>{{employee.joining_date}}</td>
                      <td>
                        <router-link @click="editEmployee(employee.id)" :to="{name: 'edit-employee', params
                        :{id: employee.id} }" class="btn btn-sm btn-primary text-white">Edit</router-link>
                        <a @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger text-white">Delete</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->



  </div>
</template>

<script type="text/javascript">
  export default {
  mounted(){
    if (!User.loggedIn()) {
      this.$router.push({name: '/'})
    }
  },
  data() { 
    return {
      employees: [],
      searchTerm: ''
    }
  },
  computed: {
    filterSearch() {
         return this.employees.filter(employee => {
         return employee.email.match(this.searchTerm)
       })
     }
  },
  methods:{
    deleteEmployee(id) {
      Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          axios.delete('/api/employee/'+id)
          .then(()=>{
              this.employees = this.employees.filter(employee => {
                return employee.id != id
              })
          })
          .catch(() => {
            this.$router.push({ name: 'employee'})
          })
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })
    }
  }, 
  created() {
    axios.get('/api/employee/')
      .then(({data}) => (this.employees = data))
      .catch(error => {
      })
  }
}

</script>

<style type="text/css">
  router-link {
    color: #fff;
    font-size: 25px;
    text-align: center;
}
#im_photo {
  height: 40px;
  width: 40px;
}
</style>