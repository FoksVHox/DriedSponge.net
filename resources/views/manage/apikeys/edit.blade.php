@extends('layouts.manage')
@section('title','Edit '.$key->name)
@section('description','Edit '.$key->name)
@section('content')
    <div class="container" id="'content">
        <h2>Edit {{$key->name}} Key</h2>
        <a href="{{route('api.index')}}" class="btn">Go Back</a>
        @include('inc.FormMsg')
        <br>
        <br>
        <div class="card">
            <div class="card-content">
                <form id="edit-name">
                    <div class="input-field">
                        <input id='key_name' type="text" value="{{$key->name}}" maxlength="30" minlength="3"
                               class="validate">
                        <label for='key_name'>Key Name</label>
                        <span id="key_name-msg" class="helper-text" data-error="" data-success=""></span>
                    </div>
                    <button class="btn green" type="submit">Save Name</button>
                </form>
                <h4>Permissions</h4>
                @foreach ($permissionsAll as $perm)
                    <p>
                        <label>
                            <input
                                data-group="{{explode('.',$perm->name)[0]}}"
                                @if(isset(explode('.',$perm->name)[1])) data-second='{{explode('.',$perm->name)[1]}}'
                                @else data-second='null' @endif data-name="{{$perm->id}}" class="filled-in"
                                id="perm-{{$perm->id}}" type="checkbox"
                                @if ($key->hasPermissionTo($perm->name)) checked @endif >
                            <span>{{$perm->name}}</span>
                        </label>
                    </p>
                @endforeach
                <h4>Other</h4>
                <button onclick="Regen()" class="btn red"><i class="material-icons left">refresh</i> Regenerate Token</button>
            </div>
        </div>
        <script>
            function Regen() {
                axios({
                    method: 'PUT',
                    url: '/manage/api/{{$key->id}}',
                    data: {
                        regen: 1,
                    }
                })
                    .then(function (response) {
                        if (response.data.success) {
                            AlertMaterializeSuccess(response.data.success)
                        } else {
                            if (response.data.error) {
                                AlertMaterializeError(response.data.error);
                            }
                        }
                    });
            }

            $('input[type="checkbox"]').click(function (e) {
                e.preventDefault()
                let name = $(this).data('name');
                let group = $(this).data('group');
                let second = $(this).data('second');
                axios({
                    method: 'PUT',
                    url: '/manage/api/{{$key->id}}',
                    data: {
                        pid: name,
                        perm: 1
                    }
                })
                    .then(function (response) {
                        if (response.data.success) {
                            AlertMaterializeSuccess(response.data.success);
                            if (second === "*") {
                                $(`input[data-group="${group}"]`).prop('checked', response.data.status);
                                if (response.data.status === true) {
                                    $(`input[data-group="${group}"]`).prop('disabled', true);
                                    $(`input[data-group="${group}"][data-second='*']`).prop('disabled', false);
                                } else {
                                    $(`input[data-group="${group}"]`).prop('disabled', false);
                                }
                            } else if (group === "*") {
                                $('input[type="checkbox"]').prop('checked', response.data.status);
                                if (response.data.status === true) {
                                    $('input[type="checkbox"]').prop('disabled', true);
                                    $('input[data-group="*"]').prop('disabled', false);
                                } else {
                                    $('input[type="checkbox"]').prop('disabled', false);
                                }
                            } else {
                                $(`input[data-name="${name}"]`).prop('checked', response.data.status);
                            }
                        } else {
                            AlertMaterializeError(response.data.error);
                        }
                    });
            })
            $('#edit-name').submit(function (e) {
                e.preventDefault()
                $(this).hide()
                $('#loading').removeClass('d-none');
                axios({
                    method: 'PUT',
                    url: '/manage/api/{{$key->id}}',
                    data: {
                        key_name: $("#key_name").val()
                    }
                })
                    .then(function (response) {
                        $('#loading').addClass('d-none');
                        $('#edit-name').show()
                        if (response.data.success) {
                            MaterialValidate('#key_name')
                            AlertMaterializeSuccess(response.data.success)
                        } else {
                            if (response.data.error) {
                                AlertMaterializeError(response.data.error);
                            }
                            MaterialValidate('#key_name')
                            $.each(response.data, function (key, value) {
                                MaterialInvalidate('#' + key, value)
                            });
                        }
                    });
            })
        </script>
    </div>
    <script>
        const observer = lozad(); // lazy loads elements with default selector as '.lozad'
        observer.observe();
    </script>
@endsection
