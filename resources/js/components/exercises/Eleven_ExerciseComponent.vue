<template>
    <form method="post" @submit.prevent="save" enctype="multipart/form-data">
        <div class="row form-group">
            <div class="col-md-4">
                <label class="col-form-label" for="image_one">Zdjęcie rozmówcy 1</label>
                <input type="file" ref="image" class="form-control" id="image_one" v-on:change="changeImageOne">
            </div>
            <div class="col-md-4">
                <label class="col-form-label" for="image_two">Zdjęcie rozmówcy 2</label>
                <input type="file" ref="image" class="form-control" id="image_two" v-on:change="changeImageTwo">
            </div>
            <div class="col-md-4">
                <label class="col-form-label" for="sound_file">Plik dźwiękowy</label>
                <input type="file" ref="soundFile" class="form-control" accept=".mp3" id="sound_file" v-on:change="changeSoundFile">
            </div>
        </div>

        <div class="conversations">
            <div class="conversation-single row" v-for="(conversation, index) in data.conversations">
                <div class="col-md-2">
                    <label :for="index" class="col-form-label">Rozmówca</label>
                    <select :id="index" class="form-control" v-model="conversation.type">
                        <option v-for="type in types" :value="type.value">{{ type.txt }}</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <label :for="index+'x'" class="col-form-label">Treść {{ index + 1 }}</label>
                    <input type="text" :id="index+'x'" class="form-control" v-model="conversation.txt">
                </div>
                <div class="col-md-4">
                    <label :for="index+'y'" class="col-form-label">Tłumaczenie {{ index + 1 }}</label>
                    <input type="text" :id="index+'y'" class="form-control" v-model="conversation.txt_trans">
                </div>
                <div class="col-md-1">
                    <div class="buttons text-right" style="margin-top: 30px; text-align: right">
                        <button v-if="data.conversations.length > 1" class="btn btn-sm btn-rounded btn-danger" type="button" @click="removeConversation(index)"><i class="icon icon-minus"></i> </button>
                    </div>
                </div>
            </div>
            <button style="margin-top: 20px" class="btn btn-sm btn-rounded btn-success" type="button" @click="addConversation"><i class="icon icon-plus"></i> </button>
        </div>
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
        <div class="form-group" style="margin-top: 40px">
            <button class="btn btn-sm btn-outline-primary">Zapisz</button>
        </div>
    </form>
</template>

<script>
export default {
    name: "Eleven_ExerciseComponent",
    data() {
        return {
            data: {
                interlocutor_one_image: '',
                interlocutor_two_image: '',
                sound_file: '',
                conversations: [{
                    type: '',
                    txt: '',
                    txt_trans: ''
                }],
                speechBubble: {
                    position: '',
                    content: ''
                }
            },
            types: [
                {txt: 'Rozmówca 1', value: 'interlocutor_one'},
                {txt: 'Rozmówca 2', value: 'interlocutor_two'},
            ],
            isSpeechBubble: false
        }
    },
    methods: {
        save() {
            let formData = new FormData();
            formData.append('interlocutor_one_image', this.data.interlocutor_one_image, this.data.interlocutor_one_image.name);
            formData.append('interlocutor_two_image', this.data.interlocutor_two_image, this.data.interlocutor_two_image.name);
            formData.append('sound_file', this.data.sound_file, this.data.sound_file.name);
            formData.append('conversations', JSON.stringify(this.data.conversations));
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
        },
        changeSoundFile(e) {
            this.data.sound_file = e.target.files[0];
        },
        changeImageOne(e) {
            this.data.interlocutor_one_image = e.target.files[0];
        },
        changeImageTwo(e) {
            this.data.interlocutor_two_image = e.target.files[0];
        },
        addConversation() {
            this.data.conversations.push({
                type: '',
                txt: '',
                txt_trans: ''
            })
        },
        removeConversation(index) {
            this.data.conversations.splice(index, 1);
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
