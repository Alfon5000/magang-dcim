<script>
export default {
    name: "About",
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
            <div class="content bg-navy">
                <div class="row mb-3">
                    <div class="col-4 offset-1">
                        <h5>PT. Digital Otoma Solusi</h5>
                        <div class="row">
                            <div class="col-1">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="col-11">
                                <a
                                    href="https://goo.gl/maps/ddwuheWk9nHbBKKZ8?coh=178573&entry=tt"
                                    class="text-white"
                                    target="_blank"
                                    >Gedung The Energy, Office 8, Jl. Jenderal
                                    Sudirman No.8, RT.5/RW.3, Senayan, Kec. Kby.
                                    Baru, Kota Jakarta Selatan, Daerah Khusus
                                    Ibukota Jakarta 12190</a
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col-4 offset-2">
                        <h5>Contacts</h5>
                        <span
                            ><i class="fas fa-globe mr-3"></i
                            ><a
                                href="https://dgos.id/"
                                class="text-white"
                                target="_blank"
                                >dgos.id</a
                            ></span
                        >
                        <br />
                        <span
                            ><i class="fas fa-envelope mr-3"></i
                            ><a
                                href="mailto:info@dgos.id"
                                class="text-white"
                                target="_blank"
                                >info@dgos.id</a
                            ></span
                        >
                        <br />
                        <span
                            ><i class="fas fa-phone mr-3"></i
                            ><a
                                href="tel:+6281261849612"
                                class="text-white"
                                target="_blank"
                                >0812-6184-9612</a
                            ></span
                        >
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row justify-content-center">
                    Copyright &copy; 2023 DGOS. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</template>
