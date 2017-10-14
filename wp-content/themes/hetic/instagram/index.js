var fs = require('fs'),
 Nightmare = require('nightmare');
const { exec } = require('child_process');

var url = 'https://www.instagram.com/jr/?hl=fr';
var nightmare = Nightmare({ show: false });
var scrapper = nightmare.goto(url)
                        .wait()
						.evaluate(function(){
                            const img = document.querySelector('body > span > section > main > article > div > div > div > div > a > div > div > img')
                            let src = img.src.split('/').pop()

                            var today = new Date();
                            var dd = today.getDate();
                            var mm = today.getMonth()+1; //January is 0!
                            var yyyy = today.getFullYear();
                            
                            if(dd<10) {
                                dd = '0'+dd
                            } 
                            
                            if(mm<10) {
                                mm = '0'+mm
                            } 
                            
                            today = dd + '/' + mm + '/' + yyyy;


                            return {
                                src,
                                desc : img.alt,
                                date : today
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
