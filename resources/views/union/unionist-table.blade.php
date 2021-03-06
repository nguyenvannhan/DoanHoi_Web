<thead>
    <tr class="headings text-center">
        <th class="column-title">MSSV</th>
        <th class="column-title">Họ tên</th>
        <th class="column-title">Chi đoàn</th>
        @if($user->level != 2)
        <th></th>
        @endif
    </tr>
</thead>
<tbody>
    @foreach($items as $item)
    <tr>
        <td class="text-center">{{ $item->id }}</td>
        <td>{{ $item->name }}</td>
        <td class="text-center">{{ $item->ClassOb->name }}</td>
        @if($user->level != 2)
        <td class="text-center">
            <a class="{{ $type_id == 1 ? 'remove_cyu' : 'update_cyu' }}" data-id="{{ $item->id }}"><i class="fa {{ $type_id == 1 ? 'fa-times red' : 'fa-check green' }}"></i></a>
        </td>
        @endif
    </tr>
    @endforeach
</tbody>
