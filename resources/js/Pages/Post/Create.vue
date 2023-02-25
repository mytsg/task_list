<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import axios from 'axios';
    import { onMounted, reactive, ref } from 'vue';
    import dayjs from 'dayjs'
    import { getToday } from '@/common'
    import { Inertia } from '@inertiajs/inertia';

    const props = defineProps({
        'loginUser': Object,
    })
    
    const form = reactive({
        label: null,
        title: null,
        content: null,
        deadline: null,
        user_id: props.loginUser.id,
    })
    const createPost = () => {
        Inertia.post('/post',form)
    }

    onMounted(() => {
        console.log(props.loginUser)
        form.date = getToday()
    })
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                新規作成
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
                                    <form @submit.prevent="createPost">
                                        <div class="h-full bg-gray-100 p-8 rounded">
                                        <div class="flex justify-between">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="block w-5 h-5 text-gray-400 mb-4" viewBox="0 0 975.036 975.036">
                                                <path d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z"></path>
                                            </svg>
                                            <span>{{ dayjs().format('YYYY年MM月DD日') }}</span>
                                        </div>
                                        <div class="flex flex-row">
                                            <div>
                                            <span class="flex-grow flex text-xl title-font font-bold text-indigo-500 mb-1">ラベル</span>
                                            </div>
                                            <div class="ml-4">
                                                <select name="label" v-model="form.label">
                                                    <option value="doing">Doing</option>
                                                    <option value="todo">ToDo</option>
                                                    <option value="done">Done</option>
                                                </select>
                                            </div>
                                        </div>
                                        <h1 class="title-font text-2xl font-medium text-gray-900 mb-3 mt-3">タイトル</h1>
                                        <input v-model="form.title" type="text" id="title" name="title" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        <p class="leading-relaxed mb-2 mt-6">内容</p>
                                        <textarea v-model="form.content" id="content" name="conten" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                                        <div class="flex justify-between">
                                            <div>
                                                期限：<input type="date" v-model="form.deadline">
                                                <a class="inline-flex items-center my-4">
                                                    <span class="flex-grow flex flex-col pl-4">
                                                    <span class="title-font font-medium text-gray-900">作成者：{{ props.loginUser.name }}</span>
                                                    </span>
                                                </a>
                                            </div>
                                            <button class="mt-8 place-self-auto text-white p-4 bg-green-400 rounded">追加する</button>
                                            
                                        </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout> 
</template>