<template>
  <div>

    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="text-center bg-success">
            <h3 class="text-white">All Supplier</h3>
          </div>
        </div>
        <div class="col-sm-6 text-center">
          <h3 class="bg-success"><router-link to="/store-supplier" class="text-center text-white">Add New Supplier</router-link></h3>
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
                      <th>Shop nmae</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="supplier in filterSearch" :key="supplier.id">
                      <td>{{supplier.name}}</td>
                      <td><img :src="supplier.photo" alt="" id="im_photo"></td>
                      <td>{{supplier.email}}</td>
                      <td>{{supplier.shop_name}}</td>
                      <td>
                        <router-link :to="{name: 'edit-supplier', params
                        :{id: supplier.id} }" class="btn btn-sm btn-primary text-white">Edit</router-link>
                        <a @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger text-white">Delete</a>
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
  created() {
    axios.get('/api/supplier/')
      .then(({data}) => (this.suppliers = data))
      .catch(error => {
      })
  },
  data() { 
    return {
      suppliers: [],
      searchTerm: ''
    }
  },
  computed: {
    filterSearch() {
         return this.suppliers.filter(supplier => {
         return supplier.email.match(this.searchTerm)
       })
     }
  },
  methods:{
    deleteSupplier(id) {
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
          axios.delete('/api/supplier/'+id)
          .then(()=>{
              this.suppliers = this.suppliers.filter(supplier => {
                return supplier.id != id
              })
          })
          .catch(() => {
            this.$router.push({ name: 'supplier'})
          })
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })
    }
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