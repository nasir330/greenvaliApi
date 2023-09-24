<script setup>
import Swal from "sweetalert2";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm, router } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import { ref, watch } from "vue";

defineProps({
  venture_plots: {
    type: Object,
  },
});

// console.log(this.$props.venture_plots.data)

const form = useForm({});

const deletePlot = (deleteInfo) => {
  const alert = Swal.mixin({
    buttonsStyling: true,
  });
  alert
    .fire({
      title: "Are you sure want to delete" + deleteInfo.plot_name + "?",
      icon: "question",
      showCancelButton: true,
      confirmButtonText: '<i class="fa fa-solid fa-check"></i> Yes Delete',
      cancelButtonText: '<i class="fa fa-ban"></i> Not Yet',
    })
    .then((result) => {
      if (result.isConfirmed) {
        form.delete(route("venture-plots.destroy", deleteInfo));
      }
    });
};
let search = ref("");
watch(search, (value) => {
  router.get(route("venture-plots.index"), { search: value }, { preserveState: true });
});
</script>

<template>
  <Head title="Venture Plots" />

  <AuthenticatedLayout>
    <section class="content-header">
      <h1>Venture Plot<small> All Venture Plot</small></h1>
      <ol class="breadcrumb">
        <li>
          <Link :href="route('dashboard')"
            ><i class="fa fa-dashboard"></i> Dashboard</Link
          >
        </li>
        <li class="active">Venture Plot List</li>
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

          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Venture Plot List</h3>
              <div class="row" style="margin-top: 10px">
                <div class="col-md-3">
                  <input
                    class="form-control"
                    v-model="search"
                    placeholder="Search Venture"
                  />
                </div>
              </div>
            </div>

            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Venture Name</th>
                    <th>Plot Id</th>
                    <th>Plot Name</th>
                    <th>Plot Square Feet</th>
                    <th>Total Price</th>
                    <th>Customer</th>
                    <th>Saleman</th>
                    <th>Sale Date</th>
                    <th>Handover Date</th>
                    <th>Plot Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="vplot in venture_plots.data">
                    <td>{{ vplot.venture_info.venture_name }}</td>
                    <td>{{ vplot.plot_id }}</td>
                    <td>{{ vplot.plot_name }}</td>
                    <td>{{ vplot.number_of_square_feet }}</td>
                    <td>{{ vplot.total_price }}</td>
                    <td v-if="vplot.venture_plot_customer">
                      {{ vplot.venture_plot_customer.first_name }}
                      {{ vplot.venture_plot_customer.last_name }}
                    </td>
                    <td v-else></td>
                    <td v-if="vplot.venture_plot_staff">
                      {{ vplot.venture_plot_staff.first_name }}
                      {{ vplot.venture_plot_staff.last_name }}
                    </td>
                    <td v-else></td>
                    <td>{{ vplot.sale_date }}</td>
                    <td>{{ vplot.handover_date }}</td>
                    <td>
                      <span class="label label-success" v-if="vplot.plot_status"
                        >Sale</span
                      >
                      <span class="label label-warning" v-else>Unsale</span>
                    </td>
                    <td>
                      <Link
                        :href="route('venture-plots-add', vplot.venture_id)"
                        class="btn btn-social-icon"
                        ><i class="fa fa-plus"></i
                      ></Link>
                      <Link
                        :href="route('venture-plots.edit', vplot)"
                        class="btn btn-social-icon btn-dropbox"
                        ><i class="fa fa-edit"></i
                      ></Link>
                      <button
                        class="btn btn-social-icon btn-danger"
                        @click="deletePlot(vplot)"
                        style="margin-left: 5px"
                        v-if="vplot.plot_status == 0"
                      >
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <Pagination class="mt-6" :links="venture_plots.links" />
            </div>
          </div>
        </div>
      </div>
    </section>
  </AuthenticatedLayout>
</template>
