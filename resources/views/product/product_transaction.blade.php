@php
    $pfs = $inv_settings->posting_field_show != "" ? explode(',',$inv_settings->posting_field_show) : explode(',',',,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,');
    $pfsl = explode(',', $inv_settings->posting_field_label);
    // dd($inv_settings->posting_field_show)
@endphp

<table class="table table-hover table-bordered">
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
                    <td width="25%"><select width="100%" name="product[]" data-row="{{ $trs }}" class="form-control product_search product"></select></td>

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
                        <td class="text-center"><button type="button" class="btn btn-sm btn-info text-white details" style="display: none"><i class="fas fa-info"></i></button></td>
                    @endif
                    @if (in_array(6, $pfs))
                        <td class="text-center buy_price"></td>
                    @endif
                    @if (in_array(7, $pfs))
                        <td class="text-center buy_price_code"></td>
                    @endif
                    @if (in_array(8, $pfs))
                        <td class="text-center sell_price"></td>
                    @endif
                    @if (in_array(9, $pfs))
                        <td class="text-center sell_price_code"></td>
                    @endif
                    @if (in_array(10, $pfs))
                        <td><input type="number" value="" onkeyup="calculate()" class="form-control text-center discount_percentage discount_percentage{{$trs}}" readonly="true"></td>
                    @endif
                    @if (in_array(11, $pfs))
                        <td><input type="number" value="" onkeyup="calculate()" class="form-control text-center manual_discount manual_discount{{$trs}}" readonly="true"></td>
                    @endif
                    @if (in_array(12, $pfs))
                        <td class="text-center product_code"></td>
                    @endif
                    @if (in_array(13, $pfs))
                        <td class="text-center last_purchase_history"></td>
                    @endif
                    <td><input type="number" name="qty[]" value="" onkeyup="calculate()" class="form-control text-center qty qty{{$trs}}" readonly="true"></td>
                    <td><input type="number" name="price[]" onkeyup="calculate()" class="form-control text-center price price{{$trs}}" readonly="true"></td>
                    <td><input type="text" name="total[]" class="form-control text-center total total{{$trs}}" readonly="true"></td>
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
            <td width="25%"><select width="100%" name="product[]" data-row="${ trs }" class="form-control product_search product"></select></td>`;

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
                rowHtml += `<td class="text-center"><button class="btn btn-sm btn-info text-white details" style="display: none"><i class="fas fa-info"></i></button></td>`;
            }
            if(pfs.includes('6')){
                rowHtml += `<td class="text-center buy_price"></td>`;
            }
            if(pfs.includes('7')){
                rowHtml += `<td class="text-center buy_price_code"></td>`;
            }
            if(pfs.includes('8')){
                rowHtml += `<td class="text-center sell_price"></td>`;
            }
            if(pfs.includes('9')){
                rowHtml += `<td class="text-center sell_price_code"></td>`;
            }
            if(pfs.includes('10')){
                rowHtml += `<td><input type="number" value="" data-row="${ trs }" onkeyup="calculate()" class="form-control text-center discount_percentage discount_percentage${trs}" readonly="true"></td>`;
            }
            if(pfs.includes('11')){
                rowHtml += `<td><input type="number" value="" data-row="${ trs }" onkeyup="calculate()" class="form-control text-center manual_discount manual_discount${trs}" readonly="true"></td>`;
            }
            if(pfs.includes('12')){
                rowHtml += `<td class="text-center product_code"></td>`;
            }
            if(pfs.includes('13')){
                rowHtml += `<td class="text-center last_purchase_history"></td>`;
            }
            rowHtml += `<td><input type="number" name="qty[]" data-row="${ trs }" onkeyup="calculate()" value="" class="form-control text-center qty qty${trs}" readonly="true"></td>
            <td><input type="number" name="price[]" data-row="${ trs }" onkeyup="calculate()" class="form-control text-center price price${trs}" readonly="true"></td>
            <td><input type="text" name="total[]" data-row="${ trs }" class="form-control text-center total total${trs}" readonly="true"></td>
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
            $(`.tr${row}`).children().children('.details').attr('onclick', `showProductDetails(${product_id})`).show();
            $(`.tr${row}`).children('.buy_price').text(info.buy_price);
            $(`.tr${row}`).children('.buy_price_code').text(info.buy_price_code);
            $(`.tr${row}`).children('.sell_price').text(info.sell_price);
            $(`.tr${row}`).children('.sell_price_code').text(info.sell_price_code);
            $(`.tr${row}`).children().children('.discount_percentage').attr('readonly', false).val(0);
            $(`.tr${row}`).children().children('.manual_discount').attr('readonly', false).val(0);
            $(`.tr${row}`).children('.product_code').text(info.product_code);
            $(`.tr${row}`).children().children('.qty').attr('readonly', false).val(0);
            $(`.tr${row}`).children().children('.price').attr('readonly', false).val(info.buy_price);
            $(`.tr${row}`).children().children('.total').val(0);
            calculate();
        }, 'get', "{{ route('common.get_product_details') }}", {transaction: 1,id:product_id});
    }


    function calculate(){
        $('.product').each(function(){
            cur_row = $(this).attr('data-row');
            if($(this).val() != null){
                price = $(`.price${cur_row}`).val();
                qty = $(`.qty${cur_row}`).val();
                discount_percentage = $(`.discount_percentage${cur_row}`).val();
                manual_discount = $(`.manual_discount${cur_row}`).val();
                if(price == undefined){
                    price = 0;
                }
                if(qty == undefined){
                    qty = 0;
                }
                if(discount_percentage == undefined){
                    discount_percentage = 0;
                }
                if(manual_discount == undefined){
                    manual_discount = 0;
                }
                total = (parseFloat(price*qty))-parseFloat(manual_discount)-parseFloat((discount_percentage/100)*(price*qty));
                $(`.total${cur_row}`).val(parseFloat(total).toFixed(2));
                console.log(price, qty, discount_percentage, manual_discount);
            }
        });
    }
</script>
