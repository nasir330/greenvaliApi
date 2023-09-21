<script setup>
import { reactive } from 'vue'
import { Head, Link, router, useForm  } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({ 
    errors: Object,
    socialLinks: {
        type: Object
    },
});

const form = useForm({
    facebook: props.socialLinks.facebook.url,
    linkedin: props.socialLinks.linkedin.url,
    twitter: props.socialLinks.twitter.url,
    vimeo: props.socialLinks.vimeo.url,
});

function submit() {
    form.post('social-links', form);
}
</script>

<template>
    <Head title="Venture Edit" />

    <AuthenticatedLayout>
        <section class="content-header">
            <h1>
                Social Link <small> Edit Social Link</small>
            </h1>
            <ol class="breadcrumb">
                <li><Link :href="route('dashboard')"><i class="fa fa-dashboard"></i> Dashboard</Link></li>
                <li class="active">Social Link Update</li>
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
                            <h3 class="box-title">Social Link Form</h3>
                        </div>
                        <form @submit.prevent="submit">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="facebook" class="control-label">Facebook Url </label>
                                            <input type="url" v-model="form.facebook" class="form-control" id="facebook" placeholder="Enter Venture Name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="linkedin" class="control-label">Linkedin Url </label>
                                            <input type="url" v-model="form.linkedin" class="form-control" id="linkedin" placeholder="Enter Linkedin Name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="twitter" class="control-label">Twitter Url </label>
                                            <input type="url" v-model="form.twitter" class="form-control" id="twitter" placeholder="Enter Twitter Name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="vimeo" class="control-label">Vimeo Url </label>
                                            <input type="url" v-model="form.vimeo" class="form-control" id="vimeo" placeholder="Enter Vimeo Name">
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
