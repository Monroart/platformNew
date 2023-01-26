<template>
    <!-- Main content START -->
    <div v-if="courses" class="col-md-9">

        <!-- Course item START -->
        <div v-for="course in courses" class="card border mb-3">
            <div class="card-header border-bottom">
                <!-- Card START -->
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-3">
                            <img :src="course.subject_image" class="rounded-2" alt="Card image">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <!-- Title -->
                                <h3 class="card-title"><a href="#">{{course.name}}</a></h3>

                                <!-- Info -->
                                <ul class="list-inline mb-2">
                                    <li class="list-inline-item h6 fw-light mb-1 mb-sm-0"><i class="fas fa-play-circle me-2"></i>{{course.start_date | momentStart}}</li>
                                    <li class="list-inline-item h6 fw-light mb-1 mb-sm-0"><i class="fas fa-table text-orange me-2"></i>{{getDays(course.lessons_days)}}</li>
                                    <li class="list-inline-item h6 fw-light mb-1 mb-sm-0"><i class="far fa-clock text-danger me-2"></i>{{course.start_date | momentTime}}</li>
                                    <li class="list-inline-item h6 fw-light mb-1 mb-sm-0"><i class="fas fa-user-graduate text-blue me-2"></i>{{$store.getters["users/getById"](course.default_teacher_id) ? $store.getters["users/getById"](course.default_teacher_id).name : ''}}</li>
                                    <li class="list-inline-item h6 fw-light"><i class="fas fa-signal text-success me-2"></i>{{course.subject_name}}</li>
                                </ul>

                                <!-- button -->
                                <router-link :to="{ name: 'courseId', query: {course_id: course.id, course_name: course.name}}"><a class="btn btn-primary-soft btn-sm mb-0">Посмотреть</a></router-link>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card END -->
            </div>
        </div>
        <!-- Course item END -->

        <!-- Course item START -->
<!--        <div class="card border mt-4">-->
<!--            <div class="card-header border-bottom">-->
<!--                &lt;!&ndash; Card START &ndash;&gt;-->
<!--                <div class="card">-->
<!--                    <div class="row g-0">-->
<!--                        <div class="col-md-3">-->
<!--                            <img src="assets/images/courses/4by3/08.jpg" class="rounded-2" alt="Card image">-->
<!--                        </div>-->
<!--                        <div class="col-md-9">-->
<!--                            <div class="card-body">-->
<!--                                &lt;!&ndash; Title &ndash;&gt;-->
<!--                                <h3 class="card-title"><a href="#">Sketch from A to Z: for app designer</a></h3>-->

<!--                                &lt;!&ndash; Info &ndash;&gt;-->
<!--                                <ul class="list-inline mb-2">-->
<!--                                    <li class="list-inline-item h6 fw-light mb-1 mb-sm-0"><i class="far fa-clock text-danger me-2"></i>8h 56m</li>-->
<!--                                    <li class="list-inline-item h6 fw-light mb-1 mb-sm-0"><i class="fas fa-table text-orange me-2"></i>65 lectures</li>-->
<!--                                    <li class="list-inline-item h6 fw-light"><i class="fas fa-signal text-success me-2"></i>All level</li>-->
<!--                                </ul>-->
<!--                                &lt;!&ndash; Button &ndash;&gt;-->
<!--                                <a href="#" class="btn btn-primary-soft btn-sm mb-0">Resume course</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                &lt;!&ndash; Card END &ndash;&gt;-->
<!--            </div>-->

<!--            <div class="card-body">-->

<!--                &lt;!&ndash; Title &ndash;&gt;-->
<!--                <h5>Course Curriculum</h5>-->

<!--                &lt;!&ndash; Accordion START &ndash;&gt;-->
<!--                <div class="accordion accordion-icon accordion-bg-light" id="accordionExample4">-->
<!--                    &lt;!&ndash; Item &ndash;&gt;-->
<!--                    <div class="accordion-item mb-3">-->
<!--                        <h6 class="accordion-header font-base" id="heading-1-1">-->
<!--                            <a class="accordion-button fw-bold rounded collapsed d-block pe-4" href="#collapse-1-1" data-bs-toggle="collapse" data-bs-target="#collapse-1-1" aria-expanded="false" aria-controls="collapse-1-1">-->
<!--                                <span class="mb-0">Introduction of Sketch</span>-->
<!--                                <span class="small d-block mt-1">(3 Lectures)</span>-->
<!--                            </a>-->
<!--                        </h6>-->
<!--                        <div id="collapse-1-1" class="accordion-collapse collapse" aria-labelledby="heading-1-1" data-bs-parent="#accordionExample4">-->
<!--                            <div class="accordion-body mt-3">-->
<!--                                <div class="vstack gap-3">-->

