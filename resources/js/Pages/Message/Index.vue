<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import { onMounted, reactive, ref, watch } from 'vue';
import dayjs from 'dayjs'
import searchByDeadline from '@/Components/searchByDeadline.vue'
import { useRouter, useRoute, routerKey } from 'vue-router';
import Echo from 'laravel-echo';

// const props = defineProps({
//     'messages': Array
// })

const form = reactive({
    text: null,
})
const messages = reactive({});

const getMessages = () => {
        axios.get('/getMessages').then( res => {
        console.log('res.data', res.data)
        messages.value = res.data
        console.log('messages',messages)
    })
}

const send = () => {
    console.log('送信します')
    try{
        axios.post('message',form).then( res => {
            form.text = ''
        getMessages()
        })
    } catch(e) {
        console.log(e.message)
    }
}

onMounted(() => {
    // axios.get('/getMessages').then( res => {
    // console.log('res.data', res.data)
    // messages.value = res.data
    // console.log('messages',messages)
    // })
    getMessages()

    // pusherからデータを受け取る
    window.Echo.channel('chat').listen('MessageCreated', (e) => {
        console.log('pusherからデータを受け取る') //失敗
        getMessages();
    })
})

</script>

<template>
    <div v-for="message in messages.value" :key="message.id">
        <div class="media-body ml-3">
            <div class="bg-light rounded py-2 px-3 mb-2">
                <p class="text-small mb-0 text-dark">{{message.text}}</p>
                <p class="text-small mb-0 text-blue">{{message.user.name}}</p>
            </div>
        </div>
    </div>
             
    <form enctype="multipart/form-data" @submit.prevent="send" class="bg-light border-gray-500">
        <div class="input-group">
            <input type="text" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light" v-model="form.text">
            <div class="input-group-append">
            <button id="button-addon2" type="submit" class="btn btn-link">送信する</button>
            </div>
        </div>
    </form>
</template>