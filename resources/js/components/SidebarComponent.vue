<script>
import { RouterLink } from "vue-router";

export default {
    name: "SidebarComponent",
};
</script>

<template>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-3 bg-navy">
        <!-- Brand Logo -->
        <router-link :to="{ name: 'dashboard' }" class="brand-link">
            <img
                src="dist/img/AdminLTELogo.png"
                alt="AdminLTE Logo"
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
                        >
                            <i class="nav-icon fas fa-tachometer-alt mr-2"></i>
                            <p>Dashboard</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'visitors.index' }"
                            class="nav-link"
                        >
                            <i class="nav-icon fas fa-users mr-2"></i>
                            <p>Visitors</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'users.index' }"
                            class="nav-link"
                        >
                            <i class="nav-icon fas fa-user mr-2"></i>
                            <p>Users</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'reports' }" class="nav-link">
                            <i class="nav-icon fas fa-chart-bar mr-2"></i>
                            <p>Reports</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'cctv' }" class="nav-link">
                            <i class="nav-icon fas fa-video mr-2"></i>
                            <p>CCTV</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'about' }" class="nav-link">
                            <i class="nav-icon fas fa-info-circle mr-2"></i>
                            <p>About</p>
                        </router-link>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>
