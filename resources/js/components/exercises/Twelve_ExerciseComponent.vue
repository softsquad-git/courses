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
                <input type="text" class="form-control" id="txt_trans" v-model="data.txt_trans">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-6">
                <label class="col-form-label" for="image">Zdjęcie</label>
                <input type="file" class="form-control" id="image" v-on:change="changeImage">
            </div>
            <div class="col-md-6">
                <label class="col-form-label" for="sound_file">Plik dźwiękowy</label>
                <input type="file" class="form-control" accept=".mp3" id="sound_file" v-on:change="changeSoundFile">
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
            <button class="btn btn-sm btn-outline-primary">Zapisz</button>
        </div>
    </form>
</template>

<script>
export default {
name: "Twelve_ExerciseComponent",
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
    }
    },
    props: {
        type: '',
        save_url: '',
        lesson_id: '',
        item_id: ''
    },
    methods: {
        changeImage(e) {
            this.data.image = e.target.files[0];
        },
        changeSoundFile(e) {
            this.data.sound_file = e.target.files[0];
        },
        save() {
            let formData = new FormData();
            formData.append('txt', this.data.txt);
            formData.append('txt_trans', this.data.txt_trans);
            if (this.data.image) {
                formData.append('image', this.data.image, this.data.image.name);
            }
            if (this.data.sound_file) {
                formData.append('sound_file', this.data.sound_file, this.data.sound_file.name);
            }
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
        }
    },
    mounted() {
        if (this.item_id) {
            this.$axios.get(`/administration/courses/lessons/exercises/find/${this.item_id}`)
                .then((data) => {
                    const item = data.data.data;
                    this.data.header = item.template.header;
                    this.data.txt = item.template.txt;
                    this.data.txt_trans = item.template.txt_trans;
                    this.data.speech_bubble_bottom = item.speech_bubble_bottom;
                    console.log(item)
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
