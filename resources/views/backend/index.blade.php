@extends('backend.master.master')
@section('title')
    Virginf - Admin
@endsection
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            @include('backend.index.statistical')
            @include('backend.index.custommer_review')
            @include('backend.index.order')
        </div>
    @endsection
