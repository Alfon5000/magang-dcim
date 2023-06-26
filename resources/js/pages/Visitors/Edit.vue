<script>
import api from "../../api";

export default {
    name: "VisitorsEdit",
    data() {
        return {
            visitor: {
                name: "",
                visiting_date: "",
                status: "",
                description: "",
            },
            errors: [],
        };
    },
    methods: {
        async getVisitor() {
            await api
                .get(`/visitors/${this.$route.params.id}`)
                .then((response) => {
                    this.visitor.name = response.data.data.name;
                    this.visitor.visiting_date =
                        response.data.data.visiting_date;
                    this.visitor.status = response.data.data.status;
                    this.visitor.description = response.data.data.description;
                });
        },
        async updateVisitor() {
            await api
                .put(`/visitors/${this.$route.params.id}`, this.visitor)
                .then(() => {
                    this.$router.push({ name: "visitors.index" });
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
    },
    mounted() {
        this.getVisitor();
    },
};
</script>

<template>
    <div class="wrapper">
        <Header />
        <Sidebar />
        <div class="content-wrapper px-3">
            <div class="content-header">
                <h2>Edit Visitor</h2>
            </div>
            <div class="content">
                <form @submit.prevent="updateVisitor()">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="visitor.name"
                            placeholder="Visitor name..."
                        />
                        <div v-if="errors.name" class="alert alert-danger mt-2">
                            <span>{{ errors.name[0] }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Visiting Date</label>
                        <input
                            type="date"
                            class="form-control"
                            v-model="visitor.visiting_date"
                        />
                        <div
                            v-if="errors.visiting_date"
                            class="alert alert-danger mt-2"
                        >
                            <span>{{ errors.visiting_date[0] }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="visitor.status"
                            placeholder="Visitor status..."
                        />
                        <div
                            v-if="errors.status"
                            class="alert alert-danger mt-2"
                        >
                            <span>{{ errors.status[0] }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="visitor.description"
                            placeholder="Visitor description..."
                        />
                        <div
                            v-if="errors.description"
                            class="alert alert-danger mt-2"
                        >
                            <span>{{ errors.description[0] }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn bg-teal mr-2">
                            <i class="fas fa-save mr-2"></i>Update
                        </button>
                        <router-link
                            :to="{ name: 'visitors.index' }"
                            class="btn btn-danger"
                            ><i class="fas fa-times mr-2"></i
                            >Cancel</router-link
                        >
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
