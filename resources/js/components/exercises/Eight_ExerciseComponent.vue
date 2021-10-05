<template>
<form method="post" @submit.prevent="save">
    <div class="form-group">
        <label for="header" class="col-form-label">Nagłówek</label>
        <input type="text" class="form-control" v-model="data.header" id="header">
    </div>
    <div class="row form-group">
        <div class="col-md-6">
            <label for="question" class="col-form-label">Pytanie</label>
            <input type="text" class="form-control" v-model="data.question" id="question">
        </div>
        <div class="col-md-6">
            <label for="question_2_true" class="col-form-label" style="margin-top: 37px">
                <input type="checkbox" v-model="data.is_true" value="1" id="question_2_true"> Prawda
            </label>
        </div>
    </div>
    <div class="form-group row" style="margin-top: 20px">
        <div class="col-md-6 col-12">
            <h4>Dymek na dole</h4>
            <label for="bottomBubble" class="col-form-label">Treść</label>
            <textarea id="bottomBubble" class="form-control" rows="3" v-model="data.speech_bubble_bottom"></textarea>
        </div>
    </div>
    <div class="form-group mt-3">
        <button type="submit" class="btn btn-sm btn-outline-primary">Zapisz</button>
    </div>
</form>
</template>

<script>
export default {
    name: "Eight_ExerciseComponent",
    data(){
        return {
            data: {
                question: '',
                is_true: '',
                type: '',
                lesson_id: '',
                speech_bubble_bottom: '',
                header: ''
            },
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
        lesson_id: '',
        item_id: ''
    },
    mounted() {
        if (this.item_id) {
            this.$axios.get(`/administration/courses/lessons/exercises/find/${this.item_id}`)
                .then((data) => {
                    const item = data.data.data;
                    this.data.header = item.template.header;
                    this.data.question = item.template.question;
                    this.data.is_true = item.template.is_true;
                    this.data.speech_bubble_bottom = item.speech_bubble_bottom;
                })
        }
    }
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
