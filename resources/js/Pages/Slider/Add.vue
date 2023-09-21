<script setup>
import { reactive } from 'vue'
import { Head, Link, router, useForm  } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({ errors: Object })

const form = reactive({
    image: ''
});

function submit() {
    router.post('/sliders', form)
}
</script>

<template>
    <Head title="Slider Add" />

    <AuthenticatedLayout>
        <section class="content-header">
            <h1>
                Slider <small> Create Slider</small>
            </h1>
            <ol class="breadcrumb">
                <li><Link :href="route('dashboard')"><i class="fa fa-dashboard"></i> Dashboard</Link></li>
                <li><Link :href="route('sliders.index')">Slider List</Link></li>
                <li class="active">Slider Add</li>
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
                            <h3 class="box-title">Slider Add Form</h3>
                        </div>
                        <form @submit.prevent="submit">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="sliderImage">Upload Slider Image</label>
                                            <input id="sliderImage" type="file" @input="form.image = $event.target.files[0]"  accept=".png, .jpg, .jpeg" required>
                                        </div>
                                        <span class="help-block" style="color: red;">{{ errors.image }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <Link :href="route('sliders.index')" class="btn btn-default">Cancel</Link>
                                <button type="submit" class="btn btn-info pull-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
