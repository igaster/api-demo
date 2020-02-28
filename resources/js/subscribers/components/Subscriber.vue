<template>
    <div>
        <h1>{{ subscriber.name }}</h1>

        <div class="card mb-4">

            <div class="card-body">

                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" v-model="subscriber_form.name" class="form-control">
                </div>

                <div class="form-group">
                    <label>email:</label>
                    <input type="email" v-model="subscriber_form.email" class="form-control">
                </div>

                <div class="form-group">
                    <label>Address:</label>
                    <input type="text" v-model="subscriber_form.address" class="form-control" >
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" v-model="subscriber_form.state">
                        <option value="active">Active</option>
                        <option value="bounced">Bounced</option>
                        <option value="junk">Junk</option>
                        <option value="unconfirmed">Unconfirmed</option>
                        <option value="unsubscribed">Unsubscribed</option>
                    </select>
                </div>

                <button type="button" class="btn btn-primary" @click="updateSubscriber">Update Subscriber</button>

            </div>
        </div>


        <h1>Fields:</h1>

        <div class="list-group">
            <div v-for="field in fields" :key="field.id" class="list-group-item">
                {{ field.title }}
                <span class="float-right">
                    <button type="button" class="btn btn-danger btn-sm py-0" @click="deleteField(field)">Delete</button>
                </span>
            </div>
        </div>

        <div class="row my-2">
            <div class="col">
                <input type="text" class="form-control" placeholder="Field Title" v-model="field_title">
            </div>
            <div class="col">
                <select class="form-control" v-model="field_type">
                    <option value="">-Choose Type-</option>
                    <option value="date">date</option>
                    <option value="number">number</option>
                    <option value="string">string</option>
                    <option value="boolean">boolean</option>
                </select>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary btn-block mb-2" @click="createField">
                    <span class="fa fa-plus"></span>
                    Create Field
                </button>
            </div>
        </div>

    </div>
</template>

<script>

    export default ({
        name: "subscriber",

        // -----------------------------------------------
        // Props
        // -----------------------------------------------

        props: {
            subscriber: null,
        },

        // -----------------------------------------------
        // data
        // -----------------------------------------------

        data() { return {
            fields: [],
            field_title: '',
            field_type: '',
            subscriber_form: {
                name: null,
                email: null,
                address: null,
                state: null,
            },
        }},

        watch: {
            subscriber: function (val, oldVal) {
                this.clone_subscriber();
                this.fetchFields();
            },
        },

        // -----------------------------------------------
        // vue lifecycle
        // -----------------------------------------------

        created() {
            // ...
        },

        mounted() {
            this.clone_subscriber();
            this.fetchFields();
        },

        // -----------------------------------------------
        // methods
        // -----------------------------------------------

        methods: {

            fetchFields() {
                axios({
                    method: 'GET',
                    url: '/api/subscribers/'+this.subscriber.id+'/fields',
                }).then(({data}) => {
                    this.fields = data.data;
                }).catch((error) => {
                    this.alert(error);
                });
            },

            clone_subscriber() {
                this.subscriber_form.name = this.subscriber.name;
                this.subscriber_form.email = this.subscriber.email;
                this.subscriber_form.address = this.subscriber.address;
                this.subscriber_form.state = this.subscriber.state;
            },

            createField() {
                axios({
                    method: 'POST',
                    url: '/api/subscribers/'+this.subscriber.id+'/fields',
                    data: {
                        title: this.field_title,
                        type: this.field_type,
                    },
                }).then(({data}) => {
                    this.addField(data.data);
                    this.field_title = '';
                    this.field_type = '';
                }).catch((error) => {
                    this.alert(error);
                });
            },

            deleteField(field) {
                axios({
                    method: 'POST',
                    url: '/api/fields/'+field.id,
                    data: {
                        _method: 'delete',
                    },
                }).then(({data}) => {
                    this.removeField(field);
                }).catch((error) => {
                    this.alert(error);
                });
            },

            addField(field) {
                this.fields.push(field);
            },

            removeField(field) {
                for( var i = 0; i < this.fields.length; i++){
                    if ( this.fields[i] === field) {
                        this.fields.splice(i, 1);
                        break;
                    }
                }
            },

            updateSubscriber() {
                axios({
                    method: 'POST',
                    url: '/api/subscribers/'+this.subscriber.id,
                    data: {
                        name: this.subscriber_form.name,
                        email: this.subscriber_form.email,
                        address: this.subscriber_form.address,
                        state: this.subscriber_form.state,
                    },
                }).then(({data}) => {
                    this.$emit('subscriber-updated', data.data);
                }).catch((error) => {
                    this.alert(error);
                });
            },

            alert(error) {
                console.log(error.response.data);
                this.$swal('Error',error.response.data.message,'error');
            }
        },

        // -----------------------------------------------
        // Components
        // -----------------------------------------------

        components: {}
    });
</script>
