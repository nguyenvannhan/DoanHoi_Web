<thead>
    <tr class="headings">
        <th class="column-title center"> STT </th>
        <th class="column-title center"> Năm học </th>
    </tr>
</thead>
<tbody>
@php
    $i=1;
@endphp
@foreach ($school_year_list as $school_year)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $school_year->name }}</td>
    </tr>
@endforeach
</tbody>
