require('./bootstrap');

let vm;

Vue.http.get('/api/game/'+Laravel.Page.Id+'/state').then((response) => {
    response.data.role = Laravel.Page.Role;
    vm = new Vue({
        el: '#app',
        data: {
            data: response.data
        },
        methods: {
            flip: function (card) {
                if (!card.flipped) {
                    Vue.http.get('/api/game/'+Laravel.Page.Id+'/flip/'+card.y+'/'+card.x);
                }
            },

            turn: function (event) {
                Vue.http.get('/api/game/'+Laravel.Page.Id+'/turn');
            }
        }
    });

    let turn = function() {
        nextTurn = {
            "red":"blue",
            "blue":"red",
        };
        vm.currentTeam = nextTurn[vm.currentTeam];
    };

    var socket = io('http://'+(Laravel.Host)+':3001');
    socket.on("room:"+Laravel.Page.Id, response => {
        console.log(response.data);
        response.data.role = Laravel.Page.Role;
        vm.data = response.data;
    });

});

$(document).ready(function() {
    $("body").show();
});

