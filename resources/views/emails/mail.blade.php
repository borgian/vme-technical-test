Hello <strong>{{ $name }}</strong>,
<p>Product #{{$product_id}} has been {{$type}}.</p>
<p><b>These are the {{$type === 'updated' ? "changes" : "details"}}:</b></p>
<p>{!! $body !!}</p>