@extends('layouts.app')
@section('title','MC Server Status')
@if($query['success'])
@section('description',"Server Online - ".$query['info']['players']['online']."/".$query['info']['players']['max']." Players")
@section('color','#43B581')
@else
    @section('description',"Server Offline")
@section('color','#F04747')

@endif
@section('content')
    <br>
    <br>
    <div class="section ">
        <h1 class="center-align white-text section-header">SERVER STATUS</h1>
        <br>
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l6 offset-l3">
                    <style>
                        .preview_zone {
                            @if($query['success'])
                                 background-image: url({{$query['info']['favicon']}}), url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAAB8CAIAAAAuDC/+AAAACXBIWXMAAAsSAAALEgHS3X78AAARmElEQVR4nO2dbZOjthJGyc6MbUBICBAvxuPN/f9/8n4AY2H6eKdz8d1sslVPqVLJxNg6krrVajVJXxaiWpuLqvOTqK7MRDXFUVSZn0TVNhflsqOoxhlRrbei8sObKJ8eVaLPp9/lsoOo5Fr7z9pv24t3o3fbts3TkKfb9lwXoobKiKqKTBR1qDepKOqIofGizPFdVJ2nKtHn0/f05iQq+bPy19p/vR3yrDPZtv1s3CUoRCOdABCwvi5FnUMlqjh9iGpMphJ9Pn3PqkhFJZ9VKepae1GdyUQRgM+2FFXbTATw9Iel27avy7522/YcvKji9C4qFJlKl2b6wOqhpe/JAOpKpcFZScW189fOfVm+tXlrzVafoRbV2rx16bYd63Js7La9dl6Uz95F9S77uroym0dSqB5a+XvOEn5vcmkqlTpXSDJ7AYDn+vnHbDQ2VhQ92mffRHX2qBLNbPFLti4Vf+xfARCKXFK2F4Cx9pLKzhnRy9ICqPI3UVoAZNvIG9wNAHgFp8+2/Gztl1USgHNVSnJ9WfQ+30oLoDbvos4+U4kAiF+y9/KPba1JYMR5AlBlJ0nHvQAM3kmyrwbw2RQq7QYARlypBXAJ7hKKL8sRALIxg7fifkILoCk+RP3ZlSrRc2nfgwD60orSLkF7AQDl58qJGz0tgGAPovYCQBtSBAAjrvi3AfjeOpV2AwBeTb4XgHOdSyq0AMgG0A8m89O6oyjqaK0NIDBqAGSctTZgLwBkA/YCcA1WFAGgjlYDoFgHeCMOooMHAjBUmSSz1xJERo9WPwKAI702oui5agAU7SPboJ0BvU8l4dZcOwPI7dMCGKtcFAGgDdduADS9Y1qbvxpAKLJgT1vtBWAoU1EEhkIOagAwok/0P9BGiQB05UlSpgVQZccq/9iKR6IRRQB6dxL1cgB44gP/A4UKCAD84FQLwKcHMYrJHaED0BYHURSKeDkAsgEULCO3jKOD8pEnaQawwQCff9QCCOZDFAC42YApRBi1cni8LtVLkHaHfGm8KOrQszcq+fTg08PkccVaevzRqGoBSAYm2BNvrBYztmpvXfHQUhQ5xxlAAGh/QEKvpszJ7knKb71/fGBwW/RjA3PoygMBAJsk9/5TAKolukQA5ekgSrkEvRxAlR1jr3fRzR+NNxmnoToRANiXYPaGNrhG+yfab+ESRACIMIkAnL3RxN9NnZ/iyMei25CMt9npuUYjDDvzvDYHUdrwMgEgdx93wgSAHkAiAJ8NhlkkOQKw1wzYCwAtNQhA4wua1hqyDSQCcA0lhV8klY1Jo/GRLtoLgLjJeLLPoP5xxw9RtNJgMI4eQDODtBeAUGTxEfSim6Md93I2NrgRI1G2hPaQnQCQs4NL0KsBaJcgAnBLR4hDnuazxY6mKOleAGikIwDtWkZrvRbA99ZrDkB852L2ZtFtxxdvv/NLyLUzwJ2+idJ6QQQAvSDqOO3SpPWCtADOlYsjH4v2WoLK9E0UuafUPzTS0QbQiNYC0O4DyAYQgLEu48jHXS+2AeQdUf/QvgqXIO3Ojf5+LzeUjPDgbRx8XaTdB5DICyI3lLw+9RKk3blR7qZ2CbrUVjzoIAC0BGndUBItNZSCSDMes6mhf3YDwEm1MoCxKsQ4O3lBn6GKPrZadBuS8WnPsfcYjCNRLIgAKH+vubaNKMyMo50bPZgesBeAaxs/ol6kDcaRyN2kMDv9Xlq6v3dBVBKPplh1nnojAHj4/YsoTE0AKBZEAJa47kPoW0raPXWlegmiHS8BoH6Ld+mxbh3VPLQJneCU+dHdrzgdF10afwnus4m1XSJWtqEv7TQKlp1BKDIybpjwtLIBD86CcIFCnTgFM4CWoD+HWtQPQDb+oU3E4TA01mUHmx0nxZfKZv6x39Lkn01xbXQAtOnmtFRSunzkoX4tb0cJ4HsvizLv6HMQgE0/ivQwyaYfi6avG/stn3V2qc0nJFQTgHkUfDmzTOl1pHsBwCUIQhq7AZiWoEnxErQXAG0HkRtHqZKvBqDOO4LnIoCqSH2RTYovlc0psXHqUpWOVa4FQGkm9EUpZKIFoLUBnAMqG3M68CGbhwAal9fOTGpcvogAXCp5b0IAytOHGHshAOTeUaYeAcADFmWaCc0AzkmVPx8B1DarbD6pttmiOSU2chxHfzr7TAugzk9ijEULgHJVCQAesCgBUEdTWrwaAC1BewHQzgDaYWoBYHz/xQAIfCIvWHXRVbat3KSusotoCRq97KcP3vWlfTgY6JwhG6BNAyEAlE1NIYe9bABfDJGfiwD62nV1Oamv3aKfBYCMsHYGUEdos521ANAIiyfUXWWGpuwbP2loyrtgCTqXluJ6KgB0AkUfrjXCFPWkDqIBsdsMENPHW5/TEjR9rThr6lwehzIdXCHGxwkAGWEMUSgPfAgAHbBQR/NFDFlqL4gAhNI0ZTEplGbRzwKgPIdwZAMIAO4/lOnvT65GyzthOVGyzMgNnR4fZ9AP7tC7Uw8JEwSgMam4FNAPVobBa7rURydf6H2hdyQD4P0BABD3zY1LaSM2PT6umtDbj84eOzgu1gLAoBgAgDh7Q8E+OvvF/Qes3VoAtMTJAFqXTktQmHVfgqaqJZ2Ndexs+kUAjZsAFDOATUvlXij+/r1rRBFIAjD3yLRwRS19T3KE1DOArhD1ZdF6YU1/SMuZ1FuzLSI0/f1DPabq9g+Tqdy2t89/bPFoUFk2hmzA7YTnMbu/L21fFtuWRjSJwDwDoMn1NGdrz/YHAKpI9Dnk1SiLgeDajTYAvCzIfii00VYEQLcY15loP8x0M6Nzo3Pn8q7ZT4/qpvlIWgDKUggY3UQvCADABtDsBoAuUhMACopdyvJSlqO/a/IIV6UbI1Ff04jbCwDehIHzhpcDoFICBADTVbz/9P5S3TWNoLjGp42EM+nZJcAdAGh32gSA9hlqGwDulKVrpJSucq2qa7Uq7zcdyNj0sKiIRADA3ayehF9EaaOb2vsNtM/QXhxXA6DUu+91/b2ur81dU9/FtTlNpL8bAG12N+0zOCsCAMB/wHo+WgBxddo8EgGgO7B7AdBGWwkAVXHksPZOACjLlwBobQDFdvYCQPsGci7IBlDxEDLyLwdANkALYK8ZoI3vK9Px0QZoQxe7LUF7eUF72QD0dkDKq1poA+i8gbIlcB+g9YJoH/CzZoA2vk+/i/YlZANoo0e3MxPI5DppAdBOWAuAyuHsNQMIDP4u2JdQ/SICQCUSEijl+0EAsMRZUQxF0du7JnulBUBT/tVLEC6tsCTSDKBYE2XMJVDM+p0AkLHqjemN6Yq7pr/XAsBkWyUA7QkXORdaABTuppxR9QxAd60wD9oCcHOu9dFlRypjQ/X6VYGXscEjQDwnWFfBWURleLaVgqZ2Vdcoask4J7dFKi6k/K02OAO0elhSb5c+MA8HYzjRxbxY1EE0Y2gp0N4Ro3pBt2IuD+2pc0Vn3axoS5HcFql4+P9R5W8vArAkz7Yuxeph0gnd+pbkXdqNGz2CytrTCTsFK8mWnH0TqZpVlTgD6AHKLTsZ7XRzseu58IBI6zURAHqxA+2TaEAQgLEKYxXGqr6r9mPtk5v/FFuG92AP9IOVUUMEsLna+Fx4QLQXAKqqTgDoyhS5s0Pph7IeSn+Xd4N3CdyzxRGnBUBejRaA0ilAr4kA0E5VOwMIwH3Z8dXqnvDNbYi/ZTY2hh6gvBGPHbSh/lxmXS3lLigP864FQCmF5ONS/+CBVRPuitxZBEBTTHkjHgGcH+sLPFfxagB06Q43GbWcjk8ArqG9hvYhe+za1sltL/5QayH/uwFYV8y6C5NzXzwD6FouAbjUjVDlM7jdZoA2nEsA6Acro7NqAP85V6JoQKwvjt9FXqJYZ2G6JflrA9AaYfJ0/xy8KAJASxD1j9j7zwBojbA2nk5GWAsAb0kCALLztASRU0AASKuNenTTBgFo3VByvwgAuaHaAyLaZyjf6IFZC+QW0wpBAxQAFL88ACxkrXujB+b7EwBlaKTcjv0lLUUGoA1F0BacAFAoQguAwsV7AdCGRiiNfl1g7d7nCEAbjFO+hyCnYJz2zXt0YkXJvNTRJAoO0gClOkLr3r9/fgJ1734ZAHRDRptNrX3/wTZHfy6jSeFxafiPjUk+a78u/jNLOeLo9Va4BNHRIHXEunb0Dyt44RJEXhadN+A7JQAMvcc4umlq7womGb07V26sptu/95ZGOtkA7QygvBoCgDtMMMLKJcgq0/FxBtPre1dXfSMMyeBtV9mhMl1llvZJZViS2ghDXo02c20vAOTX7wrAR5oxJLcLwOZB1NG0BGl3wjSLCQDNADLCykP83QCQDTuH6hyqc9Pc21Cdg08ql1Uuq9wpVm3xAgW5WcowdU55NQSAZpj2vIEAkI3ZE0DTnJs2aptzqBKTvmfpu0m/Zdm3pTXpt+k641b8Eh9d1USaAWQDyMbYw7ukN+ogArB+R81f9+LwBG3u9wc1SZa+p9l7ln1Ls29Lm2UIgGMd+wCgzDWaAXQeoAWw1wyQATR+DN0YhkjdGLoxhMQUR1McTfERqyg+CAAtQVoAZIS1uZsUjKOdNgFwx3eR5Z4AmnHLIDmlb6f07ZT+EStN/wil7G5SR2uv+NBNee0MoPMAAkDhZQJANmaTyTBL/vzKIQBagvpacRjwJAqoBUCZbuQFEQAaoQSgPH2IZee1Z9oE4NL2l/Ycqb+0/aVtkyL7yLOPInvL87elLbK3oVEEu58cROwFgNxcLQCK75MR1h6p4vlBCLd1P1ZIbH6w+cHm77Fc9s5x7X2WICpXQzaAAJAN0Ka9rF8U99fdXIqeDo0f6nqoQ9TWQ+OTW0XWjwdplxrtRowA0BUfeq72RIwA0KE/HfjQDKDoaett621blvfW29YXSWPSqkib4lgVx6VtCkrLrqmjtUeSVLKMLjhQmJc6iEIRNEIp7YU+/9p5KE0mX3ipbbauWzLVXzolrclCkbXFKdhT3CrfB6C+Y0UASFR/XwsAR6jyzPl7X4l5RJDieIyLXk1dPylpTTarON1bk1Fcm8O20laLo7jU0dpyMlN3b9tzW4hqymNTThWpVqL4fvzaxFgEeJ3mvOgQF71qXD6VxGpcmqzzVe6t9kIEdXR0ypaNTTaGdAzp2GTTuPj620vnB21elywWeGpc2gfTt1kfTCTbBxuqPFR5qIoHnZUHMtQP+EK4xxk23ydIYK3XlwYQen/a+kf9Ho5jOI7hYwxHAsBlIgG81DtNeeyDadusbU0k27a2ropIdlKoilG3ZKG7zADkpfunADiOISUAXKn2tQAuYFT/AQCMxAABUDj61QA+waj+0gDSFYCv2YCfBeA61GJq4q8DYPbkHuPM0d9ksf5uAH79GfBjb2H193QrcUcbAF5Q5Px4O+vfAWDBYEcuor0LgNYdBw2A1he0s305AO2hNl3nFHrB5q3NH7ds1VxpZzf/mgEMIRuCuaux06tZIpmbsBQCZU1rK/AiAG1+/f8KYM5pfVKT+V8GQBtN1APYhDBLP3hHZ8J7AbiZ/fjLTx0R79jv+9J/8AxYd/1NvwHMAChaqQdwCyuKAOZ+r2/6DeAGgMK5rwQQhrL+DeD/A8Bsuj78BvC4BE0pQHF7+0KCuCJU2rh0bm3euHz6tKH0nfdD6TtfD2U9ta9fgtK40++qywcA69/7CgB38Nt+bpxJyvl1nau2zE9UwIhOWhqX1+XSTu/dMLUzS5Emm6UuTad2LtgEfacShS66In/Q1ONQQOpAAEDSvYEV+EXzLJxeDxz1xtwmxbqk8yJVvn9z6+6t7LpS2az88GoAuhJquRpAdAB305xW89D72dhkQzDx+5lj/QbwswGI/9Zlcu9ztrAOgMsOu/T+TwSwnCluliC7BbAsQRKAqLx8LD2AXFT8OvRYvzqAdRrLrbigPUW2d2UGXHZ4MD+TkvzwJuo3gOcANunsc7YE3TpFAHF9/1i/AfxoBuTBFMEUjyEc+TqqRQDxS3ZWL9z5DeApgLH2D+X37pF8gQEC+C/Jwoj8QGiyPgAAAABJRU5ErkJggg==);
                            @else
                                background-image: url(https://i.driedsponge.net/images/png/QrYpU.png), url(data:image/png;base64,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);
                        @endif
                        }
                    </style>
                    @if($query['success'])
                        <div class="preview_zone" id="preview_zone" style="">
                            <div class="server-name">Gaming Island <span class="ping">{{$query['info']['players']['online']}}<span>/</span>{{$query['info']['players']['max']}}</span>
                            </div>
                            <span class="preview_motd">
                            <?php $num = 0 ?>
                                @foreach($query['info']['description']['extra'] as $part)
                                    <?php $num += 1 ?>
                                    <style>
                                #des-{{$num}} {
                                    @isset($part['color'])
                                        @if($part['color'])
                                         color: {{$part['color']}};
                                    @endif
                                @endisset
                                @isset($part['bold'])
                                    @if($part['bold'])
                                         font-weight: bold;
                                    @endif
                                @endisset
                                @isset($part['italic'])
                                    @if($part['italic'])
                                         font-style: italic;
                                @endif
                            @endisset

                                }
                            </style>
                                    @if($part['text']=="\n")
                                        <br>
                                    @else
                                        <span id="des-{{$num}}">{{$part['text']}}</span>
                                    @endif
                                @endforeach
                        </span>
                        </div>
                    @else
                        <div class="preview_zone" id="preview_zone" style="">
                            <div class="server-name">Gaming Island</div>
                            <span class="preview_motd">
                                <span style="color: #AA0000">Can't connect to server</span>
                            </span>
                        </div>
                    @endif

                </div>
            </div>
            <br>
            <div class="center-align">
                <button data-target="consolelog" class="btn button-primary modal-trigger"><i
                        class="material-icons left">description</i> Open Console Log
                </button>
            </div>
            <div id="consolelog" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <h4 class="roboto">Latest Log</h4>
                    <p class="flow-text"><strong>Here is the server log. Don't worry, all IPs are censored. Download the
                            log if you want a more readable version.</strong></p>
                    <code>{{$log}}</code>
                </div>
                <div class="modal-footer">
                    <a href="{{route('pages.mc.log')}}" download="" class="waves-effect waves-green btn-flat blue-text">Download</a>
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Done</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        const observer = lozad(); // lazy loads elements with default selector as '.lozad'
        observer.observe();
    </script>
@endsection
