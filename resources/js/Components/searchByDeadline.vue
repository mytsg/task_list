<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import { onMounted, reactive, ref, defineEmits, watch } from 'vue';
import dayjs from 'dayjs'
import { Inertia } from '@inertiajs/inertia';
import { useRouter, useRoute } from 'vue-router';

const deadline = ref('')

const emitDeadline = defineEmits(['deadline-up'])

watch(deadline, () => {
  emitDeadline('deadline-up',deadline.value)
})

</script>

<template>
    <section class="text-gray-600 body-font">
        <div class="container my-4 py-4 px-5 border-gray-700 border-t-2 mx-auto">
          <h2 class="tracking-widest text-xl title-font font-bold text-black mb-1">期間を指定して検索する</h2>
          <form @submit.prevrnt="searchByDeadline">
            <span class="title-font font-medium text-indigo-600 p-1 pr-4 rounded">期限が今日から</span>
            <input class="px-4" type="date" name="deadline" v-model="deadline">
            <span class="title-font font-medium text-indigo-600 p-1 pl-4 rounded">までを表示</span>
          </form>
        </div>
    </section>
</template>