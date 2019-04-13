    <table id="tblItems" class="table table-hover table-stripped">
    <thead>
        <tr>
            <th width="60%">الصنف</th>
            <th width="40%">الكمية</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $i)
        <tr>
            <td>{{$i->Item->name}}</td>
            <td>{{$i->quantity}} {{$i->Unit->name}}</td>
        </tr>
        @endforeach()
    </tbody>
</table>