<template>
    <div>
        <h3>Create New Customer</h3>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addCustomer">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="customer.name" required>
                    </div>
                    <div class="form-group">
                        <label>E-Mail</label>
                        <input type="email" class="form-control" v-model="customer.email" required>
                    </div>
                    <div class="form-group">
                        <label>GSM No</label>
                        <input type="number" maxlength="12" minlength="12" class="form-control"
                               v-model="customer.gsm_no" required>
                    </div>
                    <div class="form-group">
                        <label>Birthday</label>
                        <input type="date" class="date form-control" v-model="customer.birthday" required>
                    </div>
                    <div class="form-group">
                        <label>Department</label>
                        <select class="form-control" v-model="customer.department_id" required>
                            <option v-for="department in departments" :value="department.id">
                                {{ department.name }}
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

import {VueReCaptcha} from 'vue-recaptcha-v3';
import Vue from "vue";

Vue.use(VueReCaptcha, {siteKey: '6Ld-aV8cAAAAAJ6uuDPW5iQrOnMIh0TgLl79T-rq'});

export default {
    data() {
        return {
            customer: {},
            departments: []
        }
    },
    created() {
        this.axios
            .get('http://localhost:8000/api/customers/create')
            .then(response => {
                this.departments = response.data;
            });
    },
    methods: {
        addCustomer() {
            this.$recaptcha("login").then((token) => {
                this.axios
                    .post('http://localhost:8000/api/customers', this.customer)
                    .then(response => (
                        this.$router.push({name: 'index'})
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            });
        }
    }
}
</script>
