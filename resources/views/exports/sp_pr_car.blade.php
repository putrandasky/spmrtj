<table>
  <thead>
    <tr>
      <th rowspan="2" style="text-align:center;font-weight:bold">Id</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">PR Eksisting</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">Lokasi PR</th>
      <th colspan="5" style="text-align:center;font-weight:bold">Jenis Parkir </th>
      <th colspan="6" style="text-align:center;font-weight:bold">Fasilitas PR</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">Durasi</th>
      <th colspan="7" style="text-align:center;font-weight:bold">Tarif PR Mobil</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">Potensi PR</th>
    </tr>
    <tr>
      @for ($i = 0; $i < 5; $i++) <th style="text-align:center;font-weight:bold">{{$i + 1}}</th>
        @endfor
        @for ($i = 0; $i < 6; $i++) <th style="text-align:center;font-weight:bold">{{$i + 1}}</th>
          @endfor
          @php
          $headers = array(20,18,15,12,10,8,5)
          @endphp
          @foreach ($headers as $v)
          <th style="text-align:center;font-weight:bold">{{$v}}</th>
          @endforeach
    </tr>
  </thead>
  <tbody>
    @foreach($respondents as $respondent)
    @php
    $parking_type_respond = $respondent->sp_park_ride_commons()->where('question_id',2)->first()->respond;
    $pr_car_20000 = $respondent->sp_park_ride_primary_car_respond(1)->respond ;
    $pr_car_18000 = $respondent->sp_park_ride_primary_car_respond(2)->respond ?? $pr_car_20000 ;
    $pr_car_15000 = $respondent->sp_park_ride_primary_car_respond(3)->respond ?? $pr_car_18000 ;
    $pr_car_12000 = $respondent->sp_park_ride_primary_car_respond(4)->respond ?? $pr_car_15000 ;
    $pr_car_10000 = $respondent->sp_park_ride_primary_car_respond(5)->respond ?? $pr_car_12000 ;
    $pr_car_8000 = $respondent->sp_park_ride_primary_car_respond(6)->respond ?? $pr_car_10000 ;
    $pr_car_5000 = $respondent->sp_park_ride_primary_car_respond(7)->respond ?? $pr_car_8000 ;
    @endphp
    <tr>
      <td>{{$respondent->id}}</td>
      <td>{{$respondent->sp_park_ride_commons()->where('question_id',5)->first()->respond ?? null}}</td>
      <td>{{$respondent->sp_park_ride_commons()->where('question_id',1)->first()->respond}}</td>
      <td>{{$parking_type_respond == 1 ? 1 : ""}}</td>
      <td>{{$parking_type_respond == 2 ? 1 : ""}}</td>
      <td>{{$parking_type_respond == 3 ? 1 : ""}}</td>
      <td>{{$parking_type_respond == 4 ? 1 : ""}}</td>
      <td>{{$parking_type_respond == 5 ? 1 : ""}}</td>
      <td>{{$respondent->sp_park_ride_common_respond(3,"A")? 1 : ""}}</td>
      <td>{{$respondent->sp_park_ride_common_respond(3,"B")? 1 : ""}}</td>
      <td>{{$respondent->sp_park_ride_common_respond(3,"C")? 1 : ""}}</td>
      <td>{{$respondent->sp_park_ride_common_respond(3,"D")? 1 : ""}}</td>
      <td>{{$respondent->sp_park_ride_common_respond(3,"E")? 1 : ""}}</td>
      <td>{{$respondent->sp_park_ride_common_respond(3,"F")? 1 : ""}}</td>
      <td>{{$respondent->sp_park_ride_commons()->where('question_id',4)->first()->respond}}</td>
      <td>{{$pr_car_20000}}</td>
      <td>{{$pr_car_18000}}</td>
      <td>{{$pr_car_15000}}</td>
      <td>{{$pr_car_12000}}</td>
      <td>{{$pr_car_10000}}</td>
      <td>{{$pr_car_8000}}</td>
      <td>{{$pr_car_5000}}</td>
      <td>{{$respondent->sp_park_ride_commons()->where('question_id',6)->first()->respond ?? null}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
