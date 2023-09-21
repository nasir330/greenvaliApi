<script setup>
import { reactive } from 'vue'
import { Head, Link, router, useForm  } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Swal from 'sweetalert2';

const ok = (message) => {
    form.reset();
    Swal.fire({ title: message, icon: 'success'});
}

defineProps({ errors: Object })



const form = reactive({
    customer_name: '',
    customer_phone: '',
    customer_address: ''
});

function submit() {
    router.post('/customers', form)
}
</script>

<template>
    <Head title="Customer Add" />

    <AuthenticatedLayout>
        <section class="content-header">
            <h1>
                Customer <small> Create Customer</small>
            </h1>
            <ol class="breadcrumb">
                <li><Link :href="route('dashboard')"><i class="fa fa-dashboard"></i> Dashboard</Link></li>
                <li><Link :href="route('customers.index')">Customer List</Link></li>
                <li class="active">Customer Create</li>
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
                            <h3 class="box-title">Customer Create Form</h3>
                        </div>
                        <form @submit.prevent="submit">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="customerNae" class="control-label">Customer Name <span class="text-danger">*</span></label>
                                            <input type="text" v-model="form.customer_name" class="form-control" id="customerNae" placeholder="Enter Customer Name" required>
                                        </div>
                                        <span class="help-block" style="color: red;">{{ errors.customer_name }}</span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="customerPhone" class="control-label">Customer Phone <span class="text-danger">*</span></label>
                                            <input type="number" v-model="form.customer_phone" class="form-control" id="customerPhone" placeholder="Enter Customer Phone" required>
                                        </div>
                                        <span class="help-block" style="color: red;">{{ errors.customer_phone }}</span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group" for="customerAddress">
                                            <label>Customer Address </label>
                                            <textarea class="form-control" id="customerAddress" v-model="form.customer_address" rows="3" placeholder="Enter Customer Address"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <Link :href="route('customers.index')" class="btn btn-default">Cancel</Link>
                                <button type="submit" class="btn btn-info pull-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
