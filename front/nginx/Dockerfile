
FROM node:latest AS storefront
COPY ./src /app
WORKDIR /app/client
RUN npm i webpack@^2.2.0 -g
RUN npm install
RUN webpack -p


FROM nginx

COPY ./conf.d/front.botme.conf /etc/nginx/conf.d/default.conf

COPY --from=storefront /app/client/build /var/www/html








