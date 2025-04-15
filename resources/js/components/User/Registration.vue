<template>
    <div class="w-25">
        <input v-model="name" type="text" placeholder="name" class="form-control mt-3 mb-3">
        <input v-model="email" type="email" placeholder="email" class="form-control mb-3">
        <input v-model="password" type="password" placeholder="password" class="form-control mb-3">
        <input v-model="password_confirmation" type="password" placeholder="password confirmation" class="form-control mb-3">
        <input @click.prevent="register" type="submit" class="btn btn-primary">
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
            }
        },

        methods: {
            register() {
                axios.get('/BirthdayMailingList/public/sanctum/csrf-cookie')
                    .then( response => {
                        axios.post('/BirthdayMailingList/public/register', {
                            name: this.name,
                            email: this.email,
                            password: this.password,
                            password_confirmation: this.password_confirmation
                        })
                        .then ( res => {
                            localStorage.setItem('x_xsrf_token', 'true');
                            this.$router.push({name: 'user.personal'});
                        })
                    })
            }
        }
        
    }
</script>
