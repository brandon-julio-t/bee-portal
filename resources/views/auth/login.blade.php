@extends('layout.layout')

@section('body')

    <div class="mx-auto my-16 max-w-sm">
        <form action="{{ route('auth.login') }}" method="POST" class="card grid grid-cols-1 gap-4">
            @csrf
            <h1 class="text-xl font-medium">Login</h1>
            <input type="email" name="email" placeholder="Email" class="form-input">
            <input type="password" name="password" placeholder="Password" class="form-input">
            <label class="flex items-center">
                <input type="checkbox" name="remember_me">
                <span class="ml-1">Remember Me</span>
            </label>
            <button type="submit" class="btn-primary">Login</button>
        </form>
    </div>

@endsection
