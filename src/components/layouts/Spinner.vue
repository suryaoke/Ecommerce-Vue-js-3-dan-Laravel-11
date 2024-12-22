<template>
    <Loading v-model:active="store.isLoading" :is-full-page="data.fullpage" />

</template>

<script setup>
import { reactive } from 'vue';
import Loading from 'vue-loading-overlay'

//define props

const props = defineProps({
    store: {
        type: Object,
        required: true
    }
})

// define the data object
const data = reactive({
    fullpage: true
})
</script>

<style scoped></style>