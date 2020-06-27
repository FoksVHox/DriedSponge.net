@extends('layouts.manage')
@section('title','Api Keys')
@section('description',"Manage api keys here")
@section('content')
    <div class="container" id="content">
        <h2>All Api Keys</h2>
        @can('Api.Create')
        <a href="{{route('api.create')}}" class="btn green">Create New Api Key</a>
        @endcan
        <div class="section">
            <table class="responsive-table">
                <thead>
                <tr>
                    <th>Name</th>
                    @can('Api.ViewKey')
                        <th>Key</th>
                    @endcan
                    <th>Uses</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th class="center-align">Settings</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($apikeys as $key)
                    <tr id="key-{{$key->id}}">
                        <td>{{$key->name}}</td>
                        @can('Api.ViewKey')
                            <td><span class="click-to-reveal badge white-text darken-4-5 pointer" data-revealed="false"
                                      data-reveal-content="{{$key->api_token}}">Click to reveal</span> <span
                                    class="blue-text pointer" onclick="Copy('{{$key->api_token}}')">(Copy)</span></td>
                        @endcan
                        <td>{{$key->current_usage}}</td>
                        <td><span data-position="right"
                                  data-tooltip="{{ \Carbon\Carbon::parse($key->created_at)->format('n/j/Y g:i A')}}"
                                  class="ts tooltipped">{{\Carbon\Carbon::parse($key->created_at)->diffForHumans()}}</span>
                        </td>
                        <td><span data-position="right"
                                  data-tooltip="{{ \Carbon\Carbon::parse($key->updated_at)->format('n/j/Y g:i A')}}"
                                  class="ts tooltipped">{{\Carbon\Carbon::parse($key->updated_at)->diffForHumans()}}</span>
                        </td>
                        <td class="center-align">
                            @can('Api.Edit')
                                <a href='/manage/api/{{$key->id}}' class="btn-small waves-effect waves-light green"><i
                                        class="material-icons center">show_chart
                                    </i></a>
                                <a href='/manage/api/{{$key->id}}/edit' class="btn-small waves-effect waves-light blue"><i
                                        class="material-icons center">mode_edit</i></a>
                            @endcan
                            @can('Api.Delete')
                                <button onclick="RevokeKey('{{$key->id}}')" data-position="right"
                                        data-tooltip="Revoke Key" class="btn-small red tooltipped"><i
                                        class="material-icons center">delete_sweep</i></button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <script>
            function RevokeKey(id) {
                axios({
                    method: 'DELETE',
                    url: '/manage/api/' + id,
                })
                    .then(function (response) {
                        if (response.data.success) {
                            AlertMaterializeSuccess(response.data.success);
                            $("#key-" + id).remove();
                        } else {
                            AlertMaterializeError(response.data.error);
                        }
                    });
            }
        </script>
    </div>
    <script>
        const observer = lozad(); // lazy loads elements with default selector as '.lozad'
        observer.observe();
    </script>
@endsection
