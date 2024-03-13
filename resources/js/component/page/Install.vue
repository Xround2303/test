<template>
    <Toast ref="refToast"/>
    <div class="flex flex-col mt-20 h-full">
        <div class="text-center mb-3 text-6xl">
            <b>Поздравляем</b>
        </div>
        <div class="text-center mb-5 text-xl" >
            Приложение успешно установлено!
        </div>
        <div class="flex justify-center">
            <Button label="Начать работу" :loading="isLoad" @click="onClickInstallApp"/>
        </div>
    </div>
</template>

<script setup>
import {ref} from "vue";
import confetti from "canvas-confetti";
import Button from 'primevue/button';
import {request} from "../../utils/request.js";
import Toast from "../ui/Toast.vue";
const refToast = ref(null);
const isLoad = ref(false);

const onClickInstallApp = async function () {
    isLoad.value = true;

    await request("/api/app/install/", {
        method: "POST"
    })
        .then(e => finishInstall())
        .catch(e => errorInstall(e.message))
}
const errorInstall = function (e) {
    refToast.value.show("error", "Ошибка", e)
}
const finishInstall = function () {
    confetti({
        spread: 70,
        particleCount: 120,
        origin: {
            y: 0.5,
            x: 0.5
        }
    })

    BX24.installFinish();
}
</script>
