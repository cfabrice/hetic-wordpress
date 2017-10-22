'use strict'

var fs = require('fs'),
    Nightmare = require('nightmare');
const {
    exec
} = require('child_process');

var url = 'https://www.instagram.com/jr/?hl=fr';
var nightmare = Nightmare({
    show: false
});
var nightmare2 = Nightmare({
    show: false
});


function getImage() {
    nightmare.goto(url)
        .wait()
        .evaluate(function () {
            const img = document.querySelector('body > span > section > main > article > div > div > div > div > a > div > div > img')
            const link = document.querySelector('body > span > section > main > article > div > div > div > div > a')
            const isVideo = document.querySelector('body > span > section > main > article > div > div > div > div > a').childElementCount > 1;
            let src = img.src.split('/').pop()

            return {
                src,
                desc: img.alt,
                link: link.href,
                isVideo
            };
        })
        .end()
        .then(function (file) {
            if (file) {
                getDate(file)
            }
        });
}

function getDate(file) {
    nightmare2.goto(file.link)
        .wait()
        .evaluate(function () {
            return document.querySelector('time').getAttribute('datetime');
        })
        .end()
        .then(function (photoTime) {
            file.photoTime = photoTime
            const json = JSON.stringify(file)
            fs.writeFile('instagram.json', json, 'utf8')
            exec('wget https://scontent-cdt1-1.cdninstagram.com/t51.2885-15/e35/' + file.src + ' -O photo.jpg', (err, stdout, stderr) => {
                if (err) {
                    // node couldn't execute the command
                    return;
                }
            });
        });
}

var scrapper = nightmare.goto(url)
    .run(function (err, nightmare) {
        getImage();
    });