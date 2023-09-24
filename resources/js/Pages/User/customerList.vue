<script setup>
import Swal from "sweetalert2";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
  users: {
    type: Array,
  },
});

const form = useForm({});

const deleteUser = (deleteInfo) => {
  const alert = Swal.mixin({
    buttonsStyling: true,
  });
  alert
    .fire({
      title: "Are you sure?. Want to Delete" + deleteInfo.email,
      icon: "question",
      showCancelButton: true,
      confirmButtonText: '<i class="fa fa-solid fa-check"></i> Yes, delete',
      cancelButtonText: '<i class="fa fa-ban"></i> Not, Yet',
    })
    .then((result) => {
      if (result.isConfirmed) {
        form.delete(route("users.destroy", deleteInfo));
      }
    });
};

const getUserRoleClass = (userInfo) => {
  if (userInfo.role_id == 1) {
    return "label label-success";
  } else if (userInfo.role_id == 2) {
    return "label label-warning";
  } else if (userInfo.role_id == 3) {
    return "label label-info";
  }
};
</script>

<template>
  <Head title="User List" />

  <AuthenticatedLayout>
    <section class="content-header">
      <h1>Customer <small> All Customer</small></h1>
      <ol class="breadcrumb">
        <li>
          <Link :href="route('dashboard')"
            ><i class="fa fa-dashboard"></i> Dashboard</Link
          >
        </li>
        <li class="active">Customer List</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div
            class="alert alert-success alert-dismissible"
            v-if="$page.props.flash.status == 'success'"
          >
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
              ×
            </button>
            <h4><i class="icon fa fa-check"></i> Success</h4>
            {{ $page.props.flash.message }}
          </div>

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
              <h3 class="box-title">Customer List</h3>
              <div class="box-tools">
                <Link
                  :href="route('users.create')"
                  type="button"
                  class="btn btn-primary btn-flat btn-xs pull-right"
                  >Add User</Link
                >
              </div>
            </div>

            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>User Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Active Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in users">
                    <td>{{ user.first_name }}</td>
                    <td>{{ user.last_name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.user_info.phone }}</td>
                    <td>{{ user.user_info.address }}</td>
                    <td>
                      <span :class="getUserRoleClass(user)">{{
                        user.user_role.name
                      }}</span>
                    </td>
                    <td>{{ user.user_info.start_date }}</td>
                    <td>{{ user.user_info.end_date }}</td>
                    <td>
                      <span class="label label-success" v-if="user.active_status"
                        >Active</span
                      >
                      <span class="label label-danger" v-else>Inactive</span>
                    </td>
                    <td>
                      <Link
                        :href="route('users.edit', user)"
                        class="btn btn-social-icon btn-dropbox"
                        ><i class="fa fa-edit"></i
                      ></Link>
                      <button
                        class="btn btn-social-icon btn-danger"
                        @click="deleteUser(user)"
                        style="margin-left: 5px"
                        v-if="user.user_role.id != 1"
                      >
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </AuthenticatedLayout>
</template>
