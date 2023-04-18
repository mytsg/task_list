<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import DirectMessageList from '@/Components/DirectMessageList.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import { onMounted, reactive, ref, watch } from 'vue';
import dayjs from 'dayjs'
import searchByDeadline from '@/Components/searchByDeadline.vue'
import { useRouter, useRoute, routerKey } from 'vue-router';

const props = defineProps({
    'users': Array,
})
</script>

<template>
    <Head title="トーク一覧" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                メッセージを送る
            </h2>
        </template>

        <DirectMessageList :users = props.users />
    </BreezeAuthenticatedLayout>
</template>