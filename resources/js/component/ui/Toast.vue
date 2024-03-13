<template>
    <Toast :pt="{closebutton: {class: ['hidden']}}" />
</template>
<script setup>
import Toast from 'primevue/toast'
import {useToast} from "primevue/usetoast"

const toast = useToast()

function show(severity, title, content) {
    toast.add({ severity: severity, summary: title, detail: content, life: 3000 })
}

defineExpose({
    show
})
</script>
<style>
.p-toast-icon-close {
    display: none !important;
}
</style>
