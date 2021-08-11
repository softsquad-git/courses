<template>
    <form method="post" @submit.prevent="save" enctype="multipart/form-data">
        <div class="row form-group">
            <div class="col-md-6">
                <label class="col-form-label" for="txt">Tekst</label>
                <input type="text" class="form-control" v-model="data.txt" id="txt">
            </div>
            <div class="col-md-6">
                <label class="col-form-label" for="image">Zdjęcie</label>
                <input type="file" class="form-control" id="image" v-on:change="changeImage">
            </div>
        </div>
        <answers-component ref="answers"></answers-component>
        <div class="form-group" style="margin-top: 20px">
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
    name: "Four_ExerciseComponent",
    components: {AnswersComponent},
    data() {
        return {
            data: {
                txt: '',
                image: '',
                speechBubble: {
                    position: '',
                    content: ''
                }
            },
            isSpeechBubble: false
        }
    },
    props: {
        type: '',
        save_url: '',
        lesson_id: ''
    },
    methods: {
        changeImage(e) {
            this.data.image = e.target.files[0];
        },
        save() {
            let formData = new FormData();
            formData.append('txt', this.data.txt);
            formData.append('image', this.data.image, this.data.image.name);
            formData.append('answers', JSON.stringify(this.$refs.answers.$data.data));
            formData.append('type', this.type);
            formData.append('lesson_id', this.lesson_id);
            formData.append('speechBubble', JSON.stringify(this.data.speechBubble));

            this.$axios.post(this.save_url, formData)
                .then((data) => {

                }).catch((error) => {

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
