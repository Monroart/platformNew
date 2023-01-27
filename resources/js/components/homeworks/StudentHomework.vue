<template>
    <div class="col-md-9">
        <div class="d-flex">
            {{lesson_id}}
            <div data-app class="d-flex px-2 mb-0">
                <v-file-input
                    v-model="files"
                    multiple
                    prepend-icon="mdi-paperclip"
                >
                    <template v-slot:selection="{ text }">
                        <v-chip
                            small
                            label
                        >
                            {{ text }}
                        </v-chip>
                    </template>
                </v-file-input>
            </div>
            <textarea class="form-control mb-0" rows="0" spellcheck="false"></textarea>
            <button class="btn btn-sm btn-primary-soft ms-2 px-4 mb-0 flex-shrink-0"><i class="fas fa-paper-plane fs-8"></i></button>
        </div>
    </div>
</template>

<script>
export default {
    name: "StudentHomework",
    props: ['lesson_id']
}
</script>

<style scoped>

</style>
