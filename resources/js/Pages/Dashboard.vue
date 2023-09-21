<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
  summary: {
    type: Object,
  },
});
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <section class="content-header">
      <h1>Dashboard <small>Control panel</small></h1>
      <ol class="breadcrumb">
        <li>
          <Link :href="route('dashboard')"><i class="fa fa-dashboard"></i> Home</Link>
        </li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ summary.numberOfAdmin }}</h3>
              <p>Admin User</p>
            </div>
            <div class="icon">
              <i class="fa fa fa-users"></i>
            </div>
            <Link :href="route('users.index')" class="small-box-footer"
              >All Admin List <i class="fa fa-arrow-circle-right"></i
            ></Link>
          </div>
        </div>

        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ summary.numberOfCustomers }}</h3>
              <p>Total Customer</p>
            </div>
            <div class="icon">
              <i class="fa fa fa-users"></i>
            </div>
            <Link :href="route('users.index')" class="small-box-footer"
              >All Customer List <i class="fa fa-arrow-circle-right"></i
            ></Link>
          </div>
        </div>

        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ summary.numberOfStaff }}</h3>
              <p>Total Staff</p>
            </div>
            <div class="icon">
              <i class="fa fa-child"></i>
            </div>
            <Link :href="route('users.index')" class="small-box-footer"
              >All Staff List <i class="fa fa-arrow-circle-right"></i
            ></Link>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ summary.numberOfVentures }}</h3>
              <p>Number of Venture</p>
            </div>
            <div class="icon">
              <i class="fa fa-bank"></i>
            </div>
            <Link :href="route('ventures.index')" class="small-box-footer"
              >Venture List <i class="fa fa-arrow-circle-right"></i
            ></Link>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ summary.numberOfVenturePlots }}</h3>
              <p>Total Venture Plots</p>
            </div>
            <div class="icon">
              <i class="fa fa fa-bars"></i>
            </div>
            <Link :href="route('venture-plots.index')" class="small-box-footer"
              >All Venture Plots <i class="fa fa-arrow-circle-right"></i
            ></Link>
          </div>
        </div>
      </div>
    </section>
  </AuthenticatedLayout>
</template>
