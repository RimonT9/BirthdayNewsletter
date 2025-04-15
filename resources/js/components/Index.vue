<template>
    <div>
        <router-link v-if="token" :to="{ name: 'guest.create' }">Add guest</router-link><br>
        <router-link v-if="token" :to="{ name: 'newsletter.create' }">Add newsletter</router-link><br>
        <router-link v-if="token" :to="{ name: 'statistics.index' }">Statistics</router-link><br>
        <router-link v-if="!token" :to="{ name: 'user.login' }">Login</router-link><br>
        <router-link v-if="token" :to="{ name: 'user.personal' }">Personal</router-link><br>
        <router-link v-if="!token" :to="{ name: 'user.registration' }">Registration</router-link><br>
        <a v-if="token" @click.prevent="logout" href="#">logout</a>
        <router-view :key="$route.fullPath"></router-view>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                token: null,
            }
        },

        mounted() {
            this.getToken()
        },

        updated() {
            this.getToken()
        },

        methods: {
            getToken() {
                this.token = localStorage.getItem('x_xsrf_token')
            },

            logout() {
                axios.post('/BirthdayMailingList/public/logout')
                    .then( res => {
                        localStorage.removeItem('x_xsrf_token');
                        this.$router.push({name: 'user.login'});
                    })       
            }
        }
    }
</script>
