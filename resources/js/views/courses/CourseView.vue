<template>
    <div class="col-md-9">
        <v-app
               id="inspire">
        <div class="card border mt-0">
            <div class="card-body">

                <!-- Title -->
                <div class="d-flex justify-content-between mb-3">
                    <h5 >Курс {{course_name}}</h5>
                    <a @click="showModal" class="btn btn-primary-soft btn-sm">Создать урок</a>
                </div>


                <!-- Progress bar -->
                <div class="overflow-hidden mb-3">
                    <div class="d-flex justify-content-between">
                        <p class="mb-1 h6">Прогресс</p>
                        <h6 class="mb-1 text-end">{{course_progress}}%</h6>
                    </div>
                        <v-progress-linear :buffer-value="course_progress" :value="course_progress" stream></v-progress-linear>
                </div>
                <div v-if="lessons">
                    <lesson-view
                        v-for="lesson in lessons"
                        v-bind:key="lesson.lesson_id"
                        :lesson = 'lesson'
                        :course_id = course_id
                        @update = "getLessonsByCourse"
                    ></lesson-view>
                </div>
            </div>
        </div>
        </v-app>
        <create-lesson-modal
            :course_id="course_id"
            v-show="isModalVisible"
            @close="closeModal">
        </create-lesson-modal>
    </div>
</template>

<script>
import moment from "moment";
import LessonsView from "../../components/lessons/LessonsView";
import {mapState} from "vuex";
import CreateLessonModal from "../../components/lessons/CreateLessonModal";

export default {
    name: "CourseView",
    components: {
        CreateLessonModal,
        'lesson-view' : LessonsView
    },
    props: ['course_id', 'course_name', 'course_length'],
    data(){
        return {
            lessons: null,
            value: 10,
            isModalVisible: false
        }
    },
    computed: {
        course_progress(){
            if(this.lessons){
                return parseFloat((this.lessons.length / this.course_length).toFixed(2)) * 100
            }
            else{
                return 0;
            }
        },
    },
    methods: {
        getLessonsByCourse(){
            axios.post('api/courses/getLessonsByCourse', {
                course_id: this.course_id
            }).then(res => {
                this.lessons = res.data.lessons
            });
        },
        showModal(){
            this.isModalVisible = true
        },
        closeModal(){
            this.isModalVisible = false
            this.getLessonsByCourse()
        }
    },
    mounted() {
        this.getLessonsByCourse()
    },
}
</script>
<style scoped>

</style>
