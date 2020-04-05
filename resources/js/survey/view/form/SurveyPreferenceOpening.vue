<template>
        <b-row no-gutters class="text-justify">
            <b-col cols="12">
            <b-img
                fluid
                :src="selectedData.img"
                class="rounded-0 mb-3"
            ></b-img>
            </b-col>

            <p class="text-primary" v-html="selectedData.content">
            </p>
            <b-button block variant="success" @click="handleClick">
                Lanjut
            </b-button>
        </b-row>

</template>
<script>
    export default {
        name: 'SurveyPreferenceOpening',
            props: ['title'],
        data: function () {
            return {
                selectedData:{
                    title:"",
                    img:"",
                    content:""
                },
                data:[
                    {
                        title:"Kebijakan Layanan Parkir Mobil",
                        img:"./img/sp-car-park-2.jpg",
                        content:"Saat ini Pemprov DKI sedang mempersiapkan kebijakan baru terkait dengan tarif parkir di kawasan DKI Jakarta. Kebijakan tarif parkir ini bertujuan untuk salah satunya adalah mengurangi penggunaan kendaraan pribadi di kawasan DKI Jakarta.</br>Kebijakan tarif parkir di DKI Jakarta saat ini sebesar Rp 4000 per jam. Jika Anda menggunakan fasilitas parkir rata-rata 8 jam sehari untuk beraktivitas maka tarif yang Anda bayar untuk kebutuhan parkir sekitar Rp 32.000 per hari."
                    },
                    {
                        title:"Kebijakan Layanan Parkir Motor",
                        img:"./img/sp-car-park-2.jpg",
                        content:"Saat ini Pemprov DKI sedang mempersiapkan kebijakan baru terkait dengan tarif parkir di kawasan DKI Jakarta. Kebijakan tarif parkir ini bertujuan untuk salah satunya adalah mengurangi penggunaan kendaraan pribadi di kawasan DKI Jakarta. </br>Kebijakan tarif parkir di DKI Jakarta saat ini sebesar Rp 2000 per jam. Jika Anda menggunakan fasilitas parkir rata-rata 8 jam sehari untuk beraktivitas maka tarif yang Anda bayar untuk kebutuhan parkir sekitar Rp 16.000 per hari."
                    },
                    {
                        title:"Kebijakan Layanan Jalur Sepeda",
                        img:"./img/sp-cycle.jpg",
                        content:"Pemprov DKI Jakarta saat ini sedang melakukan peningkatan jalur sepeda di berbagai wilayah di DKI Jakarta.  Peningkatan fasilitas pejalan kaki dilakukan dengan melakukan revitalisasi jalur sepeda serta pembangunan fasilitas – fasilitas terkait peningkatan kenyamanan pesepeda."
                    },
                    {
                        title:"Kebijakan Layanan Jalur Pejalan Kaki",
                        img:"./img/sp-pedestrian.jpg",
                        content:"Pemprov DKI Jakarta saat ini sedang melakukan peningkatan fasilitas pejalan kaki di berbagai wilayah di DKI Jakarta.  Peningkatan fasilitas pejalan kaki dilakukan dengan melakukan revitalisasi trotoar serta pembangunan fasilitas – fasilitas terkait peningkatan kenyamanan pejalan kaki."
                    },
                    {
                        title:"Kebijakan Layanan Feeder Reguler",
                        img:"./img/sp-feeder-reguler.jpg",
                        content:"Salah satu cara untuk meningkatkan pelayanan MRT adalah dengan memberikan fasilitas layanan  feeder yang dapat dimanfaatkan baik oleh pengguna MRT maupun pengguna moda lainnya. Layanan feeder ini sebaiknya memiliki armada dan tingkat layanan seperti Tranjakarta. Layanan feeder akan beroperasi dari satu jam sebelum perjalanan MRT pertama di pagi hari hingga satu jam setelah perjalanan MRT terakhir di malam hari."
                    },
                    {
                        title:"Kebijakan Layanan Feeder Premium",
                        img:"./img/Preferensi-Feeder-Premium.jpg",
                        content:"Selain rencana kebijakan layanan pengumpan reguler, dapat juga disiapkan layanan pengumpan premium seperti layanan Royal Trans / DAMRI. Perbedaan layanan premium seperti Royal Trans dengan layanan reguler meliputi beberapa hal seperti berikut:<ul><li>Kepastian tempat duduk </li><li>Tempat duduk yang lebih nyaman </li><li>Layanan ekspres menuju Stasiun MRT</li><li>Memiliki waktu tempuh lebih singkat </li><li>Terdapat fasilitas Internet WiFi </li></ul>"
                    },
                    {
                        title:"Kebijakan Layanan Feeder & Parkir",
                        img:"./img/sp-car-park-2.jpg",
                        content:""
                    },
                    {
                        title:"Preferensi Layanan Park & Ride",
                        img:"./img/sp-park-ride.jpg",
                        content:"Salah satu cara Untuk meningkatkan pelayanan terhadap pengguna adalah dengan menyiapkan lahan parkir bagi kendaraan pribadi yang ingin transit dan menggunakan layanan MRT atau yang biasa kita sebut sebagai park & ride. Lokasi park & ride akan memberikan fasilitas parkir untuk kendaraan pribadi Anda dan layanan untuk Anda melanjutkan perjalanan. "
                    },
                    {
                        title:"Preferensi Layanan Park & Ride Pengguna Mobil Pribadi",
                        img:"./img/sp-car-park-2.jpg",
                        content:""
                    },
                    {
                        title:"Preferensi Layanan Park & Ride Pengguna Motor Pribadi",
                        img:"./img/sp-car-park-2.jpg",
                        content:""
                    },
                    {
                        title:"Preferensi Layanan Park & Ride Pengguna Mobil Pribadi Hypotethical",
                        img:"./img/sp-car-park-2.jpg",
                        content:""
                    },
                    {
                        title:"Preferensi Layanan Park & Ride Pengguna Motor Pribadi Hypotethical",
                        img:"./img/sp-car-park-2.jpg",
                        content:""
                    },
                    {
                        title:"",
                        img:"./img/sp-car-park-2.jpg",
                        content:""
                    },
                ]
            }
        },
        mounted(){
            this.selectedData = this.data[this.data.findIndex(a=>a.title == this.title)]
        },
        methods:{
            handleClick(){
                this.$emit('onClick',false)
            }
        },
    }
</script>
<style>
</style>
