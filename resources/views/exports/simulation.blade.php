<table>
  <thead>
    <tr>
      <th style="text-align:center;font-weight:bold">Id</th>
      <th style="text-align:center;font-weight:bold">Jarak ke Stasiun</th>
      <th style="text-align:center;font-weight:bold">Durasi ke Stasiun</th>
      <th style="text-align:center;font-weight:bold">Stasiun Naik</th>
      <th style="text-align:center;font-weight:bold">Jarak MRT</th>
      <th style="text-align:center;font-weight:bold">Durasi MRT</th>
      <th style="text-align:center;font-weight:bold">Stasiun turun</th>
      <th style="text-align:center;font-weight:bold">Jarak ke tujuan</th>
      <th style="text-align:center;font-weight:bold">Durasi ke tujuan</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($respondents as $v)
    <tr>
      <td>
        {{$v->id}}
      </td>
      <td>
        {{$v->origin_station_distance}}
      </td>
      <td>
          {{$v->origin_station_duration}}
      </td>
      <td>
          {{$v->station_respondents()->where('point','origin')->first()->station()->first()->name}}
      </td>
      <td>
        {{$v->mrt_distance}}
      </td>
      <td>
        {{$v->mrt_duration}}
      </td>
      <td>
        {{$v->station_respondents()->where('point','destination')->first()->station()->first()->name}}
      </td>
      <td>
        {{$v->destination_station_distance}}
      </td>
      <td>
            {{$v->destination_station_duration}}
      </td>
      </tr>
    @endforeach
  </tbody>
</table>
