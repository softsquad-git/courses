<template>
    <form method="post" @submit.prevent="save" enctype="multipart/form-data">
        <div class="form-group">
            <label for="header" class="col-form-label">Nagłówek</label>
            <input type="text" class="form-control" v-model="data.header" id="header">
        </div>
        <div class="row form-group">
            <div class="col-md-6">
                <label class="col-form-label" for="sentence">Zdanie</label>
                <input type="text" class="form-control" v-model="data.sentence" id="sentence">
                <small>
                    W miejscu słowa które ma być uzupełnione wstaw <span style="background: #000;color: #39ff1c;font-weight: bold;">&lt;span&gt;&lt;/span&gt;</span>
                </small>
            </div>
            <div class="col-md-6">
                <label for="sentence_trans" class="col-form-label">Zdanie przetłumaczone</label>
                <input type="text" class="form-control" v-model="data.sentence_trans" id="sentence_trans">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-6">
                <label class="col-form-label" for="success_answer_file">Poprawna odpowiedź (plik dźwiękowy)</label>
                <input type="file" class="form-control" id="success_answer_file" v-on:change="changeSuccessAnswerFile">
            </div>
        </div>
        <answers-component ref="answers"></answers-component>
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
import AnswersComponent from "./answers/AnswersComponent";
export default {
    name: "Thirteen_ExerciseComponent",
    components: {AnswersComponent},
    data() {
        return {
            data: {
                sentence: '',
                sentence_trans: '',
                header: '',
                speech_bubble_bottom: '',
                success_answer_file: ''
            },
        }
    },
    props: {
        type: '',
        save_url: '',
        lesson_id: '',
        item_id: ''
    },
    methods: {
        save() {
            let formData = new FormData();
            if (this.data.success_answer_file) {
                formData.append('success_answer_file', this.data.success_answer_file, this.data.success_answer_file.name);
            }
            formData.append('answers', JSON.stringify(this.$refs.answers.$data.data));
            formData.append('type', this.type);
            formData.append('lesson_id', this.lesson_id);
            formData.append('header', this.data.header);
            formData.append('speech_bubble_bottom', this.data.speech_bubble_bottom);
            formData.append('sentence', this.data.sentence);
            formData.append('sentence_trans', this.data.sentence_trans);

            this.$axios.post(this.save_url, formData)
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
        },
        changeSuccessAnswerFile(e) {
            this.data.success_answer_file = e.target.files[0]
        },
    },
    mounted() {
        if (this.item_id) {
            this.$axios.get(`/administration/courses/lessons/exercises/find/${this.item_id}`)
                .then((data) => {
                    const item = data.data.data;
                    this.data.header = item.template.header;
                    this.data.sentence = item.template.sentence;
                    this.data.sentence_trans = item.template.sentence_trans;
                    this.data.speech_bubble_bottom = item.speech_bubble_bottom;
                    this.$refs.answers.$data.data = item.template.answers;
                }).catch((error) => {
                    //
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
