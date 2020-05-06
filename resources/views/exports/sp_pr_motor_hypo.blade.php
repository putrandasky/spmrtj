<table>
  <thead>
    <tr>
      <th rowspan="2" style="text-align:center;font-weight:bold">Id</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">Lokasi PR</th>
      <th colspan="5" style="text-align:center;font-weight:bold">Jenis Parkir </th>
      <th colspan="6" style="text-align:center;font-weight:bold">Fasilitas PR</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">Durasi</th>
      <th colspan="7" style="text-align:center;font-weight:bold">SP</th>
    </tr>
    <tr>
      @for ($i = 0; $i < 5; $i++) <th style="text-align:center;font-weight:bold">{{$i + 1}}</th>
        @endfor
        @for ($i = 0; $i < 6; $i++) <th style="text-align:center;font-weight:bold">{{$i + 1}}</th>
          @endfor
          @for ($i = 0; $i < 7; $i++) <th style="text-align:center;font-weight:bold">{{$i + 1}}</th>
          @endfor
    </tr>
  </thead>
  <tbody>
    @foreach($respondents as $respondent)
    @php
    $parking_type_respond = $respondent->sp_park_ride_commons()->where('question_id',2)->first()->respond;
    @endphp
    <tr>
      <td>{{$respondent->id}}</td>
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
      <td>{{$respondent->sp_park_ride_hypo_motor_respond(1)->respond}}</td>
      <td>{{$respondent->sp_park_ride_hypo_motor_respond(2)->respond}}</td>
      <td>{{$respondent->sp_park_ride_hypo_motor_respond(3)->respond}}</td>
      <td>{{$respondent->sp_park_ride_hypo_motor_respond(4)->respond}}</td>
      <td>{{$respondent->sp_park_ride_hypo_motor_respond(5)->respond}}</td>
      <td>{{$respondent->sp_park_ride_hypo_motor_respond(6)->respond}}</td>
      <td>{{$respondent->sp_park_ride_hypo_motor_respond(7)->respond}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
