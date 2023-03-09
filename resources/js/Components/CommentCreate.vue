<template>
    <form @submit.prevent="storeComment">
    <div class="my-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
            <section class="text-gray-600 body-font">
                <h6 class="text-2xl pb-4">{{ props.post_id }}</h6>
                <textarea type="text" v-model="form.text" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out" placeholder="Type a Comment" />
                <button class="ml-4 bg-green-300 p-1 rounded btn btn-sm btn-primary">送信する</button>
            </section>
            </div>
        </div>
    </div>
    </form>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import { onMounted, reactive, ref } from 'vue';
import dayjs from 'dayjs'
import { getToday } from '@/common'
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    post_id: Number
})

const form = reactive({
    text: null,
    post_id: props.post_id,
})

console.log(form)

const storeComment = () => {
    Inertia.post('/post/comments',form)
}

</script>