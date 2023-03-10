<template>

    <div class="card bg-transparent border rounded-3">

        <!-- Catd header -->
        <div class="card-header bg-light border-bottom">
            <h5 class="card-header-title">The Complete Digital Marketing Course - 12 Courses in 1</h5>
        </div>

        <!-- Card body START -->
        <div class="card-body">

            <!-- Course image and info START -->
            <div class="row g-4">

                <!-- Course info and avatar -->
                <div class="col-md-6">
                    <!-- Avatar -->
                    <div class="d-sm-flex align-items-center">
                        <!-- Avatar image -->
                        <div class="avatar avatar-md">
                            <img class="avatar-img rounded-circle" src="assets/images/avatar/05.jpg" alt="avatar">
                        </div>
                        <div class="ms-sm-3 mt-2 mt-sm-0">
                            <h6 class="mb-0"><a href="#">By Jacqueline Miller</a></h6>
                            <p class="mb-0 small">Founder Eduport company</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Course image and info END -->

            <!-- Information START -->
            <div class="row mt-3">

                <!-- Information item -->
                <div class="col-md-6">
                    <ul class="list-group list-group-borderless">
                        <li class="list-group-item">
                            <span>release date:</span>
                            <span class="h6 mb-0">29 Aug 2020</span>
                        </li>

                        <li class="list-group-item">
                            <span>Total Hour:</span>
                            <span class="h6 mb-0">
                                <div class="d-sm-flex align-items-center">
                                    <!-- Avatar image -->
                                    <div class="avatar avatar-md">
                                        <img class="avatar-img rounded-circle" src="assets/images/avatar/05.jpg" alt="avatar">
                                    </div>
                                    <div class="ms-sm-3 mt-2 mt-sm-0">
                                        <h6 class="mb-0"><a href="#">By Jacqueline Miller</a></h6>
                                        <p class="mb-0 small">Founder Eduport company</p>
                                    </div>
                                 </div>
                            </span>
                        </li>

                        <li class="list-group-item">
                            <span>Total Enrolled:</span>
                            <span class="h6 mb-0">12,000+</span>
                        </li>

                        <li class="list-group-item">
                            <span>Certificate:</span>
                            <span class="h6 mb-0">Yes</span>
                        </li>
                    </ul>
                </div>

                <!-- Information item -->
                <div class="col-md-6">
                    <ul class="list-group list-group-borderless">
                        <li class="list-group-item">
                            <span>Skills:</span>
                            <span class="h6 mb-0">All level</span>
                        </li>

                        <li class="list-group-item">
                            <span>Total Lecture:</span>
                            <span class="h6 mb-0">30</span>
                        </li>

                        <li class="list-group-item">
                            <span>Language:</span>
                            <span class="h6 mb-0">English</span>
                        </li>

                        <li class="list-group-item">
                            <span>Review:</span>
                            <span class="h6 mb-0">4.5<i class="fas fa-star text-warning ms-1"></i></span>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- Information END -->
        </div>
        <!-- Card body END -->
    </div>

</template>

<script>
export default {
    props: ['teacher_id', 'lesson_number'],
    data() {
        return {

        }
    },

}
</script>
