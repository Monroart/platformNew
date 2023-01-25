<template>
    <div class="col-md-9">
        <div class="card border mt-0">
            <div class="card-body">

                <!-- Title -->
                <h5>Курс {{course_id}}</h5>

                <!-- Accordion START -->
                <div v-for="lesson in lessons" class="accordion accordion-icon accordion-bg-light" :id="'accordionExample' + lesson.id">
                    <!-- Item -->
                    <div  class="accordion-item mb-3">
                        <h6 class="accordion-header font-base" :id="'heading-' + lesson.id">
                            <a class="accordion-button fw-bold rounded d-block pe-4" data-bs-toggle="collapse" :data-bs-target="'#collapse-' + lesson.id" aria-expanded="false" :aria-controls="'collapse-' + lesson.id">
                                <span class="mb-0">Урок {{lesson.lesson_number}}</span>
                                <span class="small d-block mt-1">{{lesson.name}}</span>
                            </a>
                        </h6>
                        <div :id="'collapse-' + lesson.id" class="accordion-collapse collapse" :aria-labelledby="'heading-' + lesson.id" data-bs-parent="#accordionExample2">
                            <div class="accordion-body mt-3">
                                <div class="vstack gap-3">

                                    <!--                                    &lt;!&ndash; Progress bar &ndash;&gt;-->
                                    <!--                                    <div class="overflow-hidden">-->
                                    <!--                                        <div class="d-flex justify-content-between">-->
                                    <!--                                            <p class="mb-1 h6">1/2 Completed</p>-->
                                    <!--                                            <h6 class="mb-1 text-end">80%</h6>-->
                                    <!--                                        </div>-->
                                    <!--                                        <div class="progress progress-sm bg-primary bg-opacity-10">-->
                                    <!--                                            <div class="progress-bar bg-primary aos" role="progressbar" data-aos="slide-right" data-aos-delay="200" data-aos-duration="1000" data-aos-easing="ease-in-out" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">-->
                                    <!--                                            </div>-->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->

                                    <!-- Course lecture -->
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="position-relative d-flex align-items-center">
<!--                                                <span class="d-inline-block ms-0 mb-2 h6 fw-light w-150px w-sm-200px">{{lesson.subject_material}}</span>-->
                                                <p>{{lesson.subject_material}}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <!-- Add note button -->
                                            <div>
                                                <a class="btn btn-xs btn-warning mb-0 me-2" data-bs-toggle="collapse" href="#addnote-1" role="button" aria-expanded="false" aria-controls="addnote-1">
                                                    <i class="bi fa-fw bi-pencil-square me-2"></i>Домашнее задание
                                                </a>
                                                <a :href="lesson.lesson_recording" class="btn btn-xs btn-dark mb-0 me-2" target="_blank"><i class="fas fa-play me-2"></i>Запись урока</a>
                                                <a :href="lesson.material_link" class="btn btn-xs btn-dark mb-0 me-2" target="_blank"><i class="fas fa-info me-2"></i>Материал урока</a>
                                            </div>
<!--                                            <p class="mb-0">{{lesson.date | momentStart}}</p>-->
                                            <span class="badge bg-dark me-2">{{lesson.date | momentStart}}</span>
                                        </div>


                                        <!-- Notes START -->
                                        <div class="collapse" id="addnote-1">
                                            <div class="card card-body p-0 mt-2">

                                                <!-- Note item -->
                                                <div class="d-flex justify-content-between bg-light rounded-2 p-2">
                                                    <!-- Content -->
                                                    <div class="d-flex align-items-center">
                                                        <span v-if="lesson.text" class="small d-block mt-1">{{lesson.text}}</span>
                                                        <span v-else class="small d-block mt-1">Преподаватель еще не прикрепил домашнее задание</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Notes END -->

                                        <hr class="mb-0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Item -->
                    <!--                    <div class="accordion-item mb-3">-->
                    <!--                        <h6 class="accordion-header font-base" id="heading-2">-->
                    <!--                            <a class="accordion-button fw-bold collapsed rounded d-block pe-4" href="#collapse-2" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">-->
                    <!--                                <span class="mb-0">Customer Life cycle</span>-->
                    <!--                                <span class="small d-block mt-1">(3 Lectures)</span>-->
                    <!--                            </a>-->
                    <!--                        </h6>-->
                    <!--                        <div id="collapse-2" class="accordion-collapse collapse" aria-labelledby="heading-2" data-bs-parent="#accordionExample2">-->
                    <!--                            &lt;!&ndash; Accordion body START &ndash;&gt;-->
                    <!--                            <div class="accordion-body mt-3">-->
                    <!--                                <div class="vstack gap-3">-->
                    <!--                                    &lt;!&ndash; Progress bar &ndash;&gt;-->
                    <!--                                    <div class="overflow-hidden">-->
                    <!--                                        <div class="d-flex justify-content-between">-->
                    <!--                                            <p class="mb-1 h6">0/3 Completed</p>-->
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
                    <!--                                                <span class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-sm-400px">Introduction</span>-->
                    <!--                                            </div>-->
                    <!--                                            <p class="mb-0 text-truncate">2m 10s</p>-->
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
                    <!--                                                <span class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-150px w-sm-400px"> What is Digital Marketing What is Digital Marketing</span>-->
                    <!--                                            </div>-->
                    <!--                                            <p class="mb-0 text-truncate">15m 10s</p>-->
                    <!--                                        </div>-->
                    <!--                                        <hr class="mb-0">-->
                    <!--                                    </div>-->

                    <!--                                    &lt;!&ndash; Course lecture &ndash;&gt;-->
                    <!--                                    <div class="d-flex justify-content-between align-items-center">-->
                    <!--                                        <div class="position-relative d-flex align-items-center">-->
                    <!--                                            <a href="#" class="btn btn-light btn-round btn-sm mb-0 stretched-link position-static" data-bs-toggle="modal" data-bs-target="#coursePremium">-->
                    <!--                                                <i class="bi bi-lock-fill"></i>-->
                    <!--                                            </a>-->
                    <!--                                            <span class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-150px w-sm-400px">Type of Digital Marketing</span>-->
                    <!--                                        </div>-->
                    <!--                                        <p class="mb-0 text-truncate">18m 10s</p>-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            &lt;!&ndash; Accordion body END &ndash;&gt;-->
                    <!--                        </div>-->
                    <!--                    </div>-->

                </div>
                <!-- Accordion END -->
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    name: "CourseView",
    props: ['course_id'],
    data(){
        return {
            lessons: null
        }
    },
    methods: {
        getLessonsByCourse(){
            axios.post('api/courses/getLessonsByCourse', {
                course_id: this.course_id
            }).then(res => {
                this.lessons = res.data.lessons
            });
        }
    },
    mounted() {
        this.getLessonsByCourse()
    },
    filters: {
        momentStart: function (date) {
            moment.lang('ru');
            return moment(date).format('DD.MM hh:mm');
        },
        momentTime: function (date) {
            moment.lang('ru');
            return moment(date).format('hh:mm');
        }
    }
}
</script>

<style scoped>

</style>
