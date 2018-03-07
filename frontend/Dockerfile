FROM yiisoftware/yii2-php:7.2-apache

# Create a symlink for apache (if `/var/www/html` is available)
RUN rm -rf /var/www/html && ln -s /app/frontend/web/ /var/www/html || true