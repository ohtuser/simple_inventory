{{-- Jquery --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="{{ asset('jquery.js') }}"></script>
{{-- JS assets --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> --}}
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/sidebar_toggle.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script> --}}
<script src="{{ asset('js/chart.js') }}"></script>
<script src="{{ asset('js/assets/charts/chart-area-demo.js') }}"></script>
<script src="{{ asset('js/assets/charts/chart-bar-demo.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script> --}}
<script src="{{ asset('js/simple-datatables.js') }}"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
{{-- select2 --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
<script src="{{ asset('js/select2.min.js') }}"></script>
{{-- sweet alert 2 --}}
{{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
<script src="{{ asset('js/sweetalert2.js') }}"></script>
{{-- data table --}}

{{-- flatpicker --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}
<script src="{{ asset('js/flatpickr.js') }}"></script>
{{-- common blade --}}
@include('layouts.common');

<script>
    $(document).ready(function() {
        $("input[type='number']").attr('onfocus', "this.select()");

        flatpickr(".flatpicker", {
            dateFormat: "d-m-Y",
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        let product_transaction_table_height = $('.product_transaction_table').offset().top;
        $('.product_transaction_table').css('max-height',
            `calc(100vh - ${product_transaction_table_height}px)`);
    });

    remote_select('product_search', 'common/product-live-search', true, "Select Product", true);
    remote_select('vendor_search', 'common/vendor-live-search', true, "Select Vendor", false);
    remote_select('customer_search', 'common/customer-live-search', true, "Select Client", false);
    remote_select('delivery_by_search', 'common/delivery-by-live-search', true, "Delivery By", false);

    function remote_select(cls, url = "", clear = false, placeholder = "", is_product = false) {
        $('.' + cls).select2({
            placeholder: placeholder,
            allowClear: clear,
            minimumInputLength: 2,
            ajax: {
                url: '/' + url,
                dataType: 'json',
                type: "GET",
                quietMillis: 50,
                data: function(term) {
                    return {
                        // p_ids: (p_ids.length == 0 ? [0] : p_ids),
                        term: term
                    };
                },
                processResults: function(data) {
                    console.log(data);
                    return {
                        results: data
                    };
                },
                transport: function(params, success, failure) {
                    var $request = $.ajax(params);

                    $request.then(success);
                    $request.fail(failure);

                    return $request;
                }
            }
        });
    }

    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
