FROM php:7.4.9-fpm

COPY php.ini /usr/local/etc/php/

RUN apt update \
    && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
    && docker-php-ext-install pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer self-update

RUN apt-get update && \
    apt-get install -y locales && \
    echo "ja_JP UTF-8" > /etc/locale.gen && \
    locale-gen && \
    echo "export LANG=ja_JP.UTF-8" >> ~/.bashrc

RUN apt-get update && apt-get install -y cron procps

# Cronのインストール
RUN apt-get update && apt-get install -y cron

# Crontabファイルのコピー
COPY crontab /etc/cron.d/crontab

# Cronジョブの設定
RUN chmod 0644 /etc/cron.d/crontab
RUN crontab /etc/cron.d/crontab

# Cronデーモンの起動
# CMD cron && docker-php-entrypoint php-fpm

CMD service cron start && docker-php-entrypoint php-fpm

RUN touch /var/log/cron.log

WORKDIR /var/www