<?php
/**
 * @var $advert \App\Entity\Adverts\Advert\Advert
 * @var $categories \App\Entity\Adverts\Category[]
 */
?>
@extends('layouts.mmaster')

@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="?" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card mb-3">
            <div class="card-header">
                Common
            </div>
            <div class="card-body pb-2">
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="title" class="col-form-label">Title</label>
                            <input id="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', $advert->title) }}" required>
                            @if ($errors->has('title'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price" class="col-form-label">Price</label>
                            <input id="price" type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price', $advert->price) }}" required>
                            @if ($errors->has('price'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('price') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Categories</label>
                        <select class="form-control select2" multiple style="width: 100%;" name="categories[]">
                            @foreach($categories as $category)
                                <option
                                        value="{{$category->id}}"
                                        {{ $advert->hasCategory($category->id) ? 'selected' : ''}}
                                >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="content" class="col-form-label">Content</label>
                    <textarea id="content"
                              data-image-url="{{ route('admin.ajax.upload.image') }}"
                              class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }} summernote" name="content" rows="10" required>{{ old('content', $advert->content) }}</textarea>
                    @if ($errors->has('content'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('content') }}</strong></span>
                    @endif
                </div>

                <div class="row">
                    @livewire('App\Http\Livewire\Admin\Products\ProductImage', ['advertId' => $advert->id])
                    <input type="file" name="files[]" multiple accept="image/*">
                    @if ($errors->has('file'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('file') }}</strong></span>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

    <script type="text/javascript">
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            $('.summernote').summernote({
                height: 300,
                callbacks: {
                    onImageUpload: function (files) {
                        var editor = $(this);
                        var url = editor.data('image-url');
                        var data = new FormData();
                        data.append('file', files[0]);
                        axios
                            .post(url + '?from=summernote', data).then(function (response) {
                            editor.summernote('insertImage', response.data);
                        })
                            .catch(function (error) {
                                console.error(error);
                            });
                    }
                }
            });
        })
    </script>
@endpush
