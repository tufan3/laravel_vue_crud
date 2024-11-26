<template>
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <RouterLink :to="{name: 'List'}" type="button" class="btn btn-danger btn-sm add" style="float: right;">List Customer</RouterLink>
                            <h3 class="card-title">Add Transaction</h3>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="StoreTransactionData">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="invoice_no" class="form-label">Invoice No <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="invoice_no" v-model="formData.invoice_no" placeholder="Invoice No">
                                        <span v-if="errors.invoice_no" class="text-danger">{{ errors.invoice_no[0] }}</span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="amount" v-model="formData.amount" placeholder="Enter amount">
                                        <span v-if="errors.amount" class="text-danger">{{ errors.amount[0] }}</span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="created" class="form-label">Created Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="created" v-model="formData.created">
                                        <span v-if="errors.created" class="text-danger">{{ errors.created[0] }}</span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info">Add Transaction</button>
                                </div>
                            </form>
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
            formData: {
                customer_id: '',
                invoice_no: '',
                amount: '',
                created: '',
            },
            errors: {}
        }
    },
    mounted() {
        if (this.$route.params.id) {
            this.formData.customer_id = this.$route.params.id;
        }
    },
    methods: {
        StoreTransactionData() {
            axios.post('/api/customer/transaction-store', this.formData)
                .then(response => {
                    // console.log(response.data);
                    this.errors = {};
                    this.$router.push({ name: 'List' });
                })
                .catch(error => {
                    if (error.response && error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    } else {
                        console.error(error);
                    }
                });
        }
    }
}
</script>

<style>
</style>
