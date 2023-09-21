<script setup>
import Swal from 'sweetalert2';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { ref, watch } from "vue";


defineProps({
    ventures: {
        type: Array
    }
})

const form = useForm({});

const deleteVenture = (deleteInfo) => {    
    const alert = Swal.mixin({
        buttonsStyling: true
    });
    alert.fire({
        title: 'Are you sure want to delete' + deleteInfo.id + '?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: '<i class="fa fa-solid fa-check"></i> Yes Delete',
        cancelButtonText: '<i class="fa fa-ban"></i> Not Yet',
    }).then((result) => {
        if (result.isConfirmed) {
            console.log(deleteInfo);
            form.delete(route('delete.ventures', deleteInfo.id));
        }
    });
};
let search = ref('');
watch(search, (value) => {
    router.get( route('ventures.index'),
        { search: value },
        {preserveState: true,}
    );
});


    


</script>

<template>
    <Head title="Venture List" />

    <AuthenticatedLayout>
        <section class="content-header">
            <h1>
                Venture <small> All Ventures</small>
            </h1>
            <ol class="breadcrumb">
                <li><Link :href="route('dashboard')"><i class="fa fa-dashboard"></i> Dashboard</Link></li>
                <li class="active">Venture List</li>
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
                            <h3 class="box-title">Venture List</h3>                            
                            <div class="box-tools">
                                <Link :href="route('ventures.create')" type="button" class="btn btn-primary btn-flat btn-xs pull-right">Add Venture</Link>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-3">
                                    <input class="form-control"  v-model="search" placeholder="Search Venture" />
                                </div>
                            </div>
                        </div>
                       
                        <div class="box-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Venture Name</th>
                                        <th>Number of Plot</th>
                                        <th>Sqaure Feet Price</th>
                                        <th>Venture Brochure</th>
                                        <th>Venture Layout</th>
                                        <th>Venture Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="venture in ventures">
                                        <td>{{ venture.venture_name  }}</td>
                                        <td>{{ venture.number_of_plot }}</td>
                                        <td>{{ venture.per_square_feet_price }}</td>
                                        <td>
                                            <a :href="venture.venture_brochure" class="btn btn-social-icon btn-bitbucket" download v-if="venture.venture_brochure"><i class="fa fa-download"></i></a>
                                            <p v-else>No Brochure Uploaded</p>
                                        </td>
                                        <td>
                                            <a :href="venture.venture_layout" v-if="venture.venture_layout" download>
                                                <img class="img-responsive" style="width: 80px" :src="venture.venture_layout" alt="Photo" />
                                            </a>
                                            <p v-else>No Image Uploaded</p>
                                        </td>
                                        <td v-if="venture.active_status"><span class="label label-success">Active</span></td>
                                        <td v-else><span class="label label-danger">Inactive</span></td>
                                        <td>
                                            <Link :href="route('ventures.edit', venture)" class="btn btn-social-icon btn-dropbox"><i class="fa fa-edit"></i></Link>
                                            <button class="btn btn-social-icon btn-danger" @click="deleteVenture(venture)" style="margin-left: 5px"><i class="fa fa-trash"></i></button>
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
