<table>
  <thead>
    <tr>
      <th rowspan="2" style="text-align:center;font-weight:bold">Id</th>
      <th colspan="6" style="text-align:center;font-weight:bold">Feeder Park</th>
    </tr>
    <tr>
      <th style="text-align:center;font-weight:bold">3500</th>
      <th style="text-align:center;font-weight:bold">5000</th>
      <th style="text-align:center;font-weight:bold">7000</th>
      <th style="text-align:center;font-weight:bold">8000</th>
      <th style="text-align:center;font-weight:bold">10000</th>
      <th style="text-align:center;font-weight:bold">20000</th>
    </tr>
  </thead>
  <tbody>
    @foreach($respondents as $respondent)
    <tr>
      @php
      $park3500 = $respondent->sp_feeder_park_respond(1)->respond ?? "" ;
      $park5000 = $respondent->sp_feeder_park_respond(2)->respond ?? "" ;
      $park7000 = $respondent->sp_feeder_park_respond(3)->respond ?? "" ;
      $park8000 = $respondent->sp_feeder_park_respond(4)->respond ?? "" ;
      $park10000 = $respondent->sp_feeder_park_respond(5)->respond ?? "" ;
      $park12000 = $respondent->sp_feeder_park_respond(6)->respond ?? "" ;
      @endphp
      <td>{{$respondent->id}}</td>
      <td>{{$park3500}}</td>
      <td>{{$park5000}}</td>
      <td>{{$park7000}}</td>
      <td>{{$park8000}}</td>
      <td>{{$park10000}}</td>
      <td>{{$park12000}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
