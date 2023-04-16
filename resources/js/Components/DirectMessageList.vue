<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import { onMounted, reactive, ref, watch } from 'vue';
import dayjs from 'dayjs'
import searchByDeadline from '@/Components/searchByDeadline.vue'
import { useRouter, useRoute, routerKey } from 'vue-router';

const props = defineProps({
    'users': Array,
})

console.log('props.users',props.users)
</script>

<template>
    <section class="bg-gray-50 text-gray-600 body-font">
        <div class="container px-5 mx-auto">
            <div v-for="user in props.users" :key="user.id" class="flex items-center mx-auto border-b pb-10 pt-10 mb-10 border-gray-200 sm:flex-row flex-col">
                <div class="mt-4 w-20 sm:mr-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0">
                </div>
                <div class="flex-grow text-left sm:mt-0">
                    <h2 class="text-gray-900 text-lg title-font font-medium mb-2">{{ user.name }}</h2>
                    <Link :href="route('directMessage.show',{directMessage: user.id})" class="mt-3 mb-4 text-indigo-500 inline-flex items-center">Start Chat
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>