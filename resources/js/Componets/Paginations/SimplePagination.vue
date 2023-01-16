<template>
    <div class="">
        <div class="flex justify-center">
            <div class="flex space-x-2">
                <Link class="main-table__pagination-button"
                      v-html="link.label"
                      :href="link.url"
                      :class="{active: currentPage == link.label}"
                      v-for="link in links"
                      :key="link.label"
                ></Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import {Link} from '@inertiajs/inertia-vue3'

const props = defineProps({
    links: Array,
    currentPage: Number,
    totalPages: Number,
})
</script>

<style>

.main-table__pagination-button {
    min-width: 30px;
    @apply flex justify-center p-0.5 bg-blue-700 text-white cursor-pointer;
    @apply rounded-md border-[2px] border-solid border-blue-600;
    @apply disabled:bg-blue-600 disabled:border-blue-600;
    @apply hover:bg-blue-600 hover:border-blue-600;
}

.main-table__pagination-button + .active {
    @apply bg-white text-gray-600 border-blue-600;
}
</style>>
