<template>
<div>
    <div class="row form-group" v-for="(reply, index) in data">
        <div class="col-md-5">
            <label class="col-form-label" :for="index">Odpowiedź {{ index + 1 }}</label>
            <input type="text" class="form-control" v-model="reply.reply" :id="index">
        </div>
        <div class="col-md-5">
            <label class="col-form-label" :for="index + 1">Prawda?</label>
            <input type="checkbox" class="custom-checkbox d-block" style="margin-top: 12px!important;" v-model="reply.is_true" value="1">
        </div>
        <div class="col-md-2">
            <div class="buttons text-right" style="margin-top: 30px; text-align: right">
                <button v-if="data.length > 1" class="btn btn-sm btn-rounded btn-danger" type="button" @click="removeInput(index)"><i class="icon icon-minus"></i> </button>
            </div>
        </div>
    </div>
    <button class="btn btn-sm btn-rounded btn-success" type="button" @click="addInputs"><i class="icon icon-plus"></i> </button>
</div>
</template>

<script>
export default {
    name: "AnswersComponent",
    data() {
        return {
            data: [
                {
                    reply: '',
                    is_true: false
                }
            ]
        }
    },
    methods: {
        addInputs() {
            this.data.push({
                reply: '',
                is_true: false
            })
        },
        removeInput(index) {
            this.data.splice(index, 1);
        }
    }
}
</script>

<style scoped>

</style>
