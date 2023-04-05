@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
    <div class="category__alert">
        @if(session('message'))
            <div class="category__alert--success">
                {{ session('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="category__alert--danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="category__content">
        <form class="create-form" action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="create-form__input">
                <input type="text" class="create-form__input-text" name="name" value="{{ old('name') }}">
            </div>
            <div class="create-form__button">
                <button class="create-form__button-submit" type="submit">作成</button>
            </div>
        </form>
        <div class="category__table">
            <table class="category__table__inner">
                <tr class="category__table__row">
                    <th class="category__table__header">
                        category
                    </th>
                </tr>
                @foreach ($categories as $category)
                <tr class="category__table__row">
                    <td class="category__table__data">
                        <form class="update-form" action="{{ route('categories.update') }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="update-form__input">
                                <input type="text" class="update-form__input-text" name="name" value="{{ $category['name'] }}">
                                <input type="hidden" name="id" value="{{ $category['id'] }}">
                            </div>
                            <div class="update-form__button">
                                <button class="update-form__button-up" type="submit">更新</button>
                            </div>
                        </form>
                    </td>
                    <td class="category__table__data">
                        <form class="delete-form" action="{{ route('categories.destroy') }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <div class="delete-form__button">
                                <input type="hidden" name="id" value="{{ $category['id'] }}">
                                <button class="delete-form__button-dl" type="submit">削除</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
