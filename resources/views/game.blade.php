<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet" type="text/css">

        <!-- Scripts -->
        <script language="javascript">
            window.Laravel {!! "= ".json_encode([
                'csrfToken' => csrf_token(),
                'Host' => Request::getHost(),
                'Page' => [
                    'Id' => $id,
                    'Role' => app('request')->input('role')
                ]
            ]) !!};
        </script>

    </head>
    <body style="display: none;">

        <div id="app" v-bind:class="[data.currentTeam == 'red' ? 'redTurn' : 'blueTurn']">
            <div id="redScore" class="scoreBox">
                <div class="element"></div>
                <div class="score">@{{ data.score.red }}</div>
            </div>

            <div id="redNext" class="next" v-if="data.currentTeam == 'red' && data.role == 'boss'" v-on:click="turn">
                <div>
                    @{{ data.nextButton }}
                </div>
            </div>

            <div id="wordsTable">
                <table style="width: 100%; height: 100%;">
                        <tr v-for="rows in data.table">
                            <td v-for="cell in rows" style="width: 20%">
                                <div class="card" v-on:click="flip(cell)" v-bind:data-type="cell.type" v-bind:class="{ flipped: cell.flipped }">
                                    <figure class="front" v-bind:class="[data.role == 'boss' ? cell.type : '']">
                                        <div class="element">
                                            @{{ cell.word }}
                                        </div>
                                    </figure>
                                    <figure class="back" v-bind:class="cell.type">
                                        <div class="element1"></div>
                                        <div class="element2"></div>
                                    </figure>
                                </div>
                            </td>
                        </tr>
                </table>
            </div>


            <div id="blueScore" class="scoreBox">
                <div class="element"></div>
                <div class="score">@{{ data.score.blue }}</div>
            </div>

            <div id="blueNext" class="next" v-if="data.currentTeam == 'blue' && data.role == 'boss'" v-on:click="turn">
                <div>
                    @{{ data.nextButton }}
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="//{{ Request::getHost() }}:3001/socket.io/socket.io.js"></script>

        <script src="/js/app.js"></script>

        @if ( Config::get('app.debug') )
            <script type="text/javascript">
                document.write('<script src="//localhost:35729/livereload.js?snipver=1" type="text/javascript"><\/script>')
            </script>
        @endif

    </body>
</html>
