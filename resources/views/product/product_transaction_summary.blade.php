<div class="card-header bg-orange text-white">
    <h6>Total</h6>
</div>
<div class="card-body">
    <div class="form-group">
        <label for="">Total</label>
        <input type="text" readonly class="sub_total form-control">
    </div>
    <div class="form-group">
        <label for="">Discount</label>
        <input type="text" readonly class="discount form-control">
    </div>
    <div class="form-group">
        <label for="">Net Payable</label>
        <input type="text" readonly class="net_payable form-control">
    </div>
    <div class="form-group">
        <label for="">Pay Amount</label>
        <input type="text" value="0" class="pay_amount form-control" onkeyup="calculate()">
    </div>
    <div class="form-group">
        <label for="">Due</label>
        <input type="text" readonly class="due form-control">
    </div>
    <button class="btn btn-success btn-sm mt-2">Create Invoice</button>
</div>

