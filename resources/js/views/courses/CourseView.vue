<template>
    <div class="col-md-9">
        <div class="card border mt-0">
            <div class="card-body">

                <!-- Title -->
                <h5>Курс {{course_name}}</h5>
                <!-- Progress bar -->
                <div class="overflow-hidden mb-3">
                    <div class="d-flex justify-content-between">
                        <p class="mb-1 h6">1/2 Completed</p>
                        <h6 class="mb-1 text-end">80%</h6>
                    </div>
                    <div class="progress progress-sm bg-primary bg-opacity-10">
                        <div class="progress-bar bg-primary aos aos-init aos-animate" role="progressbar" data-aos="slide-right" data-aos-delay="200" data-aos-duration="1000" data-aos-easing="ease-in-out" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                </div>
                <div v-if="lessons">
                    <lesson-view
                        v-for="lesson in lessons"
                        v-bind:key="lesson.lesson_id"
                        :lesson = 'lesson'
                    ></lesson-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";
import LessonsView from "../../components/lessons/LessonsView";

export default {
    name: "CourseView",
    components: {
        'lesson-view' : LessonsView
    },
    props: ['course_id', 'course_name'],
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
}
</script>

<style scoped>

</style>
