@extends('layout.frontend')

@section('section')
<div class="mb-3 mt-3 col">
    <h1>Track Order</h1>
    <form id="orderForm" class="d-flex align-items-center row p-4" style="gap:10px">
        <label class="form-label required">Enter Order Id</label>
        <input type="text" class="form-control" placeholder="Enter Tracking Id" name="orderId" id="orderId" required />
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</div>

<script>
    const orderForm = document.getElementById('orderForm');
    orderForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const orderId = document.getElementById('orderId').value;
        if (orderId) {
            window.location.href = "{{ route('order.track', ':orderId') }}".replace(':orderId', orderId);
        }
    })
</script>
@endsection