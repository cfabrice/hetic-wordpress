var fs = require('fs'),
 Nightmare = require('nightmare');
const { exec } = require('child_process');

var url = 'https://www.instagram.com/jr/?hl=fr';
var nightmare = Nightmare({ show: false });
var scrapper = nightmare.goto(url)
                        .wait()
						.evaluate(function(){
                            const img = document.querySelector('body > span > section > main > article > div > div > div > div > a > div > div > img')
                            const link = document.querySelector('body > span > section > main > article > div > div > div > div > a')
                            let src = img.src.split('/').pop()


                            return {
                                src,
                                desc : img.alt,
                                link : link.href
                            };
                        })
                        .end()
                        .then(function(img){
                            const json = JSON.stringify(img)
                            fs.writeFile('instagram.json', json, 'utf8')
                            exec('wget https://scontent-cdt1-1.cdninstagram.com/t51.2885-15/e35/' + img.src + ' -O photo.jpg', (err, stdout, stderr) => {
                              if (err) {
                                // node couldn't execute the command
                                return;
                              }
                            });
                        });
