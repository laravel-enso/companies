<template>
    <div class="wrapper">
        <div class="controls"
             v-if="controls">
            <button class="button"
                    @click="create()">
                <span v-if="!isMobile">
                    {{ __('Create Contact') }}
                </span>
                <span class="icon">
                    <fa icon="plus"/>
                </span>
            </button>
            <button class="button has-margin-left-small"
                    @click="get()">
                <span v-if="!isMobile">
                    {{ __('Reload') }}
                </span>
                <span class="icon">
                    <fa icon="sync"/>
                </span>
            </button>
            <p class="control has-icons-left has-icons-right has-margin-left-large">
                <input class="input is-rounded"
                       type="text"
                       v-model="internalQuery"
                       :placeholder="__('Filter')">
                <span class="icon is-small is-left">
                    <fa icon="search"/>
                </span>
                <span class="icon is-small is-right clear-button"
                      v-if="internalQuery"
                      @click="internalQuery = ''">
                    <a class="delete is-small"/>
                </span>
            </p>
        </div>
        <div class="columns is-multiline"
             :class="{'has-margin-top-large': controls}">
            <div class="column is-half-tablet is-one-third-widescreen"
                 v-for="(contact, index) in filteredContacts"
                 :key="index">
                <contact :contact="contact"
                         @edit="edit(contact)"
                         @delete="destroy(contact, index)"
                         :index="index"
                         :id="id"/>
            </div>
            <contact-form
                    v-if="form"
                    :form="form"
                    @close="form = null"
                    @destroy="get(); form=false"
                    @submit="get();form=false"/>
        </div>

        <modal :show="confirmPersonDelete"
               :i18n="__"
               :message="__('Also delete the associated person?')"
               @close="confirmPersonDelete = false"
               @commit="destroyPerson">
        </modal>

    </div>

</template>

<script>

    import {mapState} from 'vuex';
    import Contact from './Contact.vue';
    import ContactForm from './ContactForm.vue';
    import Modal from '../vueforms/Modal.vue';

    export default {
        name: 'Contacts',

        components: {Contact, ContactForm, Modal},

        props: {
            id: {
                type: Number,
                required: true,
            },
            query: {
                type: String,
                default: '',
            },
            controls: {
                type: Boolean,
                default: false,
            },
        },

        data() {
            return {
                loading: false,
                contacts: [],
                form: null,
                internalQuery: '',
                deletedContact: null,
                confirmPersonDelete: false,
            };
        },

        computed: {
            ...mapState('layout', ['isMobile']),
            filteredContacts() {
                const query = this.internalQuery.toLowerCase();

                return query
                    ? this.contacts.filter(({name, position}) =>
                        name.toLowerCase().indexOf(query) > -1
                        || position.toLowerCase().indexOf(query) > -1)
                    : this.contacts;
            },
            count() {
                return this.filteredContacts.length;
            },
            params() {
                return {
                    company_id: this.id,
                };
            },
            routeParams() {
                return {
                    company: this.id,
                }
            }
        },

        watch: {
            count() {
                this.$emit('update');
            },
            query() {
                this.internalQuery = this.query;
            },
        },

        created() {
            this.get();
        },

        methods: {
            get() {
                this.loading = true;

                axios.get(route('administration.companies.contacts.index', this.routeParams), {
                    params: this.params,
                }).then(({data}) => {
                    this.contacts = data;
                    this.loading = false;
                    this.$emit('update');
                }).catch(error => this.handleError(error));
            },
            create() {
                this.loading = true;

                axios.get(route('administration.companies.contacts.create', this.routeParams))
                    .then(({data}) => {
                        this.loading = false;
                        this.form = data.form;
                        this.addFields();
                        this.$emit('update');
                    }).catch(error => this.handleError(error));
            },
            edit(contact) {
                this.loading = true;

                axios.get(route('administration.companies.contacts.edit', {"contact": contact.id, ...this.routeParams}))
                    .then(({data}) => {
                        this.loading = false;
                        this.form = data.form;
                        this.addFields();
                    }).catch(error => this.handleError(error));
            },
            destroy(contact, index) {
                this.loading = true;

                axios.delete(route('administration.companies.contacts.destroy', {"contact": contact.id, ...this.routeParams}))
                    .then(() => {
                        let deleted = this.contacts.splice(index, 1);
                        this.loading = false;
                        this.$emit('update');
                        this.postDestroy(deleted.pop());
                    }).catch(error => this.handleError(error));
            },
            addFields() {
                this.field('company_id').value = this.id;
            },
            field(field) {
                return this.form.sections
                    .reduce((fields, section) => fields.concat(section.fields), [])
                    .find(item => item.name === field);
            },
            postDestroy(contact) {
                this.deletedContact = contact;
                this.confirmPersonDelete = true;
            },
            destroyPerson() {
                this.loading = true;

                axios.delete(route('administration.people.destroy', {"person": this.deletedContact.person_id, ...this.routeParams}))
                    .then(() => {
                        this.deletedContact = null;
                        this.loading = false;
                        this.confirmPersonDelete = false;
                    })
                    .catch(error => this.handleError(error));
            },
        },
    };

</script>

<style lang="scss" scoped>

    .controls {
        display: flex;
        justify-content: center;
    }

</style>
