<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import moment from 'moment'
import {Link, useForm} from '@inertiajs/vue3'
import { ref } from 'vue'
import vueFilePond from 'vue-filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import { PencilSquareIcon } from '@heroicons/vue/20/solid';
import {TextSubs} from '../Scripts/Global'

const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);

const form = useForm({
  id: props.product.id,
  images: null
})
const getfile = ref(null)


const props =  defineProps({
    product: Object
})
const option = {
    allowMultiple: false,
    acceptedFileTypes: ['image/png', 'image/jpeg'],
    labelIdle: 'Drag & Drop your files or browse',
}

const onChangeFile = (e) => {
    form.images = e.target.files[0];
}
const submit = () => {
  form.post(route('upload.store'),{
    _method: 'put',
    forceFormData: true,
    preserveScroll: true,
    preserveState: false,
    onSubmit: () => form.reset('id', 'images')
  })
}
</script>
<template>
    <AppLayout :title="props.product.title">
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
            <div class="bg-white dark:bg-gray-800 overflow-hidden justify-between shadow-xl sm:rounded-lg block md:flex">
              <!-- forms -->
                <div class="px-8 my-8 flex-1 max-w-2xl">
                    <div>
                        <div class="px-4 sm:px-0 flex justify-between items-center">
                          <div>
                            <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">Products Profile</h3>
                            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">The personal details of this product</p>
                          </div>
                          <div>
                            <Link :href="route('product.edit', props.product.id)" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                              <PencilSquareIcon class="-ml-0.5 mr-2 h-4 w-4" />
                              Edit
                            </Link>
                          </div>
                      </div>
                        <div class="mt-6 border-t border-gray-100">
                          <dl class="divide-y divide-gray-100">
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                              <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">Title</dt>
                              <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-400 sm:col-span-2 sm:mt-0">{{product.title}}</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                              <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">Category</dt>
                              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 dark:text-gray-400 sm:mt-0">{{product.category}}</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                              <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">Description</dt>
                              <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-400 sm:col-span-2 sm:mt-0" v-html="product.description"></dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                              <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">Date Modified</dt>
                              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                <h4 class="dark:text-gray-400">Created on {{ moment(product.date_created).format('LLL') }}</h4>
                                <small class="dark:text-gray-400/90">updated on {{moment(product.date_modified).fromNow()}}</small>
                              </dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">Add Images</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                  <form @submit.prevent="submit">
                                    <FilePond ref="getfile" @change="onChangeFile" :options="option"/>
                                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Upload</button>
                                  </form>
                                </dd>
                              </div>
                          </dl>
                        </div>
                    </div>
                   
                </div>
                <!--list of imagas-->
                <div class="px-8 my-8 flex-1">
                  <div class="mt-4 px-4 sm:px-0">
                      <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-200">Products Images</h3>
                      <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">all images you can add many as you can!</p>
                    </div>
                    <ul role="list" class="mt-4 grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                      <li v-for="image in props.product.images" :key="image.id" class="relative">
                        <div class="group aspect-w-10 aspect-h-7 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                          <img :src="image.url" alt="" class="pointer-events-none object-cover group-hover:opacity-75">
                          <button type="button" class="absolute inset-0 focus:outline-none">
                            <span class="sr-only">View details for {{image.filename}}</span>
                          </button>
                        </div>
                        <div class="flex justify-between items-center">
                          <div>
                              <p class="pointer-events-none mt-2 block truncate text-sm font-medium text-gray-900 dark:text-gray-100">{{TextSubs(image.filename, 8)}}</p>
                              <p class="pointer-events-none block text-xs font-medium text-gray-500">{{image.size}}</p>
                          </div>
                          <div>
                              <Link :href="route('upload.destroy', image.image_id)" method="delete" as="button" type="button"  class="text-red-500 hover:text-red-600 text-sm px-2">Delete</Link>
                          </div>
                        </div>
                      </li>
                  </ul>
                  <h1 class="block text-center font-bold text-xl text-gray-500 bg-gray-200 py-2 rounded-md" v-if="props.product.images.length == 0">
                    No Images
                  </h1>
              </div>
            </div>
        </div>
       </div>
    </AppLayout>
</template>