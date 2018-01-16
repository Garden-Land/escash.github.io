/**
 * Created by ToXaHo on 23.04.2017.
 */
var io = require('socket.io').listen(8080);
var requestify = require('requestify');
var redis = require('redis');
var client = redis.createClient();
var users = {};

client.subscribe('purchase');
client.subscribe('balance');
client.on("message", function (channel, message) {
    if (channel == 'purchase') {
        var data = JSON.parse(message);
        io.sockets.emit(channel, data);
        if (!data.fake) {
            if (io.sockets.connected[users[data.User.id].socket]) {
                io.sockets.connected[users[data.User.id].socket].emit('balance', data.balanceTo);
                setTimeout(function () {
                    io.sockets.connected[users[data.User.id].socket].emit('balance', data.balance);
                }, 9e3);
            }
        }
    }
    if (channel == 'balance') {
        var user = JSON.parse(message);
        updateBalance(user);
    }
});

function updateBalance(user) {
    if (users[user.id]) {
        io.sockets.connected[users[user.id].socket].emit('balance', user.balance);
    }
}

io.sockets.on('connection', function (socket) {
    var user = false;
    updateOnline();
    socket.on('authenticate', function (data) {
        requestify.post('http://escash/api/authenticate', {
            token: data.token
        })
        .then(function (response) {
            var data = JSON.parse(response.body);
            if (!data.success) {
                socket.emit('unauthorized', 'token_invalid');
            } else {
                socket.emit('authenticated', data.returnValue);
                user = data.user;
                users[user.id] = {
                    socket: socket.id,
                    balance: user.balance
                };
            }
        })
    });
    socket.on('disconnect', function () {
        updateOnline();
    });
});

function updateOnline() {
    io.sockets.emit('online', Object.keys(io.sockets.connected).length);
}

setInterval(function () {
    fakeOpen();
}, 10000);

function fakeOpen() {
    requestify.post('http://escash/api/fakeOpen', {

    }).then(function (response) {

    });
}