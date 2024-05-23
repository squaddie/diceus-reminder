# Use the official PHP image with version 8
FROM php:8-cli

# Set working directory
WORKDIR /var/www/html

# Copy all files and folders to the container
COPY . /var/www/html

# Install required packages
RUN apt-get update && apt-get -y install cron \
    && apt-get -y install git \
    && apt-get clean

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Run composer dump-autoload
RUN composer dump-autoload

# Add crontab file
ADD crontab /etc/cron.d/crontab

# Give execution rights on the cron job
RUN chmod 0644 /etc/cron.d/crontab

# Apply cron job
RUN crontab /etc/cron.d/crontab

# Run cron in the foreground
CMD ["cron", "-f"]
