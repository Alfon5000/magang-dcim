<script>
import api from "../api";
import PushNotification from "./Header/PushNotification.vue";

export default {
    name: "Header",
    components: {
        PushNotification,
    },
    methods: {
        async logout() {
            await api
                .get("/api/logout", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                })
                .then(() => {
                    localStorage.removeItem("isAuth");
                    localStorage.removeItem("token");
                    this.$router.push({ name: "login" });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<template>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a
                    class="nav-link"
                    data-widget="pushmenu"
                    href="#"
                    role="button"
                    ><i class="fas fa-bars"></i
                ></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <PushNotification />

            <!-- Messages Dropdown Menu -->
            <!-- <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comment"></i>
                    <span class="badge badge-warning navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <div class="media">
                            <img
                                src="dist/img/user1-128x128.jpg"
                                alt="User Avatar"
                                class="img-size-50 mr-3 img-circle"
                            />
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span
                                        class="float-right text-sm text-danger"
                                        ><i class="fas fa-star"></i
                                    ></span>
                                </h3>
                                <p class="text-sm">
                                    Call me whenever you can...
                                </p>
                                <p class="text-sm text-muted">
                                    <i class="far fa-clock mr-1"></i> 4 Hours
                                    Ago
                                </p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <div class="media">
                            <img
                                src="dist/img/user8-128x128.jpg"
                                alt="User Avatar"
                                class="img-size-50 img-circle mr-3"
                            />
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted"
                                        ><i class="fas fa-star"></i
                                    ></span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted">
                                    <i class="far fa-clock mr-1"></i> 4 Hours
                                    Ago
                                </p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <div class="media">
                            <img
                                src="dist/img/user3-128x128.jpg"
                                alt="User Avatar"
                                class="img-size-50 img-circle mr-3"
                            />
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span
                                        class="float-right text-sm text-warning"
                                        ><i class="fas fa-star"></i
                                    ></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted">
                                    <i class="far fa-clock mr-1"></i> 4 Hours
                                    Ago
                                </p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <router-link
                        :to="{ name: 'messages' }"
                        class="dropdown-item dropdown-footer"
                        >See All Messages</router-link
                    >
                </div>
            </li> -->

            <!-- User Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-user-cog"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                    <router-link
                        :to="{ name: 'profile' }"
                        class="dropdown-item"
                    >
                        <i class="fas fa-user mr-2"></i> Profile
                    </router-link>
                    <div class="dropdown-divider"></div>
                    <button @click.prevent="logout()" class="dropdown-item">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Log Out
                    </button>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
</template>