<!--                                    &lt;!&ndash; Progress bar &ndash;&gt;-->
<!--                                    <div class="overflow-hidden">-->
<!--                                        <div class="d-flex justify-content-between">-->
<!--                                            <p class="mb-1 h6">1/3 Completed</p>-->
<!--                                            <h6 class="mb-1 text-end">35%</h6>-->
<!--                                        </div>-->
<!--                                        <div class="progress progress-sm bg-primary bg-opacity-10">-->
<!--                                            <div class="progress-bar bg-primary aos" role="progressbar" data-aos="slide-right" data-aos-delay="200" data-aos-duration="1000" data-aos-easing="ease-in-out" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->

<!--                                    &lt;!&ndash; Course lecture &ndash;&gt;-->
<!--                                    <div>-->
<!--                                        <div class="d-flex justify-content-between align-items-center mb-2">-->
<!--                                            <div class="position-relative d-flex align-items-center">-->
<!--                                                <a href="#" class="btn btn-success btn-round btn-sm mb-0 stretched-link position-static">-->
<!--                                                    <i class="fas fa-play me-0"></i>-->
<!--                                                </a>-->
<!--                                                <span class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-150px w-sm-400px">Introduction</span>-->
<!--                                            </div>-->
<!--                                            <p class="mb-0 text-truncate">2m 10s</p>-->
<!--                                        </div>-->

<!--                                        &lt;!&ndash; Add note button &ndash;&gt;-->
<!--                                        <a class="btn btn-xs btn-warning mb-0" data-bs-toggle="collapse" href="#addnote-3" role="button" aria-expanded="false" aria-controls="addnote-3">-->
<!--                                            <i class="bi fa-fw bi-pencil-square me-2"></i>Note-->
<!--                                        </a>-->
<!--                                        <a href="#" class="btn btn-xs btn-dark mb-0">Play again</a>-->

<!--                                        &lt;!&ndash; Notes START &ndash;&gt;-->
<!--                                        <div class="collapse" id="addnote-3">-->
<!--                                            <div class="card card-body p-0 mt-2">-->

<!--                                                &lt;!&ndash; Note item &ndash;&gt;-->
<!--                                                <div class="d-flex justify-content-between bg-light rounded-2 p-2 mb-2">-->
<!--                                                    &lt;!&ndash; Content &ndash;&gt;-->
<!--                                                    <div class="d-flex align-items-center">-->
<!--                                                        <span class="badge bg-dark me-2">5:20</span>-->
<!--                                                        <h6 class="d-inline-block text-truncate w-100px w-sm-400px mb-0 fw-light">Describe SEO Engine</h6>-->
<!--                                                    </div>-->
<!--                                                    &lt;!&ndash; Button &ndash;&gt;-->
<!--                                                    <div class="d-flex">-->
<!--                                                        <a href="#" class="btn btn-sm btn-light btn-round me-2 mb-0"><i class="bi fa-fw bi-play-fill"></i></a>-->
<!--                                                        <a href="#" class="btn btn-sm btn-light btn-round mb-0"><i class="bi fa-fw bi-trash-fill"></i></a>-->
<!--                                                    </div>-->
<!--                                                </div>-->

