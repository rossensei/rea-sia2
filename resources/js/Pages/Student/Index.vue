<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import StudentCard from '@/Components/StudentCard.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
    students: Array
})

function search(ev) {
    router.visit('/students/search/' + ev.target.value)
}
</script>
<template>
    <AppLayout title="Students">
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Students
                </h2>

                <TextInput type="text"
                class="mt-1 block w-1/4 focus:w-1/3 ease-in-out duration-200"
                placeholder="Search key" 
                @keyup.enter="search($event)" />

                <Link class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" href="/students/create">Add Student</Link>
            </div>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="mt-8 grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-4">
                    <StudentCard v-for="student in students" :student="student" :key="student.id" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>