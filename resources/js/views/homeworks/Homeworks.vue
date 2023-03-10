<template>
    <div class="col-md-9">
        <div v-if="$store.getters['users/getRoleNameByUserId']($store.getters['auth/user'].id) === 'student'" class="card border bg-transparent rounded-3">
            <homework-courses-list></homework-courses-list>
        </div>

        <div v-if="$store.getters['users/getRoleNameByUserId']($store.getters['auth/user'].id) === 'teacher'" class="card border bg-transparent rounded-3">
            <teacher-homework-courses-list></teacher-homework-courses-list>
        </div>
    </div>
</template>

<script>
import HomeworkCoursesList from "../../components/homeworks/HomeworkCoursesList.vue";
import TeacherHomeworkCoursesList from "../../components/homeworks/TeacherHomeworkCoursesList.vue";
export default {
    name: "Homeworks",

    data() {
        return {

        }
    },

    components: {HomeworkCoursesList, TeacherHomeworkCoursesList},
}
</script>

<style scoped>

</style>
