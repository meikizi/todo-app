@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="todo__alert">
        @if(session('message'))
            <div class="todo__alert--success">
                {{ session('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="todo__alert--danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="todo__content">
        <div class="form__title">
            <h2>新規作成</h2>
        </div>
        <form class="create-form" action="{{ route('todos.store') }}" method="post">
            @csrf
            <div class="create-form__input">
                <input type="text" class="create-form__input-text" name="content">
                <select class="create-form__input-select" name="category_id">
                    <option value="">カテゴリー</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="create-form__button">
                <button class="create-form__button-submit" type="submit">作成</button>
            </div>
        </form>
        <div class="form__title">
            <h2>Todo検索</h2>
        </div>
        <form class="search-form" action="{{ route('todos.search') }}" method="get">
            @csrf
            <div class="search-form__input">
                <input type="text" class="search-form__input-text" name="keyword" value="{{ old('keyword') }}">
                <select class="search-form__input-select" name="category_id">
                    <option value="">カテゴリー</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="search-form__button">
                <button class="search-form__button-submit " type="submit">検索</button>
            </div>
        </form>
        <div class="todo__table">
            <table class="todo__table__inner">
                <tr class="todo__table__row">
                    <th class="todo__table__header">
                        <span class="todo__table__header-item">Todo</span>
                        <span class="todo__table__header-item">カテゴリ</span>
                    </th>
                </tr>
                @foreach ($todos as $todo)
                <tr class="todo__table__row">
                    <td class="todo__table__data">
                        <form class="update-form" action="{{ route('todos.update') }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="update-form__inner">
                                <div class="update-form__input">
                                    <input type="text" class="update-form__input-text" name="content" value="{{ $todo['content'] }}">
                                    <input type="hidden" name="id" value="{{ $todo['id'] }}">
                                </div>
                                <div class="update-form__item">
                                    <p class="update-form__item-p">{{ $todo['category']['name'] }}</p>
                                </div>
                            </div>
                            <div class="update-form__button">
                                <button class="update-form__button-up" type="submit">更新</button>
                            </div>
                        </form>
                    </td>
                    <td class="todo__table__data">
                        <form class="delete-form" action="{{ route('todos.destroy') }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <div class="delete-form__button">
                                <input type="hidden" name="id" value="{{ $todo['id'] }}">
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
