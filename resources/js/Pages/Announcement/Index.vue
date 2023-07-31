<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    subject: '',
    content: ''
})

function submit() {
    form.post('/announcements/send');
}
</script>

<template>
    <AppLayout title="Announcements">
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Send Announcements To Students
                </h2>
            </div>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <FormSection @submitted="submit">
                <template #title>
                    Send Announcements To Students
                </template>
        
                <template #description>
                    Ensure that information you've entered are correct.
                </template>

                <template #form>
                    
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="subject" value="Subject" />
                        <TextInput
                            id="subject"
                            v-model="form.subject"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <InputError :message="form.errors.subject" class="mt-2" />
                    </div>
        
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="content" value="Message" />
                        <textarea 
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full h-[150px]"
                        name="content" 
                        id="content"
                        v-model="form.content" 
                        ></textarea>
                        <InputError :message="form.errors.content" class="mt-2" />
                    </div>
        
                </template>
        
                <template #actions>
                    <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                        Saved.
                    </ActionMessage>
        
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        SEND
                    </PrimaryButton>
                </template>
            </FormSection>
        </div>
    </AppLayout>
</template>