
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('chat-message', require('./components/ChatMessage.vue'));
Vue.component('chat-log', require('./components/ChatLog.vue'));
Vue.component('chat-composer', require('./components/ChatComposer.vue'));

const app = new Vue({
    el: '#app',
    data: {
    	messages: [],
        usersInRoom: []
    },
    methods: {
        addMessage (message) {
            console.info(message);

            if (message.message == '') {
                return ;
            }

            this.messages.reverse();
            this.messages.push(message);
            this.messages.reverse();

            axios.post('/messages', message).then(response => {
                // console.info(response);
            });
        }
    },
    created() {
        axios.get('/messages').then(response => {
            this.messages = response.data;
            // console.info(response);
        });

        // Echo.private('chatroom')
        //     .listen('EventName', (e) => {
        //
        //     });

        Echo.join('chatroom')
            .here((users) => {
                console.log(users);
                this.usersInRoom = users;
            })
            .joining((user) => {
                console.log(user);
                this.usersInRoom.push(user);
            })
            .leaving((user) => {
                console.log(user);
                this.usersInRoom = this.usersInRoom.filter(u => u != user)
            })
            .listen('MessagePosted', (e) => {
                console.info(e);
                this.messages.reverse();
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                });
                this.messages.reverse();
            })
    }
});
