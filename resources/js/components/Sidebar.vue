<script>
import api from "../api";

export default {
    name: "Sidebar",
    data() {
        return {
            role_id: null,
        };
    },
    methods: {
        getAuth() {
            api.get("/api/user", {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("token"),
                },
            }).then((response) => {
                this.role_id = response.data.data.role_id;
            });
        },
        closeSidebar() {
            const body = document.querySelector("body");
            body.classList.remove("sidebar-open");
            body.classList.add("sidebar-closed");
            body.classList.add("sidebar-collapse");
        },
    },
    beforeMount() {
        this.getAuth();
    },
};
</script>

<template>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-3 bg-navy">
        <!-- Brand Logo -->
        <router-link :to="{ name: 'dashboard' }" class="brand-link">
            <img
                src="https://cdn-icons-png.flaticon.com/128/9089/9089753.png"
                alt="Brand Logo"
                class="brand-image img-circle elevation-3"
                style="opacity: 0.8"
            />
            <span class="brand-text font-weight-light">DCIM</span>
        </router-link>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul
                    class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview"
                    role="menu"
                >
                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'dashboard' }"
                            class="nav-link"
                            :class="$route.name === 'dashboard' ? 'active' : ''"
                        >
                            <i class="nav-icon fas fa-tachometer-alt mr-2"></i>
                            <p>Dashboard</p>
                        </router-link>
                    </li>
                    <li v-show="role_id === 1" class="nav-item">
                        <router-link
                            :to="{ name: 'users.index' }"
                            class="nav-link"
                            :class="
                                $route.name === 'users.index' ? 'active' : ''
                            "
                        >
                            <i class="nav-icon fas fa-user mr-2"></i>
                            <p>Users</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'visitors.index' }"
                            class="nav-link"
                            :class="
                                $route.name === 'visitors.index' ? 'active' : ''
                            "
                        >
                            <i class="nav-icon fas fa-users mr-2"></i>
                            <p>Visitors</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'reports' }"
                            class="nav-link"
                            :class="$route.name === 'reports' ? 'active' : ''"
                        >
                            <i class="nav-icon fas fa-chart-bar mr-2"></i>
                            <p>Reports</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'cctv' }"
                            class="nav-link"
                            :class="$route.name === 'cctv' ? 'active' : ''"
                        >
                            <i class="nav-icon fas fa-video mr-2"></i>
                            <p>CCTV</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'about' }"
                            class="nav-link"
                            :class="$route.name === 'about' ? 'active' : ''"
                        >
                            <i class="nav-icon fas fa-info-circle mr-2"></i>
                            <p>About</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <a @click.prevent="closeSidebar()" class="nav-link">
                            <i class="nav-icon fas fa-times mr-2"></i>
                            <p>Close</p></a
                        >
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>
