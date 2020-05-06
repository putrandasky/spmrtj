<table>
  <thead>
    <tr>
      <th style="text-align:center;font-weight:bold">Id</th>
      <th style="text-align:center;font-weight:bold">X1Y1</th>
      <th style="text-align:center;font-weight:bold">X1Y2</th>
      <th style="text-align:center;font-weight:bold">X1Y3</th>
      <th style="text-align:center;font-weight:bold">X1Y4</th>
      <th style="text-align:center;font-weight:bold">X2Y1</th>
      <th style="text-align:center;font-weight:bold">X2Y2</th>
      <th style="text-align:center;font-weight:bold">X2Y3</th>
      <th style="text-align:center;font-weight:bold">X2Y4</th>
      <th style="text-align:center;font-weight:bold">X3Y1</th>
      <th style="text-align:center;font-weight:bold">X3Y2</th>
      <th style="text-align:center;font-weight:bold">X3Y3</th>
      <th style="text-align:center;font-weight:bold">X3Y4</th>
      <th style="text-align:center;font-weight:bold">X4Y1</th>
      <th style="text-align:center;font-weight:bold">X4Y2</th>
      <th style="text-align:center;font-weight:bold">X4Y3</th>
      <th style="text-align:center;font-weight:bold">X4Y4</th>
    </tr>
  </thead>
  <tbody>
    @foreach($respondents as $respondent)
    <tr>
      @php
      $X1Y1 = $respondent->sp_motor_respond(1,1)->respond;
      $X1Y2 = $respondent->sp_motor_respond(1,2)->respond ?? 0;
      $X1Y3 = $respondent->sp_motor_respond(1,3)->respond ?? 0;
      $X1Y4 = $respondent->sp_motor_respond(1,4)->respond ?? 0;
      $X2Y1 = $respondent->sp_motor_respond(2,1)->respond ?? 1;
      $X2Y2 = $respondent->sp_motor_respond(2,2)->respond ?? $X1Y2 == 1 ? 1 : 0;
      $X2Y3 = $respondent->sp_motor_respond(2,3)->respond ?? $X1Y3 == 1 ? 1 : 0;
      $X2Y4 = $respondent->sp_motor_respond(2,4)->respond ?? $X1Y4 == 1 ? 1 : 0;
      $X3Y1 = $respondent->sp_motor_respond(3,1)->respond ?? 1;
      $X3Y2 = $respondent->sp_motor_respond(3,2)->respond ?? $X2Y2 == 1 ? 1 : 0;
      $X3Y3 = $respondent->sp_motor_respond(3,3)->respond ?? $X2Y3 == 1 ? 1 : 0;
      $X3Y4 = $respondent->sp_motor_respond(3,4)->respond ?? $X2Y4 == 1 ? 1 : 0;
      $X4Y1 = $respondent->sp_motor_respond(4,1)->respond ?? 1;
      $X4Y2 = $respondent->sp_motor_respond(4,2)->respond ?? $X3Y2 == 1 ? 1 : 0;
      $X4Y3 = $respondent->sp_motor_respond(4,3)->respond ?? $X3Y3 == 1 ? 1 : 0;
      $X4Y4 = $respondent->sp_motor_respond(4,4)->respond ?? $X3Y4 == 1 ? 1 : 0;
      @endphp
      <td>{{$respondent->id}}</td>
      <td>{{$X1Y1}}</td>
      <td>{{$X1Y2}}</td>
      <td>{{$X1Y3}}</td>
      <td>{{$X1Y4}}</td>
      <td>{{$X2Y1}}</td>
      <td>{{$X2Y2}}</td>
      <td>{{$X2Y3}}</td>
      <td>{{$X2Y4}}</td>
      <td>{{$X3Y1}}</td>
      <td>{{$X3Y2}}</td>
      <td>{{$X3Y3}}</td>
      <td>{{$X3Y4}}</td>
      <td>{{$X4Y1}}</td>
      <td>{{$X4Y2}}</td>
      <td>{{$X4Y3}}</td>
      <td>{{$X4Y4}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
