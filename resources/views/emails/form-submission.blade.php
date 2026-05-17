<h2>New Form Submission</h2>
<p><strong>Form:</strong> {{ ucfirst($submission->form_name) }}</p>
<p><strong>Submitted At:</strong> {{ $submission->created_at->format('d M Y, H:i') }}</p>

<h3>Details:</h3>
<ul>
    @foreach($submission->data as $key => $value)
        <li><strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong> {{ is_array($value) ? json_encode($value) : $value }}</li>
    @endforeach
</ul>

<hr>
<p><small>IP Address: {{ $submission->ip_address }}</small></p>
