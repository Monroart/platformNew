<template>
    <div>
<!--         Card header START -->
        <div class="card-header bg-transparent border-bottom">
            <h6 class="mb-0">{{ showLessons ? 'Уроки на проверку' : 'Выбор ученика' }}</h6>
        </div>
        <!-- Card header END -->

        <!-- Card body START -->
        <div class="card-body">

            <!-- Course list table START -->
            <div v-if="showLessons" class="table-responsive border-0">
                <table class="table table-light align-middle p-2 mb-0 table-hover">
                    <!-- Table head -->
                    <thead class="border-bottom">
                    <tr>
                        <th scope="col" class="border-0 rounded-start text-center   ">Название курса</th>
                        <th scope="col" class="border-0 text-center">Номер урока</th>
                        <th scope="col" class="border-0 text-center">Дата урока</th>
                        <th scope="col" class="border-0 rounded bg-light-subtle text-center">Учеников в курсе</th>
                    </tr>
                    </thead>

                    <!-- Table body START -->
                    <tbody>
                    <!-- Table item -->
                    <tr v-for="lesson in lessons" @click="showUsers(lesson.id)">
                        <!-- Course item -->
                        <td class="text-center text-sm-left">
                            <p class="h6 fw-light mb-0 small me-3"><i class="fas fa-book text-purple me-2"></i>{{ lesson.name }}</p>
                        </td>
                        <!-- Enrolled item -->
                        <td class="text-center text-sm-left">
                            <p class="h6 fw-light mb-0 small me-3"><i class="fas fa-table text-orange me-2"></i>{{ lesson.lesson_number }}</p>
                        </td>
                        <td class="text-center text-sm-left">
                            <p class="h6 fw-light mb-0 small me-3"><i class="fas fa-fw fa-clock text-primary"></i>{{ lesson.date }}</p>
                        </td>
                        <!-- Status item -->
                        <td class="text-center text-sm-left">
                            <div class="badge bg-success bg-opacity-10 text-success">
                                <p class="h6 fw-light mb-0 small"><i class="fas fa-user-graduate text-orange me-2"></i>{{ lesson.count_students }}</p>
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
                        <th scope="col" class="border-0 rounded-start text-start">Ученик</th>
                        <th scope="col" class="border-0 text-center">Комментариев</th>
                    </tr>
                    </thead>

                    <!-- Table body START -->
                    <tbody>
                    <!-- Table item -->
                    <tr v-for="student in students" @click="goToLesson(student.lesson_id)">
                        <td>
                            <div class="d-flex align-items-center position-relative">
                                <!-- Image -->
                                <div class="avatar avatar-md mb-2 mb-md-0">
                                    <img :src="$store.getters['users/getById'](student.user_id).profile_image" class="rounded" alt="">
                                </div>
                                <div class="mb-0 ms-2">
                                    <!-- Title -->
                                    <a href="#" class="stretched-link">
                                        {{ $store.getters["users/getById"](student.user_id).name }}
                                    </a>
                                </div>
                            </div>
                        </td>
                        <!-- Status item -->
                        <td class="text-center text-sm-left">
                            <div class="badge bg-success bg-opacity-10 text-success">
                                <p class="h6 fw-light mb-0 small">{{ student.count_comments }}</p>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    <!-- Table body END -->
                </table>
            </div>

        </div>
<!--         Card body START -->
    </div>
</template>

<script>
export default {
    name: "HomeworkCoursesList",

    data() {
        return {
            lessons: null,
            showLessons: true,
            students: null,
        }
    },

    methods: {
        loadLessonsList() {
            axios.post('api/homeworks/coursesList', {
                role: this.$store.getters["users/getRoleNameByUserId"](this.$store.getters["auth/user"].id)
            }).then((res) => {
                if (res.data.status === 'ok')
                    this.lessons = res.data.courses
                else
                    alert(res.data.message)
            })
        },

        showUsers(id) {
            this.showLessons = false

            axios.post('api/homeworks/studentsList', {
                lesson_id: id
            }).then((res) => {
                if (res.data.status === 'ok') {
                    this.students = res.data.students
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

    async mounted() {
        await this.loadLessonsList()
    }
}
</script>
