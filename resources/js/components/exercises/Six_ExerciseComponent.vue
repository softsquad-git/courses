<template>
    <form method="post" @submit.prevent="save">
        <div class="form-group">
            <label for="header" class="col-form-label">Nagłówek</label>
            <input type="text" class="form-control" v-model="data.header" id="header">
        </div>
        <div class="row form-group">
            <div class="col-md-6">
                <label class="col-form-label" for="txt">Tekst</label>
                <input type="text" class="form-control" v-model="data.txt" id="txt">
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
    name: "Six_ExerciseComponent",
    components: {AnswersComponent},
    data(){
        return {
            data: {
                txt: '',
                answers: '',
                type: '',
                lesson_id: '',
                header: '',
                speech_bubble_bottom: ''
            },
        }
    },
    methods: {
        save() {
            this.data.lesson_id = this.lesson_id;
            this.data.type = this.type;
            this.data.answers = JSON.stringify(this.$refs.answers.$data.data);

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
                    this.data.txt = item.template.txt;
                    this.data.speech_bubble_bottom = item.speech_bubble_bottom;
                    this.$refs.answers.$data.data = item.template.answers;
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
