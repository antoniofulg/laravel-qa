import highlight from './highlight'
import destroy from './destroy'
import Vote from '../components/Vote'
import UserInfo from '../components/UserInfo'
import MEditor from '../components/MEditor'

export default {
    mixins: [highlight, destroy],

    components: { Vote, UserInfo, MEditor },

    data() {
        return {
            editing: false
        }
    },

    methods: {
        edit () {
            this.setEditCache();
            this.editing = true;
        },

        cancel () {
            this.restoreFromCache();
            this.editing = false;
        },

        setEditCache() {},
        restoreFromCache() {},

        update () {
            axios.put(this.endpoint, this.payload())
            .catch(({response}) => {
                this.$toast.error(response.data.message, "Error", { timeout: 3000 });
            })  
            .then(({data}) => {
                this.title = data.title;
                this.bodyHtml = data.body_html;
                this.$toast.success(data.message, "Success", { timeout: 3000 });
                this.editing = false;
            })
            .then(() => this.highlight());
        },

        payload () {},
    }
}