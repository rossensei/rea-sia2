<script setup>
import { router } from '@inertiajs/vue3'
const prop = defineProps({
    student: Object
});

function view() {
    router.visit('/students/view/' + prop.student.id)
}

function toggleActive(student) {
    router.visit('/students/toggle/' + student.id, {
        method: 'POST',
        preserveScroll: true
    })
}

function isActive(id) {
    console.log(id)
    if(id == 1){
        return true;
    } else {
        return false;
    }
}
</script>

<template>
    <div class="p-4 rounded-lg bg-gray-50 shadow-md">
        <div class="bg-blue-300 mb-4" @click="view">
            <img :src="prop.student.profile_pic_url" alt="" 
            class="object-cover w-full h-full">
        </div>
        <p class="text-base font-normal">Name:
            <span class="font-semibold">{{ prop.student.fname }} {{ prop.student.lname }}</span>
        </p>
        <p class="text-base font-normal">Course & Year:
            <span class="font-semibold">{{ prop.student.course }} {{ prop.student.year }}</span>
        </p>
        <p class="text-base font-normal">Phone:
            <span class="font-semibold">{{ prop.student.phone }}</span>
        </p>
        <p class="text-base font-normal">Email:
            <span class="font-semibold">{{ prop.student.email }}</span>
        </p>

        <label class="relative inline-flex items-center cursor-pointer" :for="'status-' + student.id" >
            <input type="checkbox" :checked="isActive(student.active)" :id="'status-' + student.id" class="sr-only peer" @change.prevent="toggleActive(student)">
            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle Active</span>
        </label>
    </div>
</template>
