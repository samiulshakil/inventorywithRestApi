<template>
  <div>

    <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <router-link to="/supplier" class="btn btn-sm btn-info mt-5" style="text-align: right">All Supplier</router-link>
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Update Supplier</h1>
              </div>
              <form class="user" @submit.prevent="supplierUpdate">
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Name" v-model="form.name">
                    <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" v-model="form.email">
                  <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                </div>                
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="phone" v-model="form.phone">
                  <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleInputPassword" placeholder="address" v-model="form.address">
                    <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="shop_name" v-model="form.shop_name">
                    <small class="text-danger" v-if="errors.shop_name">{{ errors.shop_name[0] }}</small>
                  </div>
                </div>                              

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="file" class="form-control btn btn-info" @change="onFileSelected">
                    <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
                  </div>
                  <div class="col-sm-6">
                    <img :src="form.photo" alt="img" style="height: 40px; width: 40px;">
                  </div>
                </div>
                  <button class="btn btn-primary btn-user btn-block" type="submit">
                      Update
                  </button>
              </form>
              <hr>
              <h5>Submitted yesterday at 2.30pm</h5>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  </div>
</template>

<script type="text/javascript">
  export default {
  mounted(){
    if (!User.loggedIn()) {
      this.$router.push({name: '/'})
    }
  },
  data(){
    return {
      form: {
        name: '',
        email: '',
        address: '',
        phone: '',
        shop_name: '',
        photo: '',
        new_photo: '',

      }, 
      errors: {

      },
    }
  }, 
  created(){
    let id = this.$route.params.id
    axios.get('/api/supplier/'+id)
    .then(({data}) => (this.form = data))
    .catch(console.log('error'))
  },
  methods: {
    onFileSelected(event) {
      let file = event.target.files[0];
      if (file.size > 1048770) {
        Notification.image_validation();
      }else {
        let reader = new FileReader();
        reader.onload = event => {    
          this.form.new_photo = event.target.result;
        }
        reader.readAsDataURL(file)
      }
    },

    supplierUpdate() {
      let ids = this.$route.params.id
      axios.patch('/api/supplier/'+ids, this.form)
      .then( () => {
        this.$router.push({ name: 'supplier' })
        Notification.success();
      })
      .catch(error => this.errors = error.response.data.errors)
    }
  }
}
</script>

<style type="text/css">
  
</style>