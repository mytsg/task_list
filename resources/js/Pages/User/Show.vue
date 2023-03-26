<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import axios from 'axios';
    import { onMounted, reactive, ref } from 'vue';
    import dayjs from 'dayjs'

    const props = defineProps({
        'posts': Array,
        'user': Object
    })

    const label = ref('')
    const search = ref('')
    const getPostForUser = async() =>  {
        try {
            await axios.get(`/api/getPostForUser/?search=${search.value}&&label=${label.value}&&userId=${props.user.id}`)
            .then( res =>{
                console.log('searchPost',res.data)
                console.log('search',search.value)
                // props.posts = res.data
            } )
        } catch(e) {
            console.log('searchPost',e.message)
        }
    }
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                
            </h2>
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
                    <input type="hidden" name="userId" value="{{ user.id }}">
                </div>
                <button @click="getPostForUser" class="text-white ml-4 p-2 bg-indigo-400 rounded">検索する</button>
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
                                    <span class="flex-grow flex flex-col pl-3 py-3">
                                        <span class="title-font font-medium text-gray-900">ユーザー名：{{ props.user.name }}</span>
                                    </span>
                                    <span class="flex-grow flex flex-col pl-3">
                                        <span class="title-font font-medium text-gray-900">作成日：{{ dayjs(post.created_at).format('YYYY年MM月DD日') }}</span>
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