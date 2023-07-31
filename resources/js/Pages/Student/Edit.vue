<script setup>
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const photoPreview = ref(null);
const photoInput = ref(null);

const form = useForm({
    _method: 'put',
    profile_pic: null,
    fname: prop.student.fname,
    lname: prop.student.lname,
    course: prop.student.course,
    year: prop.student.year,
    phone: prop.student.phone,
    email: prop.student.email,
});

const prop = defineProps({
    student: Object
})

function updateStudent() {
    if (photoInput.value) {
        form.profile_pic = photoInput.value.files[0];
    }

    form.post('/students/' + prop.student.id, {
        preserveScroll: true,
    });
}

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];
    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};
</script>

<template>
    <AppLayout title="Add Student">
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Update Student Details
                </h2>
            </div>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <FormSection @submitted="updateStudent">
                <template #title>
                    Update Student Details
                </template>
        
                <template #description>
                    Ensure that information you've entered are correct.
                </template>
        
                <template #form>

                    <div class="col-span-6 sm:col-span-4">
                        <!-- Profile Photo File Input -->
                        <input
                            ref="photoInput"
                            type="file"
                            class="hidden"
                            @change="updatePhotoPreview"
                        >
        
                        <InputLabel for="photo" value="Student Photo" />
        
                        <!-- Current Profile Photo -->
                        <div v-show="! photoPreview" class="mt-2">
                            <img :src="student.profile_pic_url" alt="student profile" class="rounded-full h-20 w-20 object-cover">
                        </div>
        
                        <!-- New Profile Photo Preview -->
                        <div v-show="photoPreview" class="mt-2">
                            <span
                                class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                                :style="'background-image: url(\'' + photoPreview + '\');'"
                            />
                        </div>
        
                        <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                            Select A Photo
                        </SecondaryButton>
        
                        <InputError :message="form.errors.photo" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="fname" value="First Name" />
                        <TextInput
                            id="fname"
                            v-model="form.fname"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <InputError :message="form.errors.fname" class="mt-2" />
                    </div>
        
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="lname" value="Last Name" />
                        <TextInput
                            id="lname"
                            v-model="form.lname"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <InputError :message="form.errors.lname" class="mt-2" />
                    </div>
        
                    <div class="flex items-center space-x-4 col-span-6 sm:col-span-4">
                        <div class="">
                            <InputLabel for="course" value="Course" />
                            <select v-model="form.course" name="course" id="course" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Select course</option>
                                <option value="BSA">BSA</option>
                                <option value="BSBA">BSBA</option>
                                <option value="BSCRIM">BSCRIM</option>
                                <option value="BSED">BSED</option>
                                <option value="BSHM">BSHM</option>
                                <option value="BSIT">BSIT</option>
                                <option value="BSN">BSN</option>
                            </select>
                            <InputError :message="form.errors.course" class="mt-2" />
                        </div>

                        <div class="">
                            <InputLabel for="year" value="Year" />
                            <select v-model="form.year" name="year" id="year" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Select year</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <InputError :message="form.errors.year" class="mt-2" />
                        </div>
                    </div>

                    <hr class="mb-3 mt-3 col-span-6 sm:col-span-4">

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="phone" value="Phone" />
                        <TextInput
                            id="phone"
                            v-model="form.phone"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <InputError :message="form.errors.phone" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="email" value="Email" />
                        <TextInput
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="mt-1 block w-full"
                        />
                        <InputError :message="form.errors.email" class="mt-2" />
                    </div>
                </template>
        
                <template #actions>
                    <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                        Changes saved.
                    </ActionMessage>
        
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Update
                    </PrimaryButton>
                </template>
            </FormSection>
        </div>
    </AppLayout>
</template>
