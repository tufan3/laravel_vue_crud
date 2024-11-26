<template>
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <RouterLink :to="{name:'List'}" type="button" class="btn btn-danger btn-sm add"  style="float: right;">List Customer </RouterLink>

                            <h3 class="card-title">Add Customer</h3>

                        </div>
                        <div class="card-body">
                            <form @submit.prevent="StoreData">
                            <!-- <form @submit.prevent="StoreData" action="#" method="POST" id="add_from"> -->
                                <div class="modal-body">
                                    <!-- @csrf -->
                                    <div class="mb-3">
                                        <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" value="" v-model="formData.full_name">
                                        <span v-if="errors.full_name" class="text-danger">{{ errors.full_name[0] }}</span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="age" name="age" value="" v-model="formData.age">
                                        <span v-if="errors.age" class="text-danger">{{ errors.age[0] }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" value="" v-model="formData.email">
                                        <span v-if="errors.email" class="text-danger">{{ errors.email[0] }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="" v-model="formData.phone">
                                        <span v-if="errors.phone" class="text-danger">{{ errors.phone[0] }}</span>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info">Add Customer</button>
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
                full_name: '',
                age: '',
                email: '',
                phone: '',
            },
            errors: {}
        }
    },

    methods: {
        StoreData() {
            axios.post('/api/customer/store', this.formData)
                .then(response => {
                    this.errors = {};
                    this.$router.push({ name: 'List' });
                })
                .catch(error => {
                    if (error.response && error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    } else {
                        // console.log(error);
                    }
                });
        }
    }
}

</script>

<style>

</style>
