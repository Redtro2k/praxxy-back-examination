<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import moment from 'moment'
import {Link, useForm} from '@inertiajs/vue3'

import vueFilePond from 'vue-filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);

const form = useForm({
    images: []
})

const props =  defineProps({
    product: Object
})
function handleFilePondLoad(response){
    form.images.push(response);
    return response;
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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg block md:flex items-center">
                <div class="px-8 my-8">
                    <div>
                        <div class="px-4 sm:px-0">
                          <h3 class="text-base font-semibold leading-7 text-gray-900">Products Profile</h3>
                          <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">The personal details of this product</p>
                        </div>
                        <div class="mt-6 border-t border-gray-100">
                          <dl class="divide-y divide-gray-100">
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                              <dt class="text-sm font-medium leading-6 text-gray-900">Title</dt>
                              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{product.title}}</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                              <dt class="text-sm font-medium leading-6 text-gray-900">Category</dt>
                              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{product.category}}</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                              <dt class="text-sm font-medium leading-6 text-gray-900">Description</dt>
                              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{product.description}}</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                              <dt class="text-sm font-medium leading-6 text-gray-900">Date Modified</dt>
                              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                <h4>Created on {{ moment(product.date_created).format('LLL') }}</h4>
                                <small>updated on {{moment(product.date_modified).fromNow()}}</small>
                              </dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Add Images</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    <form @submit.prevent="form.post(route('file.upload'))">
                                        <!-- <input type="file" name="" id=""> -->
                                        <FilePond 
                                        name="image"
                                        ref="pond"
                                        class-name="my-pond"
                                        allow-multiple="true"
                                        :server="{
                                            url: '',
                                            process: {
                                                url: route('file.upload', props.product.id),
                                                method: 'POST',
                                                onload: handleFilePondLoad
                                            },
                                            revert: handleFilePondRevert,
                                            headers: {
                                                'X-CSRF-TOKEN': $page.props.csrf_token
                                            }
                                        }"/>
                                        <!-- <button class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" type="submit">Upload</button> -->
                                    </form>
                                </dd>
                              </div>
                          </dl>
                        </div>
                    </div>
                    <div>
                        <div class="mt-4 px-4 sm:px-0">
                            <h3 class="text-base font-semibold leading-7 text-gray-900">Products Images</h3>
                            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">all images you can add many as you can!</p>
                          </div>
                          <ul role="list" class="mt-4 grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                            <li class="relative">
                              <div class="group aspect-w-10 aspect-h-7 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                                <img src="https://images.unsplash.com/photo-1582053433976-25c00369fc93?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=512&q=80" alt="" class="pointer-events-none object-cover group-hover:opacity-75">
                                <button type="button" class="absolute inset-0 focus:outline-none">
                                  <span class="sr-only">View details for IMG_4985.HEIC</span>
                                </button>
                              </div>
                              <div class="flex justify-between items-center">
                                <div>
                                    <p class="pointer-events-none mt-2 block truncate text-sm font-medium text-gray-900">IMG_4985.HEIC</p>
                                    <p class="pointer-events-none block text-sm font-medium text-gray-500">3.9 MB</p>
                                </div>
                                <div>
                                    <Link href="#" class="text-red-500 hover:text-red-600 text-sm px-2">Delete</Link>
                                </div>
                              </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
       </div>
    </AppLayout>
</template>