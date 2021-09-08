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
        <div class="form-group row" style="margin-top: 20px">
            <div class="col-md-6 col-12">
                <h4>Dymek na górze</h4>
                <label for="topBubble" class="col-form-label">Treść</label>
                <textarea id="topBubble" class="form-control" rows="3" v-model="data.speech_bubble_top"></textarea>
            </div>
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
    name: "Four_ExerciseComponent",
    components: {AnswersComponent},
    data() {
        return {
            data: {
                txt: '',
                image: '',
                speech_bubble_top: '',
                speech_bubble_bottom: ''
            },
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
            formData.append('speech_bubble_top', this.data.speech_bubble_top);
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
