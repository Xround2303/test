<template>
    <component :is="layout">
        <router-view />
    </component>
</template>
<script setup>
import {computed, ref} from "vue"
import {useRoute} from "vue-router"
import {useStore} from "vuex";

const route = useRoute()
const store = useStore();


const layout = computed(() => {
    return route.meta.layout
})
</script>
