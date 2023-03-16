const express = require('express')
const { php82 , php74 , php81 , expressHandler } = require("./config.json");
const { exec , spawn } = require("child_process");
const { writeLogs } = require("./logwrite");
const { sendHttp } = require("./makephpreq");
const PATH = "/opt/openhostpanel/user/";
const PATH_LOGS = "/opt/openhostpanel/logs/";
const SITE_PATH = "/opt/openhostpanel/sites/";
//Start Express Server at :80

const app80 = express()
app80.all('/', (req, res) => {
    var host = req.headers.host;
    var userAgent = req.headers['user-agent'];
    var ip = req.headers['x-forwarded-for'] || req.socket.remoteAddress

    console.log(host);
    console.log(userAgent);
    console.log(ip);
})
  
app80.listen(expressHandler, () => {
  writeLogs(`${PATH_LOGS}expressjs-out` , `:${expressHandler} Listening`);
})

//Start php82,php74,php81 Servers
const php74Server = spawn(`${PATH}php74/cli/php`, ['-S', `0.0.0.0:${php74}`, '-t' , SITE_PATH]);
const php81Server = spawn(`${PATH}php81/cli/php`, ['-S', `0.0.0.0:${php81}`, '-t' , SITE_PATH]);
const php82Server = spawn(`${PATH}php82/cli/php`, ['-S', `0.0.0.0:${php82}`, '-t' , SITE_PATH]);

php74Server.stdout.on('data', (data) => writeLogs(`${PATH_LOGS}php74-out` , `${data}`));
php74Server.stderr.on('data', (data) => writeLogs(`${PATH_LOGS}php74-error` , `${data}`));

php81Server.stdout.on('data', (data) => writeLogs(`${PATH_LOGS}php81-out` , `${data}`));
php81Server.stderr.on('data', (data) => writeLogs(`${PATH_LOGS}php81-error` , `${data}`));

php82Server.stdout.on('data', (data) => writeLogs(`${PATH_LOGS}php82-out` , `${data}`));
php82Server.stderr.on('data', (data) => writeLogs(`${PATH_LOGS}php82-error` , `${data}`));