<!--                                                &lt;!&ndash; Note item &ndash;&gt;-->
<!--                                                <div class="d-flex justify-content-between bg-light rounded-2 p-2 mb-2">-->
<!--                                                    &lt;!&ndash; Content &ndash;&gt;-->
<!--                                                    <div class="d-flex align-items-center">-->
<!--                                                        <span class="badge bg-dark me-2">10:20</span>-->
<!--                                                        <h6 class="d-inline-block text-truncate w-100px w-sm-400px mb-0 fw-light">Know about all marketing</h6>-->
<!--                                                    </div>-->
<!--                                                    &lt;!&ndash; Button &ndash;&gt;-->
<!--                                                    <div class="d-flex">-->
<!--                                                        <a href="#" class="btn btn-sm btn-light btn-round me-2 mb-0"><i class="bi fa-fw bi-play-fill"></i></a>-->
<!--                                                        <a href="#" class="btn btn-sm btn-light btn-round mb-0"><i class="bi fa-fw bi-trash-fill"></i></a>-->
<!--                                                    </div>-->
<!--                                                </div>-->

<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        &lt;!&ndash; Notes END &ndash;&gt;-->

<!--                                        <hr class="mb-0">-->
<!--                                    </div>-->

<!--                                    &lt;!&ndash; Course lecture &ndash;&gt;-->
<!--                                    <div>-->
<!--                                        <div class="d-flex justify-content-between align-items-center mb-2">-->
<!--                                            <div class="position-relative d-flex align-items-center">-->
<!--                                                <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">-->
<!--                                                    <i class="fas fa-play me-0"></i>-->
<!--                                                </a>-->
<!--                                                <span class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-150px w-sm-400px"> What is Digital Marketing What is Digital Marketing</span>-->
<!--                                            </div>-->
<!--                                            <p class="mb-0 text-truncate">15m 10s</p>-->
<!--                                        </div>-->
<!--                                        <hr class="mb-0">-->
<!--                                    </div>-->

<!--                                    &lt;!&ndash; Course lecture &ndash;&gt;-->
<!--                                    <div class="d-flex justify-content-between align-items-center">-->
<!--                                        <div class="position-relative d-flex align-items-center">-->
<!--                                            <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">-->
<!--                                                <i class="fas fa-play me-0"></i>-->
<!--                                            </a>-->
<!--                                            <span class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-150px w-sm-400px">Type of Digital Marketing</span>-->
<!--                                        </div>-->
<!--                                        <p class="mb-0 text-truncate">18m 10s</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->

<!--                    &lt;!&ndash; Item &ndash;&gt;-->
<!--                    <div class="accordion-item mb-3">-->
<!--                        <h6 class="accordion-header font-base" id="heading-1-4">-->
<!--                            <a class="accordion-button fw-bold collapsed rounded d-block pe-4" href="#collapse-1-4" data-bs-toggle="collapse" data-bs-target="#collapse-1-4" aria-expanded="false" aria-controls="collapse-1-4">-->
<!--                                <span class="mb-0">YouTube Marketing</span>-->
<!--                                <span class="small d-block mt-1">(5 Lectures)</span>-->
<!--                            </a>-->
<!--                        </h6>-->
<!--                        <div id="collapse-1-4" class="accordion-collapse collapse" aria-labelledby="heading-1-4" data-bs-parent="#accordionExample4">-->
<!--                            &lt;!&ndash; Accordion body START &ndash;&gt;-->
<!--                            <div class="accordion-body mt-3">-->
<!--                                <div class="vstack gap-3">-->
<!--                                    &lt;!&ndash; Progress bar &ndash;&gt;-->
<!--                                    <div class="overflow-hidden">-->
<!--                                        <div class="d-flex justify-content-between">-->
<!--                                            <p class="mb-1 h6">0/5 Completed</p>-->
<!--                                            <h6 class="mb-1 text-end">0%</h6>-->
<!--                                        </div>-->
<!--                                        <div class="progress progress-sm bg-primary bg-opacity-10">-->
<!--                                            <div class="progress-bar bg-primary aos" role="progressbar" data-aos="slide-right" data-aos-delay="200" data-aos-duration="1000" data-aos-easing="ease-in-out" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->

<!--                                    &lt;!&ndash; Course lecture &ndash;&gt;-->
<!--                                    <div>-->
<!--                                        <div class="d-flex justify-content-between align-items-center">-->
<!--                                            <div class="position-relative d-flex align-items-center">-->
<!--                                                <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">-->
<!--                                                    <i class="fas fa-play me-0"></i>-->
<!--                                                </a>-->
<!--                                                <span class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-150px w-sm-400px">Video Flow</span>-->
<!--                                            </div>-->
<!--                                            <p class="mb-0 text-truncate">25m 5s</p>-->
<!--                                        </div>-->
<!--                                        <hr class="mb-0">-->
<!--                                    </div>-->

