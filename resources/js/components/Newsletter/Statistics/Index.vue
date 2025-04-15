<template>
    <div class="w-25">
        <label class="mt-3">Filter by dates</label><br>
        <label class="mt-3 mx-2">from</label>
        <input v-model="start_date" type="date" class="mb-3 form-controll">
        <label class="mt-3 mx-2">to</label>
        <input v-model="end_date" type="date" class="mb-3 form-controll">
        <input @click.prevent="createFilter" type="submit" class="btn btn-primary mx-2" value="Apply"><br>
    </div>
    <div>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Sent</th>
      <th scope="col">Delivered</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="el in statistics">
      <td>{{ el.title }}</td>
      <td>{{ el.sent }}</td>
      <td>{{ el.delivered }}</td>
    </tr>
  </tbody>
</table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                statistics: null,
                start_date: null,
                end_date: null,
            }
        },

        mounted() {
            this.getStatistics()
        },

        methods: {
            createFilter() {
                axios.post('/BirthdayMailingList/public/api/newsletters/statistics/create', {
                    start_date: this.start_date, 
                    end_date: this.end_date
                })
                .then( res => {
                    this.getStatistics();
                })
            },

            getStatistics() {
                axios.get('/BirthdayMailingList/public/api/newsletters/statistics/')
                .then( res => {
                    this.statistics = res.data.data;
                })
            },

        }
    }
</script>