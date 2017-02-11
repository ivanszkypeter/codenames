var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();

var arguments;

redis.subscribe('room', function(err, count) {
});

redis.on('message', function(channel, message) {
    message = JSON.parse(message);
    io.emit(channel + ':' + message.data.roomId, message.data);
});

http.listen(3001, process.argv[2], function(){
    console.log('Listening on Port '+process.argv[2]+':3001');
});