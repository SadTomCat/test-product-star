<template>
    <div class="min-h-screen flex flex-col">
        <header class="h-12 flex justify-center items-center shadow-md">
            <div class="container">
                <ul class="flex space-x-2">
                    <li v-for="link in links">
                        <Link :href="link.link"
                              :class="{'text-blue-700': currentPath === link.link}"
                        >
                            {{ link.title }}
                        </Link>
                    </li>
                </ul>
            </div>
        </header>

        <main class="flex justify-center flex-1 my-5">
            <div class="container">
                <slot></slot>
            </div>
        </main>
    </div>
</template>

<script setup>
import {Link, usePage} from '@inertiajs/inertia-vue3'
import {computed} from 'vue'

const url = usePage().url;

const currentPath = computed(() => (new URL('http://host' +  url.value)).pathname)

const links = [
    {
        title: 'Task 1',
        link: '/task-1'
    },
    {
        title: 'Task 2',
        link: '/task-2'
    },
    {
        title: 'Task 3',
        link: '/task-3'
    }
];

</script>
