<template>
    <form method="post" @submit.prevent="save">
        <div class="form-group">
            <label for="header" class="col-form-label">Nagłówek</label>
            <input type="text" class="form-control" v-model="data.header" id="header">
        </div>

        <div class="row form-group" v-for="(word, index) in data.words">
            <div class="col-md-5 col-12">
                <label class="col-form-label" :for="index">Słowo</label>
                <input type="text" class="form-control" v-model="word.txt" :id="index">
            </div>
            <div class="col-md-5 col-12">
                <label class="col-form-label" :for="index + 1">Słowo przetłumaczone</label>
                <input type="text" class="form-control" v-model="word.txt_trans" :id="index + 1">
            </div>
            <div class="col-md-2 col-12">
                <div class="buttons text-right" style="margin-top: 30px; text-align: right">
                    <button v-if="data.words.length > 1" class="btn btn-sm btn-rounded btn-danger" type="button" @click="removeWord(index)"><i class="icon icon-minus"></i> </button>
                </div>
            </div>
        </div>

        <button class="btn mt-2 btn-sm btn-rounded btn-success" type="button" @click="addWord"><i class="icon icon-plus"></i> </button>

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
    name: "Seven_ExerciseComponent",
    data() {
        return {
            data: {
                type: '',
                lesson_id: '',
                header: '',
                speech_bubble_bottom: '',
                words: [{txt: '', txt_trans: ''}]
            }
        }
    },
    props: {
        type: '',
        save_url: '',
        lesson_id: '',
        item_id: ''
    },
    methods: {
        save() {
            this.data.lesson_id = this.lesson_id;
            this.data.type = this.type;

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
        },
        addWord() {
            this.data.words.push({
                txt: '',
                txt_trans: ''
            })
        },
        removeWord(index) {

        }
    },
    mounted() {
        if (this.item_id) {
            this.$axios.get(`/administration/courses/lessons/exercises/find/${this.item_id}`)
                .then((data) => {
                    const item = data.data.data;
                    this.data.header = item.template.header;
                    this.data.speech_bubble_bottom = item.speech_bubble_bottom;
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
