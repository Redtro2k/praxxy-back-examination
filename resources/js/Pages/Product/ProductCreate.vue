<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SimpleCustom from '@/Components/HeadlessListBox.vue'
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    categories: Object,
})

const form = useForm({
    title: '',
    category: null
})
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
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg block md:flex">
                    <div>
                        <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_sHWjfqhsHU.json"  background="transparent"  speed="1"  class="h-48 md:h-80"  loop autoplay></lottie-player>
                    </div>
                    <form class="p-6 my-2">
                        <div class="border-b border-gray-900/10 pb-8">
                            <h2 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">New Products</h2>
      <p class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-400">This information will be displayed publicly so be careful what you share.</p>
                        </div>
                        <div>
                            <InputLabel for="title" value="Title" />
                            <TextInput
                                id="name"
                                v-model="form.title"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                autocomplete="title"
                            />
                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>
                        <div>
                            <InputLabel for="category" value="Category" />
                            <SimpleCustom :options="props.categories" v-model="form.category"/>
                            <InputError class="mt-2" :message="form.errors.category" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
