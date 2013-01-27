#!/bin/sh

git status

git add .
git commit -am "$2"
git push origin $3