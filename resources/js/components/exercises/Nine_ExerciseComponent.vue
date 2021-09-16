<template>
<form @submit.prevent="save" method="post">
    <div class="form-group">
        <label for="header" class="col-form-label">Nagłówek</label>
        <input type="text" class="form-control" v-model="data.header" id="header">
    </div>
    <div class="form-group">
        <label for="content" class="col-form-label">Treść</label>
        <textarea class="form-control" v-model="data.content" id="content"></textarea>
    </div>
    <div class="form-group row" style="margin-top: 20px">
        <div class="col-md-6 col-12">
            <h4>Dymek na dole</h4>
            <label for="bottomBubble" class="col-form-label">Treść</label>
            <textarea id="bottomBubble" class="form-control" rows="3" v-model="data.speech_bubble_bottom"></textarea>
        </div>
    </div>
    <div class="form-group mt-3">
        <button class="btn btn-sm btn-outline-primary">Zapisz</button>
    </div>
</form>
</template>

<script>
export default {
    name: "Nine_ExerciseComponent",
    data() {
        return {
            data: {
                lesson_id: '',
                type: '',
                content: '',
                header: '',
                speech_bubble_bottom: ''
            },
            isSpeechBubble: false
        }
    },
    methods: {
        save() {
            this.data.type = this.type;
            this.data.lesson_id = this.lesson_id;

            this.$axios.post(this.save_url, this.data)
            .then((data) => {
                this.$swal.fire({
                    title: 'Świetnie!',
                    text: 'Ćwiczenie zostało dodane',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Dodaj kolejne ćwiczenie',

                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    } else if (result.dismiss === this.$swal.DismissReason.cancel) {

                    }
                })
            }).catch((error) => {
                //
            })
        }
    },
    props: {
        type: '',
        save_url: '',
        lesson_id: ''
    },
}
</script>

<style scoped>
.speech-bubble {
    padding: 10px;
    background: #f6f6f6;
    border-radius: 10px;
    border: 1px solid #e5e3e3;
}
</style>
