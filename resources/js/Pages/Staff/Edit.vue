<script setup>
import { reactive } from 'vue'
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({ 
    errors: Object,
    staff: {
        type: Object
    },
});

const form = useForm({
    staff_name: props.staff.staff_name,
    staff_phone: props.staff.staff_phone,
    staff_address: props.staff.staff_address,
    staff_start_date: props.staff.staff_start_date,
    staff_end_date: props.staff.staff_end_date,
    staff_active_status: props.staff.staff_active_status
});

function submit() {
    form.put(route('staffs.update', props.staff.id))
}
</script>

<template>
    <Head title="Staff Edit" />

    <AuthenticatedLayout>
        <section class="content-header">
            <h1>
                Staff <small> Edit Staff</small>
            </h1>
            <ol class="breadcrumb">
                <li><Link :href="route('dashboard')"><i class="fa fa-dashboard"></i> Dashboard</Link></li>
                <li><Link :href="route('staffs.index')">Staff List</Link></li>
                <li class="active">Staff Edit</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-danger alert-dismissible" v-if="$page.props.flash.status == 'error'">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                        {{ $page.props.flash.message }}
                    </div>
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Staff Edit Form</h3>
                        </div>
                        <form @submit.prevent="submit">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="staffName" class="control-label">Staff Name <span class="text-danger">*</span></label>
                                            <input type="text" v-model="form.staff_name" class="form-control" id="staffName" placeholder="Enter Staff Name" required>
                                        </div>
                                        <span class="help-block" style="color: red;">{{ errors.staff_name }}</span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="staffPhone" class="control-label">Staff Phone <span class="text-danger">*</span></label>
                                            <input type="number" v-model="form.staff_phone" class="form-control" id="staffPhone" placeholder="Enter Staff Phone" required>
                                        </div>
                                        <span class="help-block" style="color: red;">{{ errors.staff_phone }}</span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="staffAddress" class="control-label">Staff Address </label>
                                            <textarea class="form-control" id="staffAddress" v-model="form.staff_address" rows="3" placeholder="Enter Staff Address"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="staffStartDate" class="control-label">Staff Start Date </label>
                                            <input type="date" class="form-control datepicker" v-model="form.staff_start_date" id="staffStartDate" placeholder="Enter Staff Start Date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="staffEndDate" class="control-label">Staff End Date </label>
                                            <input type="date" class="form-control datepicker" v-model="form.staff_end_date" id="staffEndDate" placeholder="Enter Staff End Date">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="staffStatus" class="control-label">Select Active Status <span class="text-danger">*</span></label>
                                            <select class="form-control" v-model="form.staff_active_status" id="staffStatus" required>
                                                <option value="0">Not Active</option>
                                                <option value="1">Active</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <Link :href="route('staffs.index')" class="btn btn-default">Cancel</Link>
                                <button type="submit" class="btn btn-info pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
