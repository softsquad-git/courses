<template>
<form method="post" @submit.prevent="save" enctype="multipart/form-data">
    <div class="form-group row">
        <div class="col-md-6">
            <label class="col-form-label" for="sound_file">Plik dźwiękowy</label>
            <input type="file" class="form-control" accept=".mp3" id="sound_file" v-on:change="changeSoundFile">
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
        <button class="btn btn-sm btn-outline-primary">Zapisz</button>
    </div>
</form>
</template>

<script>
import AnswersComponent from "./answers/AnswersComponent";
export default {
    name: "Three_ExerciseComponent",
    components: {AnswersComponent},
    data() {
        return {
            data: {
                sound_file: '',
                speechBubble: {
                    position: '',
                    content: ''
                }
            },
            isSpeechBubble: false
        }
    },
    methods: {
        changeSoundFile(e) {
            this.data.sound_file = e.target.files[0];
        },
        save() {
            let formData = new FormData();
            formData.append('sound_file', this.data.sound_file, this.data.sound_file.name);
            formData.append('answers', JSON.stringify(this.$refs.answers.$data.data));
            formData.append('type', this.type);
            formData.append('lesson_id', this.lesson_id);
            formData.append('speechBubble', this.data.speechBubble);

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
        }
    },
    props: {
        type: '',
        save_url: '',
        lesson_id: ''
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
