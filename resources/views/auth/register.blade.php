@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('会員登録') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('名前') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="ニックネームを入力してね">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレスを入力してね">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="sauna_history"
                                    class="col-md-4 col-form-label text-md-end">{{ __('サウナ歴') }}</label>

                                <div class="col-md-6">
                                    <input id="sauna_history" type="text" class="form-control" name="sauna_history"
                                        value="{{ old('sauna_histroy') }}" placeholder="サウナ歴はどれくらい？">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="home_sauna"
                                    class="col-md-4 col-form-label text-md-end">{{ __('ホーム') }}</label>

                                <div class="col-md-6">
                                    <input id="home_sauna" type="text" class="form-control" name="home_sauna"
                                        value="{{ old('home_sauna') }}" placeholder="ホームサウナはどこかな？">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="home_sauna"
                                    class="col-md-4 col-form-label text-md-end">{{ __('好きなサウナ') }}</label>

                                <div class="col-md-6">
                                    <input id="like_sauna" type="text" class="form-control" name="like_sauna"
                                        value="{{ old('like_sauna') }}" placeholder="好きなサウナはどんなところ？">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="profile"
                                    class="col-md-4 col-form-label text-md-end">{{ __('プロフィール') }}</label>

                                <div class="col-md-6">
                                    <input id="profile" type="text" class="form-control" name="home_sauna"
                                        value="{{ old('profile') }}" placeholder="あなたはどんなサウナー？">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="link"
                                    class="col-md-4 col-form-label text-md-end">{{ __('リンク') }}</label>

                                <div class="col-md-6">
                                    <input id="link" type="text" class="form-control" name="home_sauna"
                                        value="{{ old('link') }}" placeholder="みんなにシェアしたいもののリンクを貼ってね">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" placeholder="パスワードは何にしよう？">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('確認用パスワード') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password" placeholder="さっきのパスワードは覚えているかな？">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('登録') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
