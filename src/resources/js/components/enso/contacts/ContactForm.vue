<template>
    <modal class="contact-form"
        show
        v-on="$listeners">
        <vue-form class="box has-background-light"
            v-on="$listeners"
            :data="form"/>
    </modal>
</template>

<script>

import Modal from '../bulma/Modal.vue';
import VueForm from '../vueforms/VueForm.vue';

export default {
    name: 'ContactForm',

    components: { Modal, VueForm },

    props: {
        form: {
            type: Object,
            default: null,
        },
    },
};

</script>

<style lang="scss">

    .contact-form {
        .modal-content {
            overflow: unset;
        }
    }

</style>
