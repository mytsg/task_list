<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import CommentCreate from '@/Components/CommentCreate.vue';
import CommentDisp from '@/Components/CommentDisp.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import { onMounted, reactive, ref, watch } from 'vue';
import dayjs from 'dayjs';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    'post': Object,
    'user': Object,
})

const deletePost = id => {
    Inertia.delete(route('post.destroy',{ post: id }))
}


</script>

<template>
    <Head title="タスク詳細" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                タスク詳細
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <section class="text-gray-600 body-font">
                            <div class="container px-5 py-8 mx-auto">
                                <div class="flex flex-wrap ">
                                    <div class="p-4 md:w-6/7 w-full">
                                        <div class="h-full bg-gray-100 p-8 rounded">
                                        <div class="flex justify-between">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="block w-5 h-5 text-gray-400 mb-4" viewBox="0 0 975.036 975.036">
                                                <path d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z"></path>
                                            </svg>
                                            <div>
                                            <Link v-if="post.user_id === props.user.id" :href="route('post.edit',{ post: props.post.id })">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                    <path d="M16 5l3 3"></path>
                                                </svg>
                                            </Link>
                                            </div>
                                        </div>
                                        <span class="flex-grow flex flex-col text-xl title-font font-bold text-indigo-500 mb-1">{{ post.label }}</span>
                                        <h1 class="title-font text-2xl font-medium text-gray-900 mb-3">{{ post.title }}</h1>
                                        <p class="leading-relaxed mb-6">{{ post.content }}</p>
                                        <span class="flex-grow flex flex-col">{{ dayjs(post.created_at).format('YYYY年MM月DD日') }}</span>
                                        <a class="inline-flex items-center my-4">
                                            <span class="flex-grow flex flex-col pl-4">
                                            <span class="title-font font-medium text-gray-900">作成者：{{ props.user.name }}</span>
                                            </span>
                                        </a>
                                        <a class="inline-flex items-center my-4 ">
                                            <span class="flex-grow flex flex-col pl-4">
                                            <span class="title-font font-medium text-white p-1 rounded bg-red-500">期限：{{ dayjs(props.post.deadline).format('YYYY年MM月DD日') }}</span>
                                            </span>
                                        </a>
                                        <div>
                                        <button v-if="post.user_id === user.id" @click="deletePost(post.id)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z" stroke-width="0" fill="currentColor"></path>
                                            <path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" stroke-width="0" fill="currentColor"></path>
                                            </svg>
                                        </button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <CommentDisp :post_id="post.id" :user="props.user"/>
                <CommentCreate :post_id="post.id" />
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>