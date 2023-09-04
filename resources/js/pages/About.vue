<script>
export default {
    name: "About",
    methods: {
        getCurrentYear() {
            const date = new Date();
            const year = date.getFullYear();
            return year;
        },
    },
    beforeMount() {
        if (!localStorage.getItem("isAuth")) {
            this.$router.push({ name: "login" });
        }
    },
};
</script>

<template>
    <div class="wrapper">
        <Header />
        <Sidebar />
        <div class="content-wrapper px-3">
            <div class="content-header">
                <h2>About</h2>
            </div>
            <div class="content w-75 mx-auto font-weight-bold">
                <div class="mt-3 text-center text-navy">
                    <h3>PT Digital Otoma Solusi</h3>
                    <img
                        src="https://dgos.id/assets/img/brand/dark.svg"
                        alt="brand-logo"
                        width="150"
                    />
                </div>
                <hr class="bg-navy" />
                <div class="mt-3">
                    <h5>About Company</h5>
                    <div>
                        <i class="fas fa-info mr-3"></i>
                        <span class="text-navy">
                            DGOS attempts to bring the best automation
                            experience to users and manufacturers by offering
                            the tools needed for having a quick and solid start
                            in most projects.
                        </span>
                    </div>
                </div>
                <hr class="bg-navy" />
                <div class="mt-3">
                    <h5>Location</h5>
                    <div>
                        <i class="fas fa-map-marker-alt mr-3"></i>
                        <a
                            href="https://goo.gl/maps/ddwuheWk9nHbBKKZ8?coh=178573&entry=tt"
                            class="text-navy"
                            target="_blank"
                        >
                            Gedung The Energy, Office 8, Jl. Jenderal Sudirman
                            No.8, RT.5/RW.3, Senayan, Kec. Kby. Baru, Kota
                            Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12190
                        </a>
                    </div>
                </div>
                <hr class="bg-navy" />
                <div class="mt-3">
                    <h5>Website</h5>
                    <div>
                        <i class="fas fa-globe mr-3"></i
                        ><a
                            href="https://dgos.id/"
                            class="text-navy"
                            target="_blank"
                            >dgos.id</a
                        >
                    </div>
                </div>
                <hr class="bg-navy" />
                <div class="mt-3">
                    <h5>Email</h5>
                    <div>
                        <i class="fas fa-envelope mr-3"></i
                        ><a
                            href="mailto:info@dgos.id"
                            class="text-navy"
                            target="_blank"
                            >info@dgos.id</a
                        >
                    </div>
                </div>
                <hr class="bg-navy" />
                <div class="mt-3">
                    <h5>Phone</h5>
                    <div>
                        <i class="fas fa-phone mr-3"></i
                        ><a
                            href="tel:+6281261849612"
                            class="text-navy"
                            target="_blank"
                            >0812-6184-9612</a
                        >
                    </div>
                </div>
                <hr class="bg-navy" />
                <div class="my-3 text-center">
                    Copyright &copy; {{ getCurrentYear() }} DGOS. All rights
                    reserved.
                </div>
            </div>
        </div>
    </div>
</template>
