<table>
  <thead>
    <tr>
      <th rowspan="2" style="text-align:center;font-weight:bold">Id</th>
      <th colspan="20" style="text-align:center;font-weight:bold">Feeder Reguler</th>
      <th colspan="6" style="text-align:center;font-weight:bold">Feeder Premium</th>

    </tr>
    <tr>
      <th style="text-align:center;font-weight:bold">$X4Y4</th>
      <th style="text-align:center;font-weight:bold">$X4Y5</th>
      <th style="text-align:center;font-weight:bold">$X4Y6</th>
      <th style="text-align:center;font-weight:bold">$X4Y3</th>
      <th style="text-align:center;font-weight:bold">$X4Y2</th>
      <th style="text-align:center;font-weight:bold">$X4Y1</th>
      <th style="text-align:center;font-weight:bold">$X3Y4</th>
      <th style="text-align:center;font-weight:bold">$X3Y3</th>
      <th style="text-align:center;font-weight:bold">$X3Y2</th>
      <th style="text-align:center;font-weight:bold">$X3Y1</th>
      <th style="text-align:center;font-weight:bold">$X2Y4</th>
      <th style="text-align:center;font-weight:bold">$X2Y3</th>
      <th style="text-align:center;font-weight:bold">$X2Y2</th>
      <th style="text-align:center;font-weight:bold">$X2Y1</th>
      <th style="text-align:center;font-weight:bold">$X1Y4</th>
      <th style="text-align:center;font-weight:bold">$X1Y3</th>
      <th style="text-align:center;font-weight:bold">$X1Y2</th>
      <th style="text-align:center;font-weight:bold">$X1Y1</th>
      <th style="text-align:center;font-weight:bold">$X1Y5</th>
      <th style="text-align:center;font-weight:bold">$X1Y6</th>
      <th style="text-align:center;font-weight:bold">20000</th>
      <th style="text-align:center;font-weight:bold">18000</th>
      <th style="text-align:center;font-weight:bold">15000</th>
      <th style="text-align:center;font-weight:bold">12000</th>
      <th style="text-align:center;font-weight:bold">8000</th>
      <th style="text-align:center;font-weight:bold">5000</th>
    </tr>
  </thead>
  <tbody>
    @foreach($respondents as $respondent)
    <tr>
      @php
      $time_concern = $respondent->sp_feeder_reguler_respond(4,3) || $respondent->sp_feeder_reguler_respond(3,4) ? true : false ;
      $cost_concern = $respondent->sp_feeder_reguler_respond(4,5) ? true : false;
      $X4Y4 = $respondent->sp_feeder_reguler_respond(4,4)->respond;
      $X4Y5 = $time_concern  ? '' : $respondent->sp_feeder_reguler_respond(4,5)->respond ?? 1;
      $X4Y6 = $time_concern  ? '' : $respondent->sp_feeder_reguler_respond(4,6)->respond ?? 1;
      $X4Y3 = $cost_concern  ? '' : $respondent->sp_feeder_reguler_respond(4,3)->respond ?? 0;
      $X4Y2 = $cost_concern  ? '' : $respondent->sp_feeder_reguler_respond(4,2)->respond ?? 0;
      $X4Y1 = $cost_concern  ? '' : $respondent->sp_feeder_reguler_respond(4,1)->respond ?? 0;
      $X3Y4 = $cost_concern  ? '' : $respondent->sp_feeder_reguler_respond(3,4)->respond ?? ($X4Y4 == 1 ? 1 : 0);
      $X3Y3 = $cost_concern  ? '' : $respondent->sp_feeder_reguler_respond(3,3)->respond ?? ($X4Y3 == 1 ? 1 : 0);
      $X3Y2 = $cost_concern  ? '' : $respondent->sp_feeder_reguler_respond(3,2)->respond ?? ($X4Y2 == 1 ? 1 : 0);
      $X3Y1 = $cost_concern  ? '' : $respondent->sp_feeder_reguler_respond(3,1)->respond ?? ($X4Y1 == 1 ? 1 : 0);
      $X2Y4 = $cost_concern  ? '' : $respondent->sp_feeder_reguler_respond(2,4)->respond ?? 1;
      $X2Y3 = $cost_concern  ? '' : $respondent->sp_feeder_reguler_respond(2,3)->respond ?? ($X3Y3 == 1 ? 1 : 0);
      $X2Y2 = $cost_concern  ? '' : $respondent->sp_feeder_reguler_respond(2,2)->respond ?? ($X3Y2 == 1 ? 1 : 0);
      $X2Y1 = $cost_concern  ? '' : $respondent->sp_feeder_reguler_respond(2,1)->respond ?? ($X3Y1 == 1 ? 1 : 0);
      $X1Y4 = $cost_concern  ? '' : $respondent->sp_feeder_reguler_respond(1,4)->respond ?? 1;
      $X1Y3 = $cost_concern  ? '' : $respondent->sp_feeder_reguler_respond(1,3)->respond ?? ($X2Y3 == 1 ? 1 : 0);
      $X1Y2 = $cost_concern  ? '' : $respondent->sp_feeder_reguler_respond(1,2)->respond ?? ($X2Y2 == 1 ? 1 : 0);
      $X1Y1 = $cost_concern  ? '' : $respondent->sp_feeder_reguler_respond(1,1)->respond ?? ($X2Y1 == 1 ? 1 : 0);
      $X1Y5 = $cost_concern  ? '' : $respondent->sp_feeder_reguler_respond(1,5)->respond ?? 1;
      $X1Y6 = $cost_concern  ? '' : $respondent->sp_feeder_reguler_respond(1,6)->respond ?? 1;
      $premium20000 = $respondent->sp_feeder_premium_respond(1)->respond ;
      $premium18000 = $respondent->sp_feeder_premium_respond(2)->respond ?? $premium20000 ;
      $premium15000 = $respondent->sp_feeder_premium_respond(3)->respond ?? $premium18000 ;
      $premium12000 = $respondent->sp_feeder_premium_respond(4)->respond ?? $premium15000 ;
      $premium8000 = $respondent->sp_feeder_premium_respond(5)->respond ?? $premium12000 ;
      $premium5000 = $respondent->sp_feeder_premium_respond(6)->respond ?? $premium8000 ;
      @endphp
      <td>{{$respondent->id}}</td>
      <td>{{$X4Y4}}</td>
      <td>{{$X4Y5}}</td>
      <td>{{$X4Y6}}</td>
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
      <td>{{$premium20000}}</td>
      <td>{{$premium18000}}</td>
      <td>{{$premium15000}}</td>
      <td>{{$premium12000}}</td>
      <td>{{$premium8000}}</td>
      <td>{{$premium5000}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
