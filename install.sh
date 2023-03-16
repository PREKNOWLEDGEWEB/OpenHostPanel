cwd=$(pwd)
echo "##############################";
echo "#        OpenHostPnael       #";
echo "#          --Installer       #";
echo "##############################";
mkdir logs
#Downloading PHP Releases
echo "### =Downloading PHP 8.2.3 and 8.1.16 and 7.4.33 = ###";
mkdir cache
wget https://github.com/PREKNOWLEDGEWEB/PHP-Prebuilt/releases/download/8.2.3/php-8.2.3-sapi-x64.tar.xz -O cache/php823.tar.xz -q --show-progress
mkdir user/php82
echo "[Extracting php82 to user]";
tar -C ./user/php82 -xf ./cache/php823.tar.xz 

wget https://github.com/PREKNOWLEDGEWEB/PHP-Prebuilt/releases/download/8.1.16/php-8.1.16-sapi-x64.tar.xz -O cache/php8116.tar.xz -q --show-progress
mkdir user/php81
echo "[Extracting [php81] to user]";
tar -C ./user/php81 -xf ./cache/php8116.tar.xz 

wget https://github.com/PREKNOWLEDGEWEB/PHP-Prebuilt/releases/download/7.4.33/php-7.4.33-sapi-x64.tar.xz -O cache/php7433.tar.xz -q --show-progress
mkdir user/php74
echo "[Extracting php74 to user]";
tar -C ./user/php74 -xf ./cache/php7433.tar.xz 

echo "##                    ##";
echo "## Installing Node.js ##";
echo "##                    ##";

wget https://nodejs.org/download/release/v16.19.1/node-v16.19.1-linux-x64.tar.gz -O cache/node16191.tar.gz -q --show-progress
mkdir user/node16
echo "[Extracting node16 to user]";
tar -C ./user/node16 -xf ./cache/node16191.tar.gz

echo "./user/node16/node-v16.19.1-linux-x64" > user/jspath

echo "###                           ###";
echo "### PHP & Node.JS Installation Complete ###";
echo "###                           ###";

echo "###                           ###";
echo "### Testing php -v for all    ###";
echo "###                           ###";

$cwd/user/php74/cli/php -v
$cwd/user/php81/cli/php -v
$cwd/user/php82/cli/php -v

echo "### Symlinking OHS & Node.js  ###";
sudo rm /usr/bin/node
sudo rm /usr/bin/npm
sudo ln -s $cwd/user/node16/node-v16.19.1-linux-x64/bin/node /usr/bin/node
sudo ln -s $cwd/user/node16/node-v16.19.1-linux-x64/bin/npm /usr/bin/npm

sudo ln -s $cwd /opt/openhostpanel

sudo cp $cwd/ohspanel.service /etc/systemd/system/

echo "###                           ###";
echo "### Testing Node.js           ###";
echo "###                           ###";

/usr/bin/node -v
/usr/bin/npm -v

echo "###                           ###";
echo "### Installing Packages       ###";
echo "###                           ###";

/usr/bin/npm install

sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
sudo ufw allow 21/tcp
sudo ufw allow 9010/tcp

systemctl daemon-reload
systemctl start ohspanel
echo "OHSPanel is Up!";

echo "###                           ###";
echo "### State OK                  ###";
echo "###                           ###";

