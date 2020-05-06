<table>
  <thead>
    <tr>
      <th rowspan="2" style="text-align:center;font-weight:bold">Id</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">Current</th>
      <th colspan="8" style="text-align:center;font-weight:bold">Alasan tidak nyaman </th>
      <th colspan="7" style="text-align:center;font-weight:bold">Fasilitas </th>
      <th rowspan="2" style="text-align:center;font-weight:bold">Potensi</th>

    </tr>
    <tr>
      @for ($i = 0; $i < 8; $i++)
      <th  style="text-align:center;font-weight:bold">
        {{$i + 1}}</th>
        @endfor
      @for ($i = 0; $i < 7; $i++)
      <th  style="text-align:center;font-weight:bold">
        {{$i + 1}}</th>
        @endfor
    </tr>
  </thead>
  <tbody>
    @foreach($respondents as $respondent)
    @php
    $has_pedestrian_others = $respondent->sp_pedestrian_respond(2,9) ? 1 : 0;
@endphp
    <tr>
      <td>{{$respondent->id}}</td>
      <td>{{$respondent->sp_pedestrians()->where('question_id',1)->first()->sp_pedestrian_choice()->first()->description}}</td>
      <td>{{$respondent->sp_pedestrian_respond(2,3)? 1 : 0}}</td>
      <td>{{$respondent->sp_pedestrian_respond(2,4)? 1 : 0}}</td>
      <td>{{$respondent->sp_pedestrian_respond(2,5)? 1 : 0}}</td>
      <td>{{$respondent->sp_pedestrian_respond(2,6)? 1 : 0}}</td>
      <td>{{$respondent->sp_pedestrian_respond(2,7)? 1 : 0}}</td>
      <td>{{$respondent->sp_pedestrian_respond(2,8)? 1 : 0}}</td>
      <td>{{$has_pedestrian_others}}</td>
      <td>{{$has_pedestrian_others == 1 ? ($respondent->sp_pedestrian_respond(2,9)->sp_pedestrian_other()->first() ? $respondent->sp_pedestrian_respond(2,9)->sp_pedestrian_other()->first()->description : '') : ''}}</td>
      <td>{{$respondent->sp_pedestrian_respond(3,10)? 1 : 0}}</td>
      <td>{{$respondent->sp_pedestrian_respond(3,11)? 1 : 0}}</td>
      <td>{{$respondent->sp_pedestrian_respond(3,12)? 1 : 0}}</td>
      <td>{{$respondent->sp_pedestrian_respond(3,13)? 1 : 0}}</td>
      <td>{{$respondent->sp_pedestrian_respond(3,14)? 1 : 0}}</td>
      <td>{{$respondent->sp_pedestrian_respond(3,15)? 1 : 0}}</td>
      <td>{{$respondent->sp_pedestrian_respond(3,16)? 1 : 0}}</td>
      <td>{{$respondent->sp_pedestrians()->where('question_id',4)->first()->sp_pedestrian_choice()->first()->description}}</td>

    </tr>
    @endforeach
  </tbody>
</table>
