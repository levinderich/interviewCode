var express = require('express');
var http = require('http');
var router = express.Router();

// Change as per Part A
var host = '127.0.0.1';
var port = '80';
var path = '/lz-cpt375-a2/public';

router.get('/login', function (req, res, next) {
    res.render('login', {title: 'Login'});
});

router.post('/login', function (req, res, next) {
    var email = req.body.email;
    var password = req.body.password;

    var options = {
        host: host,
        port: port,
        path: path + '/api/admin?email=' + email + '&password=' + password
    };

    http.get(options, function (httpRes) {
        httpRes.on('data', function (chunk) {
            var body = chunk + '';
            if (body === 'success') {
                req.session.user = 'loggedin';
                res.redirect('/');
            }
            else if (body === 'fail') {
                res.redirect('/login');
            }
        });
    }).on('error', function (e) {
        console.log('ERROR: ' + e.message);
    });
});

router.get('/', function (req, res, next) {
    if (req.session.user === undefined) {
        res.redirect('/login');
    }
    else {
        var options = {
            host: host,
            port: port,
            path: path + '/api/movies'
        };

        http.get(options, function (httpRes) {
            httpRes.on('data', function (chunk) {
                var body = JSON.parse(chunk);
                res.render('index', {movies: body, title:'Movies'});
            });
        }).on('error', function (e) {
            console.log('ERROR: ' + e.message);
        });
    }
});

router.get('/movie/:id', function (req, res, next) {
    if (req.session.user === undefined) {
        res.redirect('/login');
    }
    else {
        var movieId = req.params.id;

        var options = {
            host: host,
            port: port,
            path: path + '/api/movie/' + movieId
        };

        http.get(options, function (httpRes) {
            httpRes.on('data', function (chunk) {
                var body = JSON.parse(chunk);
                res.render('movie', { movie: body.movie, cinemas: body.cinemas, title:'Movies' });
            });
        }).on('error', function (e) {
            console.log('ERROR: ' + e.message);
        });
    }
});

// Movie CRUD
router.post('/movie/create', function (req, res, next) {
    if (req.session.user === undefined) {
        res.redirect('/login');
    }
    else {
        var movieTitle = req.body.title;
        var moviePoster = req.body.poster;
        var movieFeatured = req.body.featured;

        var options = {
            host: host,
            port: port,
            path: path + '/api/movie/create',
            method: 'post',
            headers: {
                'Content-Type': 'application/json'
            }
        };

        var req = http.request(options, function (httpRes) {
            httpRes.on('data', function (chunk) {
                res.redirect('back');
            });
        });

        req.on('error', function (e) {
            console.log('ERROR: ' + e.message);
        });

        req.write('{ "movie-title": "' + movieTitle + '",' +
            ' "movie-poster": "' + moviePoster + '",' +
            ' "movie-featured": "' + movieFeatured + '" }');
        req.end();
    }
});

router.post('/movie/update/:id', function (req, res, next) {
    if (req.session.user === undefined) {
        res.redirect('/login');
    }
    else {
        var movieId = req.params.id;
        var movieTitle = req.body.title;
        var moviePoster = req.body.poster;
        var movieFeatured = req.body.featured;

        var options = {
            host: host,
            port: port,
            path: path + '/api/movie/update/' + movieId,
            method: 'post',
            headers: {
                'Content-Type': 'application/json'
            }
        };

        var req = http.request(options, function (httpRes) {
            httpRes.on('data', function (chunk) {
                console.log('BODY: ' + chunk)
                res.redirect('back');
            });
        });

        req.on('error', function (e) {
            console.log('ERROR: ' + e.message);
        });

        req.write('{ "movie-title": "' + movieTitle + '",' +
            ' "movie-poster": "' + moviePoster + '",' +
            ' "movie-featured": "' + movieFeatured + '" }');
        req.end();
    }
});

router.get('/movie/delete/:id', function (req, res, next) {
    if (req.session.user === undefined) {
        res.redirect('/login');
    }
    else {
        var movieId = req.params.id;

        var options = {
            host: host,
            port: port,
            path: path + '/api/movie/delete/' + movieId,
            method: 'post',
            headers: {
                'Content-Type': 'application/json'
            }
        };

        var req = http.request(options, function (httpRes) {
            httpRes.on('data', function (chunk) {
                res.redirect('back');
            });
        });

        req.on('error', function (e) {
            console.log('ERROR: ' + e.message);
        });

        req.write('');
        req.end();
    }
});

// Session CRUD
router.post('/session/create', function (req, res, next) {
    if (req.session.user === undefined) {
        res.redirect('/login');
    }
    else {
        var sessionMovie = req.body.movie;
        var sessionCinema = req.body.cinema;
        var sessionDate = req.body.date;

        var options = {
            host: host,
            port: port,
            path: path + '/api/session/create',
            method: 'post',
            headers: {
                'Content-Type': 'application/json'
            }
        };

        var req = http.request(options, function (httpRes) {
            httpRes.on('data', function (chunk) {
                res.redirect('back');
            });
        });

        req.on('error', function (e) {
            console.log('ERROR: ' + e.message);
        });

        req.write('{ "movie-id": "' + sessionMovie + '",' +
            ' "cinema-id": "' + sessionCinema + '",' +
            ' "date": "' + sessionDate + '" }');
        req.end();
    }
});

router.post('/session/update/:id', function (req, res, next) {
    if (req.session.user === undefined) {
        res.redirect('/login');
    }
    else {
        var sessionId = req.params.id;
        var sessionDate = req.body.date;

        var options = {
            host: host,
            port: port,
            path: path + '/api/session/update/' + sessionId,
            method: 'post',
            headers: {
                'Content-Type': 'application/json'
            }
        };

        var req = http.request(options, function (httpRes) {
            httpRes.on('data', function (chunk) {
                res.redirect('back');
            });
        });

        req.on('error', function (e) {
            console.log('ERROR: ' + e.message);
        });

        req.write('{ "date": "' + sessionDate + '" }');
        req.end();
    }
});

router.get('/session/delete/:id', function (req, res, next) {
    if (req.session.user === undefined) {
        res.redirect('/login');
    }
    else {
        var sessionId = req.params.id;

        var options = {
            host: host,
            port: port,
            path: path + '/api/session/delete/' + sessionId,
            method: 'post',
            headers: {
                'Content-Type': 'application/json'
            }
        };

        var req = http.request(options, function (httpRes) {
            httpRes.on('data', function (chunk) {
                consol
                res.redirect('back');
            });
        });

        req.on('error', function (e) {
            console.log('ERROR: ' + e.message);
        });

        req.write('');
        req.end();
    }
});

router.get('/bookings', function (req, res, next) {
    if (req.session.user === undefined) {
        res.redirect('/login');
    }
    else {
        var options = {
            host: host,
            port: port,
            path: path + '/api/bookings'
        };

        http.get(options, function (httpRes) {
            httpRes.on('data', function (chunk) {
                var body = JSON.parse(chunk);
                res.render('booking', {bookings: body, title:'Bookings'});

            });
        }).on('error', function (e) {
            console.log('ERROR: ' + e.message);
        });
    }
});

module.exports = router;
