const axios = require("axios");
const { php82 , php74 , php81 } = require("./config.json");

var sendHttp = (
    domain,
    url,
    data,
    out
) => {
    let options = {
        headers: {
            'Content-Type' : 'application/json; charset=UTF-8',
            'Accept': 'Token',
            'User-agent' : data.userAgent,
            "Access-Control-Allow-Origin": "*",
        }
    }
    var urlFinal = "";
    if(data.php == "74"){ urlFinal = `http://localhost:${php74}/`; }
    if(data.php == "81"){ urlFinal = `http://localhost:${php81}/`; }
    if(data.php == "82"){ urlFinal = `http://localhost:${php82}/`; }

    if(data.method == "GET"){
        axios
            .get(`${urlFinal}${domain.replaceAll(".","-")}${url}`, {
                params : {}
            } , options).then(function (response) {
                out(response.data);
            })
            .catch(function (error) {
                out(error.response.data);
            })
            
    }else if(data.method == "POST"){
        console.log(data);
        axios({
            method: 'post',
            url: `${urlFinal}${domain.replaceAll(".","-")}${url}`,
            data: data.data,
            headers: {
                'Content-Type' : 'application/json; charset=UTF-8',
                'Accept': 'Token',
                'User-agent' : data.userAgent,
                "Access-Control-Allow-Origin": "*",
                "Array-data" : JSON.stringify(data.data)
            }
        }).then(function (response) {
            out(response.data);
            console.log(response.data);
          })
          .catch(function (error) {
            out(error.response.data);
          });
    }
}

module.exports = {
    sendHttp
}