<template>
    <transition name="modal-fade">
<!--        <div class="container">-->
            <div class="modal-backdrop">
                <div class="modal">
                    <header class="modal-header">
                        <slot name="header">
                            <label>Создание уроков</label>
                        </slot>
                        <button
                            type="button"
                            class="btn-close"
                            @click="close"
                        >
                        </button>
                    </header>

                    <section class="modal-body">
                        <slot name="body">
                            <div class="container">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <label class="form-label">Номер урока</label>
                                        <div class="input-group input-group-sm">
                                            <input v-model="lesson_number" type="number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Запись урока</label>
                                        <div class="input-group input-group-sm">
                                            <input v-model="lesson_record" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Материал урока</label>
                                        <div v-if="lesson_materials.options" class="input-group input-group-sm">
                                            <vue-multiselect label = "name" class="multiselect" placeholder="Выберите" selectLabel="Выберите" deselectLabel="Убрать" v-model="lesson_materials.value" :options="lesson_materials.options"></vue-multiselect>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Дата урока</label>
                                        <div class="input-group">
                                            <date-picker value-type="YYYY-MM-DD HH:MM:SS" type="datetime" v-model ="lesson_date"></date-picker>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </slot>
                    </section>

                    <footer class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-primary-soft btn-sm"
                            @click="close"
                        >
                            Закрыть
                        </button>

                        <button
                            type="button"
                            class="btn btn-primary-soft btn-sm"
                            @click="createLesson"
                        >
                            Создать
                        </button>
                    </footer>
                </div>
            </div>
<!--        </div>-->
    </transition>
</template>

<script>
import Multiselect from 'vue-multiselect'
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
export default {
    name: "CreateLessonModal",
    components: {
        'date-picker': DatePicker,
        'vue-multiselect' : Multiselect
    },
    data(){
        return {
            lesson_materials: {
                value: null,
                options: null
            },
            lesson_date: null,
            lesson_record: null,
            lesson_number: null
        }
    },
    props: ['course_id'],
    methods: {
        close() {
            this.$emit('close');
        },
        getLessonsMaterials(){
            axios.post('api/courses/getLessonsMaterials', {
                course_id: this.course_id
            }).then(res => {
                this.lesson_materials.value = res.data.lesson_materials[0]
                this.lesson_materials.options = res.data.lesson_materials
            });
        },
        createLesson(){
            console.log(this.lesson_date);
            axios.post('api/courses/createLesson',  {
                course_id : this.course_id,
                lesson_record : this.lesson_record,
                lesson_number : this.lesson_number,
                lesson_material : this.lesson_materials.value.id,
                lesson_date : this.lesson_date
            }).then(res => {
                if (res.data.status === 'ok'){
                    this.close()
                }
            });
        }
    },
    mounted() {
        this.getLessonsMaterials()
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style scoped>

.modal-backdrop {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal {
    background: #FFFFFF;
    box-shadow: 2px 2px 20px 1px;
    overflow-x: auto;
    display: flex;
    flex-direction: column;
}

.modal-header,
.modal-footer {
    padding: 15px;
    display: flex;
}

.modal-header {
    justify-content: center;
    position: relative;
    border-bottom: 10px solid #eeeeee;
}

.modal-footer {
    border-top: 10px solid #eeeeee;
    flex-direction: row;
}

.modal-body {
    position: relative;
    padding: 20px 10px;
}

.btn-close {
    position: absolute;
    top: 0;
    right: 0;
    border: none;
    font-size: 20px;
    padding: 10px;
    cursor: pointer;
    font-weight: bold;
    color: #4AAE9B;
    background: transparent;
}

.btn-green {
    color: white;
    background: #4AAE9B;
    border: 1px solid #4AAE9B;
    border-radius: 2px;
}

.modal-fade-enter,
.modal-fade-leave-to {
    opacity: 0;
}

.modal-fade-enter-active,
.modal-fade-leave-active {
    transition: opacity .5s ease;
}
.modal{
    position: absolute;
    left: 37%;
    top: 25%;
    width: 30%;
    height: 60%;
}
</style>
