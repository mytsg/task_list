<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import { onMounted, reactive, ref, watch } from 'vue';
import dayjs from 'dayjs'
import searchByDeadline from '@/Components/searchByDeadline.vue'
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    'posts': Array,
    // 'users' : Array,
})

const search =ref('');
const label = ref('');
const deadlineFromChild = ref('');
const isDeadline = ref('') //チェックボックス用
const deadline = ref('') //input用

const searchPost = () => {
    console.log('deadline inertia',deadline.value)
    Inertia.get(route('post.index',{
        search: search.value,
        label: label.value,
        deadline: deadline.value,
    }))
}

// onMounted(() => {
//     console.log(props.posts)
// })

</script>

<template>
    <Head title="タスク一覧" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                タスク一覧
            </h2>
            <div class="pt-4">
                <label for="isDeadline">
                    <input id="isDeadline" class="pl-4" type="checkbox" name="isDeadline" v-model="isDeadline">期限で絞り込む
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
                        <button type="button" @click="searchPost" class="text-white ml-4 p-2 bg-indigo-400 rounded">検索する</button>
                    </div>
                    </form>
                </div>
            </div>
            <template v-if="isDeadline">
                <section class="text-gray-600 body-font">
                    <div class="container my-4 py-4 px-5 border-gray-700 border-t-2 mx-auto">
                    <h2 class="tracking-widest text-xl title-font font-bold text-black mb-1">期間を指定して検索する</h2>
                        <span class="title-font font-medium text-indigo-600 p-1 pr-4 rounded">期限が今日から</span>
                        <input class="px-4" type="date" name="deadline" v-model="deadline">
                        <span class="title-font font-medium text-indigo-600 p-1 pl-4 rounded">までを表示</span>
                    </div>
                </section>
            </template>
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
                                <span class="flex-grow flex flex-col pl-3 py-3">
                                    <span class="title-font font-medium text-gray-900">ユーザー名：{{ post.user.name }}</span>
                                </span>
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