<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    student: Object,
    records: Array
})
</script>
<template>
    <AppLayout title="Records">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                View Student and Records
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 flex items-start flex-wrap lg:flex-nowrap lg:space-x-4">
                <div class="lg:w-2/5 sm:w-full rounded-lg shadow-sm h-auto p-4 bg-gray-50">
                    <img :src="props.student.profile_pic_url" class="w-full mb-4" alt="">

                    <p class="text-base font-normal">Name:
                        <span class="font-semibold">{{ props.student.fname }} {{ props.student.lname }}</span>
                    </p>
                    <p class="text-base font-normal">Course & Year:
                        <span class="font-semibold">{{ props.student.course }} {{ props.student.year }}</span>
                    </p>
                    <p class="text-base font-normal">Phone:
                        <span class="font-semibold">{{ props.student.phone }}</span>
                    </p>
                    <p class="text-base font-normal">Email:
                        <span class="font-semibold">{{ props.student.email }}</span>
                    </p>
                    <p class="text-base font-normal">Active:
                        <span v-if="props.student.active" class="font-semibold text-green-500">Yes</span>
                        <span v-if="!props.student.active" class="font-semibold text-yellow-300">No</span>
                    </p>
                    <div class="flex justify-end items-center space-x-2">
                        <Link :href="'/students/' + student.id"
                        as="button"
                        method="delete"
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                        >Delete</Link>
                        <Link :href="'/students/edit/' + student.id" 
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                        >Edit Profile</Link>
                    </div>
                </div>
                <div class="lg:3/5 sm:w-full bg-gray-50 rounded-lg shadow-sm h-auto p-4">
                    <div class="flex justify-between items-center">
                        <h1 class="font-semibold text-xl text-gray-800 leading-tight">List of Violations</h1>
                        <Link :href="'/students/add-record/' + props.student.id"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Add Record</Link>
                    </div>
                    <hr class="mb-2 mt-2">
                    
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Violation
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action Taken
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        ...
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="record in props.records" :key="record.id" class="bg-white dark:bg-gray-800">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ record.violation }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ record.violation_date}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ record.action}}
                                    </td>
                                    <td class="px-6 py-4 space-x-2 text-center">
                                        <Link :href="'/students/view/' + props.student.id + '/' + record.id + '/edit'" as="button"
                                        class="px-2 py-1 rounded-lg bg-blue-500 text-sm font-semibold text-white"
                                        ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                          </svg>
                                        </Link>
                                        <Link :href="'/students/view/' + props.student.id + '/' + record.id" as="button" method="delete"
                                        class="px-2 py-1 rounded-lg bg-red-500 text-sm font-semibold text-white"
                                        >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                          </svg>
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p v-if="records.length <= 0" class="text-sm text-center text-gray-500 font-semibold">No records</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>