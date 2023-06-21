<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SimpleCustom from '@/Components/HeadlessListBox.vue';
import { useForm } from '@inertiajs/vue3';


const props = defineProps({
    product: Object,
    categories: Object,
})

const text = props.product.description

const form = useForm({
    id: props.product.id,
    title: props.product.title,
    category: props.product.category_id,
    description: text,
});

</script>
<template>
<AppLayout :title="`Edit ` + props.product.title">
    <template #header>
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ props.product.title }}
            </h2>
            <Breadcrumbs :slug="props.product.title"/>
        </div>
    </template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg block md:flex items-center">
                <div class="flex-1">
                    <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_sHWjfqhsHU.json"  background="transparent"  speed="1"  class="h-48 md:h-96"  loop autoplay></lottie-player>
                </div>
                <form @submit.prevent="form.put(route('product.update', props.product.id))" class="p-6 my-2">
                    <div class="border-b border-gray-900/10 pb-8">
                        <h2 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">Edit {{ props.product.title }}'s Product</h2>
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
                        <InputLabel for="category" value="Description" />
                        <QuillEditor theme="snow" contentType="html" v-model:content="form.description" />
                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>
                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
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
