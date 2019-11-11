
let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forgot = require('./components/auth/forgot.vue').default;
let logout = require('./components/auth/logout.vue').default;
//end authentication

let home = require('./components/home.vue').default;

//employee
let storeEmployee = require('./components/employee/create.vue').default;
let employee = require('./components/employee/index.vue').default;
let editEmployee = require('./components/employee/edit.vue').default;

//employee
let storeSupplier = require('./components/supplier/create.vue').default;
let supplier = require('./components/supplier/index.vue').default;
let editSupplier = require('./components/supplier/edit.vue').default;

//Category
let createCategory = require('./components/category/create.vue').default;
let category = require('./components/category/index.vue').default;
let editCategory = require('./components/category/edit.vue').default;



export const routes = [
  { path: '/', component: login, name: '/' }, 
  { path: '/register', component: register, name: 'register' },
  { path: '/forgot', component: forgot, name: 'forgot' },
  { path: '/logout', component: logout, name: 'logout' },
  { path: '/home', component: home, name: 'home' },

  //employee routes
  { path: '/employee', component: employee, name: 'employee' },
  { path: '/store-employee', component: storeEmployee, name: 'store-employee' },
  { path: '/edit-employee/:id', component: editEmployee, name: 'edit-employee' }, 

  //Supplier routes
  { path: '/supplier', component: supplier, name: 'supplier' },
  { path: '/store-supplier', component: storeSupplier, name: 'store-supplier' },
  { path: '/edit-supplier/:id', component: editSupplier, name: 'edit-supplier' },

  //Supplier routes
  { path: '/category', component: category, name: 'category' },
  { path: '/create-category', component: createCategory, name: 'create-category' },
  { path: '/edit-category/:id', component: editCategory, name: 'edit-category' },

]