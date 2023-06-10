<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SimpleCustom from '@/Components/HeadlessListBox.vue'
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    categories: Object,
})

const form = useForm({
    title: '',
    category: null,
    description: null
});

const submit = () => form.post(route('product.store', {
    onSubmit: () => form.reset('category', 'description', 'title')
}));
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
                            <QuillEditor theme="snow" contentType="html" v-model:content="form.description" />
                            <InputError class="mt-2" :message="form.errors.description" />

                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <Link :href="route('product.index')" class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-200">Cancel</Link>
                            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
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
