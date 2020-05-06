<template>
  <div v-if="!isLoading">
    <h1 class="page-title">Dashboard</h1>
    <b-row>
      <b-col lg="6">
        <b-row>
          <b-col lg="6" sm="6" xs="12">
            <b-card class="mb-4 shadow" title="Valid Respondent">
              <div class="d-flex justify-content-between align-items-center">
                <h2>{{ data.stats_respondent.valid }}</h2>
                <i class="la la-arrow-right text-primary la-lg rotate-315" />
              </div>
              <div class="d-flex flex-wrap justify-content-between">
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
                  <h6>{{ data.stats_respondent.remaining }}</h6>
                  <p class="text-muted mb-0 mr">
                    <small>Remaining</small>
                  </p>
                </div>
              </div>
            </b-card>
          </b-col>
          <b-col lg="6" sm="6" xs="12">
            <b-card class="mb-4 shadow" title="Gender">
              <gender-pie :height="180" :chartData="data.gender" />
            </b-card>
          </b-col>
          <b-col lg="12" sm="12">
            <b-card class="mb-4 shadow" title="Respondents Stats">
              <b-card-body class="p-0">
                <respondent-mix-overview :height="180" :chartDatasets="data.chart" :chartLabel="data.chart.date" />
              </b-card-body>
            </b-card>
          </b-col>
        </b-row>
      </b-col>

      <b-col lg="6">
        <b-row class="h-100">
          <b-col cols="12" >
            <b-card class="mb-4 shadow">
              <h4 name="title">
                Heatmap By
                <span v-for="(v,i) in heatmap" :key="i" v-show="isHeatmap == v.id">{{v.title}}</span>

              </h4>
              <b-card-body class="p-0 text-right">
                <b-button-group class="mb-2">
                  <b-button v-for="(v,i) in heatmap" :key="i" size="sm" :pressed="isHeatmap == v.id"
                    variant="outline-secondary" @click="handleHeatmapCard(v.id)">{{v.title}}</b-button>
                </b-button-group>
                <google-heat-map v-if="isHeatmap == 1" class="travel-map" :points="data.heatmap.origin" />
                <google-heat-map v-if="isHeatmap == 2" class="travel-map" :points="data.heatmap.destination" />
                <google-heat-map v-if="isHeatmap == 3" class="travel-map" :points="data.heatmap_feeder.origin" />
                <google-heat-map v-if="isHeatmap == 4" class="travel-map" :points="data.heatmap_mrt.origin" />
              </b-card-body>
            </b-card>
          </b-col>
        </b-row>
      </b-col>

      <b-col lg="6" md="6" sm="12" class="mb-4">
        <b-card class="shadow h-100">
          <h4 name="title">
            Respondents By
            <span v-for="(v,i) in social" :key="i" v-show="isSocial == v.id">{{v.title}}</span>

          </h4>
          <b-card-body class="h-100 pt-0 text-right">
            <b-button-group>
              <b-button v-for="(v,i) in social" :key="i" size="sm" :pressed="isSocial == v.id"
                variant="outline-secondary" @click="handleSocialCard(v.id)">{{v.title}}</b-button>
            </b-button-group>
            <horizontal-bar v-if="isSocial == 1" :height="300" :labelData="data.age.map(data => data.description)"
              :data="data.age.map(data => data.respondents_count)" label="Total Respondent" />
            <horizontal-bar v-if="isSocial == 2" :height="300" :labelData="data.job.map(data => data.description)"
              :data="data.job.map(data => data.respondents_count)" label="Total Respondent" />
            <horizontal-bar v-if="isSocial == 3" :height="300"
              :labelData=" data.education.map(data => data.description) "
              :data="data.education.map( data => data.respondents_count ) " label="Total Respondent" />
          </b-card-body>
        </b-card>
      </b-col>

      <b-col lg="6" md="6" sm="12" class="mb-4">
        <b-card class="shadow h-100">
          <h4 name="title">
            Respondents By
            <span v-for="(v,i) in economics" :key="i" v-show="isEconomics == v.id">{{v.title}}</span>
          </h4>
          <b-card-body class="h-100 pt-0 text-right">
            <b-button-group>
              <b-button v-for="(v,i) in economics" :key="i" size="sm" :pressed="isEconomics == v.id"
                variant="outline-secondary" @click="handleEconomicsCard(v.id)">{{v.title}}</b-button>
            </b-button-group>
            <horizontal-bar v-if="isEconomics == 1" :height="300" :labelData="data.salary.map(data => data.description)"
              :data="data.salary.map(data => data.respondents_count)" label="Total Respondent" />
            <horizontal-bar v-if="isEconomics == 2" :height="300"
              :labelData="data.expenses.map(data => data.description)"
              :data="data.expenses.map(data => data.respondents_count)" label="Total Respondent" />

            <horizontal-bar v-if="isEconomics == 3" :height="300"
              :labelData="data.travel_expense.map(data => data.description  )"
              :data="data.travel_expense.map( data => data.respondents_count)" label="Total Respondent" />
          </b-card-body>
        </b-card>
      </b-col>
      <b-col md="6" sm="12" class="mb-4">
        <b-card class="shadow h-100">
          <h4 name="title">
            Respondents By
            <span v-for="(v,i) in travel" :key="i" v-show="isTravel == v.id">{{v.title}}</span>

          </h4>
          <b-card-body class="h-100 pt-0 text-right">
                <b-button-group class="w-100 overflow-auto">
              <b-button v-for="(v,i) in travel" :key="i" size="sm" :pressed="isTravel == v.id"
                variant="outline-secondary" @click="handleTravelCard(v.id)">{{v.btnName}}</b-button>
            </b-button-group>
            <horizontal-bar v-if="isTravel == 1" :height="300" bgcolor="#24478c" bordercolor="#24478c"
              :labelData="data.purpose.map(data => data.description) "
              :data=" data.purpose.map(data => data.respondents_count) " label="Total Respondent" />
            <vertical-bar v-if="isTravel == 2" :height="300" bgcolor="#24478c" bordercolor="#24478c"
              :labelData="data.vehicle.map(data => data.description)    "
              :data=" data.vehicle.map(data => data.respondents_count) " label="Total Respondent" />
            <horizontal-bar v-if="isTravel == 3" :height="300"
              :labelData=" data.parking_type.map(data => data.description) "
              :data="data.parking_type.map(data => data.respondents_count   ) " label="Total Respondent" />
            <multi-bar v-if="isTravel == 4" :height="300" :chartLabel=" data.parking_guarantor.label.guarantor "
              :chartDatasets="data.parking_guarantor.data_set " label="Total Respondent" />
            <multi-bar v-if="isTravel == 5" :height="300" :chartLabel=" data.travel_guarantor.label.guarantor "
              :chartDatasets="data.travel_guarantor.data_set " label="Total Respondent" />
            <multi-bar v-if="isTravel == 6" :height="300" :chartLabel=" data.is_pay_park.label.respond "
              :chartDatasets="data.is_pay_park.data_set " label="Total Respondent" />
            <vertical-bar v-if="isTravel == 7" :height="300"
              :labelData=" data.respondent_by_travel_model.data_set.map(data => data.label) "
              :data=" data.respondent_by_travel_model.data_set.map(data => data.chartData)  "
              label="Total Respondent" />
          </b-card-body>
        </b-card>
      </b-col>
      <b-col lg="6" md="6" sm="12" class="mb-4">
        <b-card class="shadow h-100">
          <h4 name="title">
            Willingness to Pay By
            <span v-for="(v,i) in wtp" :key="i" v-show="isWtp == v.id">{{v.title}}</span>
          </h4>
          <b-card-body class="h-100 pt-0 text-right">
            <b-button-group>
              <b-button v-for="(v,i) in wtp" :key="i" size="sm" :pressed="isWtp == v.id" variant="outline-secondary"
                @click="handleWtpCard(v.id)">{{v.title}}</b-button>
            </b-button-group>
            <multi-bar v-if="isWtp == 1" xLabel="Top 10 Willingness to Pay" yLabel="Respondent" :height="300" :chartLabel=" data.wtp_by_mode.label.cost "
              :chartDatasets="data.wtp_by_mode.data_set " label="Total Respondent" />
            <multi-bar v-if="isWtp == 2" xLabel="Top 10 Willingness to Pay" yLabel="Respondent"  :height="300" :chartLabel=" data.wtp_by_income.label.cost "
              :chartDatasets="data.wtp_by_income.data_set " label="Total Respondent" />
            <multi-bar v-if="isWtp == 3" xLabel="Top 10 Willingness to Pay" yLabel="Respondent"  :height="300" :chartLabel=" data.wtp_by_duration.label.cost "
              :chartDatasets="data.wtp_by_duration.data_set " label="Total Respondent" />
            <multi-bar v-if="isWtp == 4" xLabel="Top 10 Willingness to Pay" yLabel="Respondent"  :height="300" :chartLabel=" data.wtp_by_distance.label.cost "
              :chartDatasets="data.wtp_by_distance.data_set " label="Total Respondent" />
          </b-card-body>
        </b-card>
      </b-col>
      <b-col  lg="6"  class="mb-4">
        <b-card class="shadow h-100">
          <h5 name="title">
            Summary SP Respond
            <span v-for="(v,i) in sp" :key="i" v-show="isSp == v.id">{{v.title}}</span>
          </h5>
          <b-card-body class="h-100 pt-0 text-right">
            <b-button-group class="w-100 mb-2 overflow-auto">
              <b-button v-for="(v,i) in sp.slice(0,6)" :key="i" size="sm" :pressed="isSp == v.id"
                variant="outline-secondary" @click="handleSpCard(v.id)">{{v.btnName}}
              </b-button>
            </b-button-group>
            <b-button-group class="w-100 mb-2 overflow-auto">
              <b-button v-for="(v,i) in sp.slice(6,10)" :key="i" size="sm" :pressed="isSp == v.id"
                variant="outline-secondary" @click="handleSpCard(v.id)">{{v.btnName}}
              </b-button>
            </b-button-group>
            <b-button-group class="w-100 mb-2 overflow-auto">
              <b-button v-for="(v,i) in sp.slice(10,13)" :key="i" size="sm" :pressed="isSp == v.id"
                variant="outline-secondary" @click="handleSpCard(v.id)">{{v.btnName}}
              </b-button>
            </b-button-group>
            <b-button-group class="w-100 overflow-auto">
              <b-button v-for="(v,i) in sp.slice(13,16)" :key="i" size="sm" :pressed="isSp == v.id"
                variant="outline-secondary" @click="handleSpCard(v.id)">{{v.btnName}}
              </b-button>
            </b-button-group>
            <multi-bar v-if="isSp == 1" :height="350" xLabel="Time Preference" yLabel="Respondent" :chartLabel="data.sp_car.label.time"
              :chartDatasets="data.sp_car.data_set" />
            <multi-bar v-if="isSp == 2" :height="350" xLabel="Time Preference" yLabel="Respondent" :chartLabel="data.sp_motor.label.time"
              :chartDatasets="data.sp_motor.data_set" />
            <multi-bar v-if="isSp == 3" :height="350" xLabel="Time Preference" yLabel="Respondent" :chartLabel="data.sp_feeder.label.time"
              :chartDatasets="data.sp_feeder.data_set" />
            <vertical-bar v-if="isSp == 4" :height="350" bgcolor="#24478c" bordercolor="#24478c"
              scaleLabel="Cost Preference" :labelData=" data.sp_feeder_premium.data_set.map( data => data.label ) "
              :data="  data.sp_feeder_premium.data_set.map(   data => data.chartData  ) " label="Total Respond" />
            <vertical-bar v-if="isSp == 5" :height="350" bgcolor="#24478c" bordercolor="#24478c"
              scaleLabel="Cost Preference" :labelData=" data.sp_feeder_park_car.data_set.map( data => data.label ) "
              :data="  data.sp_feeder_park_car.data_set.map(   data => data.chartData  ) " label="Total Respond" />
            <vertical-bar v-if="isSp == 6" :height="350" bgcolor="#24478c" bordercolor="#24478c"
              scaleLabel="Cost Preference" :labelData=" data.sp_feeder_park_motor.data_set.map( data => data.label ) "
              :data="  data.sp_feeder_park_motor.data_set.map(   data => data.chartData  ) " label="Total Respond" />
            <multi-bar v-if="isSp == 7" :height="350" xLabel="Time Preference" yLabel="Respondent" :chartLabel="data.sp_feeder_car.label.time"
              :chartDatasets="data.sp_feeder_car.data_set" />
            <multi-bar v-if="isSp == 8" :height="350" xLabel="Time Preference" yLabel="Respondent" :chartLabel="data.sp_feeder_motor.label.time"
              :chartDatasets="data.sp_feeder_motor.data_set" />
            <multi-bar v-if="isSp == 9" :height="350" xLabel="Time Preference" yLabel="Respondent" :chartLabel="data.sp_feeder_public.label.time"
              :chartDatasets="data.sp_feeder_public.data_set" />
            <multi-bar v-if="isSp == 10" :height="350" xLabel="Time Preference" yLabel="Respondent" :chartLabel="data.sp_feeder_mix.label.time"
              :chartDatasets="data.sp_feeder_mix.data_set" />
            <vertical-bar v-if="isSp == 11" :height="350" bgcolor="#24478c" bordercolor="#24478c"
              scaleLabel="Cost Preference"
              :labelData=" data.sp_park_ride_car_with_mrt.data_set.map(data => data.label  )"
              :data=" data.sp_park_ride_car_with_mrt.data_set.map(   data => data.chartData) " label="Total Respond" />
            <vertical-bar v-if="isSp == 12" :height="350" bgcolor="#24478c" bordercolor="#24478c"
              scaleLabel="Cost Preference"
              :labelData=" data.sp_park_ride_car_without_mrt.data_set.map(data => data.label  )"
              :data=" data.sp_park_ride_car_without_mrt.data_set.map(   data => data.chartData) "
              label="Total Respond" />
            <vertical-bar v-if="isSp == 13" :height="350" bgcolor="#24478c" bordercolor="#24478c" scaleLabel="Distance"
              :labelData="data.sp_park_ride_car_hypo.data_set.map(data => data.label)"
              :data=" data.sp_park_ride_car_hypo.data_set.map(data => data.chartData) " label="Total Respond" />
            <vertical-bar v-if="isSp == 14" :height="350" bgcolor="#24478c" bordercolor="#24478c"
              scaleLabel="Cost Preference"
              :labelData=" data.sp_park_ride_motor_with_mrt.data_set.map(data => data.label  )"
              :data=" data.sp_park_ride_motor_with_mrt.data_set.map(   data => data.chartData) "
              label="Total Respond" />
            <vertical-bar v-if="isSp == 15" :height="350" bgcolor="#24478c" bordercolor="#24478c"
              scaleLabel="Cost Preference"
              :labelData=" data.sp_park_ride_motor_without_mrt.data_set.map(data => data.label  )"
              :data=" data.sp_park_ride_motor_without_mrt.data_set.map(   data => data.chartData) "
              label="Total Respond" />
            <vertical-bar v-if="isSp == 16" :height="350" bgcolor="#24478c" bordercolor="#24478c" scaleLabel="Distance"
              :labelData="data.sp_park_ride_motor_hypo.data_set.map(data => data.label)"
              :data=" data.sp_park_ride_motor_hypo.data_set.map(data => data.chartData) " label="Total Respond" />

          </b-card-body>
        </b-card>
      </b-col>

      <b-col lg="6"  class="mb-4">

        <b-row>
          <b-col md="6" class="mb-4">
            <b-card class="shadow" title="Pedestrian User">
              <b-card-body class="h-100 pt-0 text-right">
                <pie-chart v-if="isPedestrian == 1" :height="180" :label="['Ya', 'Tidak']"
                  :data="data.sp_pedestrian.is_using.map(data => data.sp_pedestrian_count )" />
                <pie-chart v-if="isPedestrian == 2" :height="180" :label="['Ya', 'Tidak']"
                  :data=" data.sp_pedestrian.will_using.map( data => data.sp_pedestrian_count )" />
              </b-card-body>
              <b-button-group class="w-100">
                <b-button size="sm" :pressed="isPedestrian == 1" variant="outline-secondary"
                  @click="handlePedestrianCard(1)">Current</b-button>
                <b-button size="sm" :pressed="isPedestrian == 2" variant="outline-secondary"
                  @click="handlePedestrianCard(2)">Potential</b-button>
              </b-button-group>
            </b-card>
          </b-col>
          <b-col md="6" class="mb-4">
            <b-card class="shadow" title="Cycle User">
              <b-card-body class="h-100 pt-0 text-right">
                <pie-chart v-if="isCycle == 1" :height="180" :label="['Ya', 'Tidak']"
                  :data=" data.sp_cycle.is_using.map( data =>data.sp_cycle_count ) " />
                <pie-chart v-if="isCycle == 2" :height="180" :label="['Ya', 'Tidak']"
                  :data=" data.sp_cycle.will_using.map( data => data.sp_cycle_count) " />
              </b-card-body>
              <b-button-group class="w-100">
                <b-button size="sm" :pressed="isCycle == 1" variant="outline-secondary" @click="handleCycleCard(1)">
                  Current
                </b-button>
                <b-button size="sm" :pressed="isCycle == 2" variant="outline-secondary" @click="handleCycleCard(2)">
                  Potential</b-button>
              </b-button-group>
            </b-card>
          </b-col>
        </b-row>
        <b-row>
          <b-col cols="12">
            <b-card class="shadow h-100">
              <b-card-body class="h-100 pt-0 text-right">
                <b-button-group class="w-100 overflow-auto">
                  <b-button v-for="(v,i) in sp2" :key="i" size="sm" :pressed="isSp2 == v.id" variant="outline-secondary"
                    @click="handleSp2Card(v.id)">{{v.title}}</b-button>
                </b-button-group>
                <horizontal-bar v-if="isSp2 == 1" :height="250" scaleLabel="Income"
                  :labelData="data.sp_pedestrian_by_income.data_set.map(data => data.label)"
                  :data=" data.sp_pedestrian_by_income.data_set.map(data => data.chartData) "
                  label="Total Respondent" />
                <vertical-bar v-if="isSp2 == 2" :height="250" scaleLabel="Mode"
                  :labelData="data.sp_pedestrian_by_mode.data_set.map(data => data.label)"
                  :data=" data.sp_pedestrian_by_mode.data_set.map(data => data.chartData) " label="Total Respondent" />
                <horizontal-bar v-if="isSp2 == 3" :height="250" scaleLabel="Income"
                  :labelData="data.sp_cycle_by_income.data_set.map(data => data.label)"
                  :data=" data.sp_cycle_by_income.data_set.map(data => data.chartData) " label="Total Respondent" />
                <vertical-bar v-if="isSp2 == 4" :height="250" scaleLabel="Mode"
                  :labelData="data.sp_cycle_by_mode.data_set.map(data => data.label)"
                  :data=" data.sp_cycle_by_mode.data_set.map(data => data.chartData) " label="Total Respondent" />
              </b-card-body>
            </b-card>
          </b-col>
        </b-row>
      </b-col>



      <b-col lg="3" md="6" sm="12" class="mb-4">
        <b-card title="Survey Preference" class="shadow">
          <b-card-body class="p-0">
            <div flush class="list-group-small">
              <div v-for="(v, i) in data.sp_count" :key="i" class="d-flex px-3">
                <span>{{ v.description }}</span>
                <span class="ml-auto text-right">{{ v.survey_preference_respondents_count }}</span>
              </div>
            </div>
          </b-card-body>
        </b-card>
      </b-col>
      <b-col lg="3" md="6" sm="12" class="mb-4">
        <b-card title="Park Ride Data" class="shadow">
          <b-card-body class="p-0">
            <div flush class="list-group-small">
              <div v-for="(v, i) in data.park_ride_count" :key="i" class="d-flex px-3">
                <span>{{ v.description }}</span>
                <span class="ml-auto text-right">{{ v.park_ride_point_respondents_count }}</span>
              </div>
            </div>
          </b-card-body>
        </b-card>
      </b-col>
      <!-- <b-col lg="3" md="6" sm="12" class="mb-4">
        <b-card title="Willingness to Pay" class="shadow">
          <b-card-body class="p-0">
            <div flush class="list-group-small">
              <div v-for="(v, i) in data.mrt_cost" :key="i" class="d-flex px-3">
                <span>{{ v.mrt_cost }}</span>
                <span class="ml-auto text-right">{{ v.total }}</span>
              </div>
            </div>
          </b-card-body>
        </b-card>
      </b-col> -->

      <b-col lg="3" md="6" sm="12" class="mb-4">
        <b-card title="Transportation Mode" class="shadow">
          <b-card-body class="p-0">
            <div flush class="list-group-small">
              <div v-for="(v, i) in data.transportation_mode" :key="i" class="d-flex px-3">
                <span>
                  {{
                  v.transportation_mode.description
                  }}
                </span>
                <span class="ml-auto text-right">{{ v.total }}</span>
              </div>
            </div>
          </b-card-body>
        </b-card>
      </b-col>
    </b-row>

  </div>
