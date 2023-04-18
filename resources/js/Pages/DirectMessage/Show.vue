<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import DirectMessageList from '@/Components/DirectMessageList.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import { onMounted, reactive, ref, watch } from 'vue';
import dayjs from 'dayjs'
import { useRouter, useRoute, routerKey } from 'vue-router';
import Echo from 'laravel-echo';

const props = defineProps({
    'opponent': Object,
    'loginUser': Object,
    'allUsers': Array,
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

    window.Echo.channel('direct-message').listen('DirectMessageCreated', (e) => {
        console.log('pusher') 
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

        <section class="text-gray-600 body-font">
            <div class="flex w-full h-full">
                <div class="">
                    <DirectMessageList :users="props.allUsers" />
                </div>
                <div class="bg-white mt-4 w-2/3">
                    <div class="text-center" v-for="message in directMessages.value" :key="message.id">
                        <template v-if="message.send == props.loginUser.id">
                            <div class="mr-3 text-right">
                                <div class="inline-block my-1 text-black bg-green-300 rounded media-body">
                                    <div class="inline-block bg-light rounded-full py-1 px-3 mb-2">
                                        <p class="text-small mb-0 text-dark">{{message.message}}</p>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <div class="ml-3 text-left">
                                <div class="inline-block my-1 text-black bg-gray-300 rounded media-body">
                                    <div class="inline-block bg-light rounded-full py-1 px-3">
                                        <p class="text-small mb-0 text-dark">{{message.message}}</p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <form enctype="multipart/form-data" @submit.prevent="send" class="text-center bg-light border-gray-500">
                        <div class="mt-8 py-4 border-t-2 border-gray-200 flex justify-between">
                            <input type="text" placeholder="Type a message" class="inline-block border-black w-2/3 rounded py-4" v-model="form.message">
                            <div class="items-center">
                                <button type="submit" class="inline-block bg-indigo-500 px-4 py-4 rounded text-white">送信する</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        
    </BreezeAuthenticatedLayout>
</template>