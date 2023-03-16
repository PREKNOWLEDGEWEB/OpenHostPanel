const fs = require('fs');
const writeLogs = (path , appendText) => {
    if(fs.existsSync(path)){
        fs.appendFile(path, appendText, function (err) {
            if (err) throw err;
        });
    }else{
        fs.writeFile(path, appendText, function (err) {
            if (err) throw err;
        });
    }
}

module.exports = {
    writeLogs
}