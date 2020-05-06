<table>

  <thead>
    <tr>
      <th rowspan="2" style="text-align:center;font-weight:bold">Id</th>
      <th colspan="10" style="text-align:center;font-weight:bold">Alasan Moda</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">Pernah MRT</th>
      <th colspan="10" style="text-align:center;font-weight:bold">Harapan</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">Tarif MRT</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">Parkir</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">jumlah Transit</th>
    </tr>
    <tr>
      @for ($i = 0; $i < 10; $i++) <th style="text-align:center;font-weight:bold">
        {{$i + 1}}</th>
        @endfor
        @for ($i = 0; $i < 10; $i++) <th style="text-align:center;font-weight:bold">
          {{$i + 1}}</th>
          @endfor
    </tr>
  </thead>
  <tbody>
    @foreach($respondents as $respondent)
    <tr>
      <td>{{$respondent->id}}</td>
      <td>{{$respondent->reason_using_transportation_respond(1)->priority ?? "" }}</td>
      <td>{{$respondent->reason_using_transportation_respond(2)->priority ?? "" }}</td>
      <td>{{$respondent->reason_using_transportation_respond(3)->priority ?? "" }}</td>
      <td>{{$respondent->reason_using_transportation_respond(4)->priority ?? "" }}</td>
      <td>{{$respondent->reason_using_transportation_respond(5)->priority ?? "" }}</td>
      <td>{{$respondent->reason_using_transportation_respond(6)->priority ?? "" }}</td>
      <td>{{$respondent->reason_using_transportation_respond(7)->priority ?? "" }}</td>
      <td>{{$respondent->reason_using_transportation_respond(8)->priority ?? "" }}</td>
      <td>{{$respondent->reason_using_transportation_respond(9)->priority ?? "" }}</td>
      <td>{{$respondent->reason_using_transportation_respond(10)->priority ?? "" }}</td>
      <td>{{$respondent->is_using_mrt}}</td>
      <td>{{$respondent->mrt_improvement_respond(1)->priority ?? "" }}</td>
      <td>{{$respondent->mrt_improvement_respond(2)->priority ?? "" }}</td>
      <td>{{$respondent->mrt_improvement_respond(3)->priority ?? "" }}</td>
      <td>{{$respondent->mrt_improvement_respond(4)->priority ?? "" }}</td>
      <td>{{$respondent->mrt_improvement_respond(5)->priority ?? "" }}</td>
      <td>{{$respondent->mrt_improvement_respond(6)->priority ?? "" }}</td>
      <td>{{$respondent->mrt_improvement_respond(7)->priority ?? "" }}</td>
      <td>{{$respondent->mrt_improvement_respond(8)->priority ?? "" }}</td>
      <td>{{$respondent->mrt_improvement_respond(9)->priority ?? "" }}</td>
      <td>{{$respondent->mrt_improvement_respond(10)->priority ?? "" }}</td>
      <td>{{$respondent->mrt_cost}}</td>
      <td>{{$respondent->work_place_parking_system->description ?? ""}}</td>
      <td>{{$respondent->willingness_public_transport_trip->description  ?? ""}}</td>
    </tr>
    @endforeach
  </tbody>

</table>
