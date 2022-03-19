@php
    $pfs = $inv_settings->posting_field_show != "" ? explode(',',$inv_settings->posting_field_show) : explode(',',',,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,');
    $pfsl = explode(',', $inv_settings->posting_field_label);
    // dd($inv_settings->posting_field_show)
@endphp

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="text-center">Sl</th>
            <th class="text-center">Product Name</th>
                @if ($inv_settings->posting_field_show != "")
                    @foreach($pfs as $row)
                    {{-- @php $row = intVal($row) @endphp --}}
                        <th class="text-center">{{ $pfsl[$row-1] }}</th>
                    @endforeach
                @endif
            <th class="text-center">Qty</th>
            <th class="text-center">Price</th>
            <th class="text-center">Total</th>
        </tr>
    </thead>
      <tbody>
          @for($i=1;$i<=5;$i++)
              <tr>
                    <td class="text-center">{{ $i }}</td>
                    <td width="25%"><select width="100%" name="product[]" class="form-control product_search"></select></td>

                    @if (in_array(1, $pfs))
                        <td><input type="text" value="" class="form-control text-center" readonly></td>
                    @endif
                    @if (in_array(2, $pfs))
                        <td><input type="text" value="" class="form-control text-center" readonly></td>
                    @endif
                    @if (in_array(3, $pfs))
                        <td><input type="text" value="" class="form-control text-center" readonly></td>
                    @endif
                    @if (in_array(4, $pfs))
                        <td><input type="text" value="" class="form-control text-center" readonly></td>
                    @endif
                    @if (in_array(5, $pfs))
                        <td><input type="text" value="" class="form-control text-center" readonly></td>
                    @endif
                    @if (in_array(6, $pfs))
                        <td><input type="text" value="" class="form-control text-center" readonly></td>
                    @endif
                    @if (in_array(7, $pfs))
                        <td><input type="text" value="" class="form-control text-center" readonly></td>
                    @endif
                    @if (in_array(8, $pfs))
                        <td><input type="text" value="" class="form-control text-center" readonly></td>
                    @endif
                    @if (in_array(9, $pfs))
                        <td><input type="text" value="" class="form-control text-center" readonly></td>
                    @endif
                    @if (in_array(10, $pfs))
                        <td><input type="text" value="" class="form-control text-center" readonly></td>
                    @endif
                    @if (in_array(11, $pfs))
                        <td><input type="text" value="" class="form-control text-center" readonly></td>
                    @endif
                    @if (in_array(12, $pfs))
                        <td><input type="text" value="" class="form-control text-center" readonly></td>
                    @endif
                    @if (in_array(13, $pfs))
                        <td><input type="text" value="" class="form-control text-center" readonly></td>
                    @endif
                    <td><input type="text" name="qty[]" value="" class="form-control text-center" readonly></td>
                    <td><input type="text" name="price[]" class="form-control text-center" readonly></td>
                    <td><input type="text" name="total[]" class="form-control text-center" readonly></td>
              </tr>
          @endfor
      </tbody>
</table>

<script>

</script>
