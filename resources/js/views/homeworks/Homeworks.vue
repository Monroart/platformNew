<template>
    <div class="col-md-9">
        <div v-if="$store.getters['users/getRoleNameByUserId']($store.getters['auth/user'].id) === 'student'" class="card border bg-transparent rounded-3">
            <homework-courses-list></homework-courses-list>
        </div>

        <div v-if="$store.getters['users/getRoleNameByUserId']($store.getters['auth/user'].id) === 'teacher'" class="card border bg-transparent rounded-3">
            qq teacher
        </div>
    </div>
</template>

<script>
import HomeworkCoursesList from "../../components/homeworks/HomeworkCoursesList.vue";
export default {
    name: "Homeworks",

    data() {
        return {

        }
    },

    components: {HomeworkCoursesList},
}
</script>

<style scoped>

</style>