<!--                                    &lt;!&ndash; Course lecture &ndash;&gt;-->
<!--                                    <div>-->
<!--                                        <div class="d-flex justify-content-between align-items-center">-->
<!--                                            <div class="position-relative d-flex align-items-center">-->
<!--                                                <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">-->
<!--                                                    <i class="fas fa-play me-0"></i>-->
<!--                                                </a>-->
<!--                                                <span class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-150px w-sm-400px">Webmaster Tool</span>-->
<!--                                            </div>-->
<!--                                            <p class="mb-0 text-truncate">15m 20s</p>-->
<!--                                        </div>-->
<!--                                        <hr class="mb-0">-->
<!--                                    </div>-->

<!--                                    &lt;!&ndash; Course lecture &ndash;&gt;-->
<!--                                    <div>-->
<!--                                        <div class="d-flex justify-content-between align-items-center">-->
<!--                                            <div class="position-relative d-flex align-items-center">-->
<!--                                                <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">-->
<!--                                                    <i class="fas fa-play me-0"></i>-->
<!--                                                </a>-->
<!--                                                <span class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-150px w-sm-400px">Featured Contents on Channel</span>-->
<!--                                            </div>-->
<!--                                            <p class="mb-0 text-truncate">32m 20s</p>-->
<!--                                        </div>-->
<!--                                        <hr class="mb-0">-->
<!--                                    </div>-->

<!--                                    &lt;!&ndash; Course lecture &ndash;&gt;-->
<!--                                    <div>-->
<!--                                        <div class="d-flex justify-content-between align-items-center">-->
<!--                                            <div class="position-relative d-flex align-items-center">-->
<!--                                                <a href="#" class="btn btn-light btn-round btn-sm mb-0 stretched-link position-static" data-bs-toggle="modal" data-bs-target="#coursePremium">-->
<!--                                                    <i class="bi bi-lock-fill"></i>-->
<!--                                                </a>-->
<!--                                                <span class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-150px w-sm-400px">Managing Comments</span>-->
<!--                                            </div>-->
<!--                                            <p class="mb-0 text-truncate">20m 20s</p>-->
<!--                                        </div>-->
<!--                                        <hr class="mb-0">-->
<!--                                    </div>-->

<!--                                    &lt;!&ndash; Course lecture &ndash;&gt;-->
<!--                                    <div class="d-flex justify-content-between align-items-center">-->
<!--                                        <div class="position-relative d-flex align-items-center">-->
<!--                                            <a href="#" class="btn btn-light btn-round btn-sm mb-0 stretched-link position-static" data-bs-toggle="modal" data-bs-target="#coursePremium">-->
<!--                                                <i class="bi bi-lock-fill"></i>-->
<!--                                            </a>-->
<!--                                            <span class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-150px w-sm-400px">Channel Analytics</span>-->
<!--                                        </div>-->
<!--                                        <p class="mb-0 text-truncate">18m 20s</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            &lt;!&ndash; Accordion body END &ndash;&gt;-->
<!--                        </div>-->
<!--                    </div>-->

<!--                </div>-->
<!--                &lt;!&ndash; Accordion END &ndash;&gt;-->
<!--            </div>-->
<!--        </div>-->
        <!-- Course item END -->
    </div>
    <!-- Main content END -->
</template>

<script>
import moment from 'moment'
import {getDayOfWeek} from "../../utils";
export default {
    name: "Courses",
    data(){
        return {
            courses: null,
        }
    },
    methods:{
        getMyCourses(){
            axios.post('api/courses/getCourse').then(res =>{
                this.courses = res.data.courses
            });
        },
        getDays(days){
            return getDayOfWeek(days)
        },
    },
    filters: {
        momentStart: function (date) {
            moment.lang('ru');
            return moment(date).format('DD.MM.yyyy');
        },
        momentTime: function (date) {
            moment.lang('ru');
            return moment(date).format('hh:mm');
        }
    },
    mounted() {
        this.getMyCourses()
    }
}
</script>

<style scoped>

</style>
