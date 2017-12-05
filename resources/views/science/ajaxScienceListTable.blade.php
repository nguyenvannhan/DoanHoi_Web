<thead>
    <tr class="headings text-center">
        <th class="column-title"> STT </th>
        <th class="column-title"> Khóa Học </th>
        <th class="column-title"> Action </th>
    </tr>
</thead>
<tbody>
<?php
    $i=1;
?>
@foreach ($scienceList as $science)
    <tr class="text-center">
        <td>
            <?php echo $i; $i++; ?>
        </td>
        <td>
            {{ $science->name }}
        </td>
        <td class="action-column">
            <a href="#"> Xem danh sách SV Khóa {{ $science->name }} </a>
        </td>
    </tr>
@endforeach
</tbody>
