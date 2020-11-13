<table>
  <thead>
    <tr>
      <th style="text-align:center;font-weight:bold">Id</th>
      <th style="text-align:center;font-weight:bold">Point PR</th>
      <th style="text-align:center;font-weight:bold">Jarak</th>
    </tr>

  </thead>
  <tbody>
    @foreach($respondents as $respondent)
    <tr>
      <td>{{$respondent->respondent_id}}</td>
    <td>{{$respondent->park_ride_point->description}}</td>
    <td>{{$respondent->distance}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
