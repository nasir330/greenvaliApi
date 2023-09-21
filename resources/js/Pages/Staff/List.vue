<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    staffs: {
        type: Array
    }
})

const form = useForm({});

const deleteUser = (deleteInfo) => {
    // console.log(deleteId)
    if(confirm("Are you sure you want to Delete")) {
        form.delete(route('staffs.destroy', deleteInfo));
    }
};
</script>

<template>
    <Head title="Staff List" />

    <AuthenticatedLayout>
        <section class="content-header">
            <h1>
                Staff <small> All Staff</small>
            </h1>
            <ol class="breadcrumb">
                <li><Link :href="route('dashboard')"><i class="fa fa-dashboard"></i> Dashboard</Link></li>
                <li class="active">Staff List</li>
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
                            <h3 class="box-title">Staff List</h3>
                            <div class="box-tools">
                                <Link :href="route('staffs.create')" type="button" class="btn btn-primary btn-flat btn-xs pull-right">Add Staff</Link>
                            </div>
                        </div>
                        
                        <div class="box-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Staff Name</th>
                                        <th>Staff Phone Number</th>
                                        <th>Staff Address</th>
                                        <th>Staff Start Date</th>
                                        <th>Staff End Date</th>
                                        <th>Staff Active Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="staff in staffs">
                                        <td>{{ staff.staff_name  }}</td>
                                        <td>{{ staff.staff_phone }}</td>
                                        <td>{{ staff.staff_address }}</td>
                                        <td>{{ staff.staff_start_date }}</td>
                                        <td>{{ staff.staff_end_date }}</td>
                                        <td v-if="staff.staff_active_status"><span class="label label-success">Active</span></td>
                                        <td v-else><span class="label label-danger">Inactive</span></td>
                                        <td>
                                            <Link :href="route('staffs.edit', staff)" class="btn btn-social-icon btn-dropbox"><i class="fa fa-edit"></i></Link>
                                            <button class="btn btn-social-icon btn-danger" @click="deleteUser(staff)" style="margin-left: 5px"><i class="fa fa-trash"></i></button>
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
