#!/bin/bash
BASEDIR=$(dirname "$0")

# Infinite loop
while true; do
    "$BASEDIR/traitement-webhooks.sh" >> "$BASEDIR/log/traitement-webhooks.log" 2>&1
#   "$BASEDIR/traitement-webhooks.sh"
  sleep 5
done
