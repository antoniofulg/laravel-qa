<template>
    <form @submit.prevent="handleSubmit">
        <div class="form-group">
            <label for="question-title">Question Title</label>
            <input type="text" v-model="title" name="title" :class="errorClass('title')">

            <div v-if="errors['title'][0]" class="invalid-feedback">
                <strong>{{ errors['title'][0] }}</strong>
            </div>
        </div>
        <div class="form-group">
            <label for="question-body">Explain you question</label>
            <m-editor :body="body" name="question-body">
                <textarea name="body" v-model="body" rows="10" :class="errorClass('body')"></textarea>

                <div v-if="errors['body'][0]" class="invalid-feedback">
                    <strong>{{ errors['body'][0] }}</strong>
                </div>
            </m-editor>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-primary btn-lg">{{ buttonText }}</button>
        </div>
    </form>
</template>

<script>
import EventBus from '../event-bus'
import MEditor from './MEditor'

export default {
    components: { 
        MEditor
    },

    data () {
        return {
            title: '',
            body: '',
            errors: {
                title: [],
                body: []
            }
        }
    },

    mounted () {
        EventBus.$on('error', errors => this.errors = errors)
    },

    computed: {
        buttonText () {
            return 'Ask Question'
        }
    },

    methods: {
        handleSubmit () {
            this.$emit('submitted', {
                title: this.title,
                body: this.body
            })
        },

        errorClass (column) {
            return [
                'form-control',
                this.errors[column] && this.errors[column][0] ? 'is-invalid' : ''
            ]
        }
    }
}
</script>