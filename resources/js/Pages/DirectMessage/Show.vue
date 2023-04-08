<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import DirectMessageList from '@/Components/DirectMessageList.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import { onMounted, reactive, ref, watch } from 'vue';
import dayjs from 'dayjs'
import searchByDeadline from '@/Components/searchByDeadline.vue'
import { useRouter, useRoute, routerKey } from 'vue-router';
import Echo from 'laravel-echo';

const props = defineProps({
    'opponent': Object,
    'loginUser': Object,
})
console.log('props.opponent.id',props.opponent.id)

const form = reactive({
    message: null,
    recieve: props.opponent.id,
})

const directMessages = reactive({})

const getDirectMessage = () => {
    axios.get('/api/getDirectMessage',{
        params: {
            recieve: props.opponent.id,
            send: props.loginUser.id
        }
    }).then( res => {
        console.log('res.data',res.data)
        directMessages.value = res.data
        console.log('directMessages',directMessages.value)
    })
} 

const send = () => {
    console.log('dm送信')
    console.log('form',form)
    try{
        axios.post('/directMessage',form).then( res => {
        form.message = ''
        getDirectMessage()
    })
    } catch(e) {
        console.log(e.message)
    }
} 

onMounted(() => {
    getDirectMessage()

    // pusherからデータを受け取る
    window.Echo.channel('direct-message').listen('DirectMessageCreated', (e) => {
        console.log('pusherからデータを受け取る') 
        getDirectMessage();
    })
})

</script>

<template>
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                メッセージを送る
            </h2>
        </template>

        <!-- ハンバーガーメニューで表示・非表示を切り替えたい -->
        <!-- <DirectMessageList :users = props.users /> -->

        <div v-for="message in directMessages.value" :key="message.id">
            <div class="media-body ml-3">
                <div class="bg-light rounded py-2 px-3 mb-2">
                    <p class="text-small mb-0 text-dark">{{message.message}}</p>
                </div>
            </div>
        </div>

        <form enctype="multipart/form-data" @submit.prevent="send" class="bg-light border-gray-500">
            <div class="input-group">
                <input type="text" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light" v-model="form.message">
                <div class="input-group-append">
                    <button id="button-addon2" type="submit" class="btn btn-link">送信する</button>
                </div>
            </div>
        </form>
        
    </BreezeAuthenticatedLayout>
</template>