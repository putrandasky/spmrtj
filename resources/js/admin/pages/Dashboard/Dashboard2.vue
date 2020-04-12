<template>
    <div v-if="!isLoading">
        <h1 class="page-title">Dashboard</h1>
        <b-row>
            <b-col lg="6">
                <b-row>
                    <b-col lg="6" sm="6" xs="12">
                        <b-card class="mb-4 shadow" title="Valid Respondent">
                            <div
                                class="d-flex justify-content-between align-items-center "
                            >
                                <h2>{{ data.stats_respondent.valid }}</h2>
                                <i
                                    class="la la-arrow-right text-primary la-lg rotate-315"
                                />
                            </div>
                            <div
                                class="d-flex flex-wrap justify-content-between"
                            >
                                <div class="mt">
                                    <h6>{{ data.stats_respondent.total }}</h6>
                                    <p class="text-muted mb-0 mr">
                                        <small>Total</small>
                                    </p>
                                </div>
                                <div class="mt">
                                    <h6>{{ data.stats_respondent.target }}</h6>
                                    <p class="text-muted mb-0">
                                        <small>Target</small>
                                    </p>
                                </div>
                                <div class="mt">
                                    <h6>
                                        {{ data.stats_respondent.remaining }}
                                    </h6>
                                    <p class="text-muted mb-0 mr">
                                        <small>Remaining</small>
                                    </p>
                                </div>
                            </div>
                        </b-card>
                    </b-col>
                    <b-col lg="6" sm="6" xs="12">
                        <b-card class="mb-4 shadow " title="Gender">
                            <gender-pie
                                :height="180"
                                :chartData="data.gender"
                            />
                        </b-card>
                    </b-col>
                    <b-col lg="12" sm="12">
                        <b-card class="mb-4 shadow" title="Respondents Stats">
                            <b-card-body class="p-0">
                                <respondent-mix-overview
                                    :height="180"
                                    :chartDatasets="data.chart"
                                    :chartLabel="data.chart.date"
                                />
                            </b-card-body>
                        </b-card>
                    </b-col>
                </b-row>
            </b-col>

            <b-col lg="6">
                <b-row class=" h-100">
                    <b-col lg="12" md="6" sm="12">
                        <b-card class="mb-4 shadow ">
                            <h4 name="title">
                                Heatmap By
                                <span v-if="isHeatmap == 1">
                                    Origin
                                </span>
                                <span v-if="isHeatmap == 2">
                                    Feeder Origin
                                </span>
                                <span v-if="isHeatmap == 3">
                                    MRTJ Origin
                                </span>
                            </h4>
                            <b-card-body class="p-0 text-right">
                                <b-button-group class="mb-2">
                                    <b-button
                                        size="sm"
                                        :pressed="isHeatmap == 1"
                                        variant="outline-secondary"
                                        @click="handleHeatmapCard(1)"
                                        >Origin</b-button
                                    >
                                    <b-button
                                        size="sm"
                                        :pressed="isHeatmap == 2"
                                        variant="outline-secondary"
                                        @click="handleHeatmapCard(2)"
                                        >Feeder</b-button
                                    >
                                    <b-button
                                        size="sm"
                                        :pressed="isHeatmap == 3"
                                        variant="outline-secondary"
                                        @click="handleHeatmapCard(3)"
                                        >MRT</b-button
                                    >
                                </b-button-group>
                                <google-heat-map
                                    v-if="isHeatmap == 1"
                                    class="travel-map"
                                    :points="data.heatmap"
                                />
                                <google-heat-map
                                    v-if="isHeatmap == 2"
                                    class="travel-map"
                                    :points="data.heatmap_feeder"
                                />
                                <google-heat-map
                                    v-if="isHeatmap == 3"
                                    class="travel-map"
                                    :points="data.heatmap_mrt"
                                />
                            </b-card-body>
                        </b-card>
                    </b-col>
                </b-row>
            </b-col>

            <b-col lg="6" md="6" sm="12" class="mb-4">
                <b-card class="shadow h-100 ">
                    <h4 name="title">
                        Respondents By
                        <span v-if="isSocial == 1">
                            Age
                        </span>
                        <span v-if="isSocial == 2">
                            Job
                        </span>
                        <span v-if="isSocial == 3">
                            Education
                        </span>
                    </h4>
                    <b-card-body class="h-100 pt-0 text-right">
                        <b-button-group>
                            <b-button
                                size="sm"
                                :pressed="isSocial == 1"
                                variant="outline-secondary"
                                @click="handleSocialCard(1)"
                                >Age</b-button
                            >
                            <b-button
                                size="sm"
                                :pressed="isSocial == 2"
                                variant="outline-secondary"
                                @click="handleSocialCard(2)"
                                >Job</b-button
                            >
                            <b-button
                                size="sm"
                                :pressed="isSocial == 3"
                                variant="outline-secondary"
                                @click="handleSocialCard(3)"
                                >Education</b-button
                            >
                        </b-button-group>
                        <horizontal-bar
                            v-if="isSocial == 1"
                            :height="300"
                            :labelData="data.age.map(data => data.description)"
                            :data="data.age.map(data => data.respondents_count)"
                            label="Total Respondent"
                        />
                        <horizontal-bar
                            v-if="isSocial == 2"
                            :height="300"
                            :labelData="data.job.map(data => data.description)"
                            :data="data.job.map(data => data.respondents_count)"
                            label="Total Respondent"
                        />

                        <horizontal-bar
                            v-if="isSocial == 3"
                            :height="300"
                            :labelData="
                                data.education.map(data => data.description)
                            "
                            :data="
                                data.education.map(
                                    data => data.respondents_count
                                )
                            "
                            label="Total Respondent"
                        />
                    </b-card-body>
                </b-card>
            </b-col>

            <b-col lg="6" md="6" sm="12" class="mb-4">
                <b-card class="shadow h-100 ">
                    <h4 name="title">
                        Respondents By
                        <span v-if="isEconomics == 1">
                            Salary
                        </span>
                        <span v-if="isEconomics == 2">
                            Expense
                        </span>
                        <span v-if="isEconomics == 3">
                            Travel Cost
                        </span>
                    </h4>
                    <b-card-body class="h-100 pt-0 text-right">
                        <b-button-group>
                            <b-button
                                size="sm"
                                :pressed="isEconomics == 1"
                                variant="outline-secondary"
                                @click="handleEconomicsCard(1)"
                                >Salary</b-button
                            >
                            <b-button
                                size="sm"
                                :pressed="isEconomics == 2"
                                variant="outline-secondary"
                                @click="handleEconomicsCard(2)"
                                >Expense</b-button
                            >
                            <b-button
                                size="sm"
                                :pressed="isEconomics == 3"
                                variant="outline-secondary"
                                @click="handleEconomicsCard(3)"
                                >Travel Cost</b-button
                            >
                        </b-button-group>
                        <horizontal-bar
                            v-if="isEconomics == 1"
                            :height="300"
                            :labelData="
                                data.salary.map(data => data.description)
                            "
                            :data="
                                data.salary.map(data => data.respondents_count)
                            "
                            label="Total Respondent"
                        />
                        <horizontal-bar
                            v-if="isEconomics == 2"
                            :height="300"
                            :labelData="
                                data.expenses.map(data => data.description)
                            "
                            :data="
                                data.expenses.map(
                                    data => data.respondents_count
                                )
                            "
                            label="Total Respondent"
                        />

                        <horizontal-bar
                            v-if="isEconomics == 3"
                            :height="300"
                            :labelData="
                                data.travel_expense.map(
                                    data => data.description
                                )
                            "
                            :data="
                                data.travel_expense.map(
                                    data => data.respondents_count
                                )
                            "
                            label="Total Respondent"
                        />
                    </b-card-body>
                </b-card>
            </b-col>
            <b-col md="6" sm="12" class="mb-4">
                <b-card class="shadow h-100">
                    <h4 name="title">
                        Respondents By
                        <span v-if="isTravel == 1">
                            Purpose
                        </span>
                        <span v-if="isTravel == 2">
                            Vehicle Availability
                        </span>
                        <span v-if="isTravel == 3">
                            Parking Type
                        </span>
                    </h4>
                    <b-card-body class="h-100 pt-0 text-right">
                        <b-button-group>
                            <b-button
                                size="sm"
                                :pressed="isTravel == 1"
                                variant="outline-secondary"
                                @click="handleTravelCard(1)"
                                >Purpose</b-button
                            >
                            <b-button
                                size="sm"
                                :pressed="isTravel == 2"
                                variant="outline-secondary"
                                @click="handleTravelCard(2)"
                                >Vehicle</b-button
                            >
                            <b-button
                                size="sm"
                                :pressed="isTravel == 3"
                                variant="outline-secondary"
                                @click="handleTravelCard(3)"
                                >Parking</b-button
                            >
                        </b-button-group>
                        <horizontal-bar
                            v-if="isTravel == 1"
                            :height="300"
                            bgColor="#24478c"
                            borderColor="#24478c"
                            :labelData="
                                data.purpose.map(data => data.description)
                            "
                            :data="
                                data.purpose.map(data => data.respondents_count)
                            "
                            label="Total Respondent"
                        />
                        <vertical-bar
                            v-if="isTravel == 2"
                            :height="300"
                            bgColor="#24478c"
                            borderColor="#24478c"
                            :labelData="
                                data.vehicle.map(data => data.description)
                            "
                            :data="
                                data.vehicle.map(data => data.respondents_count)
                            "
                            label="Total Respondent"
                        />
                        <horizontal-bar
                            v-if="isTravel == 3"
                            :height="300"
                            :labelData="
                                data.parking_type.map(data => data.description)
                            "
                            :data="
                                data.parking_type.map(
                                    data => data.respondents_count
                                )
                            "
                            label="Total Respondent"
                        />
                    </b-card-body>
                </b-card>
            </b-col>
            <b-col lg="3" md="6" sm="12" class="mb-4">
                <b-card title="Survey Preference" class="shadow">
                    <b-card-body class="p-0">
                        <div flush class="list-group-small">
                            <div
                                v-for="(v, i) in data.sp_count"
                                :key="i"
                                class="d-flex px-3"
                            >
                                <span>{{ v.description }}</span>
                                <span class="ml-auto text-right ">
                                    {{ v.survey_preference_respondents_count }}
                                </span>
                            </div>
                        </div>
                    </b-card-body>
                </b-card>
            </b-col>
            <b-col lg="3" md="6" sm="12" class="mb-4">
                <b-card title="Park Ride Data" class="shadow">
                    <b-card-body class="p-0">
                        <div flush class="list-group-small">
                            <div
                                v-for="(v, i) in data.park_ride_count"
                                :key="i"
                                class="d-flex px-3"
                            >
                                <span>{{ v.description }}</span>
                                <span class="ml-auto text-right ">
                                    {{ v.park_ride_point_respondents_count }}
                                </span>
                            </div>
                        </div>
                    </b-card-body>
                </b-card>
            </b-col>
            <b-col lg="3" md="6" sm="12" class="mb-4">
                <b-card title="Willingness to Pay" class="shadow">
                    <b-card-body class="p-0">
                        <div flush class="list-group-small">
                            <div
                                v-for="(v, i) in data.mrt_cost"
                                :key="i"
                                class="d-flex px-3"
                            >
                                <span>{{ v.mrt_cost }}</span>
                                <span class="ml-auto text-right ">
                                    {{ v.total }}
                                </span>
                            </div>
                        </div>
                    </b-card-body>
                </b-card>
            </b-col>

            <b-col lg="3" md="6" sm="12" class="mb-4">
                <b-card title="Transportation Mode" class="shadow">
                    <b-card-body class="p-0">
                        <div flush class="list-group-small">
                            <div
                                v-for="(v, i) in data.transportation_mode"
                                :key="i"
                                class="d-flex px-3"
                            >
                                <span>{{
                                    v.transportation_mode.description
                                }}</span>
                                <span class="ml-auto text-right ">
                                    {{ v.total }}
                                </span>
                            </div>
                        </div>
                    </b-card-body>
                </b-card>
            </b-col>
        </b-row>
    </div>