</template>
<script>
import Loading from 'vue-loading-overlay';

  import GenderPie from "@/admin/components/chart/GenderPie.vue";
  import PieChart from "@/admin/components/chart/PieChart.vue";
  import HorizontalBar from "@/admin/components/chart/HorizontalBar.vue";
  import VerticalBar from "@/admin/components/chart/VerticalBar.vue";
  import RespondentMixOverview from "@/admin/components/chart/RespondentMixOverview.vue";
  import GoogleHeatMap from "@/admin/components/google/HeatMap.vue";
  import MultiBar from "@/admin/components/chart/MultiBar.vue";

  export default {
    name: "Dashboard2",
    components: {
      Loading,
      GenderPie,
      RespondentMixOverview,
      HorizontalBar,
      GoogleHeatMap,
      VerticalBar,
      PieChart,
      MultiBar
    },
    data: function () {
      return {
        isLoading: true,
        data: {},
        isEconomics: 1,
        heatmap: [{
            id: 1,
            title: 'Origin'
          },
          {
            id: 2,
            title: 'Destination'
          },
          {
            id: 3,
            title: 'Feeder'
          },
          {
            id: 4,
            title: 'MRT'
          },
        ],
        social: [{
            id: 1,
            title: 'Age'
          },
          {
            id: 2,
            title: 'Job'
          },
          {
            id: 3,
            title: 'Education'
          },
        ],
        travel: [{
            id: 1,
            title: 'Purpose',
            btnName: 'Purpose'
          },
          {
            id: 2,
            title: 'Vehicle Availability',
            btnName: 'Vehicle'
          },
          {
            id: 3,
            title: 'Parking Type',
            btnName: 'Parking'
          },
          {
            id: 4,
            title: 'Parking Guarantor',
            btnName: 'Parking By'
          },
          {
            id: 5,
            title: 'Travel Guarantor',
            btnName: 'Travel By'
          },
          {
            id: 6,
            title: 'Paying for Park',
            btnName: 'Is Paying'
          },
          {
            id: 7,
            title: 'Travel Model',
            btnName: 'Model'
          },
        ],
        economics: [{
            id: 1,
            title: 'Salary'
          },
          {
            id: 2,
            title: 'Expense'
          },
          {
            id: 3,
            title: 'Travel Cost'
          },
        ],
        wtp: [{
            id: 1,
            title: 'Mode'
          },
          {
            id: 2,
            title: 'Income'
          },
          {
            id: 3,
            title: 'Duration'
          },
          {
            id: 4,
            title: 'Distance'
          },
        ],
        sp2: [{
            id: 1,
            title: 'Pedestrian by Income'
          },
          {
            id: 2,
            title: 'Pedestrian by Mode'
          },
          {
            id: 3,
            title: 'Cycle by Income'
          },
          {
            id: 4,
            title: 'Cycle by Mode'
          },
        ],
        sp: [{
            id: 1,
            title:'Car Parking',
            btnName: 'Car',

          },
          {
            id: 2,
            title:'Motor Parking',
            btnName: 'Motor'
          },
          {
            id: 3,
            title:'Feeder Reguler (Total)',
            btnName: 'Feeder'
          },
          {
            id: 4,
            title:'Feeder Premium (Total)',
            btnName: 'Premium'
          },
          {
            id: 5,
            title:'Feeder & Park w/ Car Parking',
            btnName: 'FP Car'
          },
          {
            id: 6,
            title:'Feeder & Park w/ Motor Parking',
            btnName: 'FP Motor'
          },
          {
            id: 7,
            title:'Feeder Reguler (Car)',
            btnName: 'Feeder Car'
          },
          {
            id: 8,
            title:'Feeder Reguler (Motor)',
            btnName: 'Feeder Motor'
          },
          {
            id: 9,
            title:'Feeder Reguler (Public)',
            btnName: 'Feeder Umum'
          },
          {
            id: 10,
            title:'Feeder Reguler (Campuran)',
            btnName: 'Feeder Campuran'
          },
          {
            id: 11,
            title:'Park & Ride w/ MRT & Car',
            btnName: 'PR MRT Car'
          },
          {
            id: 12,
            title:'Park & Ride w/ Car',
            btnName: 'PR Car'
          },
          {
            id: 13,
            title:'Park & Ride Hypotheis w/ Car',
            btnName: 'PR Car Hypo'
          },
          {
            id: 14,
            title:'Park & Ride w/ MRT & Motor',
            btnName: 'PR MRT Motor'
          },
          {
            id: 15,
            title:'Park & Ride w/ Motor',
            btnName: 'PR Motor'
          },
          {
            id: 16,
            title:'Park & Ride Hypotheis w/ Motor',
            btnName: 'PR Motor Hypo'
          },
        ],
        isSocial: 1,
        isTravel: 1,
        isPedestrian: 1,
        isCycle: 1,
        isHeatmap: 1,
        isWtp: 1,
        isSp: 1,
        isSp2: 1
      };
    },
    created() {
      this.getData();
    },
    methods: {
      handleWtpCard(i) {
        if (i == this.isWtp) {
          return;
        }
        this.isWtp = 0;
        setTimeout(() => {
          this.isWtp = i;
        }, 1);
      },
      handleHeatmapCard(i) {
        if (i == this.isHeatmap) {
          return;
        }
        this.isHeatmap = 0;
        setTimeout(() => {
          this.isHeatmap = i;
        }, 1);
      },
      handleSpCard(i) {
        if (i == this.isSp) {
          return;
        }
        this.isSp = 0;
        setTimeout(() => {
          this.isSp = i;
        }, 1);
      },
      handleSp2Card(i) {
        if (i == this.isSp2) {
          return;
        }
        this.isSp2 = 0;
        setTimeout(() => {
          this.isSp2 = i;
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
      handlePedestrianCard(i) {
        if (i == this.isPedestrian) {
          return;
        }
        this.isPedestrian = 0;
        setTimeout(() => {
          this.isPedestrian = i;
        }, 1);
      },
      handleCycleCard(i) {
        if (i == this.isCycle) {
          return;
        }
        this.isCycle = 0;
        setTimeout(() => {
          this.isCycle = i;
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
        let mutateData = data.map(function (item) {
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
<style scoped>
  .travel-map {
    height: 300px;
  }
  .btn-sm{
    padding: 0.4rem 0.4rem;
    font-size: 0.6rem;
  }

</style>
