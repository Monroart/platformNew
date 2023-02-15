<template>
    <div class="col-md-9">
<!--        <lesson-info></lesson-info>-->

        <h5 class="mb-4">Ask Your Question</h5>

        <!-- Comment box -->
        <div class="d-flex mb-4">
            <!-- Avatar -->
            <div class="avatar avatar-sm flex-shrink-0 me-2">
                <a href="#"> <img class="avatar-img rounded-circle" src="assets/images/avatar/09.jpg" alt=""> </a>
            </div>

            <form class="w-100 d-flex">
                <textarea class="one form-control pe-4 bg-light" id="autoheighttextarea" rows="1" placeholder="Add a comment..."></textarea>
                <button class="btn btn-primary ms-2 mb-0" type="button">Post</button>
            </form>
        </div>

        <!-- Comment item START -->
        <div class="border p-2 p-sm-4 rounded-3 mb-4">

            <ul class="list-unstyled mb-0">
                <li class="comment-item">
                    <div class="d-flex mb-3">
                        <!-- Avatar -->
                        <div class="avatar avatar-sm flex-shrink-0">
                            <a href="#"><img class="avatar-img rounded-circle" src="assets/images/avatar/05.jpg" alt=""></a>
                        </div>
                        <div class="ms-2">
                            <!-- Comment by -->
                            <div class="bg-light p-3 rounded">
                                <div class="d-flex justify-content-center">
                                    <div class="me-2">
                                        <h6 class="mb-1 lead fw-bold"> <a href="#!"> Frances Guerrero </a></h6>
                                        <p class="mb-0">Removed demands expense account in outward tedious do. Particular way thoroughly unaffected projection?</p>
                                    </div>
                                    <small>5hr</small>
                                </div>
                            </div>
                            <!-- Comment react -->
                            <ul class="nav nav-divider py-2 small">
                                <li class="nav-item"> <a class="text-primary-hover" @click="false">  1 February 00:00:01</a> </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Comment item nested START -->

                    <!-- Comment item nested END -->
                </li>
            </ul>

            <ul class="list-unstyled ms-4">
                <!-- Comment item START -->
                <li class="comment-item">
                    <div class="d-flex">
                        <!-- Avatar -->
                        <div class="avatar avatar-xs flex-shrink-0">
                            <a href="#"><img class="avatar-img rounded-circle" src="assets/images/avatar/06.jpg" alt=""></a>
                        </div>
                        <!-- Comment by -->
                        <div class="ms-2">
                            <div class="bg-unligth p-3 rounded">
                                <div class="d-flex justify-content-center">
                                    <div class="me-2">
                                        <h6 class="mb-1  lead fw-bold"> <a href="#"> Lori Stevens </a> </h6>
                                        <p class=" mb-0">See resolved goodness felicity shy civility domestic had but Drawings offended yet answered Jennings perceive. Domestic had but Drawings offended yet answered Jennings perceive.</p>
                                    </div>
                                    <small>2hr</small>
                                </div>

                                <div class="mt-2 ms-3">
                                    <i class="fa-duotone fa-file-arrow-down"></i> File
                                </div>
                            </div>
                            <!-- Comment react -->
                            <ul class="nav nav-divider py-2 small">
                                <li class="nav-item"> <a class="text-primary-hover" @click="false">  1 February 00:00:01</a> </li>
                                <li class="nav-item"> <a class="text-primary-hover" @click="false"> Delete</a> </li>
                                <li class="nav-item"> <a class="text-primary-hover" @click="false"> Edit</a> </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <!-- Comment item END -->
            </ul>

            <ul class="list-unstyled mb-0">
                <li class="comment-item">
                    <div class="d-flex mb-3">
                        <!-- Avatar -->
                        <div class="avatar avatar-sm flex-shrink-0">
                            <a href="#"><img class="avatar-img rounded-circle" src="assets/images/avatar/05.jpg" alt=""></a>
                        </div>
                        <div class="ms-2">
                            <!-- Comment by -->
                            <div class="bg-light p-3 rounded">
                                <div class="d-flex justify-content-center">
                                    <div class="me-2">
                                        <h6 class="mb-1 lead fw-bold"> <a href="#!"> Frances Guerrero </a></h6>
                                        <p class="mb-0">Removed demands expense account in outward tedious do. Particular way thoroughly unaffected projection?</p>
                                    </div>
                                    <small>5hr</small>
                                </div>
                            </div>
                            <!-- Comment react -->
                            <ul class="nav nav-divider py-2 small">
                                <li class="nav-item"> <a class="text-primary-hover" @click="false">  1 February 00:00:01</a> </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Comment item nested START -->

                    <!-- Comment item nested END -->
                </li>
            </ul>
        </div>
        <!-- Comment item END -->

    </div>
</template>

<script>
import LessonInfo from "./LessonInfo.vue";

export default {
    name: "StudentHomework",
    components: {LessonInfo},
    props: ['lesson_id'],
    data () {
      return {
          lesson: {},
      }
    },
    methods: {
        loadLessonInfo() {
            axios.post('api/homeworks/getLessonInfo', {
                lesson_id: this.lesson_id
            }).then((res) => {
                if (res.data.status === 'ok')
                    this.lesson = res.data.lesson
            })

        }
    },

    mounted() {
        this.loadLessonInfo()
    }
}
</script>

<style scoped>
    .bg-unligth {
        background-color: rgba(0,65,255,0.07);
    }
</style>
