#!/bin/bash
# Start dnsmasq service
service dnsmasq start

# Start Apache
apache2-foreground
