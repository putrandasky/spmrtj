<table>
  <thead>
    <tr>
      <th colspan="7" style="text-align:center;font-weight:bold">Informasi Pribadi</th>
      <th colspan="17" style="text-align:center;font-weight:bold">Informasi Perjalanan</th>
     
      <th colspan="2" style="text-align:center;font-weight:bold">Usulan Tarif LRT</th>
      <th colspan="3" style="text-align:center;font-weight:bold">Total Detail Perjalanan</th>
     
    </tr>
    <tr>
      <th style="text-align:center;font-weight:bold">No</th>
      <th style="text-align:center;font-weight:bold">Jenis Kelamin</th>
      <th style="text-align:center;font-weight:bold">Umur</th>
      <th style="text-align:center;font-weight:bold">Pekerjaan</th>
      <th style="text-align:center;font-weight:bold">Pendapatan</th>
      <th style="text-align:center;font-weight:bold">Penanggung Biaya</th>
      <th style="text-align:center;font-weight:bold">Kepemilikan Kendaraan</th>
      <th style="text-align:center;font-weight:bold">Tujuan Perjalanan</th>
      <th style="text-align:center;font-weight:bold">Moda</th>
      <th style="text-align:center;font-weight:bold">Frekuensi</th>
      <th style="text-align:center;font-weight:bold">Durasi (Menit)</th>
      <th style="text-align:center;font-weight:bold">Biaya Transportasi (Rp)</th>
      <th style="text-align:center;font-weight:bold">Biaya Parkir (Rp)</th>
      <th style="text-align:center;font-weight:bold">Asal Perjalanan</th>
      <th style="text-align:center;font-weight:bold">Lat</th>
      <th style="text-align:center;font-weight:bold">Lng</th>
      <th style="text-align:center;font-weight:bold">Tujuan Perjalanan</th>
      <th style="text-align:center;font-weight:bold">Lat</th>
      <th style="text-align:center;font-weight:bold">Lng</th>
      <th style="text-align:center;font-weight:bold">Jarak Perjalanan Normal (Km)</th>
      <th style="text-align:center;font-weight:bold">Jarak Perjalanan Hanya LRT (Km)</th>
      <th style="text-align:center;font-weight:bold">Durasi Perjalanan Hanya LRT (Menit)</th>
      <th style="text-align:center;font-weight:bold">Durasi Perjalanan Total + LRT (Menit)</th>
      <th style="text-align:center;font-weight:bold">Saving Time</th>
      {{-- <th style="text-align:center;font-weight:bold">Total Station</th> --}}


      <th style="text-align:center;font-weight:bold">Minimum</th>
      <th style="text-align:center;font-weight:bold">Maximum</th>
      <th style="text-align:center;font-weight:bold">Waktu Tunggu</th>
      <th style="text-align:center;font-weight:bold">Waktu Perjalanan</th>
      <th style="text-align:center;font-weight:bold">Biaya Perjalanan</th>
     
    </tr>
  </thead>
  <tbody>
    @foreach($respondents as $respondent)
    <tr>
      <td>{{$loop->iteration}}</td>
      <td>{{$respondent->gender}}</td>
      <td>{{$respondent->age->range}}</td>
      <td>{{$respondent->job->name}}</td>
      <td>{{$respondent->salary->range}}</td>
      <td>{{$respondent->transport_guarantor->description}}</td>
      <td>{{$respondent->vehicle->name}}</td>
      <td>{{$respondent->travel_purpose->description}}</td>
      <td>{{$respondent->transportation_mode->name}}</td>
      <td>{{$respondent->travel_frequences}}</td>
      <td>{{$respondent->travel_duration}}</td>
      <td>{{$respondent->travel_cost}}</td>
      <td>{{$respondent->parking_cost}}</td>
      <td>{{$respondent->travel_origin}}</td>
      <td>{{$respondent->origin_lat}}</td>
      <td>{{$respondent->origin_long}}</td>
      <td>{{$respondent->travel_destination}}</td>
      <td>{{$respondent->destination_lat}}</td>
      <td>{{$respondent->destination_long}}</td>
      <td>{{$respondent->gmaps_normal_distance}}</td>
      <td>{{$respondent->gmaps_lrt_distance}}</td>
      <td>{{$respondent->gmaps_lrt_duration}}</td>
      <td>{{$respondent->gmaps_travel_duration}}</td>
      <td>
        {{$respondent->gmaps_travel_duration? $respondent->travel_duration - $respondent->gmaps_travel_duration : null}}
      </td>
    {{-- <td>{{$respondent->respondent_station_count}}</td> --}}
    
      <td>{{$respondent->reasonable_rate}}</td>
      <td>{{$respondent->reasonable_rate_max}}</td>
      @php
      $total_waiting_duration = 0;
      $total_travel_duration = 0;
      $total_travel_cost = 0;
      foreach ($respondent->additional_informations as $additional) {
      $total_waiting_duration += $additional->waiting_duration;
      $total_travel_duration += $additional->travel_duration;
      $total_travel_cost += $additional->travel_cost;
      }
      @endphp
      <td>{{$total_waiting_duration}}</td>
      <td>{{$total_travel_duration}}</td>
      <td>{{$total_travel_cost}}</td>

      {{-- @foreach($respondent->state_preferences as $state)
              <td>{{$state->respond}}</td>
      @endforeach --}}

    </tr>
    @endforeach
  </tbody>
</table>
