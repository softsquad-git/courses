<template>
<form method="post" @submit.prevent="save">
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
    <div class="form-group">
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

            this.$axios.post(this.save_url, this.data)
                .then((data) => {
                    //
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
