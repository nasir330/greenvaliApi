<script setup>
import Topbar from '@/Components/Topbar.vue';
import Sidebar from '@/Components/Sidebar.vue';
import Footer from '@/Components/Footer.vue';

</script>

<template>
    <div class="wrapper">
        <Topbar />
        <Sidebar />
        <div class="content-wrapper">
            <slot />
        </div>
        <Footer />
    </div>
</template>
