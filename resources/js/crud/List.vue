<template>
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <RouterLink :to="{name:'AddNew'}" type="button" class="btn btn-primary add" data-toggle="modal"
                                data-target="#addModal" style="float: right;"> + Add Customer </RouterLink>

                            <h3 class="card-title">All Customer List</h3>

                        </div>
                        <div class="card-body">
                            <table id="ytable" class="table table-bordered table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Age</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Total Transactions</th>
                                        <th>Transactions Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(customer,index) in customers" :key="customer.id">
                                        <td>{{ ++index }}</td>
                                        <td>{{ customer.full_name }}</td>
                                        <td>{{ customer.age }}</td>
                                        <td>{{ customer.email }}</td>
                                        <td>{{ customer.phone }}</td>
                                        <td>{{ customer.total_amount }}</td>
                                        <td>{{ customer.last_transaction_date }}</td>
                                        <td>
                                            <router-link :to="{name:'Edit',params:{id:customer.id}}" type="button" class="btn btn-primary btn-sm">Edit</router-link>


                                            <a type="button" class="btn btn-danger btn-sm" @click="destroy(customer.id)">Delete</a>

                                            <router-link :to="{name:'AddTransaction',params:{id:customer.id}}" type="button" class="btn btn-info btn-sm">Add Transaction</router-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- <form id="deleted_form" action="" method="delete">
                                @csrf
                                @method('DELETE')
                            </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            customers: [],
        };
    },
    mounted() {
        this.CustomerList();
    },
    methods: {
        CustomerList(){
            axios.get('/api/customer')
            .then(res => {
                // console.log(res.data.customers);
                this.customers = res.data.customers;
            })
            .catch(err => {
                console.error(err);
            })
        },
        destroy(id){
            if (confirm('Are you sure you want to delete this data?')) {
                axios.delete('/api/customer/delete/' + id)
                .then(res => {
                    // console.log(res.data);
                    this.CustomerList();
                })
                .catch(err => {
                    console.error(err);
                })
            }
        }
    }
};
</script>

<style>

</style>
