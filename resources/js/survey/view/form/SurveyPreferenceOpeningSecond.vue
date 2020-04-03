<template>
    <b-row no-gutters class="text-justify">
        <b-col cols="12">
            <b-card no-body class="overflow-hidden mb-3">
                <iframe
                    class="travel-map-mymap p-0"
                    :src="selectedData.src"
                    style="position:relative; top:-55px; border:none;margin-bottom:-60px"
                ></iframe>
            </b-card>
        </b-col>
        <p class="text-primary" v-html="selectedData.content"></p>
        <b-button block variant="success" @click="handleClick">
            Lanjut
        </b-button>
    </b-row>
</template>
<script>
export default {
    name: "SurveyPreferenceOpeningSecond",
    props: ["title"],
    data: function() {
        return {
            selectedData: {
                title: "",
                src: "",
                content: ""
            },
            data: [
                {
                    title: "Kebijakan Layanan Parkir Mobil",
                    src:
                        "https://www.google.com/maps/d/embed?mid=1htfGOJfkOLbEf-lGl5fMDCPWA0j1krpW&ll=-6.185622133940079%2C106.82362947503714&z=11",
                    content:
                        "Kawasan yang akan dikenakan rencana kebijakan tarif parkir tinggi adalah kawasan pusat aktivitas di daerah jakarta pusat, tepatnya di sekitar kawasan jalan Sudirman – Thamrin. Kawasan tersebut memiliki aksesibilitas yang tinggi dengan tersedianya banyak angkutan umum sehingga dapat memberikan pilihan bagi pengguna kendaraan pribadi untuk berpindah moda, salah satunya adalah MRT Jakarta.</br>Tujuan perjalanan Anda berada dalam kawasan rencana kebijakan tarif parkir tinggi."
                },
                {
                    title: "Kebijakan Layanan Parkir Motor",
                    src:
                        "https://www.google.com/maps/d/embed?mid=1htfGOJfkOLbEf-lGl5fMDCPWA0j1krpW&ll=-6.185622133940079%2C106.82362947503714&z=11",
                    content:
                        "Kawasan yang akan dikenakan rencana kebijakan tarif parkir tinggi adalah kawasan pusat aktivitas di daerah jakarta pusat, tepatnya di sekitar kawasan jalan Sudirman – Thamrin. Kawasan tersebut memiliki aksesibilitas yang tinggi dengan tersedianya banyak angkutan umum sehingga dapat memberikan pilihan bagi pengguna kendaraan pribadi untuk berpindah moda, salah satunya adalah MRT Jakarta.</br>Tujuan perjalanan Anda berada dalam kawasan rencana kebijakan tarif parkir tinggi."
                },
                {
                    title: "Kebijakan Layanan Jalur Sepeda",
                    src: "./img/sp-cycle.jpg",
                    content:
                        "Pemprov DKI Jakarta saat ini sedang melakukan peningkatan jalur sepeda di berbagai wilayah di DKI Jakarta.  Peningkatan fasilitas pejalan kaki dilakukan dengan melakukan revitalisasi jalur sepeda serta pembangunan fasilitas – fasilitas terkait peningkatan kenyamanan pesepeda."
                },
                {
                    title: "Kebijakan Layanan Jalur Pejalan Kaki",
                    src: "./img/sp-pedestrian.jpg",
                    content:
                        "Pemprov DKI Jakarta saat ini sedang melakukan peningkatan fasilitas pejalan kaki di berbagai wilayah di DKI Jakarta.  Peningkatan fasilitas pejalan kaki dilakukan dengan melakukan revitalisasi trotoar serta pembangunan fasilitas – fasilitas terkait peningkatan kenyamanan pejalan kaki."
                },
                {
                    title: "Kebijakan Layanan Feeder Reguler",
                    src:
                        "https://www.google.com/maps/d/embed?mid=1cQ1L4eAZwhJCMXErmT1nWNAjF3uttyPN&ll=-6.310937432662428%2C106.7594426311523&z=11",
                    content:
                        "Bedasarkan pergerakan perjalanan orang saat ini, berikut terlampir potensi rencana layanan pengumpan menuju stasiun MRT. Layanan pengumpan ini akan memiliki pemberhentian terbatas dan memiliki jalur khusus sehingga memiliki waktu tempuh yang lebih singkat.</br>"
                },
                {
                    title: "Kebijakan Layanan Feeder Premium",
                    src: "./img/Preferensi-Feeder-Premium.jpg",
                    content:
                        "Selain layanan pengumpan reguler, MRT Jakarta juga bersiap untuk menyiapkan layanan pengumpan premium seperti layanan Royal Trans. Perbedaan layanan Royal Trans dengan layanan reguler meliputi beberapa hal seperti berikut : Kepastian tempat duduk, Tersedia tempat duduk yang nyaman untuk seluruh penumpang, Tidak berhenti di seluruh halte, Hanya berhenti di titik tertentu dengan layanan ekspres menuju Stasiun MRT, Memiliki waktu tempuh lebih singkat, Terdapat fasilitas WIFI"
                },
                {
                    title: "Kebijakan Layanan Feeder & Parkir",
                    src: "./img/sp-car-park-2.jpg",
                    content: ""
                },
                {
                    title: "Preferensi Layanan Park & Ride",
                    src:
                        "https://www.google.com/maps/d/embed?mid=1nJJl7Ku_aG-S0qojmepmG_PkqO7klaEN&ll=-6.312834673189734%2C106.78349533416349&z=11",
                    content:
                        "Bedasarkan hasil kondisi perjalanan saat ini, diperoleh beberapa titik potensi lokasi park & ride. Pada titik potensi tersebut nantinya akan tersedia lahan parkir baik untuk pengguna mobil maupun motor. Untuk lokasi yang dekat dengan stasiun, pengguna dapat berjalan kaki menuju stasiun  untuk menggunakan layanan MRT sedangkan untuk lokasi yang tidak berdekatan degnan statiun akan disediakan shuttle yang langsung menuju stasiun MRT."
                },
                {
                    title:
                        "Preferensi Layanan Park & Ride Pengguna Mobil Pribadi",
                    src: "./img/sp-car-park-2.jpg",
                    content: ""
                },
                {
                    title:
                        "Preferensi Layanan Park & Ride Pengguna Motor Pribadi",
                    src: "./img/sp-car-park-2.jpg",
                    content: ""
                },
                {
                    title:
                        "Preferensi Layanan Park & Ride Pengguna Mobil Pribadi Hypotethical",
                    src: "./img/sp-car-park-2.jpg",
                    content: ""
                },
                {
                    title:
                        "Preferensi Layanan Park & Ride Pengguna Motor Pribadi Hypotethical",
                    src: "./img/sp-car-park-2.jpg",
                    content: ""
                },
                {
                    title: "",
                    src: "./img/sp-car-park-2.jpg",
                    content: ""
                }
            ]
        };
    },
    mounted() {
        this.selectedData = this.data[
            this.data.findIndex(a => a.title == this.title)
        ];
    },
    methods: {
        handleClick() {
            this.$emit("onClick", false);
        }
    }
};
</script>
<style></style>
