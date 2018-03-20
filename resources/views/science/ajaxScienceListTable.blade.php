<thead>
    <tr class="headings text-center">
        <th class="column-title"> STT </th>
        <th class="column-title"> Khóa Học </th>
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
    </tr>
@endforeach
</tbody>
