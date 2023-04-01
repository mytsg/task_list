<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import { onMounted, reactive, ref, watch } from 'vue';
import dayjs from 'dayjs'
import searchByDeadline from '@/Components/searchByDeadline.vue'
import { useRouter, useRoute, routerKey } from 'vue-router';

const text = ref('');
const array = [];

const getMessages = () => {
    axios.get('message').then( res => {
        array = res.data
    })
}

const send = () => {
    text.value = text
    try{
        axios.post('message',text).then( res => {
        getMessages()
        })
    } catch(e) {
        console.log(e.message)
    }
}

</script>

<template>
    <div v-for="message in array" :key="message.id">
        <div class="media-body ml-3">
            <div class="bg-light rounded py-2 px-3 mb-2">
                <p class="text-small mb-0 text-dark">{{message.text}}</p>
            </div>
        </div>
    </div>
             
    <form @submit.prevent="send" class="bg-light">
        <div class="input-group border-gray-900">
            <input type="text" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light" v-model="text">
            <div class="input-group-append">
            <button id="button-addon2" type="submit" class="btn btn-link">送信する</button>
            </div>
        </div>
    </form>
</template>