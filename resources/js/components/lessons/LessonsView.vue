<template>
    <!-- Accordion START -->
    <div class="accordion accordion-icon accordion-bg-light" :id="'accordionExample' + lesson.lesson_id">
        <!-- Item -->
        <div  class="accordion-item mb-3">
            <h6 class="accordion-header font-base" :id="'heading-' + lesson.lesson_id">
                <a class="accordion-button fw-bold rounded d-block pe-4" data-bs-toggle="collapse" :data-bs-target="'#collapse-' + lesson.lesson_id" aria-expanded="false" :aria-controls="'collapse-' + lesson.lesson_id">
                    <span class="mb-0">Урок {{lesson.lesson_number}}</span>
                    <span class="small d-block mt-1">{{lesson.name}}</span>
                </a>
            </h6>
            <div :id="'collapse-' + lesson.lesson_id" class="accordion-collapse collapse" :aria-labelledby="'heading-' + lesson.lesson_id" data-bs-parent="#accordionExample2">
                <div class="accordion-body mt-3">
                    <div class="vstack gap-3">

                        <!-- Course lecture -->
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="position-relative d-flex align-items-center">
                                    <!--                                                <span class="d-inline-block ms-0 mb-2 h6 fw-light w-150px w-sm-200px">{{lesson.subject_material}}</span>-->
                                    <p>{{lesson.subject_material}}</p>
                                </div>
                                <div v-if="lesson.substitute_teacher_id" data-app>
                                    <v-tooltip right>
                                        <template v-slot:activator="{ on, attrs }">
                                            <i
                                                class="fas fa-user-graduate text-blue"
                                                v-bind="attrs"
                                                v-on="on"
                                            ></i>
                                        </template>
                                        <span>Замена: {{$store.getters["users/getById"](lesson.substitute_teacher_id) ? $store.getters["users/getById"](course.substitute_teacher_id).name : ''}}</span>
                                    </v-tooltip>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Add note button -->
                                <div>
                                    <button v-if="lesson.homework_id" class="btn btn-xs btn-primary mb-0 me-2" data-bs-toggle="collapse" :href="'#addnote-' + lesson.lesson_id" aria-expanded="false" :aria-controls="'addnote-' + lesson.lesson_id">
                                        <i class="fas fa-briefcase me-2"></i>Домашнее задание
                                    </button>
                                    <a :href="lesson.lesson_recording" class="btn btn-xs btn-light mb-0 me-2" target="_blank"><i class="fas fa-play me-2"></i>Запись урока</a>
                                    <a :href="lesson.material_link" class="btn btn-xs btn-light mb-0 me-2" target="_blank"><i class="fas fa-info me-2"></i>Материал урока</a>
                                </div>
                                <!--                                            <p class="mb-0">{{lesson.date | momentStart}}</p>-->
                                <span class="badge bg-dark me-2">Дата урока: {{lesson.date | momentStart}}</span>
                            </div>


                            <!-- Notes START -->
                            <div v-if="lesson.homework_id" class="collapse" :id="'addnote-' + lesson.lesson_id">
                                <hr class="mb-0">
                                <div class="card card-body p-0 mt-2">
                                    <!-- Note item -->
                                    <div class="d-flex justify-content-between bg-light rounded-2 p-2">
                                        <!-- Content -->
                                        <div class="d-flex align-items-center">
                                            <span v-if="lesson.text" class="small d-block mt-1">{{lesson.text}}</span>
                                        </div>

                                        <div class="d-flex mt-1">
                                            <router-link :to="{ name: 'studenthomeworks', query: {lesson_id: lesson.lesson_id}}"><button class="btn btn-xs btn-primary mb-0"><i class="bi fa-fw bi-pencil-square me-2"></i>Прикрепить дз</button></router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Notes END -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Accordion END -->
</template>

<script>
import moment from "moment";

export default {
    name: "LessonsView",
    props: ['lesson'],
    data(){
        return {
            //
        }
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
