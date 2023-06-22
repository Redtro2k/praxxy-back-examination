<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import { Link, router } from '@inertiajs/vue3';
import Paginate from '@/Components/Paginate.vue'
import moment from 'moment'
import {ref, watch} from 'vue'
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import debounce from 'lodash/debounce';

const props = defineProps({
    products: Object,
    categories: Object,
    filter: String,
    category: String
})
let search = ref(props.filter);
let find_category = ref(props.category);

watch([search, find_category], debounce(function ([newValue1, newValue2]) {
    router.get(route('product.index', {search: newValue1, category: newValue2}, {
        preserveState: true,
        replace: true
    }));
}, 300));
</script>
<template>
    <AppLayout title="Product">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    All Products
                </h2>
                <Breadcrumbs/>
            </div>
        </template>
        <div class="px-4 pt-8 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900 dark:text-gray-100">All Products</h1>
                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-400">A list of all the Telephones in admin
                        including their category,
                        title, description and etc.</p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <Link :href="route('product.create')"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add
                        Product</Link>
                </div>
            </div>
            <!-- <AlertSuccess v-if="$page.props.flash.success"/> -->
            <div class="flex space-x-4 items-center">
                <div class="w-72">
                    <InputLabel for="search" value="Search" />
                    <TextInput
                        id="search"
                        v-model="search"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="search title or description"
                    />
                </div>
                <div>
                    <fieldset>
                      <div class="space-y-4 mt-6 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                        <div v-for="category in props.categories" :key="category.id" class="flex items-center">
                          <input :id="category.id" name="notification-method" type="radio" v-model="find_category" :value="category.title" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                          <label :for="category.id" class="ml-3 block text-sm font-medium text-gray-700">{{ category.title }}</label>
                        </div>
                      </div>
                    </fieldset>
                  </div>
            </div>
            <div class="-mx-4 mt-8 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-200 sm:pl-6">
                                Title</th>
                            <th scope="col"
                                class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200 lg:table-cell">
                                Description
                            </th>
                            <th scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold dark:text-gray-200 text-gray-900">Category
                            </th>
                            <th scope="col"
                                class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200 sm:table-cell">
                                Date Modified
                            </th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-400 bg-white dark:bg-gray-800">
                            <tr v-if="props.products.data.length != 0" v-for="product in props.products.data" :key="product.id">
                                <td
                                    class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-gray-300 sm:w-auto sm:max-w-none sm:pl-6">
                                    <div class="hidden items-center md:flex">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <img v-if="product.image" class="h-10 w-10 rounded-full"
                                                :src="product.image"
                                                alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-medium text-gray-900 dark:text-white border-b-slate-100 border-solid">  <p :style="`border-color: ${product.bgcolor}`" class="border-b-2">{{ product.title }}</p></div>
                                            <div class="text-gray-500">{{ product.id }}</div>
                                        </div>
                                    </div>
                                    <dl class="font-normal lg:hidden md:hidden">
                                        <dt class="sr-only">Title</dt>
                                        <dd class="flex items-center">
                                            <img v-if="props.image" class="h-10 w-10 rounded-full"
                                                :src="product.image"
                                                alt="">
                                        </dd>
                                        <dt class="sr-only">Name</dt>
                                        <dd class="text-gray-800 dark:text-gray-100 pt-2">{{product.title}}</dd>
                                        <dt class="sr-only">Title</dt>
                                        <dd class="mt-1 truncate text-gray-700 dark:text-gray-500">{{product.excerpt}}</dd>
                                    </dl>
                                </td>
                                <td class="hidden px-3 py-4 text-sm text-gray-500 dark:text-gray-400 lg:table-cell">{{ product.excerpt }}</td>
                                <td class="px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    <span class="inline-flex rounded-full bg-green-400 dark:bg-green-100 px-2 text-xs font-semibold leading-5 dark:text-green-800 text-white">{{ product.category }}</span>
                                </td>
                                <td class="hidden px-3 py-4 text-sm text-gray-500 dark:text-gray-400 sm:table-cell">
                                    <div class="block">
                                        <h4 class="font-semibold dark:text-gray-200">{{product.status}}</h4>
                                    <span class="text-sm">
                                        <h4>{{ moment(product.date_created).format('LLL') }}</h4>
                                        <small>updated on {{moment(product.date_modified).fromNow()}}</small>
                                    </span>
                                    </div>
                                </td>
                                <td class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 lg:flex space-x-4">
                                    <Link :href="route('product.show', product.id)"
                                        class="text-indigo-600 dark:text-indigo-400 dark:hover:text-indigo-700 hover:text-indigo-900">View<span
                                            class="sr-only">,
                                            {{product.title}}</span>
                                        </Link>
                                        <Link :href="route('product.destroy', product.id)" method="delete" as="button" type="button"
                                            class="text-red-600 dark:text-red-400 dark:hover:text-red-700 hover:text-red-900">Remove<span
                                            class="sr-only">,
                                            {{product.title}}</span>
                                        </Link>
                                </td>
                            </tr>
                            <tr v-else>
                                <td class="text-center px-3 py-48 text-sm text-gray-500 dark:text-gray-400" colspan="5">
                                    <h1 class="text-xl font-extrabold text-slate-300 tracking-tight">No Data</h1>
                                </td>
                            </tr>
                    </tbody>
            </table>
        </div>
        <Paginate v-show="props.products.data.length > 5" class="mt-4" :links="products.links" :from="products.from" :to="products.to" :result="products.result" :responsiveNext="products.next_page_url" :responsivePrevious="products.first_page_url" />    </div>
    </AppLayout>
</template>