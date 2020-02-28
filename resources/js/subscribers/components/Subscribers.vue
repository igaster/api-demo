<template>
    <div class="row">

        <div class="col-md-6">

            <div class="d-flex justify-content-between">
                <h1>Subscribers:</h1>
                <div>
                    <a href="/subscribers/create" class="btn btn-primary"><span class="fa fa-plus"></span> Add Subscriber</a>
                </div>
            </div>


            <div class="list-group">
                <div v-for="subscriber in subscribers" :key="subscriber.id" class="list-group-item pointer"  :class="{active :is_selected(subscriber)}" @click="select(subscriber)">
                    {{ subscriber.name }}
                    <span class="float-right">
                        <span class="fa fa-chevron-right"></span>
                    </span>
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <subscriber
                v-if="selected"
                :subscriber="selected"
                @subscriber-updated="eventUpdated"
            ></subscriber>
            <p v-else>No Item Selected</p>
        </div>


    </div>
</template>

<style scoped>
</style>

<script>

    import Subscriber from "./Subscriber";

    export default ({
        name: "subscribers",

        // -----------------------------------------------
        // data
        // -----------------------------------------------

        data() { return {
            subscribers: [],
            selected: null,
        }},

        // -----------------------------------------------
        // vue lifecycle
        // -----------------------------------------------

        created() {
            this.fetchSubscribers();
        },

        mounted() {
            // ..
        },

        // -----------------------------------------------
        // methods
        // -----------------------------------------------

        methods: {

            fetchSubscribers() {
                axios({
                    method: 'GET',
                    url: '/api/subscribers',
                }).then(({data}) => {
                    this.subscribers = data.data;
                }).catch((error) => {
                    console.log(error.response.data.message );
                });
            },

            select(subscriber) {
                this.selected = subscriber;
            },

            is_selected(subscriber) {
                return this.selected && this.selected.id === subscriber.id;
            },

            eventUpdated(data) {
                this.subscribers.forEach( subscriber => {
                    if(subscriber.id === data.id) {
                        subscriber.name = data.name;
                        subscriber.email = data.email;
                        subscriber.state = data.state;
                    }
                });
            },


        },

        // -----------------------------------------------
        // Components
        // -----------------------------------------------

        components: {
            Subscriber
        }
    });
</script>
