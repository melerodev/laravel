@extends('base')

@section('content')
{!! strip_tags($post->texto, env('PERMITTED_TAGS')) !!}

<hr>

@foreach($post->comments as $comment)

<div class="card">
    <div class="card-body">
        {{ $comment->texto }}
    </div>
    <div class="card-footer text-muted text-end">
        {{ $comment->apodo }}, {{ $comment->created_at->locale('es')->isoFormat('hh:mm dddd D \d\e MMMM \d\e\l Y') }}
    </div>
</div>
<hr>

@endforeach

<hr>

<form action="{{ route('comment.store') }}" method="post">
    @csrf
    <input type="hidden" id="post_id" name="post_id" value="{{ $post->id }}">
    
    <div class="mb-3">
        <label for="correo" class="form-label">Correo</label>
        <input type="email" class="form-control" id="correo" name="correo" minlength="6"
                maxlength="100" required value="{{ old('correo') }}" placeholder="Introduce tu correo electrónico">
    </div>
    <div class="mb-3">
        <label for="apodo" class="form-label">Apodo</label>
        <input type="text" class="form-control" id="apodo" name="apodo" minlength="5"
                maxlength="40" required value="{{ old('apodo') }}" placeholder="Introduce el apodo">
    </div>

    <div class="mb-3">
        <label for="texto" class="form-label">Comentario</label>
        <textarea class="form-control" id="texto" required minlength="100" name="texto" placeholder="Introduce tu comentario">{{ old('texto') }}</textarea>
    </div>
    <hr>
    <div class="mb-3 float-end">
        <button type="submit" class="btn btn-secondary">Enviar comentario</button>
    </div>
</form>

<form action="{{ url('post/' . $post->id . '/comment') }}" method="post"></form>

<form action="{{ route('post.comment', ['post' => $post->id]) }}" method="post">
    @csrf
    <input type="hidden" id="post_id2" name="post_id" value="{{ $post->id }}">
    
    <div class="mb-3">
        <label for="correo2" class="form-label">Correo</label>
        <input type="email" class="form-control" id="correo2" name="correo" minlength="6"
                maxlength="100" required value="{{ old('correo') }}" placeholder="Introduce tu correo electrónico">
    </div>
    <div class="mb-3">
        <label for="apodo2" class="form-label">Apodo</label>
        <input type="text" class="form-control" id="apodo2" name="apodo" minlength="5"
                maxlength="40" required value="{{ old('apodo') }}" placeholder="Introduce el apodo">
    </div>

    <div class="mb-3">
        <label for="texto2" class="form-label">Comentario</label>
        <textarea class="form-control" id="texto2" required minlength="10" name="texto" placeholder="Introduce tu comentario">{{ old('texto') }}</textarea>
    </div>
    <hr>
    <div class="mb-3 float-end">
        <button type="submit" class="btn btn-secondary">Enviar comentario</button>
    </div>
</form>

@endsection

@section('titulo')
{{ $post->titulo }}
@endsection

@section('entrada')
{{ $post->entrada }}
@endsection

@section('by')
Publicado por
<a href="#">izvserver</a>
el {{ $post->created_at->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y') }}
@endsection