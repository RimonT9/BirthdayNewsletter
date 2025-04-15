<template>
    <div>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Telephone</th>
      <th scope="col">Email</th>
      <th scope="col">Birthday</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="guest in guests">
      <th scope="row">{{ guest.id }}</th>
      <td>{{ guest.name }}</td>
      <td>{{ guest.telephone }}</td>
      <td>{{ guest.email }}</td>
      <td>{{ guest.birthday }}</td>
    </tr>
  </tbody>
</table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                guests: null,
            }
        },

        mounted() {
            this.getGuests()
        },

        methods: {
            getGuests() {
                axios.get('/BirthdayMailingList/public/api/guests/')
                .then( res => {
                    this.guests = res.data.data;
                })
            }
        }
    }
</script>