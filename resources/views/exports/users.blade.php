<table id="kt_table_accounts" class="table table-row-bordered">
    <thead>
    <tr>
        <th> {{ucwords(__('common.number'))}}</th>
        <th> {{ucwords(__('common.id'))}}</th>
        <th> {{ucwords(__('common.name'))}}</th>
        <th> {{ucwords(__('common.email'))}}</th>
    </tr>
    </thead>
    <tbody>
    <?php $x = 1; ?>
    @forelse($items as $item)
        <tr class="odd gradeX" id="tr-{{ $item->id }}">
            <td>{{$x++}}</td>
            <td> {{$item->id}}</td>
            <td> {{$item->full_name}}</td>
            <td> {{$item->email}}</td>
        </tr>
    @empty
    @endforelse
    </tbody>
</table>