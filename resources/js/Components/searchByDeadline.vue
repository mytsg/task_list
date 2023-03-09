<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import { onMounted, reactive, ref } from 'vue';
import dayjs from 'dayjs'
import { Inertia } from '@inertiajs/inertia';
import { useRouter, useRoute } from 'vue-router';

// const route = useRoute()

// const searchByDeadline = async() => {
//   await axios.get('/api/serarchByDeadline/')
// })
</script>

<template>
    <section class="text-gray-600 body-font">
        <div class="container my-4 py-4 px-5 border-gray-700 border-t-2 mx-auto">
          期限で検索{{ route.path }}
          <h2 class="tracking-widest text-xl title-font font-bold text-black mb-1">期間を指定して検索する</h2>
          <form @submit.prevrnt="searchByDeadline">
            <span class="title-font font-medium text-indigo-600 p-1 pr-4 rounded">期限が今日から</span>
            <input class="px-4" type="date" name="deadline" v-model="deadline">
            <span class="title-font font-medium text-indigo-600 p-1 pl-4 rounded">までを</span>
            <button class="ml-1 bg-indigo-400 p-1 text-white rounded btn btn-sm btn-primary">表示</button>
          </form>
        </div>
    </section>
</template>