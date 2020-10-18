@extends('layouts.front') 


@section('content')
{!!$page->content!!}
<script>
    document.title="{{$page->title}}";
</script>
@endsection