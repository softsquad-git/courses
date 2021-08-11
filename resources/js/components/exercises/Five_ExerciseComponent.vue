<template>
    <form method="post" @submit.prevent="save" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-md-6">
                <label class="col-form-label" for="question">Pytanie</label>
                <input type="text" class="form-control" id="question" v-model="data.question">
            </div>
            <div class="col-md-6">
                <label class="col-form-label" for="question_trans">Tłumaczenie</label>
                <input type="text" class="form-control" id="question_trans" v-model="data.question_trans">
            </div>
        </div>
        <answers-component ref="answers"></answers-component>
        <div class="form-group" style="margin-top: 30px">
            <label for="isSpeechBubble">
                <input id="isSpeechBubble" type="checkbox" v-model="isSpeechBubble"> Dodaj dymek
            </label>
            <div v-if="isSpeechBubble" class="speech-bubble">
                <div class="row">
                    <div class="col-md-2">
                        <label for="bubblePosition" class="col-form-label">Pozycja</label>
                        <select id="bubblePosition" v-model="data.speechBubble.position" class="form-control">
                            <option value="top">Góra</option>
                            <option value="bottome">Dół</option>
                        </select>
                    </div>
                    <div class="col-md-10">
                        <label for="bubbleContent" class="col-form-label">Treść</label>
                        <textarea id="bubbleContent" class="form-control" rows="3" v-model="data.speechBubble.content"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group mt-3">
            <button @click="save" class="btn btn-sm btn-outline-primary">Zapisz</button>
        </div>
    </form>
</template>

<script>
import AnswersComponent from "./answers/AnswersComponent";
export default {
    name: "Five_ExerciseComponent",
    components: {AnswersComponent},
    data() {
        return {
            data: {
                question: '',
                question_trans: '',
                speechBubble: {
                    position: '',
                    content: ''
                }
            },
            isSpeechBubble: false
        }
    },
    methods: {
        save() {
            this.data.type = this.type;
            this.data.lesson_id = this.lesson_id;
            this.data.answers = JSON.stringify(this.$refs.answers.$data.data);
            this.data.speechBubble = JSON.stringify(this.data.speechBubble);
            this.$axios.post(this.save_url, this.data)
                .then((data) => {

                }).catch((error) => {

            })
        },
        changeSoundFile(e) {
            this.data.sound_file = e.target.files[0];
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
