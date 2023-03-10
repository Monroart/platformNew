<template>
    <div class="col-md-9">

<!--        teacher lesson-->
        <div class="border p-2 p-sm-3 rounded-3">

            <!-- Card header START -->
            <div class="card-header border-bottom">
                <h5 v-if="lesson.lesson_number" class="mb-0">{{ 'Lesson ' + lesson.lesson_number }}</h5>
            </div>
            <!-- Card header END -->

            <!-- Card body START -->
            <div class="card-body">
                <div class="row g-3">
                    <!-- Lecture item START -->
                    <div class="col-12">
                        <!-- Curriculum item -->
                        <h6 class="mb-1">{{ lesson.theme }}</h6>

                        <div class="hstack gap-3 mb-2">
                            <span class="text-dark"><i class="far fa-clock text-danger me-2"></i>{{ lesson.date }}</span>
                            <span class="text-dark"><i class="fas fa-table text-orange me-2"></i>{{ lesson.teacher }}</span>
                        </div>
                        <!-- Text -->
                        <div class="d-sm-flex justify-content-sm-between align-items-center">
                            <div v-if="lesson.text" class="d-flex">
                                <div class="ms-1 ms-sm-2 mt-1 mt-sm-0 mb-2">
                                    <p class="my-auto">{{ lesson.text }}</p>
                                </div>
                            </div>
                        </div>
                        <!--File-->
                        <div class="d-sm-flex justify-content-sm-between align-items-center">
                            <a v-if="lesson.image_path" class="d-flex px-3" :href="lesson.image_path">
                                <a class="btn btn-danger-soft btn-round mb-0"><i class="fas fa-play my-auto"></i></a>
                                <div class="ms-2 ms-sm-3 mt-1 mt-sm-0 d-flex">
                                    <h6 class="my-auto">{{ getFileName(lesson.image_path) }}</h6>
                                </div>
                            </a>
                        </div>
                        <!-- Divider -->
                        <hr>
                    </div>


                    <!-- Lecture item END -->

                    <!-- Collapse body END -->

                    <!-- Collapse button -->

                </div>
            </div>
            <!-- Card body START -->

        </div>
<!--        end teacher lesson-->

<!--        Discussion-->
        <div class="border p-2 p-sm-4 rounded-3 mb-4 mt-4 ">
            <ul class="list-unstyled mb-0">
                <li class="comment-item" v-for="comment in description" :class="{'ms-4': $store.getters['users/getById'](comment.user_id).role_id === 1}">
                    <div class="d-flex mb-3">
                        <!-- Avatar -->
                        <div class="avatar avatar-sm flex-shrink-0">
                            <a href="#"><img class="avatar-img rounded-circle"
                                             :src="$store.getters['users/getById'](comment.user_id).profile_image"
                                             alt="">
                            </a>
                        </div>
                        <div class="ms-2">
                            <!-- Comment by -->
                            <div class="p-3 rounded"
                                 :class="{'bg-primary-soft': $store.getters['users/getById'](comment.user_id).role_id === 1,
                                        'bg-light': $store.getters['users/getById'](comment.user_id).role_id === 2}"
                            >
                                <div class="d-flex justify-content-between">
                                    <div class="me-2">
                                        <h6 class="mb-1 lead fw-bold"> <a href="#!"> {{ $store.getters['users/getById'](comment.user_id).name }} </a></h6>
                                        <p class="mb-0">{{ comment.comment }}</p>

                                        <div v-if="comment.files" v-for="file in comment.files" class="d-sm-flex justify-content-sm-between align-items-center mt-2">
                                            <a v-if="file.file_type === 'document'" class="d-flex px-3" :href="file.path" download>
                                                <a class="btn btn-danger-soft btn-round mb-0"><i class="fas fa-play my-auto"></i></a>
                                                <div class="ms-2 ms-sm-3 mt-1 mt-sm-0 d-flex">
                                                    <p class="my-auto filename">{{ getFileName(file.path) }}</p>
                                                </div>
                                            </a>

                                            <div v-if="file.file_type === 'image'" class="col-md-5">
                                                <a :href="file.path" target="_blank">
                                                    <img :src="file.path" alt="" class="img-fluid rounded-3">
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                    <small>5hr</small>
                                </div>
                            </div>
                            <!-- Comment react -->
                            <ul class="nav nav-divider py-2 small">
                                <li class="nav-item"> <a class="text-primary-hover" href="#"> Отправлено </a> </li>
                                <li class="nav-item"> <a class="text-primary-hover" href="#">{{  $moment(comment.created_at).format('YY-MM-DD HH:MM') }}</a> </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Comment item nested END -->
                </li>

            </ul>
        </div>

        <div class="d-flex mt-4">
            <div data-app class="d-flex px-2 mb-0">
                <v-file-input
                    v-model="files"
                    multiple
                    prepend-icon="mdi-paperclip"
                >
                </v-file-input>
            </div>
            <textarea v-model="comment" class="form-control mb-0 shadow-hover" rows="0" spellcheck="false"></textarea>
            <button @click="sendForm" class="btn btn-sm btn-primary-soft ms-2 px-4 mb-0 flex-shrink-0"><i class="fas fa-paper-plane fs-8"></i></button>
        </div>


    </div>
</template>

<script>
export default {
    name: "StudentHomework",
    props: ['lesson_id'],

    data() {
        return {
            comment: '',
            files: null,
            lesson: {},
            loadingDescription: false,
            description: {},
        }
    },

    methods: {
        loadLessonInfo: function () {
            axios.post('api/homeworks/lessons/getById', {lesson_id: this.lesson_id})
                .then((res) => {
                    this.lesson = res.data
                })
        },

        getFileName: function (url) {
            let items = url.split('/')
            return items.pop()
        },

        loadLessonDescription() {
            this.loadingDescription = true
            axios.post('api/homeworks/lessons/getDescription', {lesson_id: this.lesson_id})
                .then((res) => {
                    this.description = res.data
                    this.loadingDescription = false
                })
        },

        sendForm() {
            if (!this.files && !this.comment)
                return false;

            let formData = new FormData()
            formData.append('lesson_id', this.lesson_id)
            if (this.files) {
                this.files.forEach((file, idx) => {
                    formData.append(`attachments[${idx}]`, file)
                })
            }

            if (this.comment)
                formData.append('comment', this.comment)

            axios.post('api/homeworks/lessons/createComment', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(((res) => {
                if (res.data.status === 'ok') {
                    this.comment = null
                    this.files = null
                    this.loadLessonDescription()
                }
            }))
        }
    },

    mounted() {
        this.loadLessonInfo()
        this.loadLessonDescription()
    }
}
</script>

<style scoped>
    .bg-primary-soft {
        background-color: #e1e1ef;
    }

    .p-3.rounded {
        width: 45rem;
        max-width: 45rem;
    }

    .filename {
        font-size: 0.8rem;
        font-weight: bold;
        color: black;
    }
</style>
