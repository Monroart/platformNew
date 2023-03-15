<template>
    <div :class="width >= '1200' ? 'col-md-9' : 'col-md-12'">
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
            width: window.innerWidth,
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
<style lang="scss">
.multiselect__tag {
  color: #f1f1f1;
  background-color: #066ac9;
  font-size: 01rem;
}
.multiselect__tag:hover {
  background-color: #ef476f;
}

.multiselect__option--disabled {
  background: purple;
  color: #066ac9;
  font-style: italic;
}

.multiselect__option--highlight {
  background-color: #066ac9;
  color: #fff;
  font-size: 0.9rem;
  height: 1rem;
}

.multiselect__content {
  background: rgb(255, 255, 255);
  color: #444;
  font-size: 0.9rem;
}
.multiselect__single {
  height: 0.8rem;
  font-size: 01rem;
  color: #444;
}
.multiselect__tag {
  position: relative;
  display: inline-block;
  padding: 0.25rem 1.625rem 0.25rem 0.625rem;

  margin-right: 0.625rem;

  line-height: 1;

  margin-bottom: 0.5rem;
}
.multiselect__tag-icon:hover{
  background-color: #ef476f;
}
.multiselect__tag-icon:after{
  color: #ffffff;
}
</style>
