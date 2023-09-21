<script setup inherit-attrs="false">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Green</b>Valley</a>
        </div>
        <div class="box box-primary">
            <p class="login-box-msg">Sign in to start</p>
            <slot />
        </div>
    </div>
</template>
