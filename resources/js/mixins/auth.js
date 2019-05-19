import {mapGetters} from 'vuex';

export default {
    data() {
      return {
          disabled: false
      }
    },
    computed: {
        ...mapGetters({user: 'getUser'})
    },
    watch: {
        user(val) {
            if (val !== null) {
                if (this.user.isSeo() || this.user.isViewer()) {
                    this.disabled = true;

                    let editor = document.querySelector('#englishEditor');

                    if (editor && !this.user.isSeo()) {
                        $('#englishEditor').summernote( 'disable');
                        $('#arabicEditor').summernote('disable' );
                    }
                }
            }
        }
    },
}