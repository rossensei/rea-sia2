<script setup>
import { useForm, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const prop = defineProps({
    student: Object
})

const form = useForm({
    student_id: prop.student.id,
    violation: null,
    violation_date: null,
    action: null,
});

function addRecord() {
    form.post('/students/view/' + prop.student.id)
}

function returnToPrevPage() {
    router.visit('/students/view/' + prop.student.id)
}

</script>

<template>
    <AppLayout title="Add Record">
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Add Violation Record
                </h2>
            </div>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <FormSection @submitted="addRecord">
                <template #title>
                    Add Violation Record
                </template>
        
                <template #description>
                    Ensure that information you've entered are correct.
                </template>
        
                <template #form>
                    
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="name" value="Violator" />
                        <TextInput
                            id="name"
                            type="text"
                            :value="prop.student.fname + ' ' + prop.student.lname"
                            class="mt-1 block w-full"
                            disabled
                        />
                    </div>
                    
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="violation" value="Violation" />
                        <TextInput
                            id="violation"
                            v-model="form.violation"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <InputError :message="form.errors.violation" class="mt-2" />
                    </div>
        
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="violation_date" value="Violation Date" />
                        <TextInput
                            id="violation_date"
                            v-model="form.violation_date"
                            type="date"
                            class="mt-1 block w-full"
                        />
                        <InputError :message="form.errors.violation_date" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="action" value="Action Taken" />
                        <TextInput
                            id="action"
                            v-model="form.action"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <InputError :message="form.errors.action" class="mt-2" />
                    </div>
        
                </template>
        
                <template #actions>
                    <SecondaryButton class="mr-2" type="button" @click.prevent="returnToPrevPage">
                        Return
                    </SecondaryButton>

                    <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                        Saved.
                    </ActionMessage>
        
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Save
                    </PrimaryButton>
                </template>
            </FormSection>
        </div>
    </AppLayout>
</template>
