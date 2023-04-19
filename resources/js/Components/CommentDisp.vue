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
    user: Object,
})

const comments = reactive({})
const users = reactive({})

const deleteComment = id => {
  Inertia.delete(route('post.comments.destroy',{ post: props.post_id, comment: id }))
  window.location.reload();
}

onMounted(() => {
  axios.get(`/post/${props.post_id}/get_comments`)
  .then( res =>{
      console.log('res.data',res.data)
      comments.value = res.data.comments
  })
})

</script>

<template>
    <div class="my-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
      <h6 class="text-2xl pb-4">{{ props.post_id }}のコメント一覧</h6>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div v-for="comment in comments.value" class="p-6 bg-white border-b border-gray-200">
            <section class="text-gray-600 body-font">
                <div>
                  <div class="py-8 flex flex-wrap md:flex-nowrap justify-between">
                    <div class="md:flex-grow">
                      <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{ comment.user.name }}</h2>
                      <p class="leading-relaxed">{{ comment.text }}</p>
                    </div>
                    <div v-if="props.user.id == comment.user.id">
                      <button @click="deleteComment(comment.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z" stroke-width="0" fill="currentColor"></path>
                        <path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" stroke-width="0" fill="currentColor"></path>
                        </svg>
                      </button>
                    </div>
                  </div>
                </div>
            </section>
            </div>
        </div>
    </div>
</template>