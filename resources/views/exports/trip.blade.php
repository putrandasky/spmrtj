<table>
  <thead>
    <tr>
      <th rowspan="2" style="text-align:center;font-weight:bold">Id</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">O (Lat)</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">O (Lng)</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">D (Lat)</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">D (Lng)</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">O (Alamat)</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">D (Alamat)</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">Distance</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">Duration</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">Purpose</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">Travel Model</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">Frequence</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">Parking Guarantor</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">Parking Cost</th>
      <th rowspan="2" style="text-align:center;font-weight:bold">Parking Type</th>
      @for ($i = 0; $i < $max_travel_detail; $i++) <th colspan="4" style="text-align:center;font-weight:bold">
        Transportation Detail ke {{$i + 1}}</th>
        @endfor
    </tr>
    <tr>
      @for ($i = 0; $i < $max_travel_detail; $i++)
      <th style="text-align:center;font-weight:bold">Mode</th>
        <th style="text-align:center;font-weight:bold">Duration</th>
        <th style="text-align:center;font-weight:bold">Waiting</th>
        <th style="text-align:center;font-weight:bold">Cost</th>
        @endfor

    </tr>
  </thead>
  <tbody>
    @foreach ($respondents as $v)
    <tr>
      <td>{{$v->id}}</td>
      <td>{{$v->origin_lat}}</td>
      <td>{{$v->origin_lng}}</td>
      <td>{{$v->destination_lat}}</td>
      <td>{{$v->destination_lng}}</td>
      <td>{{$v->origin}}</td>
      <td>{{$v->destination}}</td>
      <td>{{$v->google_distance}}</td>
      <td>{{$v->google_duration}}</td>
      <td>{{$v->travel_purpose->description}}</td>
      <td>
        {{$v->travel_model == 0 ? "Pribadi" :  $v->travel_model == 1 ? "Umum" : $v->travel_model == 2 ? "Campuran" : null }}
      </td>
      <td>{{$v->travel_frequency}}</td>
      <td>{{$v->parking_guarantor ? $v->parking_guarantor->description : null}}</td>
      <td>{{$v->parking_cost}}</td>
      <td>{{$v->parking_type ? $v->parking_type->description : null}}</td>
      @foreach ($v->travel_details as $a)
      <td>{{$a->transportation_mode->description}}</td>
      <td>{{$a->travel_duration}}</td>
      <td>{{$a->waiting_duration}}</td>
      <td>{{$a->travel_cost}}</td>
      @endforeach

    </tr>
    @endforeach
  </tbody>
</table>
