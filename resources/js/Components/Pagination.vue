<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    links: {
        type: Array,
    }
});
</script>

<template>
    <div v-if="links.length > 3">
        <ul class="pagination pagination-sm no-margin pull-right">
            <template v-for="(link, p) in links" :key="p">
                <li v-if="link.url === null">
                    <Link v-html="link.label"></Link>
                </li>
                <li v-else>
                    <Link  :class="{ 'bg-blue-700 text-white': link.active }" :href="link.url" v-html="link.label"></Link>
                </li>
            </template>
        </ul>
    </div>
</template>