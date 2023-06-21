<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SimpleCustom from '@/Components/HeadlessListBox.vue'
import { useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import GetDate from '../Scripts/Datetime'


const props = defineProps({
    categories: Object,
})
//all forms
const form = useForm({
    title: '',
    category: null,
    description: null,
    images: [],
    date_modified: ''
});

// reconstruct dates
const date = ref(new Date());
watch(date, (newDate) => {
  form.date_modified = GetDate(newDate);
});

//submit all validation
const submit = () => form.post(route('product.store', {
    forceFormData: true,
    onSubmit: () => form.reset('category', 'description', 'title')
}));

//counting pages
const pages = ref(1);
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Create Product
                </h2>
                <Breadcrumbs/>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg block md:flex items-center">
                    <div class="flex-1">
                        <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_sHWjfqhsHU.json"  background="transparent"  speed="1"  class="h-48 md:h-96"  loop autoplay></lottie-player>
                    </div>
                    <form @submit.prevent="submit" class="p-6 my-2">
                            <div class="border-b border-gray-900/10 pb-8">
                            <h2 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">New Products</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-400">This information will be displayed publicly so be careful what you share.</p>
                            </div>
                           <div v-if="pages == 1">
                                <h2 class="mt-2 font-semibold leading-7 text-gray-900 dark:text-gray-100">Step 1</h2>
                                <div class="mt-2">
                                    <InputLabel for="title" value="Title" />
                                    <TextInput
                                        id="name"
                                        v-model="form.title"
                                        type="text"
                                        class="mt-1 block w-full"
                                        autofocus
                                        autocomplete="title"
                                    />
                                    <InputError class="mt-2" :message="form.errors.title" />
                                </div>
                                <div class="mt-2">
                                    <InputLabel for="category" value="Category" />
                                    <SimpleCustom :options="props.categories" v-model="form.category"/>
                                    <InputError class="mt-2" :message="form.errors.category" />
                                </div>
                                <div class="mt-6">
                                    <InputLabel for="category" value="Description" />
                                    <QuillEditor theme="snow" contentType="html" v-model:content="form.description" />
                                    <InputError class="mt-2" :message="form.errors.description" />
                                </div>
                           </div>
                           <div v-if="pages == 2">
                            <div class="my-4">
                                <h2 class="mt-2 font-semibold leading-7 text-gray-900 dark:text-gray-100">Step 2</h2>
                                <div class="border border-orange-100 bg-orange-100 p-1 rounded-md my-2">
                                    <span class="text-sm text-orange-400">This form is optional you can skip this if you want</span>
                                </div>
                                <InputLabel for="title" value="Upload Images" />
                                <input type="file" multiple accept="images.*" @input="form.images = $event.target.files" />
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                              </progress>
                              <InputError class="mt-2" :message="form.errors.images" />

                            </div>
                           </div>
                           <div v-if="pages == 3">
                            <h2 class="mt-2 font-semibold leading-7 text-gray-900 dark:text-gray-100">Step 3</h2>
                                <div class="border border-orange-100 bg-orange-100 p-1 rounded-md my-2">
                                    <span class="text-sm text-orange-400">If you change your <b>Date Created</b>, it will not be possible to edit it.</span>
                                </div>
                                <InputLabel for="title" value="Date Create" />
                            <div class="flex justify-center my-4">
                                <VDatePicker v-model="date" mode="datetime"/>
                                <InputError class="mt-2" :message="form.errors.date_modified" />
                            </div>
                           </div>
                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                <button type="button" v-show="pages != 1" @click.prevent="pages--" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Prev</button>
                                <button type="button" @click.prevent="pages++" v-if="pages <= 2" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Next</button>
                                <button v-else type="submit" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<style>
.ql-container {
    min-height: 10rem;
    height: 100%;
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .ql-editor {
    height: 100%;
    flex: 1;
    overflow-y: auto;
    width: 100%;
  }
</style>
