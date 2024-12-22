#!/bin/bash
# Start dnsmasq service
echo "Starting dnsmasq..."
service dnsmasq start

# Start Apache (or your web server)
echo "Starting Apache..."
apache2-foreground
