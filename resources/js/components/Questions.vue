<template>
    <div>
        <div class="card-body">
            <spinner v-if="$root.loading"></spinner>
            <div v-else-if="questions.length">
                <question-excerpt v-for="question in questions" :question="question" :key="question.id"></question-excerpt>
            </div>
            <div v-else class="alert alert-warning">
                <strong>Sorry</strong> There are no questions avaliable.
            </div>
        </div>
        <div class="card-footer">
            <pagination :meta="meta" :links="links"></pagination>
        </div>
    </div>
</template>

<script>
import QuestionExcerpt from './QuestionExcerpt'
import Pagination from './Pagination'
import eventBus from '../event-bus'

export default {
    components: { 
        QuestionExcerpt,
        Pagination
    },

    data () {
        return {
            questions: [],
            meta: {},
            links: {}
        }
    },

    mounted () {
        this.fetchQuestions()

        eventBus.$on('deleted', (id) => {
            let index = this.questions.findIndex(question => id === question.id)  
            this.remove(index)
        })
    },

    methods: {
        fetchQuestions () {
            this.loading = true;
            axios.get('/questions', { params: this.$route.query })
                .then(({data}) => {
                    this.questions = data.data;
                    this.meta = data.meta;
                    this.links = data.links;
                })
        },

        remove (index) {
            this.questions.splice(index, 1)
            this.count--
        }
    },

    watch: {
        "$route": 'fetchQuestions'
    }
}
</script>