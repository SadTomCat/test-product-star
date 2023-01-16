<template>
    <MainLayout>
        <MainTable :columns="columns" :items="pagination.data"/>

        <SimplePagination class="mt-2"
                          :links="pagination.links"
                          :current-page="pagination.current_page"
                          :total-pages="pagination.last_page"
        />
    </MainLayout>
</template>

<script setup>
import MainLayout from '../Componets/MainLayout.vue'
import MainTable from '../Componets/Tables/MainTable.vue'
import SimplePagination from '../Componets/Paginations/SimplePagination.vue'

const props = defineProps({
    pagination: Object
})

const columns = [
    {field: 'lesson', title: 'Lesson'},
    {field: 'course', title: 'Course'},
    {field: 'viewed', title: 'Viewed'},
]

</script>

