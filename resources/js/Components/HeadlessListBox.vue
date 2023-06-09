<script setup>
    import { ref, computed } from "vue";
    import {
      Listbox,
      ListboxButton,
      ListboxLabel,
      ListboxOption,
      ListboxOptions,
    } from "@headlessui/vue";
    import { CheckIcon, ChevronDownIcon } from "@heroicons/vue/20/solid";
    const props = defineProps({
      options: Object,
      modelValue: [Number],
      placeholder: {
        type: String,
        default: () => "Select Option",
      },
      label: String,
    });
    const emits = defineEmits(["update:modelValue"]);
    const selected = ref(props.options[0].id);
    const name = computed(() => {
  return props.options.find((e) => e.id === props.modelValue)?.name;
});
    </script>

<template>
  <Listbox
    as="div"
    @update:modelValue="(value) => emits('update:modelValue', value)"
    :modelValue="props.modelValue"
  >
    <ListboxLabel class="block text-sm font-medium text-gray-700">
      {{ props.label }}
    </ListboxLabel>
    <div class="mt-1 relative">
        <ListboxButton
        class="bg-white dark:bg-gray-900 relative w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-700 sm:text-sm"
      >
        <span class="block truncate dark:text-gray-100" v-if="name">{{ name }}</span> <!-- Place the span here -->
        <span class="block truncate text-gray-500" v-else>{{ props.placeholder }}</span>
        <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
          <ChevronDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
        </span>
      </ListboxButton>

      <transition
        leave-active-class="transition ease-in duration-100"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <ListboxOptions
          class="absolute right-0 z-[100] overflow-auto mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
        >
        <ListboxOption
        as="template"
        v-for="option in props.options"
        :key="option.id"
        :value="option.id"
        v-slot="{ active, selected }"
      >
            <li
              :class="[
                active ? 'text-white bg-indigo-500' : 'text-gray-900',
                'cursor-default select-none relative py-2 pl-3 pr-9',
              ]"
            >
              <span
                :class="[selected ? 'font-semibold' : 'font-normal', 'block truncate']"
              >
                {{ option.name }}
              </span>

              <span
                v-if="selected"
                :class="[
                  active ? 'text-white' : 'text-indigo-500',
                  'absolute inset-y-0 right-0 flex items-center pr-4',
                ]"
              >
                <CheckIcon class="h-5 w-5" aria-hidden="true" />
              </span>
            </li>
          </ListboxOption>
        </ListboxOptions>
      </transition>
    </div>
  </Listbox>
</template>