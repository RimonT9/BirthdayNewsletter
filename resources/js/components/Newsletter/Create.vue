<template>
    <div class="w-25">
        <input v-model="title" type="text" class="mb-3 mt-3 form-controll" placeholder="Title"><br>
        <textarea v-model="description" type="text" class="mb-3 form-controll" placeholder="Description"></textarea><br>
        <input @click.prevent="create" type="submit" class="btn btn-primary" value="Add"><br><br>
    </div>
    <div v-if="is_active !== null">
        <button @click.prevent="toggleNewsletter">{{ is_active == true ? 'Остановить рассылку' : 'Запустить рассылку' }}</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                id: null,
                title: null,
                description: null,
                is_active: null,
            }
        },

        mounted() {
            this.getNewsletter()
        },

        methods: {
            create() {
                axios.post('/BirthdayMailingList/public/api/newsletters/create', {
                    title: this.title,
                    description: this.description,
                })
                .then( res => {
                    this.getNewsletter();
                    this.title = ''
                    this.description = ''
                })
            },

            getNewsletter() {
                axios.get('/BirthdayMailingList/public/api/newsletters/')
                .then( res => {
                    this.id = res.data.data.id
                    this.is_active = res.data.data.is_active;
                })
            },

            toggleNewsletter() {
                if (this.is_active == true) {
                    this.is_active = false
                } else {
                    this.is_active = true
                }
                axios.patch(`/BirthdayMailingList/public/api/newsletters/${this.id}`, {
                    is_active: this.is_active,
                })
                .then( res => {
                    this.getNewsletter()
                })
            }
        }
    }
</script>
