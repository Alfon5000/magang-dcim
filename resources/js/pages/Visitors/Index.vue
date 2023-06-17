<script>
import HeaderComponent from "../../components/HeaderComponent.vue";
import SidebarComponent from "../../components/SidebarComponent.vue";
import { ref, onMounted } from "vue";
import { RouterLink } from "vue-router";
import api from "../../api";
import { Bootstrap4Pagination } from "laravel-vue-pagination";

export default {
    name: "VisitorsIndex",
    components: {
        HeaderComponent,
        SidebarComponent,
        Bootstrap4Pagination,
    },
    setup() {
        const visitors = ref({ data: [] });
        const keyword = ref("");

        const getVisitors = async (page = 1) => {
            await api.get(`/visitors?page=${page}`).then((response) => {
                visitors.value = response.data.data;
                // console.log(visitors.value);
            });
        };

        const deleteVisitor = async (id) => {
            await api.delete(`/visitors/${id}`).then(() => {
                getVisitors();
            });
        };

        onMounted(() => {
            getVisitors();
        });

        return {
            visitors,
            keyword,
            getVisitors,
            deleteVisitor,
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
                <h2>Visitor List</h2>
            </div>
            <div class="content">
                <div class="overflow-auto">
                    <div class="float-left ml-0">
                        <router-link
                            :to="{ name: 'visitors.create' }"
                            class="btn bg-teal mb-3"
                            ><i class="fas fa-plus mr-2"></i>Create</router-link
                        >
                    </div>
                    <div class="float-right">
                        <form>
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control mb-3 mr-2"
                                    placeholder="Search here..."
                                    v-model="keyword"
                                />
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead class="bg-navy text-white">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Visiting Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-if="visitors.data.length > 0"
                            v-for="(visitor, index) in visitors.data"
                            :key="index"
                        >
                            <td>{{ ++index }}</td>
                            <td>{{ visitor.name }}</td>
                            <td>{{ visitor.visiting_date }}</td>
                            <td>
                                <div class="badge badge-secondary">
                                    {{ visitor.status }}
                                </div>
                            </td>
                            <td>{{ visitor.description.slice(0, 50) }}...</td>
                            <td class="d-flex">
                                <router-link
                                    :to="{
                                        name: 'visitors.edit',
                                        params: { id: visitor.id },
                                    }"
                                    class="btn bg-indigo mr-2"
                                    ><i class="fas fa-edit mr-2"></i
                                    >Edit</router-link
                                >
                                <button
                                    @click.prevent="deleteVisitor(visitor.id)"
                                    class="btn bg-pink"
                                >
                                    <i class="fas fa-trash-alt mr-2"></i>
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <tr v-else>
                            <td colspan="6" class="text-center">
                                <div class="alert alert-danger mb-0">
                                    Visitor is not available.
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <Bootstrap4Pagination
                :data="visitors"
                @pagination-change-page="getVisitors"
            />
        </div>
    </div>
</template>
