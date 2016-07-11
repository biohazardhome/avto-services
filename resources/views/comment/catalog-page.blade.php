@extends('layouts.index')

@section('title', 'Отзывы автосервис '. $entity->name .' одинцово')
@section('description', '')

@section('content')
	@include('comment.index', ['comments' => $entity->comments])
@stop