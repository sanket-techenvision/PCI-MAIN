<h3>PAYMENT</h3>

{!! Form::label('guarantee_amount', 'Guarantee Amount:') !!}
{!! Form::text('guarantee_amount', null, ['class' => 'form-control', 'id' => 'guarantee-amount']) !!}

<div id="payment-status" class="text-center">
    <button type="button" class="btn btn-primary" id="pay-button">Pay</button>
</div>

<div id="payment-success" style="display: none;">
    <p>Payment Successful!</p>
    {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'final-submit']) !!}
</div>
<div id="payment-failure" style="display: none;">
    <p>Payment Failed. Please try again.</p>
    <button type="button" class="btn btn-primary" id="retry-payment-button">Retry</button>
</div>
