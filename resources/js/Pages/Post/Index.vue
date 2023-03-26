<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import { onMounted, reactive, ref, watch } from 'vue';
import dayjs from 'dayjs'
import searchByDeadline from '@/Components/searchByDeadline.vue'
import { useRouter, useRoute, routerKey } from 'vue-router';

const props = defineProps({
    'posts': Array,
    'users' : Array,
})
const search =ref('');
const label = ref('');
const deadlineFromChild = ref('');
const deadline = ref('') //チェックボックス用

const searchPost = async() => {
    try{
        await axios.get(`/api/searchPost/?search=${search.value}&label=${label.value}&deadline=${deadlineFromChild.value}`)
        .then( res => {
            console.log(res.data)
            props.posts.value = res.data
        })
    } catch(e) {
        console.log(e.message)
    }
}

const getDeadline = (e) => {
    deadlineFromChild.value = e
    console.log('e',e)
    console.log('deadlineFromChild', deadlineFromChild.value)
}

</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                タスク一覧
            </h2>
            <div class="pt-4">
                <label for="deadline">
                    <input id="deadline" class="pl-4" type="checkbox" name="deadline" v-model="deadline">期限で絞り込む
                </label>
            </div>
            <div class="flex justify-between">
                <div class="searchComponent my-4">
                    <form>
                    <div class="flex">
                        <div class="mr-4">
                            タスク名：<input v-model="search" name="search" type="text">
                        </div>
                        <div class="">
                        ラベル：
                            <select v-model="label" name="label">
                                <option value="doing">Doing</option>
                                <option value="todo">ToDo</option>
                                <option value="done">Done</option>
                            </select>
                        </div>
                        <button @click="searchPost" class="text-white ml-4 p-2 bg-indigo-400 rounded">検索する</button>
                    </div>
                    </form>
                </div>
            </div>
            <div v-show="deadline">
                <searchByDeadline @deadline-up="getDeadline" />
            </div>
        </template>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -mx-4 -my-8 ">
                <div v-for="post in props.posts" class="py-8 px-4 lg:w-1/3 border-2 border-gray bg-white">
                    <a :href="route('post.show',{ post: post.id })">
                    <div class="h-full flex items-start">
                        <div class="flex-grow pl-6">
                            <h2 class="tracking-widest text-xl title-font font-bold text-indigo-500 mb-1">{{ post.label }}</h2>
                            <h1 class="title-font text-xl font-medium text-gray-900 mb-3">{{ post.title }}</h1>
                            <p class="leading-relaxed mb-5">{{ post.content }}</p>
                            <a class="items-center">
                                <div v-for="user in props.users">
                                    <span v-if="user.id == post.user_id" class="flex-grow flex flex-col pl-3 py-3">
                                        <span class="title-font font-medium text-gray-900">ユーザー名：{{ user.name }}</span>
                                    </span>
                                </div>
                                <span class="flex-grow flex flex-col pl-3 pb-3">
                                    <span class="title-font font-medium text-gray-900">作成日：{{ dayjs(post.created_at).format('YYYY年MM月DD日') }}</span>
                                </span>
                                <span v-if="post.deadline" class="mt-3 pl-3">
                                    <span class="title-font font-medium text-white bg-red-400 p-1 rounded">期限　：{{ dayjs(post.deadline).format('YYYY年MM月DD日') }}</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </a>
                </div>
            </div>
        </div>
    </section>
    </BreezeAuthenticatedLayout>
</template>