</template>
<script>
import GenderPie from "@/admin/components/chart/GenderPie.vue";
import HorizontalBar from "@/admin/components/chart/HorizontalBar.vue";
import VerticalBar from "@/admin/components/chart/VerticalBar.vue";
import RespondentMixOverview from "@/admin/components/chart/RespondentMixOverview.vue";
import GoogleHeatMap from "@/admin/components/google/HeatMap.vue";

export default {
    name: "Dashboard2",
    components: {
        GenderPie,
        RespondentMixOverview,
        HorizontalBar,
        GoogleHeatMap,
        VerticalBar
    },
    data: function() {
        return {
            isLoading: true,
            data: {},
            isEconomics: 1,
            isSocial: 1,
            isTravel: 1,
            isHeatmap: 1
        };
    },
    created() {
        this.getData();
    },
    methods: {
        handleHeatmapCard(i) {
            if (i == this.isHeatmap) {
                return;
            }
            this.isHeatmap = 0;
            setTimeout(() => {
                this.isHeatmap = i;
            }, 1);
        },
        handleEconomicsCard(i) {
            if (i == this.isEconomics) {
                return;
            }
            this.isEconomics = 0;
            setTimeout(() => {
                this.isEconomics = i;
            }, 1);
        },
        handleSocialCard(i) {
            if (i == this.isSocial) {
                return;
            }
            this.isSocial = 0;
            setTimeout(() => {
                this.isSocial = i;
            }, 1);
        },
        handleTravelCard(i) {
            if (i == this.isTravel) {
                return;
            }
            this.isTravel = 0;
            setTimeout(() => {
                this.isTravel = i;
            }, 1);
        },
        getData() {
            axios
                .get(`/dashboard`)
                .then(response => {
                    this.data = response.data;
                    this.isLoading = false;
                    console.log(this.data.gender);

                    // for (let index = 0; index < this.data.destination.length; index++) {
                    //   element[index] = this.data.destination[index].destination_lat+','+ this.data.destination[index].destination_long ;

                    // }
                    // console.log(element);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        mutateKey(data) {
            let mutateData = data.map(function(item) {
                return {
                    lat: item.origin_lat,
                    lng: item.origin_lng
                };
            });
            return mutateData;
        }
    }
};
</script>
<style>
.travel-map {
    height: 300px;
}
</style>
