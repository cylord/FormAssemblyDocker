<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }
</style>    

<p>
    A new PDF has been Generated for Form ID: {{ $response }}.
</p>

<a href="{{ route('pdf.response', $response) }}">View and Download Here.</a>