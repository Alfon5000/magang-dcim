<script>
import api from "../../api";

export default {
    name: "VisitorsEdit",
    data() {
        return {
            visitor: {
                name: "",
                category_id: "",
                status_id: 1,
                application_date: "",
                start_date: "",
                end_date: "",
                application_letter: "",
                description: "",
                _method: "PUT",
            },
            categories: [],
            statuses: [],
            errors: [],
        };
    },
    methods: {
        async getVisitor() {
            await api
                .get(`/api/visitors/${this.$route.params.id}`, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                })
                .then((response) => {
                    this.visitor.name = response.data.data.name;
                    this.visitor.category_id = response.data.data.category_id;
                    this.visitor.status_id = response.data.data.status_id;
                    this.visitor.start_date = response.data.data.start_date;
                    this.visitor.end_date = response.data.data.end_date;
                    this.visitor.application_letter =
                        response.data.data.application_letter;
                    this.visitor.description = response.data.data.description;
                });
        },
        async updateVisitor() {
            await api
                .post(`/api/visitors/${this.$route.params.id}`, this.visitor, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    if (response.data.success === true) {
                        this.$router.push({ name: "visitors.index" });
                    } else {
                        this.errors = response.data.message;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async getCategories() {
            await api
                .get("/api/categories", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                })
                .then((response) => {
                    this.categories = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async getStatuses() {
            await api
                .get("/api/statuses", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                })
                .then((response) => {
                    this.statuses = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        handleFileChange(event) {
            this.visitor.application_letter = event.target.files[0];
        },
    },
    beforeMount() {
        if (!localStorage.getItem("isAuth")) {
            this.$router.push({ name: "login" });
        }
    },
    mounted() {
        this.getVisitor();
        this.getCategories();
        this.getStatuses();
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
                <form @submit.prevent="updateVisitor()" class="w-75 mx-auto">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Visitor name"
                            id="name"
                            v-model="visitor.name"
                        />
                        <div v-if="errors.name" class="text-danger mt-2">
                            {{ errors.name[0] }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select
                            class="form-control"
                            v-model="visitor.category_id"
                            id="category"
                        >
                            <option value="">-- Choose category --</option>
                            <option
                                v-for="(category, index) in categories"
                                :key="index"
                                :value="category.id"
                            >
                                {{ category.name }}
                            </option>
                        </select>
                        <div v-if="errors.category_id" class="text-danger mt-2">
                            {{ errors.category_id[0] }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input
                            type="date"
                            class="form-control"
                            id="start_date"
                            v-model="visitor.start_date"
                        />
                        <div v-if="errors.start_date" class="text-danger mt-2">
                            {{ errors.start_date[0] }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input
                            type="date"
                            class="form-control"
                            id="end_date"
                            v-model="visitor.end_date"
                        />
                        <div v-if="errors.end_date" class="text-danger mt-2">
                            {{ errors.end_date[0] }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="application_letter"
                            >Application Letter (Optional)</label
                        >
                        <div class="input-group">
                            <div class="custom-file">
                                <input
                                    type="file"
                                    class="custom-file-input"
                                    id="application_letter"
                                    @change="handleFileChange($event)"
                                />
                                <label
                                    class="custom-file-label"
                                    for="application_letter"
                                    >Choose file</label
                                >
                            </div>
                        </div>
                        <div
                            v-if="errors.application_letter"
                            class="text-danger mt-2"
                        >
                            {{ errors.application_letter[0] }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea
                            id="description"
                            class="form-control"
                            v-model="visitor.description"
                            placeholder="Visitor description..."
                            rows="6"
                        ></textarea>
                        <div v-if="errors.description" class="text-danger mt-2">
                            {{ errors.description[0] }}
                        </div>
                    </div>
                    <div class="form-group">
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
