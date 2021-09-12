<template>
    <div>
        <h2>Customers</h2>
        <hr>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>GSM No</th>
                <th>Department</th>
                <th>Birthday</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="customer in customers" :key="customer.id">
                <td>{{ customer.name }}</td>
                <td>{{ customer.email }}</td>
                <td>{{ customer.gsm_no }}</td>
                <td>{{ customer.department.name }}</td>
                <td>{{ customer.birthday }}</td>
            </tr>
            </tbody>
        </table>

        <hr>

        <h1>Hava Durumu</h1>
        <div class="card-columns col-md-12 d-flex justify-content-center">
            <div v-for="info in weatherInfo" class="col-md-4 p-5">
                <h1>London</h1>
                <h3><span>Day:</span> {{ info.temp.day }}&deg;</h3>
                <h3><span>Min:</span> {{ info.temp.min }}&deg;</h3>
                <h3><span>Max:</span> {{ info.temp.max }}&deg;</h3>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            customers: [],
            weatherInfo: null
        }
    },
    created() {
        this.axios
            .get('http://localhost:8000/api/customers/')
            .then(response => {
                this.customers = response.data;
            });

        this.axios
            .get('http://localhost:8000/api/weather')
            .then(response => {
                this.weatherInfo = response.data.daily.slice(0,3);
            });
    },
    methods: {
        deleteProduct(id) {
            this.axios
                .delete(`http://localhost:8000/api/customers/${id}`)
                .then(response => {
                    let i = this.customers.map(data => data.id).indexOf(id);
                    this.customers.splice(i, 1)
                });
        }
    }
}
</script>
