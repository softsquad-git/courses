<template>
<form method="post" @submit.prevent="save" enctype="multipart/form-data">
    <div class="form-group">
        <label for="header" class="col-form-label">Nagłówek</label>
        <input type="text" class="form-control" v-model="data.header" id="header">
    </div>
    <div class="row form-group">
        <div class="col-md-6">
            <label class="col-form-label" for="txt">Tekst</label>
            <input type="text" class="form-control" v-model="data.txt" id="txt">
        </div>
        <div class="col-md-6">
            <label for="txt_trans" class="col-form-label">Tekst przetłumaczony</label>
            <input type="text" class="form-control" v-model="data.txt_trans" id="txt_trans">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-6">
            <label class="col-form-label" for="image">Zdjęcie</label>
            <input type="file" ref="image" class="form-control" id="image" v-on:change="changeImage">
        </div>
        <div class="col-md-6">
            <label class="col-form-label" for="sound_file">Plik dźwiękowy</label>
            <input type="file" ref="soundFile" class="form-control" accept=".mp3" id="sound_file" v-on:change="changeSoundFile">
        </div>
    </div>
    <div class="form-group row" style="margin-top: 20px">
        <div class="col-md-6 col-12">
            <h4>Dymek na dole</h4>
            <label for="bottomBubble" class="col-form-label">Treść</label>
            <textarea id="bottomBubble" class="form-control" rows="3" v-model="data.speech_bubble_bottom"></textarea>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-sm btn-outline-primary">Zapisz</button>
    </div>
</form>
</template>

<script>
export default {
    name: "One_ExerciseComponent",
    data() {
        return {
            data: {
                txt: '',
                txt_trans: '',
                image: '',
                sound_file: '',
                header: '',
                speech_bubble_bottom: ''
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
        save() {
            let formData = new FormData();
            formData.append('txt', this.data.txt);
            formData.append('txt_trans', this.data.txt_trans);
            formData.append('image', this.data.image, this.data.image.name);
            formData.append('sound_file', this.data.sound_file, this.data.sound_file.name);
            formData.append('type', this.type);
            formData.append('lesson_id', this.lesson_id);
            formData.append('header', this.data.header);
            formData.append('speech_bubble_bottom', this.data.speech_bubble_bottom);

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
        changeImage(e) {
            this.data.image = e.target.files[0];
        },
        changeSoundFile(e) {
            this.data.sound_file = e.target.files[0];
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
