const express = require('express')
const { php82 , php74 , php81 , expressHandler , panel } = require("./config.json");
const { exec , spawn } = require("child_process");
console.log("Confirming assets");
var sites = require('data-store')({ path : '/opt/openhostpanel/user/sites.json' });
setInterval(() => {
    sites = require('data-store')({ path : '/opt/openhostpanel/user/sites.json' });
} , 100);
const { writeLogs } = require("./logwrite");
const { sendHttp } = require("./makephpreq");
const PATH = "/opt/openhostpanel/user/";
const PATH_PANEL = "/opt/openhostpanel/panel/";
const PATH_LOGS = "/opt/openhostpanel/logs/";
const SITE_PATH = "/opt/openhostpanel/sites/";
//Start Express Server at :80

const app80 = express()
app80.all('*', express.urlencoded({ extended : true }) , (req, res) => {
    var host = req.headers.host;
    var hostSite = host.replaceAll("." , "*");
    var body = req.body;
    var userAgent = req.headers['user-agent'];
    var ip = req.headers['x-forwarded-for'] || req.socket.remoteAddress
    console.log(`${req.originalUrl} or ${JSON.stringify(body)} in ${req.method}`);
    if(sites.get(hostSite)){
        sendHttp(
            host,
            req.originalUrl,
            {
                userAgent : userAgent,
                php : `${sites.get(hostSite).php}`,
                method : req.method,
                data : body
            },
            (out) => {
                res.send(out);
            }
        )
        writeLogs(`${PATH_LOGS}expressjs-out` , `Site Found : ${host} , ${hostSite} , ${userAgent} , ${ip} \n`);
    }else{
        res.send("Site not found!");
        writeLogs(`${PATH_LOGS}expressjs-out` , `Not Found : ${host} , ${hostSite} , ${userAgent} , ${ip} \n`);
    }
})
  
app80.listen(expressHandler, () => {
  writeLogs(`${PATH_LOGS}expressjs-out` , `:${expressHandler} Listening \n`);
})

//Start php82,php74,php81 Servers
const php74Server = spawn(`${PATH}php74/cli/php`, ['-S', `0.0.0.0:${php74}`, '-t' , SITE_PATH]);
const php81Server = spawn(`${PATH}php81/cli/php`, ['-S', `0.0.0.0:${php81}`, '-t' , SITE_PATH]);
const php82Server = spawn(`${PATH}php82/cli/php`, ['-S', `0.0.0.0:${php82}`, '-t' , SITE_PATH]);
const php82Panel = spawn(`${PATH}php82/cli/php`, ['-S', `0.0.0.0:${panel}`, '-t' , PATH_PANEL]);

php74Server.stdout.on('data', (data) => writeLogs(`${PATH_LOGS}php74-out` , `${data}`));
php74Server.stderr.on('data', (data) => writeLogs(`${PATH_LOGS}php74-error` , `${data}`));

php81Server.stdout.on('data', (data) => writeLogs(`${PATH_LOGS}php81-out` , `${data}`));
php81Server.stderr.on('data', (data) => writeLogs(`${PATH_LOGS}php81-error` , `${data}`));

php82Server.stdout.on('data', (data) => writeLogs(`${PATH_LOGS}php82-out` , `${data}`));
php82Server.stderr.on('data', (data) => writeLogs(`${PATH_LOGS}php82-error` , `${data}`));

php82Panel.stdout.on('data', (data) => writeLogs(`${PATH_LOGS}panel-out` , `${data}`));
php82Panel.stderr.on('data', (data) => writeLogs(`${PATH_LOGS}panel-error` , `${data}`));
