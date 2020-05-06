<table>
  <thead>
    <tr>
      <th colspan="7" style="text-align:center;font-weight:bold">Informasi Pribadi</th>
      <th colspan="13" style="text-align:center;font-weight:bold">Informasi Perjalanan</th>
      @if($concern !== "cost")
      <th colspan="18" style="text-align:center;font-weight:bold">Stated Preference Survey</th>
      @endif
      @if($concern == "cost")
      <th colspan="11" style="text-align:center;font-weight:bold">Stated Preference Survey</th>
      @endif
      <th colspan="2" style="text-align:center;font-weight:bold">Usulan Tarif LRT</th>
      <th colspan="3" style="text-align:center;font-weight:bold">Total Detail Perjalanan</th>
      @for ($i = 0; $i < $max_additional_info; $i++) <th colspan="4" style="text-align:center;font-weight:bold">Detail
        Perjalanan Ke {{ $i +1 }}</th>

        @endfor
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
      <th style="text-align:center;font-weight:bold">Tujuan Perjalanan</th>
      <th style="text-align:center;font-weight:bold">Jarak Perjalanan Normal (Km)</th>
      <th style="text-align:center;font-weight:bold">Jarak Perjalanan Hanya LRT (Km)</th>
      <th style="text-align:center;font-weight:bold">Durasi Perjalanan Hanya LRT (Menit)</th>
      <th style="text-align:center;font-weight:bold">Durasi Perjalanan Total + LRT (Menit)</th>
      <th style="text-align:center;font-weight:bold">Saving Time</th>
      {{-- <th style="text-align:center;font-weight:bold">Total Station</th> --}}

      @if($category !== "D" && $concern !== "cost")
      <th style="text-align:center;font-weight:bold">X4Y4</th>
      <th style="text-align:center;font-weight:bold">X4Y3</th>
      <th style="text-align:center;font-weight:bold">X4Y2</th>
      <th style="text-align:center;font-weight:bold">X4Y1</th>
      <th style="text-align:center;font-weight:bold">X3Y4</th>
      <th style="text-align:center;font-weight:bold">X3Y3</th>
      <th style="text-align:center;font-weight:bold">X3Y2</th>
      <th style="text-align:center;font-weight:bold">X3Y1</th>
      <th style="text-align:center;font-weight:bold">X2Y4</th>
      <th style="text-align:center;font-weight:bold">X2Y3</th>
      <th style="text-align:center;font-weight:bold">X2Y2</th>
      <th style="text-align:center;font-weight:bold">X2Y1</th>
      <th style="text-align:center;font-weight:bold">X1Y4</th>
      <th style="text-align:center;font-weight:bold">X1Y3</th>
      <th style="text-align:center;font-weight:bold">X1Y2</th>
      <th style="text-align:center;font-weight:bold">X1Y1</th>
      <th style="text-align:center;font-weight:bold">X1Y5</th>
      <th style="text-align:center;font-weight:bold">X1Y6</th>
      @endif
      @if($category !== "D" && $concern == "cost")
      <th style="text-align:center;font-weight:bold">X4Y4</th>
      <th style="text-align:center;font-weight:bold">X4Y5</th>
      <th style="text-align:center;font-weight:bold">X4Y6</th>
      <th style="text-align:center;font-weight:bold">X3Y6</th>
      <th style="text-align:center;font-weight:bold">X3Y4</th>
      <th style="text-align:center;font-weight:bold">X3Y3</th>
      <th style="text-align:center;font-weight:bold">X3Y2</th>
      <th style="text-align:center;font-weight:bold">X3Y1</th>
      <th style="text-align:center;font-weight:bold">X4Y3</th>
      <th style="text-align:center;font-weight:bold">X4Y2</th>
      <th style="text-align:center;font-weight:bold">X4Y1</th>

      @endif
      @if($category == "D")
      <th style="text-align:center;font-weight:bold">X1Y1</th>
      <th style="text-align:center;font-weight:bold">X1Y2</th>
      <th style="text-align:center;font-weight:bold">X1Y3</th>
      <th style="text-align:center;font-weight:bold">X1Y4</th>
      <th style="text-align:center;font-weight:bold">X1Y5</th>
      <th style="text-align:center;font-weight:bold">X1Y6</th>
      <th style="text-align:center;font-weight:bold">X2Y1</th>
      <th style="text-align:center;font-weight:bold">X2Y2</th>
      <th style="text-align:center;font-weight:bold">X2Y3</th>
      <th style="text-align:center;font-weight:bold">X2Y4</th>
      <th style="text-align:center;font-weight:bold">X2Y5</th>
      <th style="text-align:center;font-weight:bold">X2Y6</th>
      <th style="text-align:center;font-weight:bold">X3Y1</th>
      <th style="text-align:center;font-weight:bold">X3Y2</th>
      <th style="text-align:center;font-weight:bold">X3Y3</th>
      <th style="text-align:center;font-weight:bold">X3Y4</th>
      <th style="text-align:center;font-weight:bold">X3Y5</th>
      <th style="text-align:center;font-weight:bold">X3Y6</th>
      @endif

      <th style="text-align:center;font-weight:bold">Minimum</th>
      <th style="text-align:center;font-weight:bold">Maximum</th>
      <th style="text-align:center;font-weight:bold">Waktu Tunggu</th>
      <th style="text-align:center;font-weight:bold">Waktu Perjalanan</th>
      <th style="text-align:center;font-weight:bold">Biaya Perjalanan</th>
      @for ($i = 0; $i < $max_additional_info; $i++)
      <th style="text-align:center;font-weight:bold">Mode Transportasi
        </th>
        <th style="text-align:center;font-weight:bold">Waktu Tunggu </th>
        <th style="text-align:center;font-weight:bold">Waktu Perjalanan </th>
        <th style="text-align:center;font-weight:bold">Biaya Perjalanan </th>
        @endfor
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
      <td>{{$respondent->travel_destination}}</td>
      <td>{{$respondent->gmaps_normal_distance}}</td>
      <td>{{$respondent->gmaps_lrt_distance}}</td>
      <td>{{$respondent->gmaps_lrt_duration}}</td>
      <td>{{$respondent->gmaps_travel_duration}}</td>
      <td>
        {{$respondent->gmaps_travel_duration? $respondent->travel_duration - $respondent->gmaps_travel_duration : null}}
      </td>
    {{-- <td>{{$respondent->respondent_station_count}}</td> --}}
      @php


      if ($category == "A" && $concern !== "cost") {
      # code...
      $X4Y4 = $respondent->sp_respond(4,4)->respond;
      $X4Y3 = $respondent->sp_respond(4,3)->respond ?? 0;
      $X4Y2 = $respondent->sp_respond(4,2)->respond ?? 0;
      $X4Y1 = $respondent->sp_respond(4,1)->respond ?? 0;
      $X3Y4 = $respondent->sp_respond(3,4)->respond ?? 1;
      $X3Y3 = $respondent->sp_respond(3,3)->respond ?? $X4Y3 == 1 ? 1 : 0;
      $X3Y2 = $respondent->sp_respond(3,2)->respond ?? $X4Y2 == 1 ? 1 : 0;
      $X3Y1 = $respondent->sp_respond(3,1)->respond ?? $X4Y1 == 1 ? 1 : 0;
      $X2Y4 = $respondent->saving_time > 20 ? $respondent->sp_respond(2,4)->respond ?? 1 : "";
      $X2Y3 = $respondent->saving_time > 20 ? $respondent->sp_respond(2,3)->respond ?? $X3Y3 == 1 ? 1 : 0 : "";
      $X2Y2 = $respondent->saving_time > 20 ? $respondent->sp_respond(2,2)->respond ?? $X3Y2 == 1 ? 1 : 0 : "";
      $X2Y1 = $respondent->saving_time > 20 ? $respondent->sp_respond(2,1)->respond ?? $X3Y1 == 1 ? 1 : 0 : "";
      $X1Y4 = $respondent->saving_time > 30 ? $respondent->sp_respond(1,4)->respond ?? 1 : "";
      $X1Y3 = $respondent->saving_time > 30 ? $respondent->sp_respond(1,3)->respond ?? $X2Y3 == 1 ? 1 : 0 : "";
      $X1Y2 = $respondent->saving_time > 30 ? $respondent->sp_respond(1,2)->respond ?? $X2Y2 == 1 ? 1 : 0 : "";
      $X1Y1 = $respondent->saving_time > 30 ? $respondent->sp_respond(1,1)->respond ?? $X2Y1 == 1 ? 1 : 0 : "";
      $X1Y5 = $respondent->saving_time > 30 ? $respondent->sp_respond(1,5)->respond ?? 1: "";
      $X1Y6 = $respondent->saving_time > 30 ? $respondent->sp_respond(1,6)->respond ?? 1: "";
      }
      if ($category !== "D" && $category !== "A" && $concern !== "cost") {
      # code...
      $X4Y4 = $respondent->sp_respond(4,4)->respond;
      $X4Y3 = $respondent->sp_respond(4,3)->respond ?? 0;
      $X4Y2 = $respondent->sp_respond(4,2)->respond ?? 0;
      $X4Y1 = $respondent->sp_respond(4,1)->respond ?? 0;
      $X3Y4 = $respondent->sp_respond(3,4)->respond ?? 1;
      $X3Y3 = $respondent->sp_respond(3,3)->respond ?? $X4Y3 == 1 ? 1 : 0;
      $X3Y2 = $respondent->sp_respond(3,2)->respond ?? $X4Y2 == 1 ? 1 : 0;
      $X3Y1 = $respondent->sp_respond(3,1)->respond ?? $X4Y1 == 1 ? 1 : 0;
      $X2Y4 = $respondent->sp_respond(2,4)->respond ?? 1;
      $X2Y3 = $respondent->sp_respond(2,3)->respond ?? $X3Y3 == 1 ? 1 : 0;
      $X2Y2 = $respondent->sp_respond(2,2)->respond ?? $X3Y2 == 1 ? 1 : 0;
      $X2Y1 = $respondent->sp_respond(2,1)->respond ?? $X3Y1 == 1 ? 1 : 0;
      $X1Y4 = $respondent->sp_respond(1,4)->respond ?? 1;
      $X1Y3 = $respondent->sp_respond(1,3)->respond ?? $X2Y3 == 1 ? 1 : 0;
      $X1Y2 = $respondent->sp_respond(1,2)->respond ?? $X2Y2 == 1 ? 1 : 0;
      $X1Y1 = $respondent->sp_respond(1,1)->respond ?? $X2Y1 == 1 ? 1 : 0;
      $X1Y5 = $respondent->sp_respond(1,5)->respond ?? 1;
      $X1Y6 = $respondent->sp_respond(1,6)->respond ?? 1;
      }
      if ($category !== "D" && $concern == "cost") {
      # code...
      $X4Y4 = $respondent->sp_respond(4,4)->respond;
      $X4Y5 = $respondent->sp_respond(4,5)->respond ?? 0;
      $X4Y6 = $respondent->sp_respond(4,6)->respond ?? 0;
      $X3Y6 = $respondent->sp_respond(3,6)->respond ?? 0;
      $X3Y4 = $respondent->sp_respond(3,4)->respond ?? 0;
      $X3Y3 = $respondent->sp_respond(3,3)->respond ?? 0;
      $X3Y2 = $respondent->sp_respond(3,2)->respond ?? 0;
      $X3Y1 = $respondent->sp_respond(3,1)->respond ?? 0;
      $X4Y3 = 0;
      $X4Y2 = 0;
      $X4Y1 = 0;

      }
      if ($category == "D") {
      $X1Y1 = $respondent->sp_2_respond(1,1)->respond;
      $X1Y2 = $respondent->sp_2_respond(1,2)->respond ?? 0;
      $X1Y3 = $respondent->sp_2_respond(1,3)->respond ?? 0;
      $X1Y4 = $respondent->sp_2_respond(1,4)->respond ?? 0;
      $X1Y5 = $respondent->sp_2_respond(1,5)->respond ?? 0;
      $X1Y6 = $respondent->sp_2_respond(1,6)->respond ?? 0;
      $X2Y1 = $respondent->sp_2_respond(2,1)->respond ?? 1;
      $X2Y2 = $respondent->sp_2_respond(2,2)->respond ?? $X1Y2 == 1 ? 1 : 0;
      $X2Y3 = $respondent->sp_2_respond(2,3)->respond ?? $X1Y3 == 1 ? 1 : 0;
      $X2Y4 = $respondent->sp_2_respond(2,4)->respond ?? $X1Y4 == 1 ? 1 : 0;
      $X2Y5 = $respondent->sp_2_respond(2,5)->respond ?? $X1Y5 == 1 ? 1 : 0;
      $X2Y6 = $respondent->sp_2_respond(2,6)->respond ?? $X1Y6 == 1 ? 1 : 0;
      $X3Y1 = $respondent->sp_2_respond(3,1)->respond ?? 1;
      $X3Y2 = $respondent->sp_2_respond(3,2)->respond ?? $X2Y2 == 1 ? 1 : 0;
      $X3Y3 = $respondent->sp_2_respond(3,3)->respond ?? $X2Y3 == 1 ? 1 : 0;
      $X3Y4 = $respondent->sp_2_respond(3,4)->respond ?? $X2Y4 == 1 ? 1 : 0;
      $X3Y5 = $respondent->sp_2_respond(3,5)->respond ?? $X2Y5 == 1 ? 1 : 0;
      $X3Y6 = $respondent->sp_2_respond(3,6)->respond ?? $X2Y6 == 1 ? 1 : 0;
      }
      @endphp
      @if($category !== "D" && $concern !== "cost")
      <td>{{$X4Y4}}</td>
      <td>{{$X4Y3}}</td>
      <td>{{$X4Y2}}</td>
      <td>{{$X4Y1}}</td>
      <td>{{$X3Y4}}</td>
      <td>{{$X3Y3}}</td>
      <td>{{$X3Y2}}</td>
      <td>{{$X3Y1}}</td>
      <td>{{$X2Y4}}</td>
      <td>{{$X2Y3}}</td>
      <td>{{$X2Y2}}</td>
      <td>{{$X2Y1}}</td>
      <td>{{$X1Y4}}</td>
      <td>{{$X1Y3}}</td>
      <td>{{$X1Y2}}</td>
      <td>{{$X1Y1}}</td>
      <td>{{$X1Y5}}</td>
      <td>{{$X1Y6}}</td>
      @endif
      @if($category !== "D" && $concern == "cost")
      <td>{{$X4Y4}}</td>
      <td>{{$X4Y5}}</td>
      <td>{{$X4Y6}}</td>
      <td>{{$X3Y6}}</td>
      <td>{{$X3Y4}}</td>
      <td>{{$X3Y3}}</td>
      <td>{{$X3Y2}}</td>
      <td>{{$X3Y1}}</td>
      <td>{{$X4Y3}}</td>
      <td>{{$X4Y2}}</td>
      <td>{{$X4Y1}}</td>
      @endif
      @if($category == "D")
      <td>{{$X1Y1}}</td>
      <td>{{$X1Y2}}</td>
      <td>{{$X1Y3}}</td>
      <td>{{$X1Y4}}</td>
      <td>{{$X1Y5}}</td>
      <td>{{$X1Y6}}</td>
      <td>{{$X2Y1}}</td>
      <td>{{$X2Y2}}</td>
      <td>{{$X2Y3}}</td>
      <td>{{$X2Y4}}</td>
      <td>{{$X2Y5}}</td>
      <td>{{$X2Y6}}</td>
      <td>{{$X3Y1}}</td>
      <td>{{$X3Y2}}</td>
      <td>{{$X3Y3}}</td>
      <td>{{$X3Y4}}</td>
      <td>{{$X3Y5}}</td>
      <td>{{$X3Y6}}</td>
      @endif
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
      @foreach($respondent->additional_informations as $additional)
      <td>{{$additional->transportation_mode->name}}</td>
      <td>{{$additional->waiting_duration}}</td>
      <td>{{$additional->travel_duration}}</td>
      <td>{{$additional->travel_cost}}</td>
      @endforeach
      {{-- @foreach($respondent->state_preferences as $state)
              <td>{{$state->respond}}</td>
      @endforeach --}}

    </tr>
    @endforeach
  </tbody>
</table>
