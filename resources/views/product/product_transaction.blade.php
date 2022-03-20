@php
    $pfs = $inv_settings->posting_field_show != "" ? explode(',',$inv_settings->posting_field_show) : explode(',',',,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,');
    $pfsl = explode(',', $inv_settings->posting_field_label);
    // dd($inv_settings->posting_field_show)
@endphp

<table class="table table-striped table-hover table-bordered">
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
          @for($trs=1;$trs<=5;$trs++)
              <tr class="tr{{ $trs }}">
                    <td class="text-center">{{ $trs }}</td>
                    <td width="25%"><select width="100%" name="product[]" data-row="{{ $trs }}" class="form-control product_search"></select></td>

                    @if (in_array(1, $pfs))
                        <td class="text-center local_name"></td>
                    @endif
                    @if (in_array(2, $pfs))
                        <td class="text-center avail_qty"></td>
                    @endif
                    @if (in_array(3, $pfs))
                        <td class="text-center unit"></td>
                    @endif
                    @if (in_array(4, $pfs))
                        <td><input type="text" value="" class="form-control text-center description" readonly="true"></td>
                    @endif
                    @if (in_array(5, $pfs))
                        <td class="text-center"><button type="button" class="btn btn-sm btn-info text-white details"><i class="fas fa-info"></i></button></td>
                    @endif
                    @if (in_array(6, $pfs))
                        <td class="text-center buy_price"></td>
                    @endif
                    @if (in_array(7, $pfs))
                        <td class="text-center buy_price_code"></td>
                    @endif
                    @if (in_array(8, $pfs))
                        <td><input type="text" value="" class="form-control text-center sell_price" readonly="true"></td>
                    @endif
                    @if (in_array(9, $pfs))
                        <td class="text-center sell_price_code"></td>
                    @endif
                    @if (in_array(10, $pfs))
                        <td><input type="text" value="" class="form-control text-center discount_percentage" readonly="true"></td>
                    @endif
                    @if (in_array(11, $pfs))
                        <td><input type="text" value="" class="form-control text-center manual_discount" readonly="true"></td>
                    @endif
                    @if (in_array(12, $pfs))
                        <td class="text-center product_code"></td>
                    @endif
                    @if (in_array(13, $pfs))
                        <td class="text-center last_purchase_history"></td>
                    @endif
                    <td><input type="text" name="qty[]" value="" class="form-control text-center" readonly="true"></td>
                    <td><input type="text" name="price[]" class="form-control text-center" readonly="true"></td>
                    <td><input type="text" name="total[]" class="form-control text-center" readonly="true"></td>
              </tr>
          @endfor
      </tbody>
</table>

@include('product.product.details_modal')

<script>
    let trs = 6;
    let pfs = @json($pfs);
    let pfsl = @json($pfsl);
    function addNewRow(){
        // console.log("-----------", pfs);
        let rowHtml = `
        <tr class="tr${ trs }">
            <td class="text-center">${ trs }</td>
            <td width="25%"><select width="100%" name="product[]" data-row="${ trs }" class="form-control product_search"></select></td>`;

            if(pfs.includes('1')){
                rowHtml += `<td class="text-center local_name"></td>`;
            }
            if(pfs.includes('2')){
                rowHtml += `<td class="text-center avail_qty"></td>`;
            }
            if(pfs.includes('3')){
                rowHtml += `<td class="text-center unit"></td>`;
            }
            if(pfs.includes('4')){
                rowHtml += `<td><input type="text" value="" class="form-control text-center description" readonly="true"></td>`;
            }
            if(pfs.includes('5')){
                rowHtml += `<td class="text-center"><button class="btn btn-sm btn-info text-white"><i class="fas fa-info"></i></button></td>`;
            }
            if(pfs.includes('6')){
                rowHtml += `<td class="text-center buy_price"></td>`;
            }
            if(pfs.includes('7')){
                rowHtml += `<td class="text-center buy_price_code"></td>`;
            }
            if(pfs.includes('8')){
                rowHtml += `<td><input type="text" value="" class="form-control text-center sell_price" readonly="true"></td>`;
            }
            if(pfs.includes('9')){
                rowHtml += `<td class="text-center sell_price_code"></td>`;
            }
            if(pfs.includes('10')){
                rowHtml += `<td><input type="text" value="" class="form-control text-center discount_percentage" readonly="true"></td>`;
            }
            if(pfs.includes('11')){
                rowHtml += `<td><input type="text" value="" class="form-control text-center manual_discount" readonly="true"></td>`;
            }
            if(pfs.includes('12')){
                rowHtml += `<td class="text-center product_code"></td>`;
            }
            if(pfs.includes('13')){
                rowHtml += `<td class="text-center last_purchase_history"></td>`;
            }
            rowHtml += `<td><input type="text" name="qty[]" value="" class="form-control text-center" readonly="true"></td>
            <td><input type="text" name="price[]" class="form-control text-center" readonly="true"></td>
            <td><input type="text" name="total[]" class="form-control text-center" readonly="true"></td>
        </tr>`;
        $('.product_transaction_table tbody').append(rowHtml);
        remote_select('product_search','common/product-live-search', true, "Select Product", true);
        trs++;
    }



    function setProductInfo(product_id,row){
        customAjaxCall(function(res){
            console.log("p", product_id,row);
            console.log("res", res);
            info = res.info;
            $(`.tr${row}`).children('.local_name').text(info.local_name);
            $(`.tr${row}`).children('.avail_qty').text(0);
            $(`.tr${row}`).children('.unit').text(info.get_unit.name);
            $(`.tr${row}`).children().children('.description').attr('readonly', false);
            $(`.tr${row}`).children().children('.details').attr('onclick', `showProductDetails(${product_id})`);
        }, 'get', "{{ route('common.get_product_details') }}", {transaction: 1,id:product_id});
    }
</script>
