<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import { onMounted, reactive, ref } from 'vue';
import dayjs from 'dayjs'
import { getToday } from '@/common'
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    post_id: Number,
})

const comments = reactive({})

onMounted(() => {
    axios.get(`/post/${props.post_id}/get_comments`)
    .then( res =>{
        console.log('res.data.comments',res.data.comments)
        comments.value = res.data.comments
    })
})

const proxy_comments = new Proxy(comments,{})

console.log('代入後のcomments',comments)
console.log('Proxy',proxy_comments)

</script>

<template>
    <!-- <div class="">
   <h5 class="mb-3">コメント一覧</h5>
   <div class="container">
     <div v-for="comment in props.comments" :key="comment.id">
       <div class="row my-2">
        <small class="text-muted mr-4">{{comment.user.name}}</small> -->
        <!-- <div v-if="edit_time && comment.id == edit_comment.id">
           <input v-if="edit_time" type="text" v-model="edit_comment.text" class="px-2 py-2" placeholder="Type a Comment" />
           <button v-if="comment.user_id == current_user_id && edit_comment.text != ''" @click.prevent="update(edit_comment)" type="button" class=" btn btn-primary btn-sm">更新</button>
           <button v-if="edit_time" @click.prevent="back(comment)" type="button" class="btn btn-outline-dark btn-sm ml-1">戻る</button>
         </div> -->
        <!-- <div v-else>
           <p style="display: contents;">{{comment.text}}</p>
           <button v-if="comment.user_id == current_user_id" @click.prevent="edit(comment)" type="button" class="ml-4 btn btn-warning btn-sm">編集</button>
           <button v-if="comment.user_id == current_user_id || item_user_id == current_user_id" @click.prevent="destroy(comment.id)" type="button" class="ml-1 btn btn-danger btn-sm">削除</button>
         </div> -->
       <!-- </div>
     </div>
   </div>
 </div> -->

    <div class="my-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
            <section class="text-gray-600 body-font">
                <h6 class="text-2xl pb-4">{{ props.post_id }}のコメント一覧</h6>
                <div v-for="comment in comments">
                    <h6 class="text-2xl pb-4">{{ comment.text }}</h6>
                </div>
            </section>
            </div>
        </div>
    </div>
</template>