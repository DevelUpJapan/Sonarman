#!/bin/bash

swatch \
  --pid-file=/var/run/swatch.pid \
  --config-file=/home/sonarman/shells/swatchrc \
  --tail-file=/var/log/messages \
  --tail-args='--follow=name --retry -n 0 ---disable-inotify' &


