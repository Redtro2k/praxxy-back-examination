<template>
    <nav class="flex" aria-label="Breadcrumb">
      <ol role="list" class="flex items-center space-x-4">
        <li>
          <div>
            <a :href="route('dashboard')" class="text-gray-400 hover:text-gray-500">
              <HomeIcon class="h-5 w-5 flex-shrink-0" aria-hidden="true" />
              <span class="sr-only">Home</span>
            </a>
          </div>
        </li>
        <li v-for="(breadcrumb, index) in $page.props.breadcrumbs" :key="breadcrumb">
          <div class="flex items-center">
            <ChevronRightIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
            <span :class="[ index+1 === $page.props.breadcrumbs.length ? 'text-gray-600' : 'text-gray-500','ml-4 font-medium text-sm']">
              <div v-if="breadcrumb.includes('{') && breadcrumb.includes('}')">
                {{ props.slug }}
              </div>
              <div v-else>
                {{breadcrumb.charAt(0).toUpperCase() + breadcrumb.slice(1)}}
              </div>
            </span>
          </div>
        </li>
      </ol> 
    </nav>
  </template>
  
  <script setup>
  import { ChevronRightIcon, HomeIcon } from '@heroicons/vue/20/solid';
  const props = defineProps({
    slug: String
  })
  </script>