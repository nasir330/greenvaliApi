<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />
        <form @submit.prevent="submit">
          <div class="form-group">
            <input type="email" v-model="form.email" class="form-control" placeholder="Email">
            <span class="help-block" style="color: red;">{{ form.errors.email }}</span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" v-model="form.password" class="form-control" placeholder="Password">
            <span class="help-block" style="color: red;">{{ form.errors.password }}</span>
          </div>
          
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
        </form>
    </GuestLayout>
</template>
