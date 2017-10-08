FROM nginx:latest

COPY ./conf.d/botme.key /etc/ssl/cert/botme.key
COPY ./conf.d/botme.crt /etc/ssl/cert/botme.crt
COPY ./conf.d/laravel.botme.conf /etc/nginx/conf.d/default.conf
