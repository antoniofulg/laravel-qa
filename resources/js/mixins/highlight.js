import Prism from 'prismjs'

export default {
    methods: {
        highlight (id = "") {
            let el;
            if (!id) {
                el = this.$refs.bodyHtml;
            } else {
                el = document.getElementById(id);
            }
            if (el) Prism.highlightAllUnder(el);
        }
    }
}