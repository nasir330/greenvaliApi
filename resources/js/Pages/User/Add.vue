<script setup>
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

import { reactive } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
  errors: Object,
  user_roles: Array,
});

const form = reactive({
  first_name: "",
  last_name: "",
  email: "",
  password: "password",
  role_id: 3,
  phone: "",
  address: "",
  start_date: "",
  end_date: "",
  active_status: 1,
  show_password: false,
});

const showPassword = () => {
  form.show_password = !form.show_password;
};

const checkUserRoleChange = () => {
  if (form.role_id != 2) {
    form.start_date = "";
    form.end_date = "";
  }
};

const formatDate = (date) => {
  if (date != null && date != "") {
    var d = new Date(date),
      month = "" + (d.getMonth() + 1),
      day = "" + d.getDate(),
      year = d.getFullYear();

    if (month.length < 2) {
      month = "0" + month;
    }
    if (day.length < 2) {
      day = "0" + day;
    }

    return [year, month, day].join("-");
  } else {
    return "";
  }
};

function submit() {
  let formData = {
    first_name: form.first_name,
    last_name: form.last_name,
    email: form.email,
    password: form.password,
    role_id: form.role_id,
    phone: form.phone,
    address: form.address,
    active_status: form.active_status,
    start_date: formatDate(form.start_date),
    end_date: formatDate(form.end_date),
  };
  router.post("/users", formData);
}
</script>

<template>
  <Head title="User Add" />

  <AuthenticatedLayout>
    <section class="content-header">
      <h1>Users <small> Create User</small></h1>
      <ol class="breadcrumb">
        <li>
          <Link :href="route('dashboard')"
            ><i class="fa fa-dashboard"></i> Dashboard</Link
          >
        </li>
        <li><Link :href="route('users.index')">User List</Link></li>
        <li class="active">User Create</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div
            class="alert alert-danger alert-dismissible"
            v-if="$page.props.flash.status == 'error'"
          >
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
              ×
            </button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            {{ $page.props.flash.message }}
          </div>
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">User Create Form</h3>
            </div>
            <form @submit.prevent="submit">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="userRole" class="control-label"
                        >Select User Role <span class="text-danger">*</span></label
                      >
                      <select
                        class="form-control"
                        @change="checkUserRoleChange"
                        v-model="form.role_id"
                        id="userRole"
                        required
                      >
                        <option :value="role.id" v-for="role in $page.props.user_roles">
                          {{ role.name }}
                        </option>
                      </select>
                      <span class="help-block" style="color: red">{{
                        errors.role_id
                      }}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="userFirstName" class="control-label"
                        >User First Name <span class="text-danger">*</span
                        ><span style="color: red">{{ errors.first_name }}</span></label
                      >
                      <input
                        type="text"
                        v-model="form.first_name"
                        class="form-control"
                        id="userFirstName"
                        placeholder="Enter User First Name"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="userLastName" class="control-label"
                        >User Last Name
                        <span style="color: red">{{ errors.last_name }}</span></label
                      >
                      <input
                        type="text"
                        v-model="form.last_name"
                        class="form-control"
                        id="userLastName"
                        placeholder="Enter User Last Name"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="userEmail" class="control-label"
                        >User Email <span class="text-danger">*</span
                        ><span style="color: red">{{ errors.email }}</span></label
                      >
                      <input
                        type="email"
                        v-model="form.email"
                        class="form-control"
                        id="userEmail"
                        placeholder="Enter User Email"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="userPassword" class="control-label"
                        >User Password <span class="text-danger">*</span
                        ><span style="color: red">{{ errors.password }}</span></label
                      >
                      <div class="input-group input-group-sm">
                        <input
                          :type="form.show_password ? 'text' : 'password'"
                          v-model="form.password"
                          class="form-control"
                          id="userPassword"
                          placeholder="Enter User Password"
                          required
                        />
                        <span class="input-group-btn" @click="showPassword">
                          <button type="button" class="btn btn-info btn-flat">
                            <i
                              :class="
                                form.show_password ? 'fa fa-eye-slash' : 'fa fa-eye'
                              "
                            ></i>
                          </button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="userPhone" class="control-label"
                        >User Phone Number <span class="text-danger">*</span>
                        <span style="color: red">{{ errors.phone }}</span></label
                      >
                      <input
                        type="text"
                        v-model="form.phone"
                        class="form-control"
                        id="userPhone"
                        placeholder="Enter User Phone Number"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="userAddress" class="control-label">User Address </label>
                      <textarea
                        class="form-control"
                        id="userAddress"
                        v-model="form.address"
                        rows="3"
                        placeholder="Enter User Address"
                      ></textarea>
                    </div>
                  </div>
                  <div class="col-md-6" v-if="form.role_id == 2">
                    <div class="form-group">
                      <label for="staffStartDate" class="control-label"
                        >Employee Start Date
                        <span style="color: red">{{ errors.start_date }}</span>
                      </label>
                      <!-- <input type="date" class="form-control datepicker" v-model="form.start_date" id="staffStartDate" placeholder="Enter Employee Start Date"> -->
                      <VueDatePicker
                        id="staffStartDate"
                        v-model="form.start_date"
                        placeholder="Enter Employee Start Date"
                        class="vue-date-picker"
                        :enable-time-picker="false"
                      />
                    </div>
                  </div>

                  <div class="col-md-6" v-if="form.role_id == 2">
                    <div class="form-group">
                      <label for="staffEndDate" class="control-label"
                        >Employee End Date
                        <span class="help-block" style="color: red">{{
                          errors.end_date
                        }}</span>
                      </label>
                      <!-- <input type="date" class="form-control datepicker" v-model="form.end_date" id="staffEndDate" placeholder="Enter Employee End Date"> -->
                      <VueDatePicker
                        id="staffStartDate"
                        v-model="form.end_date"
                        placeholder="Enter Employee End Date"
                        class="vue-date-picker"
                        :enable-time-picker="false"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="staffStatus" class="control-label"
                        >Select Active Status <span class="text-danger">*</span>
                        <span style="color: red">{{ errors.active_status }}</span></label
                      >
                      <select
                        class="form-control"
                        v-model="form.active_status"
                        id="staffStatus"
                        required
                      >
                        <option value="0">Not Active</option>
                        <option value="1">Active</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <Link :href="route('users.index')" class="btn btn-default">Cancel</Link>
                <button type="submit" class="btn btn-info pull-right">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </AuthenticatedLayout>
</template>
