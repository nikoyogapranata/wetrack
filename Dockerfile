# Gunakan PHP 8.0 dengan Apache sebagai base image
FROM php:8.0-apache

# Install dependensi sistem, dnsmasq, dan utilitas DNS
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    dnsmasq \
    dnsutils && \
    rm -rf /var/lib/apt/lists/*  # Bersihkan file yang tidak perlu untuk mengurangi ukuran image

# Install ekstensi PHP untuk GD, PDO, dan MySQL support
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo pdo_mysql mysqli gd

# Aktifkan modul Apache
RUN a2enmod rewrite env

# Setel direktori kerja untuk aplikasi
WORKDIR /var/www/html

# Salin konfigurasi Apache kustom
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf
RUN a2ensite 000-default.conf

# Salin file aplikasi ke dalam container
COPY . /var/www/html/

# Setel izin yang benar untuk file web
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Salin file konfigurasi dnsmasq (jika Anda memiliki file ini)
COPY dnsmasq.conf /etc/dnsmasq.conf

# Salin skrip entrypoint kustom
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# Setel entrypoint untuk menjalankan dnsmasq dan Apache
ENTRYPOINT ["/usr/local/bin/start.sh"]

# Ekspos port yang diperlukan (HTTP dan DNS)
EXPOSE 80 53/udp
