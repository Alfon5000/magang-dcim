<script>
import HeaderComponent from "../../components/HeaderComponent.vue";
import SidebarComponent from "../../components/SidebarComponent.vue";
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "../../api";
import { RouterLink } from "vue-router";

export default {
    name: "VisitorsCreate",
    components: {
        HeaderComponent,
        SidebarComponent,
    },
    setup() {
        const name = ref("");
        const visiting_date = ref("");
        const status = ref("");
        const description = ref("");
        const errors = ref([]);
        const router = useRouter();

        const storeVisitor = async () => {
            let formData = new FormData();
            formData.append("name", name.value);
            formData.append("visiting_date", visiting_date.value);
            formData.append("status", status.value);
            formData.append("description", description.value);

            await api
                .post("/visitors", formData)
                .then(() => {
                    // errors.value = res.data.errors;
                    router.push({ name: "visitors.index" });
                })
                .catch((error) => {
                    errors.value = error.response.data.errors;
                });
        };

        return {
            name,
            visiting_date,
            status,
            description,
            errors,
            router,
            storeVisitor,
        };
    },
};
</script>

<template>
    <div class="wrapper">
        <header-component></header-component>
        <sidebar-component></sidebar-component>
        <div class="content-wrapper px-3">
            <div class="content-header">
                <h2>Create Visitor</h2>
            </div>
            <div class="content">
                <form @submit.prevent="storeVisitor()">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="name"
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
                            v-model="visiting_date"
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
                            v-model="status"
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
                            v-model="description"
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
                            <i class="fas fa-save mr-2"></i>Save
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
