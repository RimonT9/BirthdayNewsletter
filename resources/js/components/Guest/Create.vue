<template>
    <div class="w-25">
        <input v-model="name" type="text" class="mb-3 mt-3 form-controll" placeholder="Name"><br>
        <input v-model="telephone" type="number" class="mb-3 form-controll" placeholder="Telephone"><br>
        <input v-model="email" type="email" class="mb-3 form-controll" placeholder="Email"><br>
        <input v-model="birthday" type="date" class="mb-3 form-controll" placeholder="Birthday"><br>
        <input @click.prevent="create" type="submit" class="btn btn-primary" value="Add"><br><br>
    </div>
    <div>
        <form @submit.prevent="uploadFile">
            <input type="file" @change="handleFileUpload">
            <button type="submit">Import</button><br><br>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: null,
                telephone: null,
                email: null,
                birthday: null,
                file: null,
            }
        },

        methods: {
            create() {
                axios.post('/BirthdayMailingList/public/api/guests/create', {
                    name: this.name,
                    telephone: this.telephone,
                    email: this.email,
                    birthday: this.birthday,
                })
                .then( res => {
                    this.name = '',
                    this.telephone = ''
                    this.email = ''
                    this.birthday = '';
                })
            },

            handleFileUpload(event) {
                this.file = event.target.files[0];
            },

            uploadFile(event) {
                const formData = new FormData();
                formData.append('file', this.file);

                axios.post('/BirthdayMailingList/public/api/guests/import', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                })
                .then( res => {
                    event.target.reset();
                })
            }
        }
    }
</script>
