<template>
    <!-- Main content START -->
    <div class="col-md-9">
        <div class="card border bg-transparent rounded-3">
            <!-- Card header START -->
            <div class="card-header bg-transparent border-bottom">
                <h5 class="mb-0">Выбор курса</h5>
            </div>
            <!-- Card header END -->

            <!-- Card body START -->
            <div class="card-body">

                <!-- Course list table START -->
                <div class="table-responsive border-0">
                    <table class="table table-light align-middle p-4 mb-0 table-hover">
                        <!-- Table head -->
                        <thead>
                        <tr>
                            <th scope="col" class="border-0 rounded-start">Название курса</th>
                            <th scope="col" class="border-0">Всего уроков</th>
                            <th scope="col" class="border-0">Пройдено уроков</th>
                        </tr>
                        </thead>

                        <!-- Table body START -->
                        <tbody>
                        <!-- Table item -->
                        <tr>
                            <!-- Course item -->
                            <td>
                                <div class="d-flex align-items-center">
                                    <!-- Image -->
                                    <div class="w-60px">
                                        <img src="assets/images/courses/4by3/08.jpg" class="rounded" alt="">
                                    </div>
                                    <div class="mb-0 ms-2">
                                        <!-- Title -->
                                        <h6><a href="#">Building Scalable APIs with GraphQL</a></h6>
                                        <!-- Info -->
                                        <div class="d-sm-flex">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <!-- Enrolled item -->
                            <td class="text-center text-sm-start">
                                <p class="h6 fw-light mb-0 small me-3"><i class="fas fa-table text-orange me-2"></i>18 lectures</p>
                            </td>
                            <!-- Status item -->
                            <td>
                                <div class="badge bg-success bg-opacity-10 text-success">
                                    <p class="h6 fw-light mb-0 small"><i class="fas fa-check-circle text-success me-2"></i>6 Completed</p>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                        <!-- Table body END -->
                    </table>
                </div>
                <!-- Course list table END -->

            </div>
            <!-- Card body START -->
        </div>

    </div>
    <!-- Main content END -->
</template>

<script>
export default {
    name: "Homeworks",

    data() {
        return {

        }
    },

    methods: {
        loadCourses() {
            axios.post('api/courses/getCourse')
        }
    },

    mounted() {
        this.loadCourses()
    }
}
</script>

<style scoped>

</style>
