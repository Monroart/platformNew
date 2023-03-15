<template>
    <section class="p-0 d-flex align-items-center position-relative overflow-hidden">
        <div class="container-fluid">
            <div class="row">
                <!-- left -->
                <div
                    class="col-12 col-lg-6 d-md-flex align-items-center justify-content-center bg-primary bg-opacity-10 vh-lg-100">
                    <div class="p-3 p-lg-5">
                        <!-- Title -->
                        <div class="text-center">
                            <h2 class="fw-bold">Добро пожаловать в EasyCode!</h2>
                            <p class="mb-0 h6 fw-light">Давайте узнаем что-то новое сегодня!</p>
                        </div>
                        <!-- SVG Image -->
                        <img src="assets/images/element/02.svg" class="mt-5" alt="">
                        <!-- Info -->
                        <div class="d-sm-flex mt-5 align-items-center justify-content-center">
                            <!-- Avatar group -->
                            <ul class="avatar-group mb-2 mb-sm-0">
                                <li class="avatar avatar-sm">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/01.jpg"
                                         alt="avatar">
                                </li>
                                <li class="avatar avatar-sm">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/02.jpg"
                                         alt="avatar">
                                </li>
                                <li class="avatar avatar-sm">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/03.jpg"
                                         alt="avatar">
                                </li>
                                <li class="avatar avatar-sm">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/04.jpg"
                                         alt="avatar">
                                </li>
                            </ul>
                            <!-- Content -->
                            <p class="mb-0 h6 fw-light ms-0 ms-sm-3">4k+ К нам присоединились студенты, теперь ваша очередь.</p>
                        </div>
                    </div>
                </div>

                <!-- Right -->
                <div class="col-12 col-lg-6 m-auto">
                    <div class="row my-5">
                        <div class="col-sm-10 col-xl-8 m-auto">
                            <!-- Title -->
                            <span class="mb-0 fs-1">👋</span>
                            <h1 class="fs-2">Вход в систему обучения</h1>
                            <p class="lead mb-4">Рады вас видеть! Пожалуйста, войдите в свою учетную запись</p>

                            <!-- Form START -->
                            <form>
                                <!-- Email -->
                                <div class="mb-4">
                                    <label for="exampleInputEmail1" class="form-label">Логин</label>
                                    <div class="input-group input-group-lg">
                                        <span
                                            class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i
                                            class="bi bi-envelope-fill"></i></span>
                                        <input v-model.trim="phone"
                                               type="tel"
                                               :class="{invalid: $v.phone.$dirty && !$v.phone.required}"
                                               class="form-control border-0 bg-light rounded-end ps-1"
                                               placeholder="Телефон"
                                               id="exampleInputEmail1">
                                    </div>
                                    <span class="text-danger"
                                          v-if="$v.phone.$dirty && !$v.phone.required"
                                    >
                                            Введите номер телефона
                                        </span>
                                </div>
                                <!-- Password -->
                                <div class="mb-4">
                                    <label for="inputPassword5" class="form-label">Пароль</label>
                                    <div class="input-group input-group-lg">
                                        <span
                                            class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i
                                            class="fas fa-lock"></i></span>
                                        <input v-model="password" type="password"
                                               class="form-control border-0 bg-light rounded-end ps-1"
                                               placeholder="password" id="inputPassword5">
                                    </div>
                                    <div id="passwordHelpBlock" class="form-text">
                                        Ваш пароль должен быть не менее 8 символов
                                    </div>
                                </div>
                                <!-- Check box -->
                                <div class="mb-4 d-flex justify-content-between mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" @click="remember = !remember" class="form-check-input" id="exampleCheck1" checked>
                                        <label class="form-check-label" for="exampleCheck1">Запомните меня</label>
                                    </div>
                                    <div class="text-primary-hover">
                                        <a href="forgot-password.html" class="text-secondary">
                                            <u>Забыли пароль?</u>
                                        </a>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="align-items-center mt-0">
                                    <div class="d-grid">
                                        <button @click.prevent="login" class="btn btn-primary mb-0 text-white" type="button">Вход</button>
                                    </div>
                                </div>
                            </form>
                            <!-- Form END -->

                        </div>
                    </div> <!-- Row END -->
                </div>
            </div> <!-- Row END -->
        </div>
    </section>
</template>

<script>

import {mapActions, mapState} from 'vuex'
import {required,} from 'vuelidate/lib/validators'

export default {
    name: "Login",
    data() {
        return {
            url: '',
            phone: '',
            password: '',
            isLoading: false,
            remember: true,
        }
    },
    validations: {
        phone: {required},
        password: {required}
    },
    watch:{
        remember(el){
            console.log(this.remember)
            return this.remember
        }
    },
    methods: {
        ...mapActions({
            signIn: "auth/login",
            startLoading: "loading/startLoading",
            endLoading: "loading/endLoading",
        }),
        login() {
            this.startLoading()
            if (this.$v.$invalid) {
                this.$v.$touch()
                return
            } else {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/login', {
                        phone: this.phone,
                        password: this.password,
                        remember: this.remember
                        //comment
                    }).then(res => {
                        localStorage.setItem('x_xsrf_token', res.config.headers['X-XSRF-TOKEN'])
                        this.signIn()
                        this.$store.commit('auth/SET_TOKEN', res.config.headers['X-XSRF-TOKEN'])
                        this.endLoading();
                        this.$router.push('/');
                    }).catch(err => {
                        this.endLoading()
                        console.log(err.response)
                    })
                })
                this.$router.replace({
                    name: 'Index'
                })
            }
        }
    }
}
</script>

<style scoped>

</style>
