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
          'User-Agent': data.userAgent
        }
    }
    var urlFinal = "";
    if(data.php == "74"){ urlFinal = `http://localhost:${php74}/`; }
    if(data.php == "81"){ urlFinal = `http://localhost:${php81}/`; }
    if(data.php == "82"){ urlFinal = `http://localhost:${php82}/`; }

    if(data.method == "GET"){
        axios
            .get(`${urlFinal}${domain}/${url}`, {} , options).then(function (response) {
                out(response.body);
            })
    }
}

module.exports = {
    sendHttp
}