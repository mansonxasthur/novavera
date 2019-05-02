import DeleteDialog from '../components/dialoges/DeleteDialog';

export default {
    components: {DeleteDialog},
    data() {
        return {
            loading: false,
            deleteDialog: false,
        }
    },
    methods: {
        post(item, form, collection = '', subcollection = '') {
            if (this.validate(form)) {
                let vm = this;
                vm.loading = true;
                axios.post(vm.postRoute, item)
                    .then(res => {
                        if (collection !== '') {
                            if (subcollection !== '') {
                                vm[collection][subcollection].push(res.data.data);
                            } else {
                                vm[collection].push(res.data.data);
                            }
                        }
                        vm.reset(form);
                        vm.activateSnackbar('success', res.data.message);
                        return true;
                    })
                    .catch(error => {
                        vm.loading = false;
                        vm.activateSnackbar('error', error.response.data.message);
                        return false;
                    })
            }
        },
        update(item, key, form, collection = '', subcollection = '') {
            if (this.validate(form)) {
                let vm = this;
                vm.loading = true;
                axios.put(vm.updateRoute + key, item)
                    .then(res => {
                        if (collection !== '') {
                            if (subcollection !== '') {
                                Object.assign(vm[collection][subcollection][vm.editedIndex], res.data.data);
                            } else {
                                Object.assign(vm[collection][vm.editedIndex], res.data.data);
                            }
                        }
                        vm.reset(form);
                        vm.activateSnackbar('success', res.data.message);
                    })
                    .catch(error => {
                        vm.loading = false;
                        vm.activateSnackbar('error', error.response.data.message);
                    })
            }
        },
        delete(item, key, collection, subcollection = '') {
            let vm = this;
            vm.loading = true;
            axios.delete(vm.deleteRoute + key, item)
                .then(res => {
                    if (collection !== '') {
                        if (subcollection !== '') {
                            vm[collection][subcollection].splice(vm.editedIndex, 1);
                        } else {
                            vm[collection].splice(vm.editedIndex, 1);
                        }
                    }
                    vm.closeDeleteDialog();
                    vm.activateSnackbar('success', 'Deleted successfully!');
                })
                .catch(error => {
                    vm.loading = false;
                    vm.activateSnackbar('error', error.response.data.message);
                })

        },
        validate(form) {
            return this.$refs[form].validate();
        },
        reset(form) {
            if (this.dialog) {
                this.close();
            }
            this.loading = false;
            this.$refs[form].reset();
            this.$refs[form].resetValidation();
        },
        closeDeleteDialog(){
            this.loading = false;
            this.deleteDialog = false;
            if (typeof this.editedIndex !== 'undefined') {
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem);
                    this.editedIndex = -1;
                }, 300)
            }
        },
        editItem(item, collection, subcollection = '') {
            if (subcollection !== '') {
                this.editedIndex = this[collection][subcollection].indexOf(item);
            } else {
                this.editedIndex = this[collection].indexOf(item);
            }

            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        deleteItem(item, collection, subcollection = '') {
            if (subcollection !== '') {
                this.editedIndex = this[collection][subcollection].indexOf(item);
            } else {
                this.editedIndex = this[collection].indexOf(item);
            }
            this.editedItem = Object.assign({}, item);
            this.deleteDialog = true;
        },
        close() {
            this.dialog = false;
            setTimeout(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            }, 300)
        },
        confirmDelete(collection = '', subcollection = '', key = null) {
            this.delete(
                this.editedItem,
                key ? this.editedItem[key] : this.editedItem.id,
                collection,
                subcollection
            )
        }
    }
}