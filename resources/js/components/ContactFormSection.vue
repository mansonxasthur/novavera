<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <section id="contact-us">
        <v-layout column align-center>
            <v-flex shrink class="py-3">
                <h1 class="display-1">Contact Us</h1>
            </v-flex>
            <v-flex shrink
                    class="red darken-2 mb-4"
                    style="height: 3px; width: 50px">
            </v-flex>
        </v-layout>
        <v-flex>
            <v-container fluid>
                <v-layout row wrap>
                    <v-flex xs12 lg8 pa-2>
                        <v-card flat>
                            <v-form ref="form" lazy-validation>
                                <v-card-text>
                                    <v-layout row wrap>
                                        <v-flex xs12>
                                            <v-layout row wrap>
                                                <v-flex xs12 md6 pa-1>
                                                    <v-text-field
                                                            v-model="contact.name"
                                                            outline
                                                            label="Enter Name"
                                                            type="text"
                                                            color="primary"
                                                            autocomplete="name"
                                                            prepend-inner-icon="person"
                                                            required
                                                            :rules="nameRules"
                                                            :counter="30"
                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 md6 pa-1>
                                                    <v-text-field
                                                            v-model="contact.email"
                                                            outline
                                                            label="Enter Email"
                                                            type="email"
                                                            color="primary"
                                                            autocomplete="email"
                                                            prepend-inner-icon="email"
                                                            required
                                                            :rules="emailRules"
                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 md6 pa-1>
                                                    <v-text-field
                                                            v-model="contact.phone"
                                                            outline
                                                            label="Enter Phone"
                                                            type="tel"
                                                            color="primary"
                                                            autocomplete="tel"
                                                            prepend-inner-icon="phone"
                                                            required
                                                            :rules="phoneRules"
                                                            :counter="15"
                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 md6 pa-1>
                                                    <v-select
                                                            v-model="contact.inquiry_type"
                                                            outline
                                                            :items="inquiries"
                                                            label="Select Inquiry Type"
                                                            color="primary"
                                                            prepend-inner-icon="category"
                                                            required
                                                            :rules="inquiryRules"
                                                    ></v-select>
                                                </v-flex>
                                            </v-layout>
                                        </v-flex>
                                        <v-flex xs12 pa-1>
                                            <v-textarea
                                                    v-model="contact.message"
                                                    outline
                                                    height="100%"
                                                    label="Message"
                                                    color="primary"
                                                    prepend-inner-icon="message"
                                                    required
                                                    :rules="messageRules"
                                                    :counter="140"
                                            ></v-textarea>
                                        </v-flex>
                                    </v-layout>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="primary" class="mx-2" :loading="loading" @click.stop="send()">Send message</v-btn>
                                </v-card-actions>
                            </v-form>
                        </v-card>
                    </v-flex>
                    <v-flex xs12 lg4 pa-2>
                        <v-card flat>
                            <v-card-text>
                                <v-flex pa-2>
                                    <h2 class="headline mb-3">
                                        <v-icon large>location_on</v-icon>
                                        Our office
                                    </h2>

                                    <v-layout column>
                                        <v-flex class="subheading py-2">
                                            <address>
                                                <v-tooltip left>
                                                    <template v-slot:activator="{ on }">

                                                        <a href="https://goo.gl/maps/4y74kX6UDg5We5Ud7"
                                                           target="_blank" role="link" v-on="on"
                                                           style="text-decoration: none; color:inherit">
                                                            Cairo, Capital Business Park, Sheikh Zayed
                                                            Building 6 , Office 314
                                                        </a>
                                                    </template>
                                                    <span>Address</span>
                                                </v-tooltip>
                                            </address>
                                        </v-flex>
                                        <v-flex class="subheading py-2">
                                            <v-tooltip left>
                                                <template v-slot:activator="{ on }">
                                                    <a href="tel:+201019699911" role="tel" v-on="on"
                                                       style="text-decoration: none; color:inherit">
                                                        (+20) 1019699911
                                                    </a>
                                                </template>
                                                <span>Phone</span>
                                            </v-tooltip>

                                        </v-flex>
                                        <v-flex class="subheading py-2">
                                            <v-tooltip left>
                                                <template v-slot:activator="{ on }">
                                                    <a href="mailto:realestate@novavera.com" role="email"
                                                       v-on="on"
                                                       style="text-decoration: none; color:inherit">
                                                        realestate@novavera.com
                                                    </a>
                                                </template>
                                                <span>Email</span>
                                            </v-tooltip>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-flex>
        <snackbar :active="snackbar.active" :color="snackbar.color" :message="snackbar.message"
                  @deactivate="deactivateSnackbar"></snackbar>
    </section>
</template>

<script>
    import SnackbarComponent from '../mixins/SnackbarComponent';
    export default {
        name: "ContactFormSection",
        mixins: [SnackbarComponent],
        data() {
            return {
                loading: false,
                inquiries: [
                    'Real Estate Egypt',
                    'Citizenship & Residency'
                ],
                contact: {
                    name: '',
                    email: '',
                    phone: '',
                    inquiry_type: '',
                    message: '',
                },
                nameRules: [
                    v => !!v || 'Name is required',
                    v => (v && v.length <= 30) || 'Name must be less than 30 characters'
                ],
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+/.test(v) || 'E-mail must be valid'
                ],
                phoneRules: [
                    v => !!v || 'Phone is required',
                    v => /\d+/.test(v) || 'Phone must be valid',
                    v => (v && v.length <= 15) || 'Name must be less than 15 characters'
                ],
                inquiryRules: [
                    v => !!v || 'Inquiry is required',
                ],
                messageRules: [
                    v => !!v || 'Message is required',
                    v => (v && v.length <= 150) || 'Message must be less than 150 characters',
                    v => (v && v.length >= 10) || 'Message must be more than 10 characters'
                ],
            }
        },
        methods: {
            send () {
                if (this.$refs.form.validate()) {
                    let vm = this;
                    vm.loading = true;
                    axios.post('/contact/home', vm.contact)
                        .then(res => {
                            vm.reset();
                            vm.resetValidation();
                            vm.activateSnackbar('success', res.data.message);
                        })
                        .catch(err => {
                            vm.loading = false;
                            if ('response' in err) {
                                vm.activateSnackbar('error', err.response.data.message);
                            }
                        })
                }
            },
            reset () {
                this.$refs.form.reset();
                this.loading = false;
            },
            resetValidation () {
                this.$refs.form.resetValidation()
            }
        }
    }
</script>

<style scoped>

</style>