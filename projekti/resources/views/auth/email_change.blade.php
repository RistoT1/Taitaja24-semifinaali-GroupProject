<form method="POST" action="{{ route('email.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <label for="email">New Email:</label>
    <input type="email" name="Sähköposti" required>
    <button type="submit">Change Email</button>
</form>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
