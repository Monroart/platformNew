<template>
    <div>
        <!-- Card header START -->
        <div class="card-header bg-transparent border-bottom">
            <h5 class="mb-0">{{ showCourses ? 'Выбор курса' : 'Выбор урока' }}</h5>
        </div>
        <!-- Card header END -->

        <!-- Card body START -->
        <div class="card-body">

            <!-- Course list table START -->
            <div v-if="showCourses" class="table-responsive border-0">
                <table class="table table-light align-middle p-2 mb-0 table-hover">
                    <!-- Table head -->
                    <thead class="border-bottom">
                    <tr>
                        <th scope="col" class="border-0 rounded-start">Название курса</th>
                        <th scope="col" class="border-0 text-center">Всего уроков</th>
                        <th scope="col" class="border-0 rounded bg-light-subtle text-center">Пройдено уроков</th>
                    </tr>
                    </thead>

                    <!-- Table body START -->
                    <tbody>
                    <!-- Table item -->
                    <tr v-for="course in courses" @click="showLessons(course.id)">
                        <!-- Course item -->
                        <td>
                            <div class="d-flex align-items-center">
                                <!-- Image -->
                                <div class="w-60px">
                                    <img :src="course.subject_image" class="rounded" alt="">
                                </div>
                                <div class="mb-0 ms-2">
                                    <!-- Title -->
                                    <h6><a href="#">{{ course.name }}</a></h6>
                                    <!-- Info -->
                                    <div class="d-sm-flex">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <!-- Enrolled item -->
                        <td class="text-center text-sm-left">
                            <p class="h6 fw-light mb-0 small me-3"><i class="fas fa-table text-orange me-2"></i>{{ course.count_lessons }}</p>
                        </td>
                        <!-- Status item -->
                        <td class="text-center text-sm-left">
                            <div class="badge bg-success bg-opacity-10 text-success">
                                <p class="h6 fw-light mb-0 small"><i class="fas fa-check-circle text-success me-2"></i>{{ course.count_lessons_complete }}</p>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    <!-- Table body END -->
                </table>
            </div>
            <!-- Course list table END -->
            <div v-else class="table-responsive border-0">
                <table class="table table-light align-middle p-4 mb-0 table-hover">
                    <!-- Table head -->
                    <thead>
                    <tr>
                        <th scope="col" class="border-0 rounded-start text-center">Номер урока</th>
                        <th scope="col" class="border-0">Преподаватель</th>
                        <th scope="col" class="border-0 text-center">Дата урока</th>
                        <th scope="col" class="border-0 text-center">Комментариев</th>
                    </tr>
                    </thead>

                    <!-- Table body START -->
                    <tbody>
                    <!-- Table item -->
                    <tr v-for="lesson in lessons" @click="goToLesson(lesson.id)">
                        <!-- Course item -->
                        <td class="text-center text-sm-left">
                            <div class="d-flex align-items-center">
                                <!-- Image -->
                                <div class="w-60px">
                                    <img src="#" class="rounded" alt="">
                                </div>
                                <div class="mb-0 ms-2">
                                    <!-- Title -->
                                    <h6>{{ lesson.lesson_number }}</h6>
                                    <!-- Info -->
                                    <div class="d-sm-flex">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <!-- Enrolled item -->
                        <td>
                            <div class="d-flex align-items-center position-relative">
                                <!-- Image -->
                                <div class="avatar avatar-md mb-2 mb-md-0">
                                    <img :src="$store.getters['users/getById'](lesson.substitute_teacher_id).profile_image" class="rounded" alt="">
                                </div>
                                <div class="mb-0 ms-2">
                                    <!-- Title -->
                                    <a href="#" class="stretched-link">
                                        {{ $store.getters["users/getById"](lesson.substitute_teacher_id).name }}
                                    </a>
                                </div>
                            </div>
                        </td>
                        <!-- Status item -->
                        <td class="text-center text-sm-left">
                            <div class="badge bg-success bg-opacity-10 text-success">
                                <p class="h6 fw-light mb-0 small">{{ lesson.date }}</p>
                            </div>
                        </td>

                        <td class="text-center text-sm-left">
                            <div class="badge bg-success bg-opacity-10 text-success">
                                <p class="h6 fw-light mb-0 small">{{ lesson.lesson_description.length }}</p>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    <!-- Table body END -->
                </table>
            </div>

        </div>
        <!-- Card body START -->
    </div>
</template>

<script>
export default {
    name: "HomeworkCoursesList",

    data() {
        return {
            courses: null,
            showCourses: true,
            lessons: null,
        }
    },

    methods: {
        loadCoursesList() {
            axios.post('api/homeworks/coursesList', {
                role: this.$store.getters["users/getRoleNameByUserId"](this.$store.getters["auth/user"].id)
            }).then((res) => {
                if (res.data.status === 'ok')
                    this.courses = res.data.courses
                else
                    alert(res.data.message)
            })
        },

        showLessons(id) {
            axios.post('api/homeworks/lessonsList', {
                course_id: id
            }).then((res) => {
                if (res.data.status === 'ok') {
                    this.lessons = res.data.lessons
                    this.showCourses = false
                } else
                    alert(res.data.message)

            })
        },

        goToLesson(id) {
            console.log(id)
            this.$router.push({
                path: '/studenthomeworks',
                query: { lesson_id: id }
            })
        }
    },

    mounted() {
        this.loadCoursesList()
    }
}
</script>
