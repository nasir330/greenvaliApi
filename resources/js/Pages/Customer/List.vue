<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

defineProps({
    customers: {
        type: Array
    }
})

const form = useForm({});

const deleteUser = (deleteInfo) => {
    const alert = Swal.mixin({
        buttonsStyling: true
    });
    alert.fire({
        title: 'Are you sure'+ deleteInfo.customer_name +'?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: '<i class="fa-solid fa-check"></i> Yes, delete',
        cancelButtonText: '<i class="fa-solid fa-ban"></i> Yes, delete',
    }).then((result) => {
        if(result.isConfirmed) {
            form.delete(route('customers.destroy', deleteInfo));
        }
    });
    // console.log(deleteId)
    // if(confirm("Are you sure you want to Delete")) {
    //     form.delete(route('customers.destroy', deleteInfo));
    // }
};
</script>

<template>
    <Head title="Customer List" />

    <AuthenticatedLayout>
        <section class="content-header">
            <h1>
                Customer <small> All Customers</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Customer List</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-success alert-dismissible" v-if="$page.props.flash.status == 'success'">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Success</h4>
                        {{ $page.props.flash.message }}
                    </div>

                    <div class="alert alert-danger alert-dismissible" v-if="$page.props.flash.status == 'error'">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                        {{ $page.props.flash.message }}
                    </div>

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Customer List</h3>
                            <div class="box-tools">
                                <Link :href="route('customers.create')" type="button" class="btn btn-primary btn-flat btn-xs pull-right">Add Customer</Link>
                            </div>
                        </div>
                        
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Customer Phone Number</th>
                                        <th>Customer Address</th>
                                        <th>Create Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="customer in customers">
                                        <td>{{ customer.customer_name  }}</td>
                                        <td>{{ customer.customer_phone }}</td>
                                        <td>{{ customer.customer_address }}</td>
                                        <td>{{ customer.created_at }}</td>
                                        <td>
                                            <Link :href="route('customers.edit', customer)" class="btn btn-social-icon btn-dropbox"><i class="fa fa-edit"></i></Link>
                                            <button class="btn btn-social-icon btn-danger" @click="deleteUser(customer)" style="margin-left: 5px"><i class="fa fa-trash"></i></button>
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
