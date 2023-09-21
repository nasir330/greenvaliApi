<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
    sliders: {
        type: Array
    }
})

const form = useForm({});

const deleteSlider = (deleteInfo) => {
    const alert = Swal.mixin({
        buttonsStyling: true
    });
    alert.fire({
        title: 'Are you sure want to delete slider ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: '<i class="fa fa-solid fa-check"></i> Yes Delete',
        cancelButtonText: '<i class="fa fa-ban"></i> Not Yet',
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('sliders.destroy', deleteInfo));
        }
    });
};
</script>

<template>
    <Head title="Slider List" />

    <AuthenticatedLayout>
        <section class="content-header">
            <h1>
                Slider <small> All Sliders</small>
            </h1>
            <ol class="breadcrumb">
                <li><Link :href="route('dashboard')"><i class="fa fa-dashboard"></i> Dashboard</Link></li>
                <li class="active">Slider List</li>
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
                            <h3 class="box-title">Slider List</h3>
                            <div class="box-tools">
                                <Link :href="route('sliders.create')" type="button" class="btn btn-primary btn-flat btn-xs pull-right">Add Slider</Link>
                            </div>
                        </div>
                        
                        <div class="box-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Slider Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="slider in sliders">
                                        <td>
                                            <img class="img-responsive" style="width: 80px" :src="slider.image" alt="Photo" />
                                        </td>
                                        <td>
                                            <button class="btn btn-social-icon btn-danger" @click="deleteSlider(slider)" style="margin-left: 5px"><i class="fa fa-trash"></i></button>
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