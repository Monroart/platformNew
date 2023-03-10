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
                                <router-link :to="{ name: 'courseId', query: {course_id: course.id, course_name: course.name, course_length: course.course_length}}"><a class="btn btn-primary-soft btn-sm mb-0">Посмотреть</a></router-link>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card END -->
            </div>
        </div>
        <!-- Course item END -->
    </div>
    <!-- Main content END -->
</template>

<script>
import moment from 'moment'
import {getDayOfWeek} from "../../utils";
import {mapActions} from "vuex";
export default {
    name: "Courses",

    data(){
        return {
            courses: null,
        }
    },
    methods:{
        ...mapActions({
            startLoading: "loading/startLoading",
            endLoading: "loading/endLoading",
        }),
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
        this.startLoading()
        this.getMyCourses()
        this.endLoading()
    }
}
</script>

<style scoped>

</style>
