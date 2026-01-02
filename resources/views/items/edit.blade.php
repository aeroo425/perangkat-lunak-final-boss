@extends('layouts.app')

@section('content')
<h1>Edit Item</h1>

<form method="POST" action="{{ route('items.update', $item->id) }}">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ $item->title }}">
    <button type="submit">Update</button>
</form>
@endsection
