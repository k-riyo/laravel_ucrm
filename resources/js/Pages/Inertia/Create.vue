<script setup>
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia' 

defineProps({
    errors: Object
})

const form = reactive({
    title: null,
    content: null 
})

const submitFunction = () => { 
    Inertia.post('/inertia', form)
}
</script> 

<template>
<div v-if="errors.title" class="text-red-500">{{ errors.title }}</div>
<div v-if="errors.content" class="text-red-500">{{ errors.content }}</div>

<form @submit.prevent="submitFunction">
    <input type="text" name="title" v-model="form.title">
    <input type="text" name="content" v-model="form.content"> 
    <button>送信</button>
</form> 
</template>