<template>
        <b-row no-gutters >
            <b-img
                fluid
                :src="selectedData.img"
                class="rounded-0 mb-3"
            ></b-img>
            <p class="text-primary">
                {{selectedData.content}}
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
                        content:"Kebijakan tarif parkir di DKI Jakarta saat ini sebesar Rp 2000 per jam. Jika Anda menggunakan fasilitas parkir rata -rata 8 jam sehari untuk beraktivitas maka tarif yang Anda bayar untuk kebutuhan parkir sekitar Rp 16.000 per hari."
                    },
                    {
                        title:"Kebijakan Layanan Parkir Motor",
                        img:"./img/sp-car-park-2.jpg",
                        content:"Kebijakan tarif parkir di DKI Jakarta saat ini sebesar Rp 2000 per jam. Jika Anda menggunakan fasilitas parkir rata -rata 8 jam sehari untuk beraktivitas maka tarif yang Anda bayar untuk kebutuhan parkir sekitar Rp 16.000 per hari."
                    },
                    {
                        title:"Kebijakan Layanan Jalur Sepeda",
                        img:"./img/sp-cycle.png",
                        content:"Pemprov DKI Jakarta saat ini sedang melakukan peningkatan jalur sepeda di berbagai wilayah di DKI Jakarta.  Peningkatan fasilitas pejalan kaki dilakukan dengan melakukan revitalisasi jalur sepeda serta pembangunan fasilitas – fasilitas terkait peningkatan kenyamanan pesepeda."
                    },
                    {
                        title:"Kebijakan Layanan Jalur Pejalan Kaki",
                        img:"./img/sp-pedestrian.png",
                        content:"Pemprov DKI Jakarta saat ini sedang melakukan peningkatan fasilitas pejalan kaki di berbagai wilayah di DKI Jakarta.  Peningkatan fasilitas pejalan kaki dilakukan dengan melakukan revitalisasi trotoar serta pembangunan fasilitas – fasilitas terkait peningkatan kenyamanan pejalan kaki."
                    },
                    {
                        title:"Kebijakan Layanan Feeder Reguler",
                        img:"./img/Preferensi-Feeder-Reguler.png",
                        content:"MRT Jakarta saat ini sedang mempersiapkan layanan feeder / pengumpan yang bisa dimanfaatkan baik oleh pengguna MRT maupun pengguna moda lainnya. Layanan feeder ini akan memiliki armada dan layanan seperti layanan Transjakarta. Layanan feeder akan beroperasi dari satu jam sebelum perjalanan MRT pertama di pagi hari hingga satu jam setelah perjalanan MRT terakhir di malam hari."
                    },
                    {
                        title:"Kebijakan Layanan Feeder Premium",
                        img:"./img/Preferensi-Feeder-Premium.png",
                        content:"Selain layanan pengumpan reguler, MRT Jakarta juga bersiap untuk menyiapkan layanan pengumpan premium seperti layanan Royal Trans. Perbedaan layanan Royal Trans dengan layanan reguler meliputi beberapa hal seperti berikut : Kepastian tempat duduk, Tersedia tempat duduk yang nyaman untuk seluruh penumpang, Tidak berhenti di seluruh halte, Hanya berhenti di titik tertentu dengan layanan ekspres menuju Stasiun MRT, Memiliki waktu tempuh lebih singkat, Terdapat fasilitas WIFI"
                    },
                    {
                        title:"Kebijakan Layanan Feeder & Parkir",
                        img:"./img/sp-car-park-2.jpg",
                        content:""
                    },
                    {
                        title:"Preferensi Layanan Park & Ride",
                        img:"./img/sp-park-ride.jpg",
                        content:"MRT Jakarta saat ini sedang mempersiapkan pengembangan kawasan Park & Ride di sekitar wilayah Jabodetabek. Lokasi park & ride akan memberikan fasilitas parkir untuk kendaraan pribadi Anda dan layanan untuk Anda melanjutkan perjalanan. "
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
