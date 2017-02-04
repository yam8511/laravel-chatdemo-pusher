<template>
    <div class="chat-composer">
        <input type="text" placeholder="Start typing message ..." v-model="messageText" @keydown.enter="sendMessage">
        <button class="btn btn-primary" @click="sendMessage">Send</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                messageText: ''
            }
        },
        props: ['user'],
        methods: {
            sendMessage () {
                this.$emit('messagesend', {
                    message: this.messageText,
                    user: this.user
                });
                this.messageText = '';
            }
        }
    }
</script>

<style>
    .chat-composer {
        display:flex;
    }

    .chat-composer input {
        flex: 1 auto;
    }

    .chat-composer button {
        border-radius: 0;
    }
</style>