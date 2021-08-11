<template>
    <form method="post" @submit.prevent="save_url" enctype="multipart/form-data">
        <div class="row form-group">
            <div class="col-md-6">
                <label class="col-form-label" for="txt">Słowo</label>
                <input type="text" class="form-control" v-model="data.txt" id="txt">
            </div>
            <div class="col-md-6">
                <label for="txt_trans" class="col-form-label">Słowo przetłumaczone</label>
                <input type="text" class="form-control" v-model="data.txt_trans" id="txt_trans">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-6">
                <label class="col-form-label" for="sentence">Zdanie</label>
                <input type="text" class="form-control" v-model="data.sentence" id="sentence">
            </div>
            <div class="col-md-6">
                <label for="sentence_trans" class="col-form-label">Zdanie przetłumaczone</label>
                <input type="text" class="form-control" v-model="data.sentence_trans" id="sentence_trans">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-6">
                <label class="col-form-label" for="sound_file">Plik dźwiękowy</label>
                <input type="file" class="form-control" accept=".mp3" id="sound_file" v-on:change="changeSoundFile">
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
            <button @click="save" class="btn btn-sm btn-outline-primary">Zapisz</button>
        </div>
    </form>
</template>

<script>
export default {
    name: "Ten_ExerciseComponent",
    data() {
        return {
            data: {
                txt: '',
                txt_trans: '',
                sentence: '',
                sentence_trans: '',
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
        save() {
            let formData = new FormData();
            formData.append('txt', this.data.txt);
            formData.append('txt_trans', this.data.txt_trans);
            formData.append('sentence', this.data.sentence);
            formData.append('sentence_trans', this.data.sentence_trans);
            formData.append('sound_file', this.data.sound_file);
            formData.append('type', this.type);
            formData.append('lesson_id', this.lesson_id);
            formData.append('speechBubble', this.data.speechBubble);

            this.$axios.post(this.save_url, formData)
                .then((data) => {
                    //
                }).catch((error) => {
                //
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
